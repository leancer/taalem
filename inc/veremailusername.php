<?php 
	
	require 'dataclass.php';

	$dc = new Dataclass();
	
	if (isset($_POST['username'])) {
		$ur = $_POST['username'];

		$query = "select username from register where username = '$ur'";

		if ($dc->checkExUser($query)) {
			echo "true";	
		}else{
			echo "false";
		}

	}

	if (isset($_POST['email'])) {
		$em = $_POST['email'];

		$query = "select email from register where email = '$em'";

		if ($dc->checkExUser($query)) {
			echo "true";	
		}else{
			echo "false";
		}
	}

 ?>