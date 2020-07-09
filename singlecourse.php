<?php

	$title="single course | Taalem | Online Course Learning";
	require_once 'header.php';
	if (!isset($_GET['id'])) {
		header('location: index.php');
	}

	//get id
	$courseid = $_GET['id'];


	//get instructor and course detail
	$course = $dc->getRow("SELECT c.*,ct.catname,i.instname from course c, category ct,instructor i where c.catid = ct.catid and c.instid=i.regid AND c.courseid = '$courseid'");
	$inst = $dc->getRow("select photo,qualification,about from instructor where regid='$course[instid]'");

	//get status
	if ($course['status'] == 0) {
		$st = false;
	}else{
		$st = true;
	}

	if (isset($_SESSION['regid'])) {
		if ($_SESSION['usertype'] == "admin" or $_SESSION['regid'] == $course['instid']) {
				$ust = true;
			}else{
				$ust = false;
			}
	}else{
		$ust=false;
	}


	if (!$st and !$ust) {
		header("location: index.php");
	}

	//finds total hours of videos in course
	$totalcoursetime=totalHour($course['courseid']);
	if (empty($course)) {
		header('location: index.php');	
	}

	$social = $dc->getTable("select socialbrandname,url from social where regid='$course[instid]'");
	$socialicon = array(
						"facebook"=>"fab fa-facebook",
						"twitter"=>"fab fa-twitter",
						"instagram"=>"fab fa-instagram",
						"gplus"=>"fab fa-google-plus",
						"linkedin"=>"fab fa-linkedin",
						"websitelink"=>"fas fa-globe"
	);

	//for store review
	if (isset($_POST['btnrv'])) {
		$currentcid = $_POST['courseidr'];
		$nos = $_POST['star'];
		$todaydate = date("Y-m-d");
		$revmsg = mysqli_real_escape_string($dc->getConn(),$_POST['review']);


		$apsub = "<p class='text-success'>Has Reviewed your Course</p>";
		$apsub = mysqli_real_escape_string($dc->getConn(),$apsub);
		$apmessage = "<p>rating : ".$nos."<br/>Message : ".$revmsg." <br/><i>This Message Automated By System</i></p>";
		$apmessage = mysqli_real_escape_string($dc->getConn(),$apmessage);
		$currenttime = date("Y-m-d H:i:s");

		$savemsg = $dc->saveRecord("insert into message(msgdatetime,subject,message,senderregid,receiverregid,status) values('$currenttime','$apsub','$apmessage','$_SESSION[regid]','$course[instid]',0)");

		$saverev = $dc->saveRecord("insert into review(courseid,regid,revdesc,rating,revdate) values('$currentcid','$_SESSION[regid]','$revmsg','$nos','$todaydate')");
		if ($saverev['success']) {
			header("location: singlecourse.php?id=".$currentcid);
		}else{
			echo '<script> alert("'.$saverev['error'].'");</script>';
		}

	}

	//get Free Enroll Courses
	if (isset($_POST['btnenroll'])) {
		$id = $_POST['btnenroll'];
		$enrolldate = date("Y-m-d");

		if (isset($_SESSION['regid'])) {
			$saveenroll = $dc->saveRecord("insert into courseenroll(courseid,regid,enrolldate) values('$id','$_SESSION[regid]','$enrolldate')");
			if ($saveenroll['success']) {
				header("location: usercourse.php");
			}else{
				echo '<script>'.$saveenroll['error'].'</script>';
			}
		}else{
			header("location: login.php");
		}
	}


	// cart entry
	if (isset($_POST['btncart'])) {
		if (!isset($_SESSION['regid'])) {
			header("location: login.php");
		}
		$all = $dc->getTable("select * from cart where courseid='$courseid' and regid='$_SESSION[regid]'");
		$norc = mysqli_num_rows($all);
		if ($norc > 0) {
			echo '<script> alert("Already In Cart");</script>';
		}else{
			$addcart = $dc->saveRecord("INSERT INTO cart(courseid,regid) VALUES('$courseid','$_SESSION[regid]')");

			if ($addcart['success']) {
				header("location: cart.php");
			}else{
				echo '<script> alert("Error in Add to Cart");</script>';
			}
		}
	}



	if (isset($_SESSION['regid'])) {
		$getenrolld = $dc->getRow("select * from courseenroll where courseid='$courseid' and regid='$_SESSION[regid]'");
	}
	
?>

		<div class="titlepage">
			
			<h1><a href="search.php?catid=<?= $course['catid'] ?>" class="a-white"><?= $course['catname'] ?></a></h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> <a href="<?= URL.'cart.php' ?>"  class="a-white"> Course </a>

		</div>

		<div class="container mt-5">
			<div class="row">
					<div class="col-md-8">
						<h1 style="margin-bottom: 0px"><?= $course['coursename'] ?></h1>
						<p class="text-muted"> Posted on <?php echo date("d M Y",strtotime($course['coursedate'])); ?></p>
						<hr/>
						<div class="row curdesc">
							<div class="col-md-4">
								<p><span class="text-muted">Created By</span> : <?= $course['instname'] ?></p>
								<p><i class="fas fa-clock text-muted mr-1"></i><?php echo $totalcoursetime; ?></p>
							</div>
							<div class="col-md-4">
								<p><span class="text-muted">Skill Level</span> : <?php echo ucfirst($course['skilllevel']); ?></p>
								<p><i class="fas fa-language"></i> <?php echo ucfirst($course['lang']); ?></p>
							</div>
							<div class="col-md-4">
								
								<p><span class="text-muted">Rating</span> : <?php echo getRatingStar($courseid)."(".getTotalRating($courseid)." Rating)"; ?></p>
									 <?php $totalenroll = $dc->getRow("select count(enrollid) as total from courseenroll where courseid='$courseid'"); ?>
								<p><i class="fas fa-users"></i> <?= $totalenroll['total'] ?> Student(s) Enrolled.</p>
							</div>
						</div>

						<img class="rounded" src="content/<?= $course['thumbnailurl'] ?>" width="100%" height="350px;">
					</div>
					<div class="col-md-4">
						<div class="card ">
							<?php 
								if (empty($course['thumbvidurl'])) {
									echo '<img src="content/'.$course['thumbnailurl'].'" class="courseimg">';
								}else{
									?>
									<video width="100%" height="200px" controlslist="nodownload" controls>
				  						<source src="content/<?= $course['thumbvidurl'] ?>" type="video/mp4">
										  Your browser does not support the video tag.
										</video>
									<?php
								}
							 ?>
							<div class="card-body">
								<h1 style="color:#505763">
								<?php if ($course['coursetype'] == 'free') {
									echo 'Free';
								}else{
									echo "₹ ".$course['price'];
								} ?>

								</h1>
								
								<form action="" method="post">
									<div class="form-group">
										<?php 
										if (isset($_SESSION['regid']) and $_SESSION['regid'] == $course['instid']) {
											echo '<a href="instructor/mycourses.php" class="btn-block btn-lg btn btn-custom mt-3">Mange Courses</a>';
										}else if(isset($_SESSION['regid']) and $_SESSION['regid'] == $getenrolld['regid']){
											echo '<a href="lecture.php" class="btn-block btn-lg btn btn-custom mt-3">View Course</a>';
										}else{
											if ($course['coursetype'] == 'free') {
												?>
												<button type="submit" name="btnenroll" id="btncart" value="<?= $courseid ?>" class="btn-block btn-lg btn btn-custom mt-3">Enroll Now</button>
												<?php
											}else{
												?>
												<input type="submit" name="btncart" id="btncart" value="Add to Cart" class="btn-block btn-lg btn btn-custom mt-3">	
												<?php
											} 
										}?>
									</div>
						      	</form>
							</div>
							<div class="ml-3">
								<h4>Includes :</h4>
								<p><i class="fas fa-video"></i> <?= $totalcoursetime ?> videos</p>
								<p><i class="fas fa-file-alt"></i> 2 Supplement</p>
								<p><i class="fas fa-check-circle"></i> Lifetime Access</p>
								<p><i class="fas fa-trophy"></i> Certificate Of Completion</p>
							</div>
						</div>
					</div>
			</div>

			<div class="row mt-5">
				<div class="col-md-12">
					<div style="width:750px;">
					<ul class="nav nav-tabs" role="tablist">
					    <li class="nav-item">
					      <a class="nav-link active" data-toggle="tab" href="#about">About</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="tab" href="#curriculum">Curriculum</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="tab" href="#instructor">Instructor</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="tab" href="#reviews">Reviews</a>
					    </li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div id="about" class="container tab-pane active"><br>
					      <h2>About</h2>
					      <div>
					      	<?= $course['description'] ?>
					      </div>

					      <h4>What you will Learn</h4>
					      <div class="ml-4">
					      	<?php 
					      		$ww = explode("`", $course['whatlearn']);
					      		for ($i = 0; $i < count($ww)-1 ; $i++) {
					      			echo '<p><i class="fas fa-check mr-2"></i>'.$ww[$i].'</p>';
					      		}
					      	 ?>
						      
					      </div>

					      <h3>Reqiurement</h3>
						  <div class="ml-4">
						      <?php 
					      		$rq = explode("`", $course['prerequirement']);
					      		for ($i = 0; $i < count($rq)-1 ; $i++) {
					      			echo '<p><i class="fas fa-check mr-2"></i>'.$rq[$i].'</p>';
					      		}
					      	 ?>
					      </div>
					    </div>

					    <div id="curriculum" class="container tab-pane fade"><br>
							<div id="accordion">

								<?php 
									$collapes = 1;
									$sections = $dc->getTable("select sectionid,sectionname,sectiondesc from section where courseid='$course[courseid]'");
									while ($secrw = mysqli_fetch_assoc($sections)) {
									    
								 ?>
							    <div class="card">
							      <div class="card-header">
							        <a class="card-link a-black" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $collapes ?>" style="display:block;">
							          <i class="fas fa-angle-down mr-2"></i><?= $secrw['sectionname'] ?>
							        </a>
							      </div>
							      <div id="collapse<?= $collapes ?>" class="collapse">
							        <div class="card-body">
							        	<p class="text-muted ml-3"><?= $secrw['sectiondesc'] ?></p>
							          	<?php showContents($secrw['sectionid']); ?>
							        </div>
							      </div>
							    </div>
							    <?php 
							    	$collapes++;
								} ?>
							  </div>					     
					    </div>


					    <div id="instructor" class="container tab-pane fade"><br>
					    	<div class="row">
					    		<div class="col-md-3">
					    			<img class="rounded-circle" src="<?= $inst['photo'] ?>" alt="" width="170px" height="170px">
					    		</div>
					    		<div class="col-md-9">
					    			<h1><?= $course['instname'] ?></h1>
					    			<p class="ml-1"><?= $inst['qualification'] ?></p>
					    			<div>
					    				<?= $inst['about'] ?>

					    			</div>
					    		</div>
					    	</div>
					    	<div class="row">
					    		<div class="col-md-4">
					    			<a href="profile.php?id=<?= $course['instid'] ?>" class="btn btn-outline-primary btn-lg">View Profile</a>	
					    		</div>
					    		<div class="col-md-8 social-icon mt-3">
					    			<?php 
										while($rw = mysqli_fetch_array($social)){ 
											if ($rw['url'] != '') {
												echo '<a href="'.$rw['url'].'" target="_blank"><i class="'.$socialicon[$rw['socialbrandname']].' mx-1 "></i></a>';	
											}
											
										}
									?>
					    		</div>
					    	</div>
					    </div>

					    <div id="reviews" class="container tab-pane fade"><br>
					    	<div class="row">
					    		<?php 

					    			$nor = $dc->getRow("SELECT COUNT(revid) as totalr, SUM(rating) as totalrating,SUM(rating) / COUNT(revid) as grandrat from review where courseid='$courseid'");

					    		 ?>
					    		<div class="col-md-4 text-center my-auto" style="background:#f2f2f2;">
									<h1 style="font-size:3em;font-weight: bold;margin-top:10px;"><?= $nor['grandrat'] ?></h1>
									<?php 
										$realrating = $nor['grandrat'];
										$roundv = round($realrating);
										for ($i = 0; $i < $roundv ; $i++) {
											if ($i == $roundv-1) {
												if ($realrating < $roundv) {
													echo '<i class="fas fa-star-half"></i>';	
												}else{
													echo '<i class="fas fa-star"></i>';
												}
											}else{
												echo '<i class="fas fa-star"></i>';
											}
										}


									 ?>
									
									<p><?= $nor['totalr'] ?> Rating</p>
					    		</div>
					    		<div class="col-md-8 ">
					    			<?php 	
					    				$rateper = $dc->getRow("SELECT (select count(revid) from review where rating=5 and courseid='$courseid') * 100/ count(revid) as fivestar, (select count(revid) from review where rating=4 and courseid='$courseid') * 100/ count(revid) as fourstar, (select count(revid) from review where rating=3 and courseid='$courseid') * 100/ count(revid) as threestar, (select count(revid) from review where rating=2 and courseid='$courseid') * 100/ count(revid) as twostar, (select count(revid) from review where rating=1 and courseid='$courseid') * 100/ count(revid) as onestar from review where courseid='$courseid'");
					    			 ?>
					    			<div>
					    				<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<div class="progress">
											<div class="progress-bar bar bar-1" role="progressbar" style="width: <?php echo round($rateper['fivestar']); ?>%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><?php echo round($rateper['fivestar']); ?>%
											</div>
										</div>
					    			</div>
					    			<div>
					    				<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<div class="progress">
											<div class="progress-bar bar bar-1" role="progressbar" style="width: <?php echo round($rateper['fourstar']); ?>%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><?php echo round($rateper['fourstar']); ?>%
											</div>
										</div>
					    			</div>
					    			<div>
					    				<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
 										<div class="progress">
											<div class="progress-bar bar bar-1" role="progressbar" style="width: <?php echo round($rateper['threestar']); ?>%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><?php echo round($rateper['threestar']); ?>%
											</div>
										</div>
					    			</div>
					    			<div>
					    				<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<div class="progress">
											<div class="progress-bar bar bar-1" role="progressbar" style="width: <?php echo round($rateper['twostar']); ?>%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><?php echo round($rateper['twostar']); ?>%
											</div>
										</div>
					    			</div>
									<div>
					    				<i class="fas fa-star"></i>
					    				<div class="progress">
											<div class="progress-bar bar bar-1" role="progressbar" style="width: <?php echo round($rateper['onestar']); ?>%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><?php echo round($rateper['onestar']); ?>%
											</div>
										</div>
					    			</div>
					    		</div>
					    	</div>

					    	<div class="row mt-4">
					    		<div class="col-md-12">
					    			
					    			<?php 
					    				$reviews = $dc->getTable("select regid, revdesc, rating, revdate from review where courseid='$courseid'");
					    				echo '<h4>'.$reviews->num_rows.' Reviews</h4>';
					    				if ($reviews->num_rows == 0) {
					    					echo "<p class='text-center'> No Reviews</p>";
					    				}else{
					    				while ($rwrow = mysqli_fetch_assoc($reviews)) {
					    			 ?>
										
					    			<div class="row mt-4 ">
					    				<div class="col-md-2">
					    					<?php 
					    					$dp = $dc->getRow("(SELECT photo FROM instructor WHERE regid = '$rwrow[regid]') UNION (SELECT photo FROM student WHERE regid = '$rwrow[regid]')");

					    					 ?>
					    					<img class="rounded-circle imgr" src="<?= $dp['photo'] ?>" alt="" width="60px" height="60px">
					    				</div>
					    				<div class="col-md-8">
					    					<?php 
					    					$dpname = $dc->getRow("(SELECT instname as name FROM instructor WHERE regid = '$rwrow[regid]') UNION (SELECT name as name FROM student WHERE regid = '$rwrow[regid]')");

					    					 ?>
					    					<p style="font-weight: bold;margin-bottom: 0;"><?= $dpname['name'] ?></p>
					    					<div style="font-size: 12px;">
					    						<?php for ($i = 0; $i < $rwrow['rating'] ; $i++) {
					    							echo '<i class="fas fa-star"></i>';
					    						} ?>
					    					</div>
					    					<p class="text-muted" style="font-size: 12px;"><i class="fas fa-calendar-alt"> <?php echo date("d M Y",strtotime($rwrow['revdate'])); ?></i></p>
					    					<p><?= $rwrow['revdesc'] ?></p>
					    				</div>
					    			</div>
									<?php } } ?>
								</div>
							</div>

					    	<div class="row">
					    		<div class="col-md-12">
						    		<h4 class="text-left">Leave A Review</h4>

						    		<?php if (isset($_SESSION['regid']) and $_SESSION['regid'] == $getenrolld['regid']): ?>
						    			<form action="" method="post">
						    			<div class="form-group">
						    				<input type="hidden" name="courseidr" value="<?= $courseid ?>">
						    				<label for="">Rating</label>
						    				<div class="stars">
												<input type="radio" title="I Hate It" name="star" value="1" class="star-1" id="star-1" />
												<label class="star-1" for="star-1">1</label>
												<input type="radio" title="I Don't Like It" name="star" value="2" class="star-2" id="star-2" />
												<label class="star-2" for="star-2">2</label>
												<input type="radio" title="It's Ok" name="star" value="3" class="star-3" id="star-3" />
												<label class="star-3" for="star-3">3</label>
												<input type="radio" title="I LIke It" name="star" value="4" class="star-4" id="star-4" />
												<label class="star-4" for="star-4">4</label>
												<input type="radio" title="I Love It" name="star" value="5" class="star-5" id="star-5" />
												<label class="star-5" for="star-5">5</label>
												<span></span>
											</div>
						    			</div>
						    			<div class="form-group">
						    				<label for="">Review</label>
						    				<textarea name="review" id="" class="form-control" cols="30" rows="10"></textarea>
						    			</div>
						    			<div class="form-group">
						    				<button type="submit" name="btnrv" class="btn btn-custom">Review</button>
						    			</div>
						    		</form>
						    		<?php else: ?>
						    			<div class="text-center">
						    			<a href="login.php" class="btn btn-custom text-center">Login And Enroll Course for Reviews </a>	
						    			</div>
						    		<?php endif ?>

						    		
						    		
					    		</div>
					    	</div>
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
		<!-- END CONTAINER -->

<?php require_once 'footer.php'; ?>
<script>
	$(document).ready(function(){
		var url = document.location.toString();
		if (url.match('#')) {
		    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
		    window.location.hash = e.target.hash;
		})
	});
</script>
</body>
</html>
