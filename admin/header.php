<?php
session_start();
ob_start();
require_once '../inc/config.php';
if (!isset($_SESSION['regid']) or $_SESSION['usertype'] != "admin") {
header("Location: ../login.php");
}

require_once '../inc/dataclass.php';
$dc = new Dataclass();
$unseenmsg = $dc->getTable("SELECT * FROM message WHERE status = 0 and receiverregid='$_SESSION[regid]'");
$countmsg=mysqli_num_rows($unseenmsg);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title ?></title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
    <link href="vendor/printjs/print.min.css" rel="stylesheet">
     <script src="vendor/printjs/print.min.js"></script>
     
    <style>
    </style>
  </head>
  <body class="fixed-nav sticky-footer" id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top adminnav" id="mainNav">
      <a class="navbar-brand" href="index.html">
        <img src="../assests/img/taalem-128.png" alt=""> Admin
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="index.php">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="users">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-users"></i>
              <span class="nav-link-text">Users</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseUsers">
              <li>
                <a href="users.php">Students</a>
              </li>
              <li>
                <a href="Instructors.php">Instructor</a>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
            <a class="nav-link" href="categories.php">
              <i class="fa fa-fw fa-table"></i>
              <span class="nav-link-text">Categories</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Course">
            <a class="nav-link" href="courses.php">
              <i class="fa fa-fw fa-list"></i>
              <span class="nav-link-text">Courses</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="message">
            <a class="nav-link" href="message.php">
              <i class="fa fa-fw fa-comments"></i>
              <span class="nav-link-text">Messages</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Earning">
            <a class="nav-link" href="earning.php">
              <i class="fa fa-fw fa-dollar"></i>
              <span class="nav-link-text">Earning</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseReports" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-flag"></i>
              <span class="nav-link-text">Reports</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseReports">
              <li>
                <a href="userreports.php">Users</a>
              </li>
              <li>
                <a href="coursereport.php">Course</a>
              </li>
              <li>
                <a href="earningreport.php">Earning</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler adminnav">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto" >
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" onclick="showMsg()" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?= $countmsg ?> Messages">
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
            <div class="dropdown-menu" aria-labelledby="messagesDropdown" style="width: 400px;">
              <h6 class="dropdown-header">New Messages:</h6>
              <div class="dropdown-divider"></div>
              <div id="amsgbox">
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item small" href="#">View all messages</a>
            </div>
          </li>
          
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
              <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link logmod" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
          </li>
        </ul>
      </div>
    </nav>