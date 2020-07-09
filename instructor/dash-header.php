<?php 
session_start();
require_once '../inc/config.php';
if (!isset($_SESSION['regid']) and $_SESSION['usertype'] != "instructor") {
	header("Location: index.php");
}

require_once '../inc/dataclass.php'; 
$dc=new Dataclass();

	$unseenmsg = $dc->getTable("SELECT * FROM message WHERE status = 0 and receiverregid='$_SESSION[regid]'");
	$countmsg=mysqli_num_rows($unseenmsg);
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
	<link rel="stylesheet" href="../assests/libs/datatable/datatables.min.css">
	<link rel="stylesheet" href="../assests/css/main.css">
	<link rel="stylesheet" href="../admin/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="../admin/vendor/printjs/print.min.css">
	<script src="../admin/vendor/printjs/print.min.js"></script>



</head>
<body style="margin-top: 50px;">

	<div class="container-fluid">
	
		<nav class="navbar fixed-top navbar-expand-lg dashnav">
		  <a class="navbar-brand" href="#" style="color: white"><img src="../assests/img/taalem-128.png" alt=""> Instructor</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="../usercourse.php" title="this is your Purchase Course From Taalem">Your Courses</a></li>
		    </ul>
		    <ul class="navbar-nav ml-auto">
		    	<li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" id="messagesDropdown" href="#" onclick="showMsg()" data-toggle="dropdown" aria-haspopup="true" title="<?= $countmsg ?> Messages" aria-expanded="false">
		           	<i class="fa fa-fw fa-envelope"></i>
		            <?php if ($countmsg >0) {
		            	?>
		            	<span id="indi">
			            <span class="d-lg-none">Messages
			              <span class="badge badge-pill badge-primary"><?= $countmsg ?> New</span>
			            </span>
			            <span class="indicator text-primary d-none d-lg-block">
			              <i class="fa fa-fw fa-circle"></i>
			            </span>
						</span>
		            <?php
		            	} ?>
		          </a>
		          <div class="dropdown-menu" style="width: 400px;" id="showmsgbox" aria-labelledby="messagesDropdown">
		            <h6 class="dropdown-header">New Messages:</h6>
		            <div class="dropdown-divider"></div>
		           
		           	<div id="amsgbox">
		           	</div>
		            
		            <div class="dropdown-divider"></div>
		            <a class="dropdown-item small" href="#">View all messages</a>
		          </div>
		        </li>	
		    </ul>
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
		  </div>
		</nav>

	</div>