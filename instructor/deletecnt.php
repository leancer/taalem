<?php 
	require '../inc/dataclass.php';
	$dc = new Dataclass();

	if(isset($_POST['fileurl']))
	{
	
	$del = $dc->deleteRecord("delete from content where contentid='$_POST[cid]'");
	$currentfile = "../content/".$_POST['fileurl'];
    if (unlink($currentfile)) {
    	echo 'success';
    }

    // Do whatever you want with the $uid
	}

	if (isset($_POST['sid'])) {
		
		$getcnt = $dc->getTable("select contenturl from content where sectionid='$_POST[sid]'");

		while ($rw = mysqli_fetch_assoc($getcnt)) {
		    $currentfile = "../content/".$rw['contenturl'];
		    unlink($currentfile);

		}
		$delcn = $dc->deleteRecord("delete from content where sectionid='$_POST[sid]'");
		$delsc = $dc->deleteRecord("delete from section where sectionid='$_POST[sid]'");


	}



 ?>