<?php 
	session_start();
	ob_start();
	require_once 'inc/config.php'; 
	require_once 'inc/dataclass.php';
	include 'inc/logincode.php'; 
	include 'inc/functions.php';
	if (empty($_GET['s'])) {
	 	$_GET['s'] = "";
	 }
	 if (empty($_SESSION['totalval'])) {
	 	header("location:index.php");
	 }


	 //Payu
	 $MERCHANT_KEY = getenv('MERCHANT_KEY');
$SALT = getenv('salt');
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;

    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Confirm Checkout</title>

	<link rel="icon" href="assests/img/taalem-T.png">

	<!-- Css Files  -->
	<link rel="stylesheet" href="assests/libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assests/libs/animatecss/animate.min.css" />
	<link rel="stylesheet" href="assests/libs/fontawesome/css/fontawesome-all.min.css" />
	<link rel="stylesheet" href="assests/libs/jqueryui/jquery-ui.min.css">
	<link rel="stylesheet" href="assests/libs/slick/slick.css">
	<link rel="stylesheet" href="assests/libs/slick/slick-theme.css">
	<link rel="stylesheet" href="assests/css/main.css">
	<link rel="stylesheet" href="assests/css/star.css">
	<style>


	</style>
<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
</head>
<body onload="submitPayuForm()">

	<div class="container-fluid" style="padding:0px">
		
		<nav class="navbar navbar-expand-lg navbar-light mynavbar">
		  <a class="navbar-brand"  href="<?= URL ?>"><img src="assests/img/taalem-128.png" class="mx-auto"  alt="Taalem Logo 1080"></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse " id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Categories
		        </a>
		        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
		        	<?php 
		        		$parcat = $dc->getTable("select catid,catname from category where catparentid=0");
		        		while($parcatrw = mysqli_fetch_assoc($parcat)){
		        	 ?>
	                <li class="dropdown-submenu"><a class="dropdown-item" tabindex="-1" href="course.php?catid=<?= $parcatrw['catid'] ?>"><?= $parcatrw['catname'] ?></a>
	                	<ul class="dropdown-menu">
						<?php showSubCat($parcatrw['catid'],$dc); ?>
						</ul>
	                </li>
                <?php } ?>
                
              </ul>
		      </li>
		    </ul>

			<form class="form-inline menu-search" method="get" action="./search.php">
		      <input class="mx-2 animated bounceInDown" id="header-search" type="text" placeholder="What you want to learn today ?" name="s" aria-label="Search" value="<?= $_GET['s'] ?>" required>
		      <!--<button class="btn btn-outline-success animated bounceInDown my-2 my-sm-0" type="submit">Search</button>-->
				
		      <button type="submit" class="btn search animated bounceInDown"><i class="fas fa-search"></i></button>
		    </form>
		    <?php

		    	if (!isset($_SESSION['regid'])) {
		    		$countc = 0;
		    	}else{
		    		$cc = $dc->getRow("SELECT count(cartid) as cc from cart where regid='$_SESSION[regid]'");
		    		$countc = $cc['cc'];
		    	}
		     ?>
		    <a href="cart.php" class="mr-3"  style="color:black;font-size:20px"><i class="fas fa-shopping-cart"></i><span class="badge mybadge"><?= $countc ?></span></a>
			<?php 
				

				if (!isset($_SESSION['regid'])) {
			 ?>
		    <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#loginModal">Login</button>
		      <a href="reg.php" class="btn btn-custom mx-2 my-sm-0" >SignUp</a>
		      <?php }else{ ?>
				
				<h5 class="mr-4"><a class="a-black" href="usercourse.php">My Courses</a>
				</h5>
				<div class="dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						
						<img src="<?= $dc->getDp($_SESSION['regid'],$_SESSION['usertype']) ?>" class="rounded-circle imgr" height="35px" width="35px" alt="user profile">
					</a>
				    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        <a class="dropdown-item" href="#">Hey <?= $_SESSION['username'] ?></a>
				        <a class="dropdown-item" href="profile.php?id=<?= $_SESSION['regid'] ?>">View Profile</a>
				        <?php 
				        if ($_SESSION['usertype'] == "student") {
				        	$edprurl = "editstuprofile.php";
				        }else{
				        	$edprurl = "instructor/editprofile.php";
				        }
				         ?>
				        <a class="dropdown-item" href="<?= $edprurl ?>">Edit Profile</a>
				        <div class="dropdown-divider"></div>
				        <a class="dropdown-item" href="logout.php">Logout</a>
				    </div>
				</div>


		     <?php } ?>
		  </div>
		</nav>
<section class="payment-form dark">
				<div class="container">
					<div class="block-heading">
						<h2>Confirm Detail</h2>
					</div>
					
					<form action="<?php echo $action; ?>" method="post" name="payuForm">
				      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
				      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
				      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />

						<div class="card-details compare-card">
							<h3 class="title">Credit Card Details</h3>
							<div class="row">
								<div class="form-group col-sm-5">
									<label for="card-holder">Total Amount</label>
									<h2><?= $_SESSION['totalval'] ?></h2>
									<input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? $_SESSION['totalval'] : $posted['amount'] ?>" />
								</div>
								<div class="form-group col-sm-7">
									<label for="">Your Name</label>
									<?php $gname = $dc->getRow("(SELECT instname as name FROM instructor WHERE regid = '$_SESSION[regid]') UNION (SELECT name as name FROM student WHERE regid = '$_SESSION[regid]')"); ?>
									<input name="firstname" id="firstname" class="form-control" value="<?php echo (empty($posted['firstname'])) ? $gname['name'] : $posted['firstname']; ?>" required/>
								</div>
								<div class="form-group col-sm-6">
									<label for="card-number">Email:</label>
									<?php $gemail = $dc->getRow("SELECT email FROM register WHERE regid = '$_SESSION[regid]'"); ?>
									<input type="email" name="email" id="email" class="form-control" value="<?php echo (empty($posted['email'])) ? $gemail['email'] : $posted['email']; ?>" required/>
								</div>
								<div class="form-group col-sm-6">
									<label for="cvc">Phone Number:</label>
									<input name="phone" class="form-control" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" required/>
								</div>
								<textarea style="display: none;" name="productinfo"><?php echo (empty($posted['productinfo'])) ? 'taalemproduct' : $posted['productinfo'] ?></textarea>
								<input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? 'http://localhost/academy/paymentsuccess.php' : $posted['surl'] ?>" size="64" />
								<input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? 'http://localhost/academy/paymentfail.php' : $posted['furl'] ?>" size="64" />
								<input type="hidden" name="service_provider" value="payu_paisa" size="64" />
								<div class="form-group col-sm-12">
									<button type="submit" class="btn custom-btn btn-block">Proceed to Pay</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</section>

<div class="container-fluid foot">
		<div class="row footer">
			<div class="col-md-12 pt-3">
				<div class="row my-2">
					<div class="col-md-4 col-xs-12 p-4 wow fadeInUpBig">
						<div class="text-center pb-2">
						<img src="assests/img/taalem-128.png" class="mx-auto"  alt="Taalem Logo 1080"></div>	
						<p class="text-center" style="color:#979797">Lorem ipsum dolor sit amet, vix an natu tur eleifend, mel amet laorit menandri. Ei item justo complectitur duo.</p>
				
						<div class="social-icon text-center">
							<a href="#"><i class="fab fa-facebook mx-1"></i></a>
							<a href="#"><i class="fab fa-twitter mx-1"></i></a>
							<a href="#"><i class="fab fa-instagram mx-1"></i></a>
							<a href="#"><i class="fab fa-google-plus mx-1"></i></a>
							<a href="#"><i class="fab fa-linkedin mx-1"></i></a>
						</div>
					</div>
					<div class="col-md-4 col-xs-12 p-4 wow fadeInUpBig">
						
						<h2 class="pl-3"> Quick Links</h2>

						<ul class="ft-ql">
							<li><i class="fas fa-angle-right mr-2"></i><a href="aboutus.php">About us</a></li>
							<li><i class="fas fa-angle-right mr-2"></i><a href="#">Our Mission</a></li>
							<li><i class="fas fa-angle-right mr-2"></i><a href="#">Help Center</a></li>
							<li><i class="fas fa-angle-right mr-2"></i><a href="#">FAQ's</a></li>
						</ul>

					</div>
					<div class="col-md-4 col-xs-12 p-4 wow fadeInUpBig">
						<h2 class="pl-3"> Address</h2>

						<ul class="ft-add">
							<li><i class="fas fa-address-book mr-2"></i>Navsari Gujarat 396445, India</li>
							<li><i class="fas fa-mobile mr-2"></i>+91 9876543210</li>
							<li><i class="fas fa-phone-square mr-2"></i>02637-555555</li>
							<li><i class="fas fa-envelope mr-2"></i><a href="mailto:contact@taalem.com">contact@taalem.com</a></li>
						</ul>
					</div>
				</div>
				<hr class="mx-auto style13 my-3" style="width: 100%;height: 3px;">
				<div class="row">
					<div class="col-md-6 col-sm-12 pl-5">
						<p class="">© 2018 Taalem. Designed & Developed By DashMedia</p>
					</div>
					<div class="col-md-6 text-right col-sm-12">
						<ul class="ft-sublink">
							<li><a href="">Privacy Policy</a></li>
							<i>|</i>
							<li><a href="">Term And Conditions</a></li>
						</ul>
					</div>
				</div>
			</div>
			
		</div>

		<div class="modal animated zoomIn" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header reghead">
		      	<i class="fas fa-lock mt-2 mr-1" style="font-size:20px;"></i>
		        <h4 class="modal-title" id="exampleModalLabel">Login</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true" style="color:#fff;font-size:30px;">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="" method="post">
		      		<div class="formgroup">
			      		<label for="">Username</label>
			      		<input type="text" name="username" id="lgusername" class="form-control"  placeholder="Enter Username." required />
		      		</div>
		      		<div class="formgroup">
			      		<label for="">Password</label>
						<input type="password" name="password" id="lgpassword" class="form-control"
						placeholder="Enter Password." required />
		      		</div>
		      		<div class="form-group">
						<input type="submit" name="btnlogin" id="btnlogin" value="Login" class="btn-block btn-lg btn btn-custom mt-3">
					</div>
					<div>
						<h6 class="float-left mt-2">Forget password? Please <a href="forgetpassword.php" style="color:#f74040">click here.</a></h6>
						<h6 class="float-right mt-2">Create <a href="reg.php" style="color:#f74040">new account.</a></h6>
					</div>
		      	</form>
		      </div>
		    </div>
		  </div>
		</div>
		<i class="fas fa-angle-up fa-2x scrollup"></i>
	</div>


	<!-- Javascript files -->

	<script src="assests/libs/jquery/jquery-3.2.1.min.js"></script>
	<script src="assests/libs/bootstrap/js/umd/popper.min.js"></script>
	<script src="assests/libs/bootstrap/js/bootstrap.min.js"></script>
	<script src="assests/libs/jqueryui/jquery-ui.min.js"></script>
	<script src="assests/libs/animatecss/wow.min.js"></script>
	<script src="assests/libs/jquery/jquery-migrate-3.0.0.min.js"></script>
	<script src="assests/libs/slick/slick.js"></script>
	<script src="assests/libs/tinymce/tinymce.min.js"></script>
	<script src="assests/libs/tinymce/init-tinymce.js"></script>
	<!-- <script src="assests/libs/particles/particles.min.js"></script> -->
	<script src="assests/js/main.js"></script>
</body>
</html>