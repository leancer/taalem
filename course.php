<?php

	$title="Course  | Taalem | Online Course Learning";
	require_once 'header.php';
	$pjn = new Pagination();

	$cat = $_GET['catid'];
	$q = "SELECT course.*,instructor.instid,instructor.instname from course left join instructor on course.instid = instructor.regid where course.catid='$cat' ";

	if (!isset($_GET['p'])) {
		$page = 1;
	}else{
		$page = $_GET['p'];
	}

	$q = $pjn->getPagQuery($q,5,$page);
	$catr = $dc->getTable($q);
	$nor = mysqli_num_rows($catr);
?>

		<div class="titlepage">
			
			<h1>Course</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Course</p>
		</div>
			
		<div class="container mt-5">
			<div class="row mb-4">
					<div class="col-md-12 subcat" style="display: inline;">
						<?php 
						$gtsb = $dc->getTable("select catid,catname from category where catparentid='$cat'");
						if ($gtsb->num_rows != 0) {
						while ($rwsub = mysqli_fetch_assoc($gtsb)) {
							?>
							<div class="sbox float-left" style="background:#007bff;margin-right:5px;padding: 4px 5px;border-radius: 5px;text-align:center;">
								<a href="course.php?catid=<?= $rwsub['catid'] ?>" style="text-decoration: none;"><span style="font-size:12px;font-weight: bold;color:#fff;"> <?= $rwsub['catname'] ?></span></a>
							</div>
							<?php
						} }?>

					</div>
				</div>

			<div class="row mb-4">
				<div class="col-md-6 ">
					<h2 class="float-left">our Course</span></h2>
				</div>
				<div class="col-md-6 ">
					<select id="sortby" class="form-control float-right searchdrop">
					 		<option value="default">Sort By</option>
					 		<option value="pasc">Price Low to High</option>
					 		<option value="pdesc">Price High to Low</option>
					 </select>
					 <select id="pricewala" class="form-control float-right searchdrop" onchange="location = this.value;">
					 	<option value="default">Price</option>
					 	<?php 
					 	
					 	 ?>
					 	<option value="search.php?&pr=paid">Paid ()</option>
					 	<option value="search.php?&pr=free">Free ()</option>
					 </select>
				</div>
			</div>

				<div class="maindiv">
				<?php 
				if ($nor > 0) {
					while ($rw = mysqli_fetch_assoc($catr)) {

				 ?>
				<div class="row curbox1 searchbox" data-price="<?php if(empty($rw['price'])) echo '0'; else echo $rw['price']; ?>">
					<div class="col-md-4">
						<div class="cardimg">
							<img src="content/<?= $rw['thumbnailurl'] ?>" width="100%" height="100%;">

							<a class="forcard" href="singlecourse.php?id=<?= $rw['courseid'] ?>">TAKE THIS COURSE</a>
						</div>
					</div>					
					<div class="col-md-8">
						<div class="mt-2">
							<div class="float-left">
								<h5 style="font-weight:bold;margin:0;"><span class="text-muted">By</span> <a class="a-black" href="profile.php?id=<?= $rw['instid'] ?>" style="text-decoration: none;"><?= $rw['instname'] ?></a></h5>
							</div>
							<div class="float-right mr-3">
								<?php echo getRatingStar($rw['courseid']); ?>
								<p>(<?php echo getTotalRating($rw['courseid']); ?> Rating)</p>
							</div>
						</div>
						
						<div style="clear:both">
							<h4 style="margin:0;"><a class="a-black" href="singlecourse.php?id=<?= $rw['courseid'] ?>"><?= $rw['coursename'] ?></a></h4>
							<p><?= $rw['description'] ?></p>
						</div>
						
						<div class="text-muted">
							<div class="float-left">
								<?php 
								if ($rw['coursetype'] == 'free') {
									$pr = 'free';
								}else{
									$pr = $rw['price'];
								}
						 		?>
								<h4 style="display:inline-block;margin-left:5px;color:#474747;">₹ <?= $pr ?></h4>
							</div>
							
							<div class="float-right mt-2">
								<?php $totalenroll = $dc->getRow("select count(enrollid) as total from courseenroll where courseid='$rw[courseid]'"); ?>
								<span class="mx-3"><i class="fas fa-user"></i> <?= $totalenroll['total'] ?></span>
								<?php $totalrv = $dc->getRow("select count(revid) as total from review where courseid='$rw[courseid]'"); ?>
								<a class="a-black" href="singlecourse.php?id=<?= $rw['courseid'] ?>#reviews" style="text-decoration: none;"><span class="mx-3"><i class="fas fa-comments"></i> <?= $totalrv['total'] ?></span></a>
							</div>					
						</div>
					</div>
				</div>
				<?php }}else {
					echo '<center><p>No Result Found</p></center>';
				} ?>
			</div>
			
			<div class="row mt-5">
			
				<div class="col-md-12">
				
					<nav aria-label="...">
					  <ul class="pagination justify-content-center" >
						<?php 
						$searchp = "course.php?catid=".$cat."&";
							if ($nor >0) {
								echo $pjn->getPagelink($searchp,$page);	
							}
							
						 ?>
					  </ul>
					</nav>
				
				</div>
			
			</div>
		</div>
	
<?php require_once 'footer.php'; ?>
<script>
	$('.subcat').slick({
	  infinite: true,
	  slidesToShow: 15
	});
	$(document).ready(function(){
	$("body").on("change", "#sortby", function() {

    var sortingMethod = $(this).val();
    console.log(sortingMethod);

    if(sortingMethod == 'pasc')
    {
        sortProductsPriceAscending();
    }
    else if(sortingMethod == 'pdesc')
    {
        sortProductsPriceDescending();
    }

	});
	function sortProductsPriceAscending()
	{
	    var products = $('.searchbox');
	    products.sort(function(a, b){ return $(a).data("price")-$(b).data("price")});
	    $(".maindiv").html(products);

	}

	function sortProductsPriceDescending()
	{
	    var products = $('.searchbox');
	    products.sort(function(a, b){ return $(b).data("price") - $(a).data("price")});
	    $(".maindiv").html(products);

	}
	});
</script>
</body>
</html>
