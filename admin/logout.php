<?php 
	session_start();
	if (isset($_SESSION['regid'])) {
		session_unset();
		session_destroy();
		setcookie("username", "", time() -3600);
		setcookie("regid", "", time() - 3600);
		setcookie("usertype", "", time() - 3600);
		header("Location: ../login.php");
	}
 ?>