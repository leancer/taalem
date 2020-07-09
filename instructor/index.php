<?php 

$title = "Instructor | Taalem";
 require_once 'header.php';

?>

<div id="myCarousel" class="carousel slide mycs" data-ride="carousel" data-interval="5000">

			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
					<img class="first-slide img-responsive sliderimage imgr" src="../assests/img/insslider1.jpg" width="100%" height="600px" alt="First slide">

					<div class="carousel-caption slide1-cap">
					  
					  <h1 class="animated bounce" style="text-align: left;font-size:40px;"><span class="highlight">Explore</span> Your <span class="highlight">Skill</span> With <span class="abfont" style="font-size:65px;">Taalem</span>
					  	</h1>
					  	<h3 class="animated flash" style="text-align: left;">Touch with millions of Student With Your Skills.</h3>

					  	<button class="btn btn-custom btn-md float-left">Join Now</button>
					</div>
				</div>

				<div class="carousel-item">
				  <img class="second-slide img-responsive sliderimage imgr" src="../assests/img/insslider3.jpg" width="100%" height="600px" alt="Second slide">

				  <div class="carousel-caption slide2-cap">
					  <h1 class="animated slideInDown m-0" style="font-size:45px;text-align: left"><span class="highlight">Teaching</span> is not a job,<br>it is a <span class="highlight">Pillar</span> Of The Society.</h1>
					  <h1 class="animated slideInDown" style="font-size:70px;text-align: left"></h1>
				  </div>
				</div>

				<div class="carousel-item">
				  <img class="second-slide img-responsive sliderimage imgr" src="../assests/img/insslider4.jpg" width="100%" height="600px" alt="Second slide">

				  <div class="carousel-caption slide2-cap">
					  <h1 class="animated slideInDown m-0" style="font-size:45px;text-align: left">Take an <span class="highlight">opportunity</span> <br>to <span class="highlight">Teach</span> the World.
					  <h1 class="animated slideInDown" style="font-size:70px;text-align: left"></h1>
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

<div class="container">
	<div class="col text-center text-muted mt-5"><h1>It's Simple To Spread Your Skill</h1></div>
	<div class="row">
		<div class="col-md-4 text-center p-3">
			<div class="icon">
				<i class="fas fa-video fa-3x m-4"></i>
			</div>
			<h3>Create</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
		</div>
		<div class="col-md-4 text-center p-3">
			<div class="icon">
				<i class="fas fa-upload fa-3x m-4"></i>
			</div>
			<h3>Publish</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
		</div>
		<div class="col-md-4 text-center p-3">
			<div class="icon">
				<i class="fas fa-dollar-sign fa-3x m-4"></i>
			</div>
			<h3>Earn</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
		</div>
	</div>
</div>

	<div class="counter-section mt-2" >
				
				<div class="row">
					<?php 
						$getse = $dc->getRow("select count(enrollid) as tenstud from courseenroll");
						$geti = $dc->getRow("select count(instid) as tinst from instructor");
					?>
					
					<div class="col-md-4 col-xs-12 text-center" style="color:white">
						
						<i class="fas fa-user fa-5x mb-2"></i>

						<h2><span class="count"><?= $getse['tenstud'] ?></span>+ <br>Students Enrolled</h2>


					</div>
					<div class="col-md-4 col-xs-12 text-center" style="color:white">
						
						<i class="fas fa-language fa-5x mb-2"></i>

						<h2><span class="count">30</span>+ <br>Suitable Language</h2>


					</div>
					<div class="col-md-4 col-xs-12 text-center" style="color:white">
						
						<img src="../assests/img/ins.png" alt="" width="180px" height="100px" style="position: relative;left:-20px;">

						<h2><span class="count"><?= $geti['tinst'] ?></span>+ <br>Best Instructors</h2>


					</div>
				</div>
			</div>

<div class="container">
	<div class="row m-4">
				
				<div class="col-md-12" style="margin-top: 50px">
					
					<div class="text-center">
						<h1 class="display-3 text-center wow flipInX">Become A Instructor</h1>
						<hr class="mx-auto style13">
						<p class="mx-auto" style="width: 60%;">Join the World's trustable online Learning Academy.</p>

						<a href="regins.php" class="btn btn-primary btn-lg"> Get Start Now</a>

					</div>
					
				</div>

	</div>		
</div>

<?php 
 require_once 'footer.php';
 ?>
</body>
</html>