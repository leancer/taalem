<?php 
	session_start(); 
	require_once '../inc/config.php'; 
	require_once '../inc/dataclass.php';
	include '../inc/logincode.php';
	include '../inc/functions.php';   
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?></title>

	<!-- Css Files  -->
	
	<link rel="stylesheet" href="../assests/libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../assests/libs/animatecss/animate.min.css" />
	<link rel="stylesheet" href="../assests/libs/fontawesome/css/fontawesome-all.min.css" />
	<link rel="stylesheet" href="../assests/libs/jqueryui/jquery-ui.min.css">
	<link rel="stylesheet" href="../assests/css/main.css">
	
</head>
<body>

	<div class="container-fluid" style="padding:0px">
		
		<nav class="navbar navbar-expand-lg navbar-light mynavbar">
		  <a class="navbar-brand abfont"  href="<?= URL ?>"><img src="../assests/img/taalem-1080p.png" class="mx-auto" height="40" width="135" alt="Taalem Logo 1080"></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse " id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		    </ul>

			<form class="form-inline menu-search" method="get" action="../search.php">
		      <input class="mx-2 animated bounceInDown" type="text" name="s" placeholder="What you want to learn today ?" aria-label="Search">
		      <!--<button class="btn btn-outline-success animated bounceInDown my-2 my-sm-0" type="submit">Search</button>-->
				
		      <button type="submit" class="btn search animated bounceInDown"><i class="fas fa-search"></i></button>
		    </form>
		    
			<?php 
				

				if (!isset($_SESSION['regid']) or $_SESSION['usertype'] == "student") {
			 ?>
		      <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#loginModal">Login</button>
		      <a href="regins.php" class="btn btn-custom mx-2 my-sm-0" >SignUp</a>
		      <?php }else{ ?>
				
				<h5 class="mr-4"><a class="a-black px-2" href="../mycourses.php">My Courses</a> <a class="a-black px-2" href="dashboard.php">Dashboard</a></h5>
				<div class="dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						
						<img src="../<?= $dc->getDp($_SESSION['regid'],$_SESSION['usertype']) ?>" class=" rounded-circle imgr" height="35px" width="35px" alt="user profile">
					</a>
				    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        <a class="dropdown-item" href="#">Hey <?= $_SESSION['username'] ?></a>
				        <a class="dropdown-item" href="../profile.php?id=<?= $_SESSION['regid'] ?>">View Profile</a>
				        <a class="dropdown-item" href="editprofile.php">Edit Profile</a>
				        <div class="dropdown-divider"></div>
				        <a class="dropdown-item" href="logout.php">Logout</a>
				    </div>
				</div>


		     <?php } ?>
		  </div>
		</nav>