<?php

	$title="cart | Taalem | Online Course Learning";
	require_once 'header.php';


	if (isset($_SESSION['regid'])) {
		$getcartd = $dc->getTable("SELECT ct.courseid, c.coursename,c.thumbnailurl,c.price,i.instname,ct.* from cart ct, course c, instructor i where ct.courseid = c.courseid and c.instid = i.regid and ct.regid = '$_SESSION[regid]'");

		$_SESSION['totalval'] = 0;
		$_SESSION['courseid'] = array();
		$_SESSION['cprice'] = array();

		$nocd = mysqli_num_rows($getcartd);

		if (isset($_GET['did'])) {

			$did = $_GET['did'];
			// unset($_SESSION['courseid']);
			// unset($_SESSION['cprice']);
			// $_SESSION['courseid']=array();
			// $_SESSION['cprice']=array();
			// print_r($_SESSION['courseid']);
			$deletecart = $dc->deleteRecord("Delete from cart where cartid='$did'");
			if ($deletecart) {
			 	header("location: cart.php");
			 }
		}
	}
	
?>

		<div class="titlepage">
			
			<h1>Cart</h1>
			<p><a href="<?= URL ?>"><i class="fas fa-home"></i></a> / cart</p>

		</div>
	</div>

	<div class="container mt-5">

		<?php if (isset($_SESSION['regid'])): ?>
		
		<div class="row">
			
			<div class="col-md-8 p-2">
				
				<p> <?= $nocd ?> Course in Cart</p>
				<?php 
					if ($nocd > 0) {
					$i=0;
					while($rw = mysqli_fetch_assoc($getcartd)){

						$_SESSION['courseid'][$i] = $rw['courseid'];
						$_SESSION['cprice'][$i] = $rw['price'];
				 ?>
				<div class="row p-2" style="border: 1px solid #DEDEDE">
					<div class="col-sm-2 hidden-xs"><img src="content/<?= $rw['thumbnailurl'] ?>" height="100px" width="100px" alt="..." class="imgr"/></div>
					<div class="col-sm-6">
						<h4 class="m-0" style="word-wrap: break-word;"><?= $rw['coursename'] ?></h4>
						<p class="m-0 text-muted"><?= $rw['instname'] ?></p>
					</div>
					<div class="col-sm-2 text-center pt-3">
						<a href="cart.php?did=<?= $rw['cartid'] ?>" class="a-black"><i class="fas fa-trash fa-2x"></i></a>
					</div>
					<div class="col-sm-2 pt-3">
						<?php $_SESSION['totalval'] = $_SESSION['totalval'] + $rw['price']; ?>
						<h3>₹ <?= $rw['price'] ?></h3>
					</div>
				</div>
				
				<?php $i++; }
				}else{
					echo '<p class="text-center">You Do not Have any Course in cart</p>';
				} ?>

			</div>

			<div class="col-md-4 pt-4 px-5">
				
				<h3>Total:</h3>
				<h1 class="display-4">₹ <?= $_SESSION['totalval'] ?></h1>
				<a href="newcheckout.php" class="btn btn-warning btn-lg d-block <?php if($_SESSION['totalval'] == 0){ echo 'disabled'; } ?>">Checkout</a>
				<form action="" class="mt-5 text-center">
					<input type="text" class="form-control d-block">
					<input type="submit" class="btn btn-success mt-1" value="Apply Code">
				</form>
				
			</div>

		</div>
		<?php else: ?>		

			<div class="row">
				
				<div class="col">
					<p class="text-center">Please Login or Register To Access Cart Details. <a href="login.php" class="a-black">Click here to Login</a></p>
				</div>

			</div>

		<?php endif ?>

		<div class="row mt-4">

			<div class="col-md-12"><h3>You Might Also Like</h3></div>

			<?php 
			$coursed = $dc->getTable("select c.*,i.instname from course c,instructor i where c.instid=i.regid order by rand() limit 4");

			while ($rw= mysqli_fetch_assoc($coursed)) {
			 ?>
			
			<div class="col-md-3 col-sm-6 mb-3 rec">
						
				<div class="card single-card" style="width: 15rem;height: auto">
					<img class="card-img-top imgr" src="content/<?= $rw['thumbnailurl'] ?>" alt="Card image cap" height="120px">
					<div class="card-body">
						<p class="card-title"><?= $rw['coursename'] ?></p>
						<p class="card-text"><span class="text-muted"> <?= $rw['instname'] ?></span></p>
						<hr/>
						<?php if ($rw['coursetype'] == 'free'): ?>
							<a href="singlecourse.php?id=<?= $rw['courseid'] ?>" class="btn btn-primary mr-2"><?= $rw['coursetype'] ?></a>
						<?php else: ?>
							<a href="singlecourse.php?id=<?= $rw['courseid'] ?>" class="btn btn-primary mr-2"><?= $rw['price'] ?></a>	
						<?php endif ?>
						
						<?php $totalenroll = $dc->getRow("select count(enrollid) as total from courseenroll where courseid='$rw[courseid]'"); ?>
						<span class="mx-2"><i class="fas fa-user"></i> <?= $totalenroll['total'] ?></span>
						<?php $totalrv = $dc->getRow("select count(revid) as total from review where courseid='$rw[courseid]'"); ?>
						<span class="mx-2"><i class="fas fa-comments"></i> <?= $totalrv['total'] ?> </span>

					</div>
				</div>

			</div>
			<?php } ?>
			
		</div>

	</div>



<?php require_once 'footer.php'; ?>
</body>
</html>
