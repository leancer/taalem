<?php 



// Update About Me

if (isset($_POST['upam'])) {
	
	$aboutme = mysqli_real_escape_string($dc->getConn(),$_POST['aboutme']);

	$amquery = "update student set about='$aboutme' where regid='$regid'";

	$abup = $dc->saveRecord($amquery);
	if ($abup['success']) {
		$msg = "About me Successfully Updated";
		$upst=true;
	}else{
		$msg = "Error in Updating About Me ".$abup['error'];
		$upst=false;
	}

}


//update personal Data
if (isset($_POST['uptpd'])) {

	$name = ucwords(strtolower($_POST['fname']." ".$_POST['lname']));
	$address = $_POST['address'];
	$cityid = $_POST['city'];
	$interest = $_POST['interest'];

	$pdquery = "update student set name='$name', address='$address', cityid='$cityid', interest='$interest' where regid='$regid'";
	$pdup = $dc->saveRecord($pdquery);
	if ($pdup['success']) {
		$msg = "Successfully Updated";
		$upst=true;
	}else{
		$msg = "Error in Updating ".$abup['error'];
		$upst=false;
	}
}

//update Password
if (isset($_POST['uppass'])) {
	$expass = $_POST['expassword'];
	$newpass = $_POST['newpwd'];

	$query = "select password from register where regid='$regid'";
	$exdbpass = $dc->getRow($query);

	if ($expass == $exdbpass['password']) {
		
		$pwquery = "update register set password='$newpass' where regid='$regid'";
		$pwup = $dc->saveRecord($pwquery);
		if ($pwup['success']) {
			$msg = "Password Successfully Updated";
			$upst=true;
		}else{
			$msg = "Error in Updating ".$abup['error'];
			$upst=false;
		}

	}else{
		$msg = "Password Does Not Match With Exsiting Password.";
		$upst=false;
	}
}

//update dp
if (isset($_POST['btnupdp'])) {

  $file = $_FILES['dpfile'];

  $flname = $file['name'];
  $ftmp = $file['tmp_name'];
  $fer = $file['error'];
  $fsz = $file['size'];

  $ftex= explode('.',$flname);
  $fex = strtolower(end($ftex));
  $fileloc = 'assests/img/users/'.$username.'-'.uniqid().'.'.$fex;
  $allowf = array('jpg','jpeg','png');

  if(in_array($fex,$allowf)){
    if($fsz < 1048576){
      move_uploaded_file($ftmp,$fileloc);
      $fileloc = mysqli_real_escape_string($dc->getConn(),$fileloc);
      $sql8 = "UPDATE student SET photo='$fileloc' WHERE regid='$regid'";
      $dpup = $dc->saveRecord($sql8);
      if($dpup['success']){
        $upst = true;
        $msg = "successfully Updated";
        header('Location: editstuprofile.php');
      }else{
       $msg = "Error in Updating ".$dpup['error'];
		$upst=false;
      }

    }else{
      $upst = false;
      $msg = "unsuccessfully Because File Size More Than 1MB";
    }

  }else{
    $upst =false;
    $msg = "unsuccessfully Because file type Not allowd";
  }

}


 ?>