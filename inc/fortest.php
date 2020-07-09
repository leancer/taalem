<?php 

	require '../assests/libs/getid3/getid3.php';


	$getID3 = new getID3();
    $filename = '../content/chef.mp4';
    $file = $getID3->analyze($filename);
    echo $file['playtime_string'];

 ?>