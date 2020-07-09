<?php

	$title="Payment Fail | Taalem | Online Course Learning";
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
         $upst=true;
         $_SESSION['totalval']="";
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
										<h1 class="text-center">Payment Fail</h1>
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