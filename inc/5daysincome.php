<?php 	
	
	require 'dataclass.php';
	$dc = new Dataclass();

	$end = time();
	$begin = time()-345600;
	$data = array();
	for ($i = $begin; $i <=$end ; $i = $i + 86400) {
		$idate =  date("Y-m-d",$i);

		$cncn = $dc->getRow("select IFNULL(sum(amount),0) as totalc from earning where earndate = '$idate' and regid='$_POST[regid]'");
		$data[] = $cncn['totalc'];
	}

	echo json_encode(array_reverse($data));
 ?>