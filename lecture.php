<?php
	
	if (!isset($_GET['id']) and !isset($_GET['cid'])) {
		header('location: index.php');
	}
	$savecnt = array();
	$contentid;
	$opmd="";
	$title="Lecture | Taalem | Online Course Learning";
	require_once 'header.php';
	if (!isset($_SESSION['regid'])) {
		header('location: index.php');
	}
	if (!isset($_GET['id'])) {
		$cid = $_GET['cid'];
		$enroll = $dc->getRow("select * from courseenroll where courseid='$cid' and regid='$_SESSION[regid]'");
		if (empty($enroll)) {
			header("location: index.php");
		}
		$getcntid = $dc->getTable("SELECT contentid,contenturl from content where courseid='$cid' and contenttype != 'doc'");
		if ($getcntid->num_rows > 0) {
			while ($cnnrw = mysqli_fetch_assoc($getcntid)) {
				$contime = $dc->getRow("select timeplayed from playtime where contentid='$cnnrw[contentid]' and regid='$_SESSION[regid]'");
				if (empty($contime)) {
						$contentid = $cnnrw['contentid'];
						break;
					}else{
						$cucntime = getContentDuration($cnnrw['contenturl']);
						$insec = getInSeconds($cucntime);
						if ($insec == $contime['timeplayed']) {
							$savecnt[] = $cnnrw['contentid'];
							$stime = 0;
							continue;
						}else{
							$contentid = $cnnrw['contentid'];
							$stime = $contime['timeplayed'];
								break;
						}
						// $contime['timeplayed'];
					}
			}
			if (!isset($contentid)) {
				$contentid = $savecnt[0];
			}
		}else{
			header("location: index.php");
		}
		// $contentid = $getcntid['contentid'];
	}else{
		$getcid = $dc->getRow("select courseid from content where contentid='$_GET[id]'");
		$enroll = $dc->getRow("select * from courseenroll where courseid='$getcid[courseid]' and regid='$_SESSION[regid]'");
		if (empty($enroll)) {
			header("location: index.php");
		}
			$contentid = $_GET['id'];
	}
	function showContentsl($secid){
		global $dc;
		$complete = "";
		$content = $dc->getTable("select contentid,contentname,contenttype,contenturl from content where sectionid='$secid'");
		while ($cntrw = mysqli_fetch_assoc($content)) {
			$contime = $dc->getRow("select timeplayed from playtime where contentid='$cntrw[contentid]' and regid='$_SESSION[regid]'");
		if ($cntrw['contenttype'] != 'doc') {
			$cucntime = getContentDuration($cntrw['contenturl']);
					$insec = getInSeconds($cucntime);
					if ($insec == $contime['timeplayed']) {
						$complete = "completed";
					}
			echo '<p><i class="fas fa-video a-black"></i><a href="lecture.php?id='.$cntrw['contentid'].'" class="a-black">'.$cntrw['contentname'].'</a><br/><span class="text-success">'.$complete.'</span><span class="float-right a-black">'.getContentDuration($cntrw['contenturl']).'</span></p><hr/>';
		}
		}
	}
		$content = $dc->getRow("select cn.contentname,cn.contenturl, c.courseid, c.coursetype, c.coursename,c.instid,i.instname from content cn, course c, instructor i WHERE cn.courseid=c.courseid and c.instid = i.regid and cn.contentid='$contentid'");
		if (isset($_GET['cid'])) {
			$coid = $_GET['cid'];
		}else{
			$coid = $getcid['courseid'];
		}

		$totalcnt=$dc->getRow("select count(contentid) as totalcontent from content where courseid='$coid'");
			$totalf=$dc->getRow("select noc,cmpdate from cmprecord where courseid='$coid' and regid='$_SESSION[regid]'");
		 	if ($totalf['noc'] == '') {
		 		$totalf['noc'] = 0;
		 	}
		 	if ($totalf['noc'] == $totalcnt['totalcontent']) {
		 		if ($totalf['cmpdate'] == '') {
		 			$cudate = date("Y-m-d");
		 			$ss = $dc->saveRecord("update cmprecord set cmpdate = '$cudate' where courseid='$coid' and regid='$_SESSION[regid]'");
		 		}
		 		if ($content['coursetype'] != 'free') {
		 			$opmd= '$("#completed").modal("show");';	
		 		}
		 			
		 	}
		
		if (isset($_POST['btnque'])) {
			$currenttime = date("Y-m-d H:i:s");
			$getemail = $dc->getRow("select email from register where regid='$_SESSION[regid]'");
			$apsub = "<p>Have Query on Your Lecture</p>";
			$apmessage = "<p>".$_SESSION['username']." Ask Question About your Lecture : ".$content['contentname']."<br/>Question : ".$_POST['que']."<br/> You Can Reply with Email : ".$getemail['email']." </p>";
			$savemsg = $dc->saveRecord("insert into message(msgdatetime,subject,message,senderregid,receiverregid,status) values('$currenttime','$apsub','$apmessage','$_SESSION[regid]','$content[instid]',0)");
		}
?>
<div class="titlepage">
	
	<h3><?= $content['contentname'] ?></h3>
	<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> <a href="<?= URL.'cart.php' ?>"  class="a-white"> Course </a> <i class="fas fa-angle-right a-white"></i> <a href="<?= URL.'singlecourse.php' ?>"  class="a-white"> Single Course </a></p>
	
</div>
<div class="container-fluid p-5">
	<div class="row">
		<div class="col-md-9">
			<div class="show-video">
				<video id="video-active" width="100%" controlslist="nodownload" controls>
					<source src="content/<?= $content['contenturl'] ?>#t=<?= $stime ?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
			</div>
			
			<div>
				<?php
				$np = $dc->getTable("select contentid from content where ( contentid = IFNULL((select min(contentid) from content where contentid > '$contentid'),0) or  contentid = IFNULL((select max(contentid) from content where contentid < '$contentid'),0)) and courseid='$content[courseid]' and contenttype != 'doc'");
					while($nprw = mysqli_fetch_assoc($np)){
						if ($nprw['contentid'] < $contentid) {
							echo '<a href="lecture.php?id='.$nprw['contentid'].'" class="btn btn-primary">Previous</a>';
						}
						if ($nprw['contentid'] > $contentid) {
							echo '<a href="lecture.php?id='.$nprw['contentid'].'" id="nextbtn" class="btn btn-primary float-right">Next</a>';
						}
					}
				?>
				
				
				<div class="clearfix"></div>
			</div>
		</div>
		<?php 
			$totalcnt=$dc->getRow("select count(contentid) as totalcontent from content where courseid='$coid'");
			$totalf=$dc->getRow("select noc from cmprecord where courseid='$coid' and regid='$_SESSION[regid]'");
		 	if ($totalf['noc'] == '') {
		 		$totalf['noc'] = 0;
		 	}
		 ?>
		<div class="col-md-3 vdlist">
			<h5 class="float-left">Lectures List</h5>
			<h5 class="float-right" title="Lectures complete"><?= $totalf['noc'] ?>/<?= $totalcnt['totalcontent'] ?></h5>
			<div class="clearfix"></div>
			<div class="vdlist-inner">
				<div id="accordion">
					<?php
									$collapes = 1;
									$sections = $dc->getTable("select sectionid,sectionname,sectiondesc from section where courseid='$content[courseid]'");
									while ($secrw = mysqli_fetch_assoc($sections)) {
									
					?>
					<div class="card">
						<div class="card-header">
							<a class="card-link a-black" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $collapes ?>" style="display:block;">
								<i class="fas fa-angle-down mr-2"></i><?= $secrw['sectionname'] ?>
							</a>
						</div>
						<div id="collapse<?= $collapes ?>" class="collapse show">
							<div class="card-body">
								<?php showContentsl($secrw['sectionid']); ?>
							</div>
						</div>
					</div>
					<?php
						$collapes++;
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container mx-5">
	<div class="row">
		<div class="col-md-12">
			<h2><?= $content['contentname'] ?></h2>
			<h3 class="text-muted" style="margin:0;"><?= $content['coursename'] ?></h3>
			<h5 class="text-muted">By <?= $content['instname'] ?></h5>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-md-12">
			<h4>Have Any Query About This Lecture ?</h4>
			<form action="" method="post">
				<input type="text" name="que" class="form-control mb-2" style="width: 40%;">
				<input type="submit" name="btnque" class="btn btn-primary" value="Send">
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="completed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><b>Course Completed</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h3 class="text-muted">Congratulations You Completed the Course</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="certificate.php?cid=<?= $coid ?>" class="btn btn-primary">Get Certificate</a>
			</div>
		</div>
	</div>
</div>
<?php require_once 'footer.php'; ?>
<script>
	var curtime;
	var regid=<?php echo $_SESSION['regid']; ?>;
	var cntid=<?= $contentid ?>;
	var coid=<?= $coid ?>;
	var cmp;
	var cntt= 1;
	$(document).ready(function(){
		<?= $opmd ?>
		$("#video-active").on(
		"timeupdate",
		function(event){
			console.log(Math.round(this.currentTime));
		curtime = Math.round(this.currentTime);
			if (Math.round(this.currentTime) == Math.round(this.duration)){
				if (cntt==1) {
					$.ajax({
						url: "inc/savetime.php",
						method: "get",
						data: { rgid: regid, coid: coid },
							success:function(data){
							console.log(data);
						}
					});
				}
				cntt++;
				if ($('#nextbtn').length) {
					$('#nextbtn')[0].click();
				}else{
					
					$.ajax({
						url: "inc/savetime.php",
						method: "get",
						data: { ctime: curtime, rgid: regid, cnid: cntid },
							success:function(data){
							console.log(data);
						}
					});
					window.location = "lecture.php?cid="+coid;
				}
			}
		});
	});



window.onbeforeunload = function()        //When the user leaves the page(closes the window/tab, clicks a link)...
{
var regid=<?php echo $_SESSION['regid']; ?>;
var cntid=<?= $contentid ?>;    //Find out how long it's been.
var xmlhttp;        //Make a variable for a new ajax request.
if (window.XMLHttpRequest)        //If it's a decent browser...
{
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();        //Open a new ajax request.
}
else        //If it's a bad browser...
{
// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");        //Open a different type of ajax call.
}
var url = "inc/savetime.php?ctime="+curtime+"&rgid="+regid+"&cnid="+cntid;        //Send the time on the page to a php script of your choosing.
xmlhttp.open("GET",url,false);        //The false at the end tells ajax to use a synchronous call which wont be severed by the user leaving.
xmlhttp.send(null);        //Send the request and don't wait for a response.
}
</script>
</body>
</html>