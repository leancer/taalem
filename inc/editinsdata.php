<?php 


//personal data update
if (isset($_POST['uppd'])) {
	$name = ucwords(strtolower($_POST['firstname']." ".$_POST['lastname']));
	$quali = $_POST['quali'];
	$expr=$_POST['expr'];
	$special = $_POST['special'];

	$uppdq = "update instructor set instname='$name', qualification='$quali', expirance='$expr', speciality='$special' where regid='$regid'";
	$uppd = $dc->saveRecord($uppdq);
	if ($uppd['success']) {
		$msg = "Updated Successfully";
		$upst=true;
	}else{
		$msg = "Updated unsuccessfully ".uppd['error'];
		$upst=false;
	}
}


// Update About Me

if (isset($_POST['upam'])) {
	
	$aboutme = mysqli_real_escape_string($dc->getConn(),$_POST['aboutme']);

	$amquery = "update instructor set about='$aboutme' where regid='$regid'";

	$abup = $dc->saveRecord($amquery);
	if ($abup['success']) {
		$msg = "About me Successfully Updated";
		$upst=true;
	}else{
		$msg = "Error in Updating About Me ".$abup['error'];
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
  $filelocdb = 'assests/img/users/'.$username.'-'.uniqid().'.'.$fex;
  $fileloc = '../'.$filelocdb;
  $allowf = array('jpg','jpeg','png');

  if(in_array($fex,$allowf)){
    if($fsz < 1048576){
      move_uploaded_file($ftmp,$fileloc);
      $filelocdb = mysqli_real_escape_string($dc->getConn(),$filelocdb);
      $sql8 = "UPDATE instructor SET photo='$filelocdb' WHERE regid='$regid'";
      $dpup = $dc->saveRecord($sql8);
      if($dpup['success']){
        $upst = true;
        $msg = "successfully Updated";
        header('Location: editprofile.php');
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

//social link
if (isset($_POST['upsocial'])) {

	$stb = $dc->getTable("select socialbrandname,url from social where regid='$regid'");
	
	if ($stb->num_rows == 0) {
		foreach ($_POST['social'] as $name => $url) {
			$verifyurl = mysqli_real_escape_string($dc->getConn(),$url);
			$scinsertq = "insert into social(regid,socialbrandname,url) values('$regid','$name','$verifyurl')";
			$scin = $dc->saveRecord($scinsertq);
		}		
	}else{
		foreach ($_POST['social'] as $name => $url) {
			
			$verifyurl = mysqli_real_escape_string($dc->getConn(),$url);

			$socialupq = "update social set socialbrandname='$name', url='$verifyurl' where regid='$regid' and socialbrandname='$name'";
			$scup = $dc->saveRecord($socialupq);
		}
	}
}
 ?>