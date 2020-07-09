<?php

	$title="Login | Taalem | Online Course Learning";
	require_once 'header.php';
?>

		<div class="titlepage">
			
			<h1>Login</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Login</p>

		</div>

		<div class="container mt-5">
			<div class="row">
				<div class="col-md-6 mx-auto">
					<div class="card ">
						<div class="reghead">
							<h1 class="mt-2 float-left">Login</h1>
							<i class="fas fa-lock fa-3x float-right m-2"></i>
						</div>
						<div class="card-body">
							<form action="" method="post">
					      		<div class="formgroup">
						      		<label for="">Username</label>
						      		<input type="text" name="username" id="lgbxusername" class="form-control"  placeholder="Enter Username." onkeypress="return notSpace(event)" required />
					      		</div>
					      		<div class="formgroup">
						      		<label for="">Password</label>
									<input type="password" name="password" id="lgbxpassword" class="form-control"
									placeholder="Enter Password." required />
					      		</div>
					      		<div class="form-group">
									<input type="checkbox" name="remember" value="me"> Remember Me
								</div>
					      		<div class="form-group">
									<input type="submit" name="btnlogin" id="btnlogin" value="Login" class="btn-block btn-lg btn btn-custom mt-3">
								</div>
								<div>
									<h6 class="float-left mt-2">Forget password? Please <a href="forgetpassword.php" style="color:#f74040">click here.</a></h6>
									<h6 class="float-right mt-2">Create <a href="" style="color:#f74040">new account.</a></h6>
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
