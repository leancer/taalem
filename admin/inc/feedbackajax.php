<?php 

	require '../../inc/dataclass.php';
	$dc = new Dataclass();

	$save = $dc->saveRecord("update feedback set sih='$_POST[value]' where fbid=$_POST[id]");



 ?>