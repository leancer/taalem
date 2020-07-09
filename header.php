<?php 
	session_start();
	ob_start();
	require_once 'inc/config.php'; 
	require_once 'inc/dataclass.php';
	include 'inc/logincode.php'; 
	include 'inc/functions.php';
	if (empty($_GET['s'])) {
	 	$_GET['s'] = "";
	 } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?></title>

	<link rel="icon" href="assests/img/taalem-T.png">

	<!-- Css Files  -->
	<link rel="stylesheet" href="assests/libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assests/libs/animatecss/animate.min.css" />
	<link rel="stylesheet" href="assests/libs/fontawesome/css/fontawesome-all.min.css" />
	<link rel="stylesheet" href="assests/libs/jqueryui/jquery-ui.min.css">
	<link rel="stylesheet" href="assests/libs/slick/slick.css">
	<link rel="stylesheet" href="assests/libs/slick/slick-theme.css">
	<link rel="stylesheet" href="assests/css/main.css">
	<link rel="stylesheet" href="assests/css/star.css">
	<style>


	</style>

</head>
<body>

	<div class="container-fluid" style="padding:0px">
		
		<nav class="navbar navbar-expand-lg navbar-light mynavbar">
		  <a class="navbar-brand"  href="<?= URL ?>"><img src="assests/img/taalem-128.png" class="mx-auto"  alt="Taalem Logo 1080"></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse " id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Categories
		        </a>
		        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
		        	<?php 
		        		$parcat = $dc->getTable("select catid,catname from category where catparentid=0");
		        		while($parcatrw = mysqli_fetch_assoc($parcat)){
		        	 ?>
	                <li class="dropdown-submenu"><a class="dropdown-item" tabindex="-1" href="course.php?catid=<?= $parcatrw['catid'] ?>"><?= $parcatrw['catname'] ?></a>
	                	<ul class="dropdown-menu">
						<?php showSubCat($parcatrw['catid'],$dc); ?>
						</ul>
	                </li>
                <?php } ?>
                
              </ul>
		      </li>
		    </ul>

			<form class="form-inline menu-search" method="get" action="./search.php">
		      <input class="mx-2 animated bounceInDown" id="header-search" type="text" placeholder="What you want to learn today ?" name="s" aria-label="Search" value="<?= $_GET['s'] ?>" required>
		      <!--<button class="btn btn-outline-success animated bounceInDown my-2 my-sm-0" type="submit">Search</button>-->
				
		      <button type="submit" class="btn search animated bounceInDown"><i class="fas fa-search"></i></button>
		    </form>
		    <?php

		    	if (!isset($_SESSION['regid'])) {
		    		$countc = 0;
		    	}else{
		    		$cc = $dc->getRow("SELECT count(cartid) as cc from cart where regid='$_SESSION[regid]'");
		    		$countc = $cc['cc'];
		    	}
		     ?>
		    <a href="cart.php" class="mr-3"  style="color:black;font-size:20px"><i class="fas fa-shopping-cart"></i><span class="badge mybadge"><?= $countc ?></span></a>
			<?php 
				

				if (!isset($_SESSION['regid'])) {
			 ?>
		    <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#loginModal">Login</button>
		      <a href="reg.php" class="btn btn-custom mx-2 my-sm-0" >SignUp</a>
		      <?php }else{ ?>
				
					
				</h5>
				<div class="dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						
						<img src="<?= $dc->getDp($_SESSION['regid'],$_SESSION['usertype']) ?>" class="rounded-circle imgr" height="35px" width="35px" alt="user profile">
					</a>
				    <div class="dropdown-menu" style="width: 150px" aria-labelledby="navbarDropdownMenuLink">
				        <a class="dropdown-item" href="#">Hey <?= $_SESSION['username'] ?></a>
				        <a class="dropdown-item" href="profile.php?id=<?= $_SESSION['regid'] ?>">View Profile</a>
				        <?php 
				        if ($_SESSION['usertype'] == "student") {
				        	$edprurl = "editstuprofile.php";
				        }else{
				        	$edprurl = "instructor/editprofile.php";
				        }
				         ?>
				        <a class="dropdown-item" href="<?= $edprurl ?>">Edit Profile</a>
				        <a class="dropdown-item" href="usercourse.php">My Courses</a>
				        <?php if ($_SESSION['usertype'] == 'instructor'): ?>
						<a class="dropdown-item" href="instructor/dashboard.php">Dashboard</a>
					<?php endif ?>
				        <div class="dropdown-divider"></div>
				        <a class="dropdown-item" href="logout.php">Logout</a>
				    </div>
				</div>


		     <?php } ?>
		  </div>
		</nav>