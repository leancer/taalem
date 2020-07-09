<?php
	include 'dataclass.php';
	$dc = new Dataclass();

if (isset($_GET['cnid'])) {
	
		$getpid = $dc->getRow("select ptid from playtime where contentid='$_GET[cnid]' and regid='$_GET[rgid]'");
		if ($getpid['ptid'] == NULL) {
			$save = $dc->saveRecord("insert into playtime(contentid,regid,timeplayed) values('$_GET[cnid]','$_GET[rgid]','$_GET[ctime]')");
		}else{
			$save = $dc->saveRecord("update playtime set timeplayed='$_GET[ctime]' where contentid='$_GET[cnid]' and regid='$_GET[rgid]'");
		}
		
}
if (isset($_GET['coid'])) {
	$getpid = $dc->getRow("select crid from cmprecord where courseid='$_GET[coid]' and regid='$_GET[rgid]'");
	if ($getpid['crid'] == NULL) {
		$save = $dc->saveRecord("insert into cmprecord(courseid,regid,noc) values('$_GET[coid]','$_GET[rgid]',1)");
	}else{
		$save = $dc->saveRecord("update cmprecord set noc=noc+1 where courseid='$_GET[coid]' and regid='$_GET[rgid]'");
	}
}
	
?>