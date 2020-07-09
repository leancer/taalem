<?php 

	$title = "feedback | Taalem ";
	include_once 'header.php';
	$msg;
	$upst;
	if (isset($_POST['btnfb'])) {
		$curdate = date("Y-m-d");

		$msg = mysqli_real_escape_string($dc->getConn(),$_POST['msg']);
		$savefb = $dc->saveRecord("insert into feedback(fbdate,regid,fbfor,detail,star,sih) values('$curdate','$_SESSION[regid]','website','$msg','$_POST[star]',0)");
		if ($savefb['success']) {
			$upst = true;
			$msg="FeedBack success Sent, Thank You!";
		}else{
			$upst=false;
			$msg="Something Went Wrong ".$savefb['error'];
		}
	}

 ?>

 <div class="titlepage">
			
			<h1>FeedBack</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> FeedBack</p>

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
			<?php if (!isset($_SESSION['regid'])): ?>
				<div class="row">
					<div class="col-md-6 mx-auto text-center">
						<p>You Have To Login for Give Feedback</p>
					</div>	
				</div>
			<?php else: ?>
			
			<div class="row">
				<div class="col-md-6 mx-auto">
					<div class="card ">
						<div class="reghead">
							<h1 class="mt-2 float-left">FeedBack</h1>
						</div>
						<div class="card-body">
							<form action="" method="post">
					      		<div class="formgroup">
					      			<label for="">Give us Rating</label>
						    				<div class="stars">
												<input type="radio" title="I Hate It" name="star" value="1" class="star-1" id="star-1" />
												<label class="star-1" for="star-1">1</label>
												<input type="radio" title="I Don't Like It" name="star" value="2" class="star-2" id="star-2" />
												<label class="star-2" for="star-2">2</label>
												<input type="radio" title="It's Ok" name="star" value="3" class="star-3" id="star-3" />
												<label class="star-3" for="star-3">3</label>
												<input type="radio" title="I LIke It" name="star" value="4" class="star-4" id="star-4" />
												<label class="star-4" for="star-4">4</label>
												<input type="radio" title="I Love It" name="star" value="5" class="star-5" id="star-5" />
												<label class="star-5" for="star-5">5</label>
												<span></span>
											</div>
					      		</div>
					      		<div class="formgroup">
						      		<label for="">Messege:</label>
									<textarea name="msg" id="" class="form-control" cols="30" rows="10" placeholder="Your Text Here....."></textarea>
					      		</div>
					      		<div class="form-group">
									<input type="submit" name="btnfb" id="btnlogin" value="FeedBack" class="btn-block btn-lg btn btn-custom mt-3">
								</div>
		      				</form>
		      				
						</div>	
					</div>
				</div>
			</div>
			<?php endif ?>
		</div>


<?php require_once 'footer.php'; ?>
</body>
</html>