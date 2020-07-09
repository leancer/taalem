<?php 
	$dc = new Dataclass();
	if (isset($_POST['btnlogin'])) {
		
		$username = $_POST['username'];
		$password = $_POST['password'];

		$record = $dc->getRow("select regid,username,password,usertype from register where username='$username'");
		if (!empty($record)) {
			
			if ($record['password'] == $password) {

				if ($record['usertype'] == "student") {
					$_SESSION['regid'] = $record['regid'];
					$_SESSION['username'] = $record['username'];
					$_SESSION['usertype'] = $record['usertype'];
					if (!empty($_POST['remember'])) {
						setcookie("username", my_simple_crypt($record['username'],'e'), time() + (86400 * 30));
						setcookie("regid", my_simple_crypt($record['regid'],'e'), time() + (86400 * 30));
						setcookie("usertype", $record['usertype'], time() + (86400 * 30));
					}
					if (URL_SUB_FOLDER == "/academy/instructor") {
						header("Location: ../index.php");
					}else{
						header("Location: index.php");
					}
				
				}else if ($record['usertype'] == "instructor"){
					echo "<script>alert('student')</script>";
					$_SESSION['regid'] = $record['regid'];
					$_SESSION['username'] = $record['username'];
					$_SESSION['usertype'] = $record['usertype'];
					if (!empty($_POST['remember'])) {
						setcookie("username", my_simple_crypt($record['username'],'e'), time() + (86400 * 30));
						setcookie("regid", my_simple_crypt($record['regid'],'e'), time() + (86400 * 30));
						setcookie("usertype", $record['usertype'], time() + (86400 * 30));
					}
					if (URL_SUB_FOLDER == "/academy/instructor") {
						header("Location: ../instructor/dashboard.php");
					}else{
						header("Location: instructor/dashboard.php");
					}					

				}else{
					echo "<script>alert('admin')</script>";
					$_SESSION['regid'] = $record['regid'];
					$_SESSION['username'] = $record['username'];
					$_SESSION['usertype'] = $record['usertype'];
					if (!empty($_POST['remember'])) {
						setcookie("username", my_simple_crypt($record['username'],'e'), time() + (86400 * 30));
						setcookie("regid", my_simple_crypt($record['regid'],'e'), time() + (86400 * 30));
						setcookie("usertype", $record['usertype'], time() + (86400 * 30));
					}
					if (URL_SUB_FOLDER == "/academy/instructor") {
						header("Location: ../admin/index.php");
					}else{
						header("Location: admin/index.php");
					}
				}

			}else{
				echo "<script>alert('Password Is Incorrect')</script>";
				if (URL_SUB_FOLDER == "/academy/instructor") {
						header("Location: ../login.php");
					}else{
						header("Location: login.php");
					}
			}

		}else{
			echo "<script>alert('Username Is Incorrect')</script>";
			if (URL_SUB_FOLDER == "/academy/instructor") {
						header("Location: ../login.php");
					}else{
						header("Location: login.php");
					}
		}
		

	}

 ?>