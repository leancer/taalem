<?php

	$title="Search  | Taalem | Online Course Learning";
	require_once 'header.php';
	$pjn = new Pagination();

	if ($_GET['s'] == "") {
		header("location: index.php");
	}
	$search = $_GET['s'];

	$searchq = "SELECT course.*,instructor.instname from course left join instructor on course.instid = instructor.regid where instructor.instname like '$search%' ";
	$terms = explode(" ",$search);
	

	foreach ($terms as $value) {
		$searchq .= "or course.coursename like '% $value %' ";
	}

	foreach ($terms as $value) {
		$searchq .= "or course.keyword like '%$value%' ";
	}

	$qqq = $_SERVER['QUERY_STRING'];

	if (!isset($_GET['p'])) {
		$page = 1;
	}else{
		$page = $_GET['p'];
	}
	$searcpaid = $searchq." and coursetype='paid'";
	$searchrpaid = $dc->getTable($searcpaid);
	$norpaid = mysqli_num_rows($searchrpaid);
	$searcfree = $searchq." and coursetype='free'";
	$searchrfree = $dc->getTable($searcfree);
	$norfree = mysqli_num_rows($searchrfree);

	if (isset($_GET['pr']) and $_GET['pr'] == 'paid') {
		
		$searchq = $searchq." and coursetype='paid'";

	}else if (isset($_GET['pr']) and $_GET['pr'] == 'free') {
		$searchq = $searchq." and coursetype='free'";
	}

	$searchq = $pjn->getPagQuery($searchq,5,$page);
	$searchr = $dc->getTable($searchq);
	$nor = mysqli_num_rows($searchr);
?>

		<div class="titlepage">
			
			<h1>Search</h1>
			<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Search</p>

		</div>
		
		<div class="container mt-5">
			<div class="row">
				<div class="col-md-6 ">
					<h2 class="float-left">Search result for <span>"<?= $search ?>"</span></h2>
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
					 	<option value="search.php?<?= $qqq ?>&pr=paid">Paid (<?= $norpaid ?>)</option>
					 	<option value="search.php?<?= $qqq ?>&pr=free">Free (<?= $norfree ?>)</option>
					 </select>
				</div>
			</div>
			<div class="maindiv">
				<?php 
				if ($nor > 0) {
					while ($rw = mysqli_fetch_assoc($searchr)) {

				 ?>
				<div class="row mt-3 curbox searchbox" data-price="<?php if(empty($rw['price'])) echo '0'; else echo $rw['price']; ?>">
					<div class="col-md-3">
						<a href="singlecourse.php?id=<?= $rw['courseid'] ?>"><img src="content/<?= $rw['thumbnailurl'] ?>" width="100%" height="100%;"></a>
					</div>
					<div class="col-md-9">
						<a href="singlecourse.php?id=<?= $rw['courseid'] ?>" class="a-black" style="font-size:20px;font-weight:bold;float:left;"><?= $rw['coursename'] ?></a>
						
						<p style="clear:left;"><?= $rw['description'] ?></p>

						<div class="float-left">
						<?php $cntc = $dc->getRow("select count(contentid) as totalcc from content where courseid = '$rw[courseid]' and contenttype='video'"); ?>
						<p class="details"><i class="fas fa-play"></i> <?= $cntc['totalcc'] ?> Lectures</p>
						<p class="details"><i class="fas fa-clock"></i> <?php echo totalHour($rw['courseid']); ?></p>
						<p class="details"><i class="fas fa-sliders-h"></i> <?php echo ucfirst($rw['skilllevel']) ?> Level</p>
						<p class="details"><i class="fas fa-closed-captioning"></i> <?= $rw['lang'] ?></p>
						<p><a href="profile.php?id=<?= $rw['instid'] ?>" class="a-black text-muted">By <?= $rw['instname'] ?></a></p>
						</div>
						<?php 
							if ($rw['coursetype'] == 'free') {
								$pr = 'free';
							}else{
								$pr = $rw['price'];
							}
						 ?>
						<div class="float-right">
							<h5><b>₹ <?= $pr ?></b></h5>
							<?php echo getRatingStar($rw['courseid']); ?>
							<p>(<?php echo getTotalRating($rw['courseid']); ?> Rating)</p>
						</div>
						
					</div>
				</div>
				<?php }}else {
					echo '<center><p>No Result Fournd for "<b>'.$search.'<b>"</p></center>';
				} ?>
			</div>

			<div class="row mt-5">
			
				<div class="col-md-12">
				
					<nav aria-label="...">
					  <ul class="pagination justify-content-center" >
						<?php 
						$searchp = implode("+", $terms);
						$searchp = "search.php?".$qqq."&";
							if ($nor >0) {
								echo $pjn->getPagelink($searchp,$page);	
							}
							
						 ?>
						<!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item active">
						  <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
						</li>
						<li class="page-item"><a class="page-link" href="#">3</a></li> -->
						
					  </ul>
					</nav>
				
				</div>
			
			</div>
		</div>
	
		
		
<?php require_once 'footer.php'; ?>
<script>
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
