<?php

	$title="Payment Success | Taalem | Online Course Learning";
	require_once 'header.php';
	if (empty($_SESSION['totalval'])) {
		header("location:index.php");
	}
	$msg;
	$upst;

	$status=$_POST["status"];
	$firstname=$_POST["firstname"];
	$amount=$_POST["amount"];
	$txnid=$_POST["txnid"];
	$posted_hash=$_POST["hash"];
	$key=$_POST["key"];
	$productinfo=$_POST["productinfo"];
	$email=$_POST["email"];
	$salt=getenv('salt');

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   } else {
          	$currentdate = date("Y-m-d");
		$pymentsave = $dc->saveRecord("insert into payment(paymentdate,pmethod,pamount,regid) values('$currentdate','Payu','$_SESSION[totalval]','$_SESSION[regid]')");

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
				$_SESSION['totalval']="";
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
<section class="payment-form dark">
				<div class="container">
					<div class="block-heading">
						<h2>Payment</h2>
					</div>
					
					<form>
						<div class="card-details compare-card">
							<h3 class="title">Payment Status</h3>
							<div class="row">
								<div class="col-sm-12">
									<?php if(isset($upst) and $upst): ?>
										<h3 class="text-center">Payment Successful</h3>
									<p class="text-muted">Detail</p>
									<table style="font-size: 20px;">
										<tr>
											<td>Transaction Id</td>
											<td>:</td>
											<td><?= $txnid ?></td>
										</tr>
										<tr>
											<td>Amount:</td>
											<td>:</td>
											<td><?= $amount ?></td>
										</tr>
									</table>
									<div class="text-center mt-5">
										<a href="usercourse.php" class="btn btn-custom">Go to MyCourse</a>
									</div>
									<?php endif ?>
									
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</section>

<?php require_once 'footer.php'; ?>
</body>
</html>