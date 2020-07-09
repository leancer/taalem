<?php

	$title="checkout | Taalem | Online Course Learning";
	require_once 'header.php';

	$msg;
	$upst;

	if (isset($_POST['btncreditcard'])) {
		$currentdate = date("Y-m-d");
		$pymentsave = $dc->saveRecord("insert into payment(paymentdate,pmethod,pamount,regid) values('$currentdate','Credit Card','$_SESSION[totalval]','$_SESSION[regid]')");

		if ($pymentsave['success']) {

			for ($i = 0; $i <count($_SESSION['courseid']) ; $i++) {
				$adminshare = round($_SESSION['cprice'][$i] * 20 / 100);
				$insshare = $_SESSION['cprice'][$i] - $adminshare;
				$currentcourseid = $_SESSION['courseid'][$i];
				$instid = $dc->getRow("select instid from course where courseid='$currentcourseid'");

				$earn = $dc->saveRecord("INSERT INTO earning(earndate,regid,courseid,amount) VALUES('$currentdate','$instid[instid]','$currentcourseid','$insshare'),('$currentdate','1','$currentcourseid','$adminshare')");
				$enroll = $dc->saveRecord("INSERT INTO courseenroll(courseid,regid,enrolldate) VALUES('$currentcourseid','$_SESSION[regid]','$currentdate')");
				$deletefromcart = $dc->deleteRecord("DELETE FROM cart where courseid='$currentcourseid' and regid='$_SESSION[regid]'");
			}
			if ($earn['success'] and $enroll['success'] and $deletefromcart) {
				$msg = "success";
				$upst=true;
				header("refresh:3,usercourse.php");
			}else{
				$msg = "not success";
			$upst=false;
			}
			
		}else{
			$msg = "not success";
			$upst=false;
		}
	}



	if (isset($_POST['btndebitcard'])) {
		$currentdate = date("Y-m-d");
		$pymentsave = $dc->saveRecord("insert into payment(paymentdate,pmethod,pamount,regid) values('$currentdate','Debit Card','$_SESSION[totalval]','$_SESSION[regid]')");

		if ($pymentsave['success']) {

			for ($i = 0; $i <count($_SESSION['courseid']) ; $i++) {
				$adminshare = round($_SESSION['cprice'][$i] * 20 / 100);
				$insshare = $_SESSION['cprice'][$i] - $adminshare;
				$currentcourseid = $_SESSION['courseid'][$i];
				$instid = $dc->getRow("select instid from course where courseid='$currentcourseid'");

				$earn = $dc->saveRecord("INSERT INTO earning(earndate,regid,courseid,amount) VALUES('$currentdate','$instid[instid]','$currentcourseid','$insshare'),('$currentdate','1','$currentcourseid','$adminshare')");
				$enroll = $dc->saveRecord("INSERT INTO courseenroll(courseid,regid,enrolldate) VALUES('$currentcourseid','$_SESSION[regid]','$currentdate')");
				$deletefromcart = $dc->deleteRecord("DELETE FROM cart where courseid='$currentcourseid' and regid='$_SESSION[regid]'");
			}
			if ($earn['success'] and $enroll['success'] and $deletefromcart) {
				$msg = "success";
				$upst=true;
				header("refresh:3,usercourse.php");
			}else{
				$msg = "not success";
			$upst=false;
			}
			
		}else{
			$msg = "not success";
			$upst=false;
		}
	}
?>

		<div class="titlepage">
			
			<h1>Checkout</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> / <a href="<?= URL.'cart.php' ?>"  class="a-white"> cart </a>/ CheckOut</p>

		</div>

		<div class="container mt-5">
			<div class="row text-center mb-3">
				<div class="col-md-6 offset-md-3" id="stmsgbox">
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
					<div class="card paycard">
						<h1 class="text-center payhead">Payments</h1>

						<div class="row m-2">
							<div class="col-md-3">
						
								<ul class="nav nav-tabs flex-column payment-tab">
								  <li class="nav-item">
								    <a class="nav-link" data-toggle="tab" href="#creditcard">Credit Card</a>
								  </li>
								  <li class="nav-item">
								    <a class="nav-link" data-toggle="tab" href="#debitcard">Debit Card</a>
								  </li>
								</ul>
							</div>
							<div class="col-md-9">
								<!-- Tab panes -->
								<div class="tab-content">
								  <div class="tab-pane active container" id="creditcard">
								  	
								  	<form action="" method="post" onsubmit="return checkCreditCard()">
								  		
								  		<div class="form-group">
								  			
								  			<label for="">Card Number</label>
								  			<input type="text" name="creditcardno" id="ccno" class="form-control" required />
								  			<p class="text-danger" id="resultmsg"></p>

								  		</div>
								  		<h2>₹ <?= $_SESSION['totalval'] ?> <span style="font-size: 15px">(Total Amount Payble)</span></h2>
								  		<div class="form-group">
								  			
								  			<input type="submit" name="btncreditcard" class="btn btn-success" value="Make Payment">
								  			<a href="cart.php" class="btn btn-danger">Cancel</a>
								  		</div>


								  	</form>

								  </div>
								  <div class="tab-pane container" id="debitcard">
									<form action="" method="post" onsubmit="return checkDebitCard()">
								  		
								  		<div class="form-group">
								  			
								  			<label for="">We Accept</label>
								  			<select id="cardname" class="form-control">
								  				<option value="mastercard">Master Debit Card</option>
								  				<option value="visacard">Visa Card</option>
								  				<option value="rupaycard">Rupay Card </option>
								  			</select>

								  		</div>

								  		<div class="form-group">
								  			<label for="">Card Number</label>
								  			<input type="text" id="dcno" class="form-control" required/>
								  			<p class="text-danger" id="resultdc"></p>
								  		</div>

								  		<div class="row">
								  			<div class="col-md-4">
								  			<div class="form-group">
								  			
								  				<label for="expirydate">Expriy Date</label>
									  			<select id="" class="form-control " required>
									  				<option value="jan">Jan</option>
									  				<option value="feb">Feb</option>
									  				<option value="mar">Mar </option>
									  				<option value="apr">Apr</option>
									  				<option value="may">May </option>
									  				<option value="june">June</option>
									  				<option value="july">July</option>
									  				<option value="aug">Aug</option>
									  				<option value="sep">Sep</option>
									  				<option value="oct">Oct</option>
									  				<option value="nov">Nov</option>
									  				<option value="dec">Dec</option>
									  			</select>	
								  			</div>
								  			
								  		</div>
								  		<div class="col-md-4">
								  			<div class="form-group">
								  			
								  				<label for="expirydate">Expriy Date</label>
									  			<select id="" class="form-control ">
									  				<?php 

									  				$year = date('Y');
									  				echo $year;

									  				for ($i = 1; $i <= 20 ; $i++) {
									  					
									  					echo '<option value="'.$year.'">'.$year.'</option>';
									  					$year++;
									  				}


									  				 ?>
									  			</select>	
								  			</div>
								  			
								  		</div>

								  		<div class="col-md-4">
								  			<div class="form-group">
								  				<label for="cvv">CVV</label>
								  				<input type="number" id="cvvno" class="form-control" required >
												<p class="text-danger" id="resultcvv"></p>
								  			</div>
								  		</div>
								  		<h2>₹ <?= $_SESSION['totalval'] ?> <span style="font-size: 15px">(Total Amount Payble)</span></h2>
								  		</div>

										

								  		<div class="form-group">
								  			
								  			<input type="submit" name="btndebitcard" class="btn btn-success" value="Make Payment">
								  			<a href="#" class="btn btn-danger">Cancel</a>
								  		</div>
								  	</form>
								  	
								  </div>
								</div>
							</div>
						</div>	
						
					</div>

				</div>
			</div>
		</div>
<?php require_once 'footer.php'; ?>
</body>
</html>

