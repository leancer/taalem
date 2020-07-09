<?php 

	$title = "= Forget Password | Taalem ";
	include_once 'header.php';
	include 'assests/libs/PHPMailer/PHPMailerAutoload.php';
	$msg;
	$upst;
	if (isset($_POST['btnfp'])) {
		$getp = $dc->getRow("select username,password,email from register where username='$_POST[username]'");
	

		if (!empty($getp)) {

			$mailtitle = "Forget Password | Taalem";
			$reply = "Hello ".$getp['username']."<br/> Your Password Is <b>".$getp['password']."</b>.<br/> Note: Don't Reply to this message..";
			$mail = new PHPMailer;

                    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'sportsbikersinc@gmail.com';                 // SMTP username
                    $mail->Password = 'Xtreme1502';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to

                    $mail->setFrom('sportsbikersinc@gmail.com', 'Official Taalem');
                    $mail->addAddress($getp['email'], $getp['username']);     // Add a recipient
                    //$mail->addReplyTo('sportsbikersinc@gmail.com', 'Official Taalem');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = $mailtitle;
                    $mail->Body    = $reply;
                    $mail->AltBody = $reply;

                    if(!$mail->send()) {
                    	$upst=false;
                        $msg = "Email Could Not Be Sent";
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                    	$upst=true;
                        $msg = "Email Successfully Sent";
                    }

		}else{
			$upst=false;
			$msg = "This Username Does Not exsist Please Enter Valid Username.";
		}

	}
 ?>

 <div class="titlepage">
			
			<h1>Forget Password</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Forget Password</p>

		</div>
	
		<div class="container mt-5">
			<div class="row text-center">
				<div class="col-md-6 offset-md-3">
					<?php if (isset($msg) and $upst == false): ?>
						<div class="alert alert-danger" role="alert">
						  <?= $msg ?>
						</div>
						<?php endif ?>
					<?php if (isset($msg) and $upst == true): ?>
						<div class="alert alert-success" role="alert">
						  	<?= $msg ?>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mx-auto">
					<div class="card ">
						<div class="card-body">
							<form action="" method="post">
					      		<div class="formgroup">
						      		<label for="">Username:</label>
						      		<input type="text" name="username" id="username" class="form-control"  placeholder="Enter Username." required />
					      		</div>
					      		<div class="form-group">
									<input type="submit" name="btnfp" id="btnlogin" value="Send Password" class="btn-block btn-lg btn btn-custom mt-3">
								</div>
		      				</form>
						</div>	
					</div>
				</div>
			</div>
		</div>


<?php require_once 'footer.php'; ?>
</body>
</html>