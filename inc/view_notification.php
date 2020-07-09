<?php

include 'dataclass.php';
include 'functions.php';

$dc = new dataclass();
	if (isset($_POST['regid'])) {
		
		$id = $_POST['regid'];

		$changestatus = $dc->saveRecord("UPDATE message SET status=1 WHERE status=0 and receiverregid='$id'");

		$msg = $dc->getTable("select m.*,r.username from message m, register r where receiverregid='$id' and r.regid = m.senderregid ORDER BY msgid DESC limit 3");

		$response='';
		while($row=mysqli_fetch_array($msg)) {
			$response = $response .'<a class="dropdown-item" href="message.php?id='.$row['msgid'].'&action=view"><strong>'.$row['username'].'</strong><span class="small float-right text-muted">'.timeago(strtotime($row['msgdatetime'])).'</span><div class="dropdown-message small">'.$row['subject'].'<p class="text-muted">Click to View</p></div></a><div class="dropdown-divider"></div>	';
		}
		if(!empty($response)) {
			echo $response;
		}
	}

?>