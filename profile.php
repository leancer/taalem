<?php
	
	$title="Profile | Taalem | Online Course Learning";
	require_once 'header.php';

	if (!isset($_GET['id'])) {
		header("Location: index.php");
	}

	

	$regid = $_GET['id'];
	$dc = new Dataclass();

	$getregq = "select regdate,username,usertype from register where regid=$regid";
	$regdt = $dc->getRow($getregq);



	if ($regdt['usertype'] == "student") {
		$getuserq = "select * from student where regid=$regid";
		$userd =$dc->getRow($getuserq);
		include_once 'studprofile.php';
	}else{
		$getinsq = "select * from instructor where regid=$regid";
		$insd =$dc->getRow($getinsq);
		include_once 'insprof.php';
	}

?>

		


<?php require_once 'footer.php'; 
if ($regdt['usertype'] != "student") {
	?>
<script>
	$('.cardcur').slick({
		infinite:true,
		slidesToShow:3,
		arrows:true,
		autoplay:true,
		autoplaySpeed:1000
	});
</script>
<?php } ?>
</body>
</html>

