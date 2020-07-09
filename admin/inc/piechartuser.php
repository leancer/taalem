<?php 

	require '../../inc/dataclass.php';
	$dc = new Dataclass();
	$nou = $dc->getTable("(SELECT COUNT(regid) as nou from register where usertype='student') UNION ALL (SELECT COUNT(regid) as nou from register where usertype='instructor')");
	$data = array();

	while ($rw = mysqli_fetch_assoc($nou)) {
	    $data[] = $rw['nou'];
	}
	print json_encode($data);
 ?>