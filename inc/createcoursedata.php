<?php 
$vex = array("mkv","mp4");
$docex = array("doc","docx","pdf");
$cst="";
$secst="";
$contst="";
if (isset($_POST['submit-course'])) {
	$instid = $_SESSION['regid'];
	$cname = $_POST['curname'];
	$catid = $_POST['parcat'];
	$todaydate = date("Y-m-d");
	if ($_POST['subcat'] != "no") { $catid = $_POST['subcat'];	}
	$tag = $_POST['tags'];
	$lang = $_POST['curlang'];
	$thumburl = $_POST['tumbimage'];
	if (!empty($_POST['tumbvideo'])) { $tumbvideo = $_POST['tumbvideo']; }else{ $tumbvideo = ""; }
	$ww = "";
	foreach ($_POST['whatwill'] as $key => $value) {
	 	$ww .= $value."`";
	 } 
	$rq = "";
	foreach ($_POST['req'] as $key => $value) {
		$rq .= $value."`";
	}
	$skillg = $_POST['skillg'];
	$cabout = mysqli_real_escape_string($dc->getConn(),$_POST['aboutcourse']);

	$ctype = $_POST['rdoprice'];
	$cprice =0;
	if (isset($_POST['drpprice'])) { $cprice = $_POST['drpprice']; }

	$courseinsq = "insert into course(coursename, catid,coursedate, description, coursetype, price, prerequirement, whatlearn, skilllevel, keyword, lang, thumbnailurl, thumbvidurl, instid, status) values('$cname','$catid','$todaydate','$cabout','$ctype','$cprice','$rq','$ww','$skillg','$tag','$lang','$thumburl','$tumbvideo','$instid','0')";
	$courseins = $dc->saveRecord($courseinsq);

	if ($courseins['success']) {
		$cst=true;
		$cid = $dc->getRow("select courseid from course where instid='$instid' ORDER BY courseid DESC LIMIT 1");
		$realcid = $cid['courseid'];

		$secname = $_POST['secname'];
		$secdesc = $_POST['secdesc'];
	    $contname = $_POST['contname'];
	    $contdesc = $_POST['contdesc'];
	    $contfileurl = $_POST['contfileurl'];
	    $noof = $_POST['nooflecture'];
	    $lpc = 0;
	    $succnt = 0;
	    foreach ($secname as $key => $value) {
	    	$secins = $dc->saveRecord("insert into section(courseid,sectionname,sectiondesc) values('$realcid','$value','$secdesc[$key]')");
	    	if ($secins['success']) {
	    		$secst=true;
	    		$sid = $dc->getRow("select sectionid from section where courseid='$realcid' ORDER BY sectionid DESC LIMIT 1");
				$realsid = $sid['sectionid'];
	    		$endddd = $lpc + $noof[$key];
		        for ($i = $lpc; $i < $endddd; $i++) {
		            $exarr = explode(".", $contfileurl[$lpc]);
		            $ex = end($exarr);
		            if (in_array($ex, $vex)) { $conttype = "video"; }else{ $conttype = "doc"; }
		            $contins = $dc->saveRecord("insert into content(sectionid,courseid,contentname,contentdesc,contenttype,contenturl) values('$realsid','$realcid','$contname[$lpc]','$contdesc[$lpc]','$conttype','$contfileurl[$lpc]')");

		            	if ($contins['success']) {
		            		$contst=true;
		            	}else{
		            		$msg = "error in upload course ".$contins['error'];
		            		$st = false;
		            		$upst = false;
		            		break;
		            	}
		            $lpc++;
		        }
		        if (isset($upst) and $upst == false) {
		        	break;
		        }
	    	}else{
	    		$msg = "Course Not Save ".$secins['error'];
				$st=false;
				break;
	    	}

	    }

    }else{
		$msg = "Course Not Save ".$courseins['error'];
		$st=false;
	}

	if ($cst==true and $secst==true and $contst==true) {
		$msg="successfull Uploaded and Send For Review";
		$st =true;
	}
}


 ?>