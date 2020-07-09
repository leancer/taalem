
<?php 	
	
	require '../../inc/dataclass.php';
	$dc = new Dataclass();

	$data = array();
	for ($i = 0; $i < 5; $i++) {
		$idate =  date('Y', strtotime("-$i years"));

		$cncn = $dc->getRow("SELECT COUNT(courseid) as totalc FROM course WHERE YEAR(coursedate) = '$idate'");
		$data[] = $cncn['totalc'];
	}
	echo json_encode($data);
 ?>