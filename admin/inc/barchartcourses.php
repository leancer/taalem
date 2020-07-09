
<?php 	
	
	require '../../inc/dataclass.php';
	$dc = new Dataclass();

	$end = time();
	$begin = time()-345600;
	$data = array();
	for ($i = $begin; $i <=$end ; $i = $i + 86400) {
		$idate =  date("Y-m-d",$i);

		$cncn = $dc->getRow("select count(courseid) as totalc from course where coursedate = '$idate'");
		$data[] = $cncn['totalc'];
	}

	echo json_encode(array_reverse($data));
 ?>