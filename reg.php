<?php
	
	$title="Sing Up | Taalem | Online Course Learning";
	require_once 'header.php';

	$dc = new Dataclass();
	$msg;
	$regst;
	if (isset($_POST['btnreg'])) {

		//variables
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$email = trim($_POST['email']);
		$gender = $_POST['rdogender'];
		
		$name = ucwords(strtolower(trim($_POST['firstname']." ".$_POST['lastname'])));
		$url = $gender == "m" ? $dm : $df ;
		$url = $url;
		$todaydate = date("Y-m-d");
		
		$checkquery = "Select username from register where username='$username'";

		if ($dc->checkExUser($checkquery)) {
			
			$checkemailquery = "Select email from register where email='$email'";

			if ($dc->checkExUser($checkemailquery)) 
			{
				
				$registerquery = "insert into register(regdate, username, password, usertype, email) values('$todaydate','$username','$password','student','$email')";
					
					$registerdata = $dc->saveRecord($registerquery);
				
				if ($registerdata['success']) {
					
					$lastregister = $dc->getRow("select regid from register where email='$email' ORDER BY regid DESC LIMIT 1");

					$userquery = "insert into student(regid, name, gender, photo) values('".$lastregister['regid']."','$name','$gender','$url')";

					$userdata = $dc->saveRecord($userquery);

					if ($userdata['success']) {

						$_SESSION['regid'] = $lastregister['regid'];
						$_SESSION['username'] = $username;
						$_SESSION['usertype'] = "student";
						header("Location: index.php");
						
						
					}else{
						$msg = "Error in register :".$userdata['error'];
						$regst = false;
					}

				}else{
					$msg = "Error in register :".$registerdata['error'];
					$regst = false;
				}
				

			}else{

				$msg = "<span class='font-weight-bold'>$email</span> is Already Exist, please try Different !";
					$regst = false;
			}

		}else{

			$msg = "<span class='font-weight-bold'>$username</span> is Already Exist, please try Different !";
			$regst = false;

		}

	}
?>

		<div class="titlepage">
			
			<h1>Sign Up</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Sing Up</p>

		</div>

		<div class="container mt-5">
			<div class="row text-center">
				<div class="col-md-6 offset-md-3">
					<?php if (isset($msg) and $regst == false): ?>
						<div class="alert alert-danger" role="alert">
						  <?= $msg ?>
						</div>
						<?php endif ?>
					<?php if (isset($msg) and $regst == true): ?>
						<div class="alert alert-success" role="alert">
						  	<?= $msg ?>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 my-auto px-5 animated fadeInLeftBig" >
					<div >
						<h1 class="text-center" style="font-size: 30px;letter-spacing: 3px">Become An Instructor.</h1>
						<a href="instructor/index.php" class="btn-block btn-lg btn btn-custom">Click Here</a>
					</div>
				</div>
				<div class="col-md-6 top-to-bottom px-5 animated fadeInRightBig" >
					<div class="card ">
						<div class="reghead">
							<h1 class="mt-2 float-left">Sign Up</h1>
							<i class="fas fa-pencil-alt fa-3x float-right m-2"></i>
						</div>
						<div class="card-body">
							<form action="" method="post" onsubmit="return userRegVal()">
								<div class="form-group">
									<p class="text-danger" style="font-size: 18spx">*This Is Not Instructor Register Form</p>
									<div class="row">
										<div class="col-md-6">
											<label for="">First Name</label>
								  			<input type="text" name="firstname" id="firstname" class="form-control"  placeholder="Enter First Name." required  />
								  			
										</div>
										<div class="col-md-6">
											<label for="">Last Name</label>
								  			<input type="text" name="lastname" id="lastname" class="form-control"  placeholder="Enter Last Name." required  />
								  			
										</div>
										
									</div>
									<p class="text-center text-danger" id="fname"></p>
								</div>
								<div class="form-group">
						  			<label for="">Username</label>
						  			<input type="text" name="username" id="username" class="form-control"  placeholder="Enter Username." onkeypress="return notSpace(event)" required  />
						  			<p class="" id="resultur"></p>
								</div>
						
								<div class="form-group">
						  			<label>Gender</label>
						  			<label class="custom-control custom-radio ml-1">
                                            <input  name="rdogender" type="radio" class="custom-control-input" id="male" value="m" required>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Male</span>
                                    </label>
                                    <label class="custom-control custom-radio" style="margin-left:-10px;">
                                            <input  name="rdogender" type="radio" class="custom-control-input" id="female" value="f" required>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Female</span>
                                    </label>
								</div>

								<div class="form-group">
						  			<label for="">Email</label>
						  			<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address." required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$"/>
						  			<p class="" id="resultemail"></p>
								</div>

								<div class="form-group">
						  			<label for="">Password</label>
						  			<input type="password" name="password" id="password" class="form-control"
						  			placeholder="Enter Password." required />
						  			<p class="text-danger" id="resultpwd"></p>
								</div>

								<div class="form-group">
						  			<label for="">Confirm Password.</label>
						  			<input type="password" name="repass" id="repass" class="form-control" 
						  			placeholder="Enter Re-Password."required />
						  			<p class="text-danger" id="resultrepwd"></p>
								</div>

								<div class="form-group">
									<!-- <p style="font-size: 12px">By Clicking Sign Up button you accept our <a href="#">term & Condition</a></p> -->
						  			<input type="submit" name="btnreg" id="btnreg" value="Sign Up" class="btn-block btn-lg btn btn-custom ">	
								</div>

								<div>
									<h6>Already Have Account ?<a href="#" data-toggle="modal" data-target="#loginModal"> Login Here...</a></h6>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php require_once 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#password, #repass, #email,#username').keypress(function(event){
			$(this).next().html('');
		});
		$('#firstname, #lastname').keypress(function(event){
			$('#fname').html('');
		});
		
	});
</script>
</body>
</html>

