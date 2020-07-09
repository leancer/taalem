<?php 

	$title = "Contact Us | Taalem ";
	include_once 'header.php';
	include 'assests/libs/PHPMailer/PHPMailerAutoload.php';
	$msg;
	$upst;

	if (isset($_POST['btncnt'])) {

			$mailtitle = $_POST['name']."'s Messege From Taalem";
			$reply = "Messege From :".$_POST['name']."<br/> Sender Email :".$_POST['email']."<br/>Subject : ".$_POST['txtsubject']."<br/>Messege : ".$_POST['msg'];
			$mail = new PHPMailer;

                    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'kamiyabhusain530@gmail.com';                 // SMTP username
                    $mail->Password = '9978150780';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to

                    $mail->setFrom('kamiyabhusain530@gmail.com', 'Official Taalem');
                    $mail->addAddress('kamiyabhusain530@gmail.com', 'Official Taalem');     // Add a recipient
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
                        $msg = "Email Successfully Sent. we will shortly contact you";
                    }
	}

 ?>

 <div class="titlepage">
			
			<h1>Contact Us</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Contact</p>

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
						<div class="reghead">
							<h1 class="mt-2 float-left">Contact Us</h1>
						</div>
						<div class="card-body">
							<form action="" method="post">
					      		<div class="formgroup">
						      		<label for="">Full Name:</label>
						      		<input type="text" name="name" id="username" class="form-control"  placeholder="Enter Full Name." required />
					      		</div>
					      		<div class="formgroup">
						      		<label for="">Email:</label>
									<input type="email" name="email" id="password" class="form-control"
									placeholder="Enter Email." required />
					      		</div>
					      		<div class="formgroup">
						      		<label for="">Subject:</label>
									<input type="text" name="txtsubject" id="txtsubject" class="form-control"
									placeholder="Enter Subject." required />
					      		</div>
					      		<div class="formgroup">
						      		<label for="">Messege:</label>
									<textarea name="msg" id="" class="form-control" cols="30" rows="10" placeholder="Your Text Here....."></textarea>
					      		</div>
					      		<div class="form-group">
									<input type="submit" name="btncnt" id="btnlogin" value="Send Messege" class="btn-block btn-lg btn btn-custom mt-3">
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