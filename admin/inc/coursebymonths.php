
<?php 	
	
	require '../../inc/dataclass.php';
	$dc = new Dataclass();

	$data = array();
	for ($i = 0; $i < 5; $i++) {
		$idate =  date('m', strtotime("-$i month"));;

		$cncn = $dc->getRow("SELECT COUNT(courseid) as totalc FROM course WHERE MONTH(coursedate) = '$idate'");
		$data[] = $cncn['totalc'];
	}
	echo json_encode($data);
 ?>