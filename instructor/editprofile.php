<?php

	$title="Edit Profile | Taalem | Online Course Learning";
	require_once 'header.php';

	if (!isset($_SESSION['regid'])) {
		header("Location: index.php");
	}
	if ($_SESSION['usertype'] == "student") {
		header("Location: index.php");
	}

	$dc = new Dataclass();
	$msg;
	$upst;
	$regid = $_SESSION['regid'];
	$username = $_SESSION['username'];
	$usertype = $_SESSION['usertype'];

	include '../inc/editinsdata.php';

	$getuserq = "select * from instructor where regid=$regid";
	$insd = $dc->getRow($getuserq);
	$namear = explode(" ", $insd['instname']);

	$stb = $dc->getTable("select socialbrandname,url from social where regid='$regid'");
	$socialarr = array();
	if ($stb->num_rows == 0) {
		$socialarr = array(
							"", // 0 for facebook
							"", // 1 for twitter
							"",	// 2 for instagram
							"", // 3 for gplus
							"", // 4 for linkedin
							"" // 5 for website
						);
	}
	else{
		while ($rw = mysqli_fetch_assoc($stb)) {
		    
		    array_push($socialarr, $rw['url']);
		}
	}



?>

		<div class="titlepage">
			<div class="row">
				<div class="col-md-6">
					<h1>Edit Profile</h1>
					<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Edit Profile</p>
				</div>
				<div class="col-md-6 text-right pt-4">
					<a href="../profile.php?id=<?= $regid ?>" class="btn btn-custom">View Profile</a>
				</div>
			</div>
			

		</div>

		<div class="container mt-5" style="padding-left:16%;">

			<div class="row text-center">
				<div class="col-md-6 offset-md-2">
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
				<div class="col-md-12">
					<div class="dpdiv profilehead">
						<img src="../<?= $insd['photo'] ?>" class="rounded-circle mb-3 imgr" width="150" height="150" alt="user profile">

						<div class="uplicon">
					      <a href="#" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-upload" aria-hidden="true"></i></a>
					    </div>					
					</div>

					<div class="profilehead ml-3">
						    <h3><?= $username ?></h3>
							<?php
								if ($insd['gender'] == 'm') {
									echo "<span class='text-muted'>Male</span>";
								}
								else
								{
									echo "<span class='text-muted'>Female</span>";
								}
							?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div style="width:750px;">
						<ul class="nav nav-tabs" role="tablist">
						    <li class="nav-item">
						      <a class="nav-link active" data-toggle="tab" href="#personal">Personal Detail</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#sociallink">Social Link</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#aboutme">About Me</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#changepwd">Change Password</a>
						    </li>
						</ul>

						<div class="tab-content">
					    	<div id="personal" class="container tab-pane active"><br>
						 		<form action="" method="post" onsubmit="return userRegVal()">
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label for="">First Name</label>
									  			<input type="text" name="firstname" id="firstname" class="form-control"
									  			value="<?= $namear[0]  ?>" required 
									  			/>
									  			
											</div>
											<div class="col-md-6">
												<label for="">Last Name</label>
									  			<input type="text" name="lastname" id="lastname" class="form-control" value="<?= $namear[1]  ?>"required  />
											</div>
										</div>

										<div class="row mt-2">
											<div class="col-md-6">
												<label for="">Qaulification</label>
									  			<input  type="text" name="quali" id="quali" class="form-control"
									  			value="<?= $insd['qualification'] ?>" required  />
											</div>

											<div class="col-md-6">
												<label for="">Expirance</label>
									  			<input  type="text" name="expr" id="expr" class="form-control"
									  			value="<?= $insd['expirance'] ?>" required  />
											</div>
										</div>
			
										<div class="row mt-2">
											<div class="col-md-12">
												<label for="">Speciality</label>
									  			<input  type="text" name="special" id="special" class="form-control" value="<?= $insd['speciality'] ?>" required  />
											</div>
										</div>


										<div class="row">
											<div class="col-md-12 mt-2">
									  			<input type="submit" name="uppd" class="btn-block btn-lg btn btn-custom" value="Update Data">
											</div>
										</div>
									</div>
								</form>
					    	</div>

						    <div id="sociallink" class="container tab-pane fade"><br>
						    	<form action="" method="post">
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label for=""><i class="fab fa-facebook"></i> Facebook</label>
									  			<input type="text" name="social[facebook]" id="facebook" value="<?= $socialarr[0] ?>" class="form-control"  
									  			/>
									  			
											</div>
											<div class="col-md-12 mt-1">
												<label for=""><i class="fab fa-twitter"></i> Twitter</label>
									  			<input type="text" name="social[twitter]" id="twitter" value="<?= $socialarr[1] ?>" class="form-control"   />
											</div>

											<div class="col-md-12 mt-1">
												<label for=""><i class="fab fa-instagram "></i> Instagram</label>
									  			<input type="text" name="social[instagram]" id="instagram" value="<?= $socialarr[2] ?>" class="form-control"   />
											</div>

											<div class="col-md-12 mt-1">
												<label for=""><i class="fab fa-google-plus"></i> Google Plus</label>
									  			<input type="text" name="social[gplus]" id="googleplus" value="<?= $socialarr[3] ?>" class="form-control"   />
											</div>

											<div class="col-md-12 mt-1">
												<label for=""><i class="fab fa-linkedin"></i> Linked-in</label>
									  			<input type="text" name="social[linkedin]" id="linkedin" value="<?= $socialarr[4] ?>" class="form-control"   />
											</div>

											<div class="col-md-12 mt-1">
												<label for=""><i class="fas fa-globe"></i> Website Link</label>
									  			<input type="text"  name="social[websitelink]" id="websitelink" value="<?= $socialarr[5] ?>" class="form-control" />
											</div>

											<div class="col-md-12 mt-2">
									  			<input type="submit" name="upsocial" class="btn-block btn-lg btn btn-custom" value="Update Link">
											</div>
										</div>
									</div>
								</form>
						    </div>

						    <div id="aboutme" class="container tab-pane fade"><br>
						    	<form action="" method="post" onsubmit="return userRegVal()">
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<textarea class="tinymce form-control" name="aboutme" >
													<?= $insd['about'] ?>
												</textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 mt-2">
										  			<input type="submit" name="upam" class="btn-block btn-lg btn btn-custom" value="Update">
											</div>
										</div>
									</div>
								</form>
						    </div>

						    <div id="changepwd" class="container tab-pane fade"><br>
						    	<form action="" method="post" onsubmit="return userpwd()">
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">Enter Existing Password</label>
													<input type="password" name="expassword" id="expassword" class="form-control" required />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">Enter New Password</label>
													<input type="password" name="newpwd" id="newpwd" class="form-control" required />
													<span class="text-danger" id="pwderr"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">Retype New Password</label>
													<input type="password" name="repwd" id="repwd" class="form-control" required />
													<span class="text-danger" id="repwderr"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<input type="submit" name="uppass" class="btn-block btn-lg btn btn-custom mt-2" value="Change Password">
											</div>
										</div>
									</div>
								</form>
							</div>
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
