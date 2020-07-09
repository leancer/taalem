<?php 

	if(isset($_POST['fileurl']))
{
	$currentfile = "../content/".$_POST['fileurl'];
    if (unlink($currentfile)) {
    	echo 'success';
    }

    // Do whatever you want with the $uid
}

 ?>