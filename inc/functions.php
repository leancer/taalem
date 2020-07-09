<?php 

	if (file_exists('assests/libs/getid3/getid3.php')) {
		include 'assests/libs/getid3/getid3.php';
		$getID3 = new getID3();
	}

	// for showing sub categories
	function showSubCat($parentid,$dataobj){

		$subcat = $dataobj->getTable("select catid,catname from category where catparentid='$parentid'");

		while ($subcatrw = mysqli_fetch_assoc($subcat)) {
		    echo '<li class="dropdown-item"><a href="course.php?catid='.$subcatrw['catid'].'" class="a-black">'.$subcatrw['catname'].'</a></li>';
		}

	}
	function timeago($date) {
	   $timestamp = $date;
	   $strTime = array("second", "minute", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");
	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "(s) ago ";
	   }
	   else{
	   	return date("Y-m-d H:i:s",$currentTime)." ".date("Y-m-d H:i:s",$timestamp);
	   }
	}

	function showContents($secid){
		global $dc;
		$content = $dc->getTable("select contentid,contentname,contenttype,contenturl from content where sectionid='$secid'");

		while ($cntrw = mysqli_fetch_assoc($content)) {
		    if ($cntrw['contenttype'] == 'doc') {
		    	echo '<p><i class="fas fa-sticky-note ml-5 mr-2 a-black"></i><a href="#" class="a-black">'.$cntrw['contentname'].'</a></p><hr/>';
		    }else{
		    	echo '<p><i class="fas fa-video ml-5 mr-2 a-black"></i><a href="lecture.php?id='.$cntrw['contentid'].'" class="a-black">'.$cntrw['contentname'].'</a><span class="float-right a-black">'.getContentDuration($cntrw['contenturl']).'</span></p><hr/>';
		    }
		}
	}
	function getContentDuration($cnturl)
	{
		global $getID3;
		$filename = 'content/'.$cnturl;
    	$file = $getID3->analyze($filename);
    	return $file['playtime_string'];

	}
	function getInSeconds($value)
	{
		$str_time = $value;

	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

	$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
	return $time_seconds;
	}
	function totalHour($courseid){
		global $dc,$getID3;
		$totaltime = 0;
		$cont = $dc->getTable("select contenttype,contenturl from content where courseid='$courseid'");
		while ($cntrw = mysqli_fetch_assoc($cont)) {
		   if ($cntrw['contenttype'] == 'video') { 
			   	$filename = 'content/'.$cntrw['contenturl'];
	    		$file = $getID3->analyze($filename);
	    		$playtime=$file['playtime_string'];
	    		$split = explode(":", $playtime);
	    		if (count($split) == 3) {
	    			$totaltime = $totaltime + ($split[0] * 60);
	    		}else{
	    			$totaltime = $totaltime + $split[0];
	    		}
			}
    	}
    	if ($totaltime >= 60) {
    		$totalwithword = ($totaltime/60);
    		$totalwithword = number_format((float)$totalwithword, 2, '.', '');
    		return $totalwithword." Hours";
    	}else{
    		return $totaltime." Minutes";
    	}
	}

	function getRatingStar($courseid){
		global $dc;
		$nor = $dc->getRow("SELECT COUNT(revid) as totalr, SUM(rating) as totalrating,SUM(rating) / COUNT(revid) as grandrat from review where courseid='$courseid'");

		$realrating = $nor['grandrat'];
		$roundv = round($realrating);
		$showstar = "";
		for ($i = 0; $i < $roundv ; $i++) {
			if ($i == $roundv-1) {
				if ($realrating < $roundv) {
					$showstar .= '<i class="fas fa-star-half" style="color:#f4c150;"></i>';	
				}else{
					$showstar .= '<i class="fas fa-star" style="color:#f4c150;"></i>';
				}
			}else{
				$showstar .= '<i class="fas fa-star" style="color:#f4c150;"></i>';
			}
		}

		return $showstar;
	}

	function getTotalRating($courseid){
		global $dc;
		$nor = $dc->getRow("SELECT COUNT(revid) as totalr from review where courseid='$courseid'");

		return $nor['totalr'];
	}

 ?>