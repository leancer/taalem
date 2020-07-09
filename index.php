<?php

	$title="Taalem | Online Course Learning";
	require_once 'header.php';
?>


		<div id="myCarousel" class="carousel slide mycs" data-ride="carousel" data-interval="5000">

			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
					<img class="first-slide img-responsive sliderimage imgr" src="assests/img/1.jpg" width="100%" height="600px" alt="First slide">

					<div class="carousel-caption slide1-cap">
						<h1 class="abfont animated slideInDown" style="font-size: 130px;text-align:left;margin-bottom:-20px;">Taalem.</h1>
						<h2 class="animated fadeInUp" style="text-align: left;"><span class="highlight">Intelligent</span> that is the <span class="highlight">goal</span> of the education.</h2>

					</div>
				</div>

				<div class="carousel-item">
				  <img class="second-slide img-responsive imgr" src="assests/img/2.jpg" width="100%" height="600px" alt="Second slide">

				  <div class="carousel-caption slide2-cap">
					  	<h1 class="animated fadeInUp" style="text-align: left;font-size:72px;"><span class="highlight">BeSmart</span> with <br>our <span class="highlight">Courses</span></h1>
				  </div>
				</div>

				<div class="carousel-item">
				  <img class="second-slide img-responsive sliderimage imgr" src="assests/img/3.jpg" width="100%" height="600px" alt="Second slide">
					
					<div class="carousel-caption slide2-cap">
					  	<h1 class="animated fadeInUp" style="text-align: left;font-size:72px;"><span class="highlight">Learn</span> more <br><span class="highlight">Earn</span> more.</h1>
					</div>			  
				</div>

				
			</div>

	        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
	          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	          <span class="sr-only">Previous</span>
	        </a>

	        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
	          <span class="carousel-control-next-icon" aria-hidden="true"></span>
	          <span class="sr-only">Next</span>
	        </a>
	    </div>


		<div class="row m-4">
			
			<div class="col-md-12 mt-4">
				
				<div class="text-center">
					<h1 class="display-2 text-center">Welcome To </h1>
					<img src="assests/img/taalem-512.png" alt="dasd">
					<hr class="mx-auto style13">
					<p class="mx-auto" style="width: 60%;">Welcome to Taalem collection of world-class online learning opportunities. The Taalem Online Learning portal provides a gateway for the public to access Taalem's extensive learning content. </p>

				</div>

				<div class="row m-5">
					
					<div class="col-md-4 text-center">
						
						<i class="fas fa-graduation-cap fa-5x mb-5 wow bounce"  data-wow-offset="150"></i>

						<h3>Facility of Scholarship</h3>

						<p>Online and inside campus programs for all teachers, principal, administrator, and the policy makers for free.</p>

					</div>
					<div class="col-md-4 text-center">
						
						<i class="fas fa-desktop fa-5x mb-5 wow bounce" data-wow-offset="150"></i>

						<h3>Learn Courses Online</h3>

						<p>Online and inside campus programs for all teachers, principal, administrator, and the policy makers for free.</p>

					</div>
					<div class="col-md-4 text-center">
						
						<i class="fas fa-book fa-5x mb-5 wow bounce" data-wow-offset="150"></i>

						<h3>Notes And books </h3>

						<p>Online and inside campus programs for all teachers, principal, administrator, and the policy makers for free.</p>

					</div>

				</div>

			</div>
			
			
		</div>

		<div class="counter-section" >
			
			<div class="row">
				<?php 
				$gets = $dc->getRow("select count(studid) as tstud from student");
				$geti = $dc->getRow("select count(instid) as tinst from instructor");
				$getc = $dc->getRow("select count(courseid) as tcourse from course");
				 ?>
				
				<div class="col-md-4 col-xs-12 text-center" style="color:white">
					
					<i class="fas fa-graduation-cap fa-5x mb-2"></i>

					<h2><span class="count"><?= $gets['tstud'] ?></span>+ Students</h2>


				</div>
				<div class="col-md-4 col-xs-12 text-center" style="color:white">
					
					<i class="fas fa-user fa-5x mb-2"></i>

					<h2><span class="count"><?= $geti['tinst'] ?></span>+ Instructor</h2>


				</div>
				<div class="col-md-4 col-xs-12 text-center" style="color:white">
					
					<i class="fas fa-desktop fa-5x mb-2" ></i>

					<h2><span class="count"><?= $getc['tcourse'] ?></span>+ Courses</h2>


				</div>

			</div>


		</div>
	</div>

	<div class="container mb-5">
		<div class="row mx-4">
			
			<div class="col-md-12 mt-4">

				<div class="text-center">
					<h1 class="display-4">Courses</h1>
					<hr class="mx-auto style13">
					<p class="mx-auto" style="width: 60%;">Find online courses and a wide range of related learning content from across Educamp’s online store, schools, initiatives, and programs. </p>
					
					<div class="float-right" style="width: 20%">
						<select class="form-control" id="btns">
							<option value="1" data-filter="rec" selected="selected">Recent</option>
							<option value="2" data-filter="fea">Featured</option>
						</select>
						<!-- <button class="btn btn-primary btns" data-filter="rec">Recent</button>
						<button class="btn btn-primary btns" data-filter="fea">Featured</button> -->
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="row mt-4">
					
					<?php 
					$coursed = $dc->getTable("select c.*,i.instname from course c,instructor i where c.instid=i.regid order by courseid desc limit 4");

					while ($rw= mysqli_fetch_assoc($coursed)) {
					 ?>
					
					<div class="col-md-3 col-sm-6 mb-3 rec">
								
						<div class="card single-card" style="width: 15rem;height: auto">
							<img class="card-img-top imgr" src="content/<?= $rw['thumbnailurl'] ?>" alt="Card image cap" height="120px">
							<div class="card-body">
								<p class="card-title"><a class="a-black" href="singlecourse.php?id=<?= $rw['courseid'] ?>"><?= $rw['coursename'] ?></a></p>
								<p class="card-text"><span class="text-muted"> <?= $rw['instname'] ?></span></p>
								<hr/>
								<?php if ($rw['coursetype'] == 'free'): ?>
									<a href="singlecourse.php?id=<?= $rw['courseid'] ?>" class="btn btn-primary mr-2"><?= $rw['coursetype'] ?></a>
								<?php else: ?>
									<a href="singlecourse.php?id=<?= $rw['courseid'] ?>" class="btn btn-primary mr-2"><?= $rw['price'] ?></a>	
								<?php endif ?>
								
								<?php $totalenroll = $dc->getRow("select count(enrollid) as total from courseenroll where courseid='$rw[courseid]'"); ?>
								<span class="mx-2"><i class="fas fa-user"></i> <?= $totalenroll['total'] ?></span>
								<?php $totalrv = $dc->getRow("select count(revid) as total from review where courseid='$rw[courseid]'"); ?>
								<span class="mx-2"><i class="fas fa-comments"></i> <?= $totalrv['total'] ?> </span>

							</div>
						</div>

					</div>
					<?php } ?>
					<?php $coursed = $dc->getTable("select c.*,i.instname from course c,instructor i where c.instid=i.regid order by rand() limit 4");

					while ($rw= mysqli_fetch_assoc($coursed)){ ?>
					<div class="col-md-3 col-sm-6 col-xs-12 mb-3 fea">

						<div class="card single-card" style="width: 15rem;height: auto">
							<img class="card-img-top imgr" src="content/<?= $rw['thumbnailurl'] ?>" alt="Card image cap" height="120px">
							<div class="card-body">
								<p class="card-title"><a class="a-black" href="singlecourse.php?id=<?= $rw['courseid'] ?>"><?= $rw['coursename'] ?></a></p>
								<p class="card-text"><span class="text-muted"> <?= $rw['instname'] ?></span></p>
								<hr/>
								<?php if ($rw['coursetype'] == 'free'): ?>
									<a href="singlecourse.php?id=<?= $rw['courseid'] ?>" class="btn btn-primary mr-2"><?= $rw['coursetype'] ?></a>
								<?php else: ?>
									<a href="singlecourse.php?id=<?= $rw['courseid'] ?>" class="btn btn-primary mr-2"><?= $rw['price'] ?></a>	
								<?php endif ?>
								
								<?php $totalenroll = $dc->getRow("select count(enrollid) as total from courseenroll where courseid='$rw[courseid]'"); ?>
								<span class="mx-2"><i class="fas fa-user"></i> <?= $totalenroll['total'] ?></span>
								<?php $totalrv = $dc->getRow("select count(revid) as total from review where courseid='$rw[courseid]'"); ?>
								<span class="mx-2"><i class="fas fa-comments"></i> <?= $totalrv['total'] ?> </span>

							</div>
						</div>

					</div>
					<?php } ?>

				</div>

			</div>

		</div>
	</div>


		<div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
			<div class="carousel-inner btcs" role="listbox">
				<?php 

					$getfbdt = $dc->getTable("select f.fbid,f.detail,f.star,r.username,sih from feedback f,register r where f.regid=r.regid and sih=1");
					$k=1;
					while ($fbrw = mysqli_fetch_assoc($getfbdt)) {
					    

				 ?>
				<div class="carousel-item csci <?php if($k == 1){echo 'active';} ?>">
				  
				  <div class="carousel-caption csca">
					<p class="animated fadeInDown bfont"><?= $fbrw['detail'] ?></p>
					<div>
						<?php 
			                	for ($i = 1; $i <=$fbrw['star'] ; $i++){
			                		echo '<i class="fa fa-star" style="color:#f4c150;"></i>';
			                	}
			                	 ?>
					</div>
					 <p class="bfont pl-2" style="letter-spacing:2px;"><?= $fbrw['username'] ?></p>
				  </div>
				</div>
				<?php $k++;} ?>
			</div>

			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>

			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	
	<div class="container-fluid" >

		<div class="row m-4">
			
			<div class="col-md-12" style="margin-top: 50px">
				
				<div class="text-center">
					<h1 class="display-3 text-center wow flipInX">Become A Instructor</h1>
					<hr class="mx-auto style13">
					<p class="mx-auto" style="width: 60%;">Join our creative community to spread your skill over world</p>

					<a href="instructor/" class="btn btn-primary btn-lg"> Get Start Now</a>

				</div>
				
			</div>

		</div>
	</div>

	<?php require_once 'footer.php'; ?>
</body>
</html>