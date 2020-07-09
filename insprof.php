<?php 

	$social = $dc->getTable("select socialbrandname,url from social where regid='$regid'");

	$socialicon = array(
						"facebook"=>"fab fa-facebook",
						"twitter"=>"fab fa-twitter",
						"instagram"=>"fab fa-instagram",
						"gplus"=>"fab fa-google-plus",
						"linkedin"=>"fab fa-linkedin",
						"websitelink"=>"fas fa-globe"
	);

 ?>

<div class="titlepage">
			<div class="row">
				<div class="col-md-6">
					<h1><?= $regdt['username'] ?></h1>
					<h4><?= $insd['qualification'] ?></h4>
				</div>
				<div class="col-md-6 text-right pt-4">
					<?php if (isset($_SESSION['regid']) and $_SESSION['regid'] == $regid): ?>
					<a href="instructor/editprofile.php" class="btn btn-custom">Edit Profile</a>
					<?php endif ?>
				</div>
			</div>
		</div>

		<div class="container mt-5">
			<div class="row inspro">
				<div class="col-md-2">
					<img class="rounded-circle wow rollIn" src="<?= $insd['photo'] ?>">
				</div>
				<div class="col-md-10">
					<div class="records wow flipInX">
						<div class="row">
							<div class="col-md-6" style="padding-left: 80px; padding-top: 10px;">
								<h3 class="recdetail" style="font-size: 20px;"><?= $insd['instname'] ?></h3>
								<h5 class="recdetail text-muted" style="font-size: 12px;margin-top: 5px;">Joined Since <?= date('Y',strtotime($regdt['regdate'])); ?></h5>
								<h5 class="recdetail text-muted" style="font-size: 12px;"><i class="fas fa-transgender" ></i> 
									<?php if($insd['gender'] == 'm'){echo "Male";}else{echo "Female";} ?></h5>
							</div>
							<div class="col-md-6">
								<?php $totalstud = $dc->getRow("select count(DISTINCT ce.regid) as totals from courseenroll ce,course c where ce.courseid = c.courseid and c.instid = '$regid'"); ?>
								<p class="recdetail text-center wow zoomIn">Total Students<br><span ><?= $totalstud['totals'] ?></span></p>
								<?php $totalcourse = $dc->getRow("select count(courseid) as totalc from course where instid='$regid'"); ?>
								<p class="recdetail text-center wow zoomIn">Courses<br><span><?= $totalcourse['totalc'] ?></span></p>
								<?php $totalreview = $dc->getRow("SELECT count(r.revid) as totalr from review r, course c where c.courseid=r.courseid and c.instid='$regid'"); ?>
								<p class="recdetail text-center wow zoomIn">Reviews<br><span><?= $totalreview['totalr'] ?></span></p>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-3">
					<div class="social-icon mt-2 ">
						<?php 
							while($rw = mysqli_fetch_array($social)){ 
								if ($rw['url'] != '') {
									echo '<a href="'.$rw['url'].'" target="_blank"><i class="'.$socialicon[$rw['socialbrandname']].' ml-2 "></i></a>';	
								}
								
							}
						?>
					</div>
				</div>
				<div class="col-md-9">
					<div class="desc">
						<?= $insd['about'] ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center my-2">Course taught by <?= $regdt['username'] ?></h3>
					<div class="cardcur">
						<?php 
						$courselist = $dc->getTable("select * from course where instid='$regid'");
						while($crw = mysqli_fetch_assoc($courselist)){
						
					 	?>
						<div class="card single-card mx-4" style="width: 15rem;height: auto">
							<img class="card-img-top imgr" src="content/<?= $crw['thumbnailurl'] ?>" alt="Card image cap" height="120px">
							<div class="card-body">
								<p class="card-title"><a href="singlecourse.php?id=<?= $crw['courseid'] ?>" class="a-black" ><?= $crw['coursename'] ?></a></p>
								
								<?php echo getRatingStar($crw['courseid']); ?>
								<p class="float-right">(<?php echo getTotalRating($crw['courseid']) ?> Rating)</p>
								<?php if ($crw['coursetype'] == 'free'): ?>
									<h4 class="text-muted"><b>₹<?= $crw['coursetype'] ?></b></h4>
								<?php else: ?>
									<h4 class="text-muted"><b>₹<?= $crw['price'] ?></b></h4>
								<?php endif ?>
								
							</div>
						</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>