<?php
	$title="Edit Profile | Taalem";
	require_once 'header.php';
	if (!isset($_SESSION['regid'])) {
		header("Location: index.php");
	}
	if ($_SESSION['usertype'] != "student") {
		header("Location: index.php");
	}
	$dc = new Dataclass();
	$msg;
	$upst;
	$regid = $_SESSION['regid'];
	$username = $_SESSION['username'];
	$usertype = $_SESSION['usertype'];

	include 'inc/studeditdata.php';

	

	$getuserq = "select * from student where regid=$regid";
	$getdate = "select regdate from register where regid=$regid";

	$userd = $dc->getRow($getuserq);
	$regdt = $dc->getRow($getdate);
	$getcityq = "select cityid, cityname from city";
	$city = $dc->getTable($getcityq);

	$namear = explode(" ", $userd['name']);

?>
		<div class="titlepage">
			<div class="row">
				<div class="col-md-6">
					<h1><?= $username ?></h1>
				</div>
				<div class="col-md-6 text-right">
					<a href="profile.php?id=<?= $regid ?>" class="btn btn-custom">View Profile</a>
				</div>
			</div>
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


			<div class="row inspro">
				<div class="col-md-2 stimg">
					<img class="rounded-circle wow rollIn" src="<?= $dc->getDp($regid,$usertype) ?>">
					<div class="edupload">
					    <a href="#" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-upload" aria-hidden="true"></i></a>
					</div>					
				</div>

				<div style="border-bottom:5px solid #676767;width:750px;border-radius: 2px;">
				<h3 class="mt-5 wow flipInX" style="font-weight: bold;font-size: 32px;"><?php echo $namear[0]." ".$namear[1]; ?></h3>
				<h5 class="wow flipInX text-muted">Register Since <?= date('Y',strtotime($regdt['regdate'])); ?> <br/> <i class="fas fa-transgender"></i>

					<?php
						if ($userd['gender'] == 'm') {
							echo "Male";
						}
						else
						{
							echo "Female";
						}
					?>
				 </h5>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
				</div>
				
				<div class="col-md-10 mt-3">
					<div style="width:750px;">
							<ul class="nav nav-tabs" role="tablist">
							    <li class="nav-item">
							      <a class="nav-link active" data-toggle="tab" href="#personal">Personal Detail</a>
							    </li>
							    <li class="nav-item">
							      <a class="nav-link" data-toggle="tab" href="#aboutme">About Me</a>
							    </li>
							    <li class="nav-item">
							      <a class="nav-link" data-toggle="tab" href="#changepwd">Change Password</a>
							    </li>
							</ul>
					</div>

					<div class="tab-content">
						<div id="personal" class="container tab-pane active"><br>
							<form action="" method="post" onsubmit="return userRegVal()">
								<div class="form-group">
									<div class="row">
										<div class="col-md-5">
											<label for="">First Name</label>
								  			<input type="text" name="fname" id="fname" class="form-control" value="<?= $namear[0] ?>" required />
										</div>
										<div class="col-md-5">
											<label for="">Last Name</label>
								  			<input type="text" name="lname" id="lname" class="form-control" value="<?= $namear[1] ?>" required />
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-10">
											<label for="">Address</label><br>
											<textarea name="address" id="" cols="40" rows="4" style="width: 100%;border-radius: 5px;padding:10px;"><?= $userd['address'] ?></textarea>
										</div>
									</div>

									<div class="row mt-2">
										<div class="col-md-5">
											<label for="">City</label><br>
											<select class="form-control" name="city" id="">
												<?php 
													while($cr=mysqli_fetch_assoc($city))
												{
												 ?>
												<option value="<?= $cr['cityid'] ?>" <?php if($cr['cityid'] == $userd['cityid']){ echo "selected"; } ?>><?= $cr['cityname'] ?></option>
												<?php } ?>
											</select>
										</div>

										<div class="col-md-5">
											<label for="">Interest</label>
											<input type="text" name="interest" id="interest" class="form-control" value="<?= $userd['interest'] ?>" required />
										</div>
									</div>

									<div class="row mt-2">
										<div class="col-md-10">
											<input type="submit" name="uptpd" class="btn-block btn-lg btn btn-custom" value="Update">
										</div>
									</div>
								</div>
							</form>	
						</div>

						<div id="aboutme" class="container tab-pane "><br>
							<form action="" method="post">
									<div class="form-group">
										<div class="row">
											<div class="col-md-10">
												<label for="">About Me</label><br>
												<textarea class="tinymce form-control" name="aboutme"><?= $userd['about'] ?></textarea>
												
												<input type="submit" name="upam" class="btn-block btn-lg btn btn-custom mt-2" value="Update">
											</div>
										</div>
									</div>
							</form>
						</div>

						<div id="changepwd" class="container tab-pane "><br>
							<form action="" method="post" onsubmit="return userpwd()">
									<div class="row">
										<div class="col-md-10">
											<div class="form-group">
												<label for="">Enter Existing Password</label>
												<input type="password" name="expassword" id="expassword" class="form-control" required />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-10">
											<div class="form-group">
												<label for="">Enter New Password</label>
												<input type="password" name="newpwd" id="newpwd" class="form-control" required />
												<span class="text-danger" id="pwderr"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-10">
											<div class="form-group">
												<label for="">Retype New Password</label>
												<input type="password" name="repwd" id="repwd" class="form-control" required />
												<span class="text-danger" id="repwderr"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-10">
											<input type="submit" name="uppass" class="btn-block btn-lg btn btn-custom mt-2" value="Change Password">
										</div>
									</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Upload Profile Picture</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body p-5">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
					  <label for="file"> Select File</label>
					  <input type="file" class="form-control" name="dpfile" required>
					</div>
			</div>
			<div class="modal-footer text-left">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="btnupdp" class="btn btn-primary">Upload</button>
				</form>
			</div>
		</div>
	</div>
</div>


<?php require_once 'footer.php'; ?>
<script>
	
	function userpwd(){
		var pwd=document.getElementById('newpwd').value;
		var pwdreg= /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{7,19}$/;
		var repwd=document.getElementById('repwd').value;

		if(pwd.length >= 6 && pwd.length <= 20)
				{
					if(pwd.match(pwdreg))
					{
						if(repwd==pwd)
						{
							return true;
						}else{
							document.getElementById("repwderr").innerHTML = "Password Mismatch.";
							return false;	
						}
					}else{
						document.getElementById("pwderr").innerHTML = "Contain atlest one alpha one number and one special char.";
							return false;
					}
				}else{
					document.getElementById("pwderr").innerHTML = "Must Between 6 to 20.";
							return false;
				}
	}

</script>
</body>
</html>
