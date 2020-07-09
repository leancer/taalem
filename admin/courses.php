<?php
	$title = "Course | Taalem Admin";
	include 'header.php';
	$dc = new Dataclass();
	$msg;
	$upst;
	$opmd="";
	if (isset($_GET['action']) and $_GET['action'] == "reject") {
		$rejid = $_GET['id'];
		$opmd = "$('#rejuser').modal('show');";
	}
	if (isset($_GET['action']) and $_GET['action'] == "approve") {
		$apid = $_GET['id'];
		$dcourse = $dc->getRow("select coursename,instid from course where courseid='$apid'");
		$apsub = "<p class='text-success'>Your Course Has Been Accepted</p>";
		$apsub = mysqli_real_escape_string($dc->getConn(),$apsub);
		$apmessage = "<p>Now your Course : ".$dcourse['coursename']." Has been Public for Everyone so You Can Share and Earn from this course</p>";
		$currenttime = date("Y-m-d H:i:s");
		$savemsg = $dc->saveRecord("insert into message(msgdatetime,subject,message,senderregid,receiverregid,status) values('$currenttime','$apsub','$apmessage','$_SESSION[regid]','$dcourse[instid]',0)");
		$upcoursest = $dc->saveRecord("update course set status=1 where courseid='$apid'");
		if ($upcoursest['success']) {
			$msg="Update successful";
			$upst=true;
			header("refresh: 3,courses.php");
		}else{
			$msg="Update unsuccessful";
			$upst=false;
		}
	}
	if (isset($_POST['btnrej'])) {
		$cid = $_POST['currentid'];
		$sub = $_POST['subject'];
		$message = $_POST['message'];
		$currenttime = date("Y-m-d H:i:s");
		$dcourse = $dc->getRow("select coursename,instid from course where courseid='$cid'");
		$message = "<strong>Your course: ".$dcourse['coursename']." is Rejected following Reason<br/>".$message;
		$savemsg = $dc->saveRecord("insert into message(msgdatetime,subject,message,senderregid,receiverregid,status) values('$currenttime','$sub','$message','$_SESSION[regid]','$dcourse[instid]',0)");
		if ($savemsg['success']) {
			$msg="Send successful";
			$upst=true;
		}else{
			$msg="Send unsuccessful";
			$upst=false;
		}
	}
	
	$coursed = $dc->getTable("SELECT c.courseid,c.coursename,c.`status`,i.instname, c.coursedate from instructor i, course c where i.regid=c.instid ORDER BY  c.`status` ASC,c.courseid DESC");
	function getCourseTotal($instid)
	{
		global $dc;
		$totalc = $dc->getRow("select count(courseid) as totalno from course where instid='$instid'");
		return $totalc['totalno'];
	}
	
	
?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.php">Dashboard</a>
			</li>
			<li class="breadcrumb-item active ">Courses</li>
		</ol>
		<div class="row text-center">
			<div class="col-md-6 offset-md-3" id="stmsgbox">
				<?php if (isset($msg) and $upst == false): ?>
				<div class="alert alert-danger" role="alert">
					<?= $msg ?>
				</div>
				<?php endif ?>
				<?php if (isset($msg) and $upst == true): ?>
				<div class="alert alert-success" role="alert">
					<?= $msg ?>
				</div>
				<?php endif ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-header">
						<div class="row">
							<div class="col-md-6 pt-2">
								<i class="fa fa-table"></i> <b>Courses</b>
							</div>
							<div class="col-md-6 text-right">
								
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="" width="100%" cellspacing="0">
								<thead>
									<tr class="text-center tblheading">
										<th style="display: none;">Course Id</th>
										<th style="display: none;">status</th>
										<th>Course Name</th>
										<th>Instructor Name</th>
										<th>Creation Date</th>
										<th>Enroll Students</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="text-center">
									<?php
												while ($courserw = mysqli_fetch_assoc($coursed)) {
																			
									?>
									<tr>
										<td style="display: none;"><?= $courserw['courseid'] ?></td>
										<td style="display: none;"><?= $courserw['status'] ?></td>
										<td><?= $courserw['coursename'] ?></td>
										<td><?= $courserw['instname'] ?></td>
										<td><?= $courserw['coursedate'] ?></td>
										<td>
											<?php
											$enrs = $dc->getRow("select count(enrollid) as totalen from courseenroll where courseid='$courserw[courseid]'");
											echo $enrs['totalen'];
											?>
										</td>
										<td class="text-center" style="font-size: 20px"><a href="../singlecourse.php?id=<?= $courserw['courseid'] ?>" class="mx-1 a-black" title="View"><i class="fa fa-eye"></i></a>
										<?php if ($courserw['status'] == 0) {
										?>
										<a href="courses.php?id=<?= $courserw['courseid'] ?>&action=approve"
										title="Approve" class="a-black"><i class="fa fa-check"></i></a>
										<?php } ?>
										<a href="courses.php?id=<?= $courserw['courseid'] ?>&action=reject" title="reject"class="a-black"><i class="fa fa-close"></i></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="rejuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Reject Course</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="courses.php" method="post">
				<input type="hidden" name="currentid" value="<?= $rejid ?>">
				<div class="form-group">
					<label for="">Subject</label>
					<input type="text" name="subject" class="form-control" Value="Your Course Has been Rejected" readonly>
				</div>
				<div class="form-group">
					<label for="">Add Detail Message</label>
					<textarea name="message" class="form-control" cols="30" rows="10"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="btnrej">Send</button>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<a href="courses.php" class="btn btn-secondary">Close</a>
			
		</div>
	</div>
</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
$('#courseTable').DataTable( {
});
$(document).ready(function(){
<?php echo $opmd; ?>
$("#stmsgbox").fadeOut(5000);
});
});
</script>
</body>
</html>