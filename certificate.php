<?php 

	session_start();
	ob_start();
	require_once 'inc/config.php'; 
	require_once 'inc/dataclass.php';
	include 'inc/logincode.php'; 
	include 'inc/functions.php';

	$dc = new Dataclass();

	if (!isset($_GET['cid'])) {
		header("location: index.php");
	}else{
		$cid = $_GET['cid'];
	}
	$totalcnt=$dc->getRow("select count(contentid) as totalcontent from content where courseid='$cid'");
			$totalf=$dc->getRow("select noc,cmpdate from cmprecord where courseid='$cid' and regid='$_SESSION[regid]'");
		 	if ($totalf['noc'] == '') {
		 		$totalf['noc'] = 0;
		 	}
		 	if ($totalf['noc'] != $totalcnt['totalcontent']) {
		 		header("location: index.php");
		 	}
	$gname = $dc->getRow("(SELECT instname as name FROM instructor WHERE regid = '$_SESSION[regid]') UNION (SELECT name as name FROM student WHERE regid = '$_SESSION[regid]')");
	$getc = $dc->getRow("select c.coursename,i.instname from course c, instructor i where c.instid = i.regid and c.courseid = '$cid'");




 ?>



<html>
	<head>
		<title>Certificate</title>
		<link rel="stylesheet" href="assests/libs/fontawesome/css/fontawesome-all.min.css" />
		
		<style type="text/css">
			@font-face {
				    src: url("assests/font/AB.ttf");
				    font-family: abfont;
				}
				.abfont{
					font-family: abfont;
				}
			
			.myDiv
			{
				height:550px;
				width:75%;
				position:relative;
				margin:0 auto;
				margin-top:30px;
				padding: 15px;
				border:1px solid #ccc;
				background:linear-gradient(to right,rgb(255,255,255),rgb(251,251,251),rgb(237,237,237),rgb(251,251,251),rgb(233,233,233));
				border:3px solid #ccc;
				box-shadow:0 0 10px rgba(0,0,0,.5),0 0 10px 5px rgba(255,255,255,.5),0px 0px 10px 13px rgba(0,0,0,.3);
				overflow:hidden;
			}
			
			.certihead
			{
				width:100%;
				position:relative;
				left:19%;
				transform:translateX(-10%);
				top:5%;
			}
			.certihead img
			{
				width:120px;
				height:50px;
				padding:10px 3px;
			}
			.certi
			{
				margin:0;
				margin-top:12px;
				padding:0;
				font-size:45px;
				color:rgb(176,59,56);
				font-family:Algerian; 
				text-shadow:0 4px 5px rgba(0,0,0,.5);
			}
			.subcerti
			{
				position:relative;
				font-size:23px;
				bottom:10px;
				color:rgb(166,166,166);
				font-family:Calibri Light;
				text-shadow:none;
				font-weight:900;
			}
			.stamp
			{
				width:255px;
				height:255px;
				position:absolute;
				right:13%;
				top:20%;
			}
			.stamp img
			{
				width:100%;
				height:100%;
			}
			.stamp h4
			{
				position:absolute;
				top:30%;
				left:50%;
				transform:translate(-50%,-50%);
				font-weight:bold;
				color:#fff;
			}
			.certicontent
			{
				margin-top:5%;
				margin-left:16%;
				padding-top:25px;
				padding-bottom:2px;
				padding-left:2.5%;
				border-left:6px solid rgb(144,59,57);
				border-radius:2px;
			}
			.certicontent p,span
			{
				font-size:21px;
				font-family:Arial;
				font-weight:bold;
				color:#796464;
				margin:0;
				padding:0;
			}
			.certicontent h1
			{
				margin:5px;
				padding:0;
				font-size:50px;
				font-family:Brush Script MT;
			}
			.certicontent h3{
				margin-top:5px;
				padding:0;
				font-size:30px;
				font-family:Arial;
				color:#542626;
			}
			.signature
			{
				width:60%;
				height:100px;
				margin:0 auto;
			}
			.signature .sign1,
			.signature .sign2
			{
				width:50%;
				text-align:center;
			}
			.signature img
			{
				width:100px;
				height:50px;
			}
			.signature .dperson
			{
				padding-top:8px;
				margin:0;
				margin-bottom:3px;
				font-family:Arial;
				font-weight:bold;
			}
			.signature .downer
			{
				margin:0;
				padding:0;
				font-family:Calibri light;
				font-style:italic;
				padding-top:4px;
				font-weight:bold;
			}
			.signature .sign1,
			.signature .sign2,
			.signature .demo
			{
				float:left;
			}
			.dtitle
			{
				padding-bottom:2px;
				border-bottom:4px solid rgb(178,77,74);
				color:rgb(178,77,74);
				border-radius:7px;
			}
			.sqbl
			{
				width: 239px;
				height: 89px;
				background: rgb(156,50,45);
				position: absolute;
				left: -75px;
				bottom: 0;
				transform: rotate(45deg);
			}
			.sqtr
			{
				width: 239px;
				height: 89px;
				background: rgb(156,50,45);
				position: absolute;
				right: -75px;
				top: 0;
				transform: rotate(45deg);
			}
			.sqtl {
				width: 239px;
				height: 89px;
				background: rgb(156,50,45);
				position: absolute;
				left: -75px;
				top: 0;
				transform: rotate(-45deg);
			}
			.sqbr
			{
				width: 239px;
				height: 89px;
				background: rgb(156,50,45);
				position: absolute;
				right: -75px;
				bottom: 0;
				transform: rotate(-45deg);
			}
			.certibtn
			{
				margin:0 auto;
				margin-top:30px;
				width:75%;
			}
			.btnprint
			{
				background:green;
				color:#fff;
				width:20%;
				padding: 10px 5px;
				font-size:20px;
				letter-spacing: 2px;
				border-radius: 10px;
				float: left;
				margin-right:10px;
				font-weight: bold;
				text-align: center;
				text-decoration: none;
			}
			.btnback
			{
				background:#007bff;
				color:#fff;
				width:20%;
				padding: 10px 5px;
				font-size:20px;
				letter-spacing: 2px;
				border-radius: 10px;	
				float: left;
				text-align: center;
				font-weight: bold;
				text-decoration: none;
			}
			canvas{
				max-width: 100%;
				max-height: 100%;
			}
		</style>
		<script src="assests/libs/jquery/jquery-3.2.1.min.js"></script>
		<script src="assests/js/html2canvas.js"></script>
		
	</head>
	
	<body>
			<div class="myDiv" id="pdiv">
				<div class="certihead">
					<img src="assests/img/taalem-512.png">
					<h1 class="certi">Certificate<br><span class="subcerti">OF ACHIEVEMENT</span></h1>
				</div>
				<div class="certicontent">
					<div class="stamp">
						<img src="assests/img/stamp.png">
						<h4>COMPLETED</h4>
					</div>
					<p>This certificate is presented to</p>
					<h1><?= $gname['name'] ?></h1>
					<p>for the successfully completed the</p>
					<h3><?= $getc['coursename'] ?><span> course on <?php echo date("F d,Y",strtotime($totalf['cmpdate'])); ?></span></h3>
				</div>
				<div class="signature">
					<div class="sign1" style="margin-top:12px;">
						<p class="dperson">
							<span style="font-size:14px">Given By</span><br>
							<span class="dtitle"><?= $getc['instname'] ?></span>
						</p>
						<p class="downer">Instructor</p>
					</div>
					<div class="sign2">
						<p style="font-weight: bold;color:gray">Issued by <br><span class="abfont" style="font-size:40px;">Taalem</span> </p>
					</div>
				</div>
				<div class="sqbl"></div>
				<div class="sqtr"></div>
				<div class="sqtl"></div>
				<div class="sqbr"></div>
			</div>
			
			<div class="certibtn">
				<button type="buttom" class="btnprint" id="pr"><i class="fas fa-download"></i>Download</button>
				<a class="btnback" href="index.php"><i class="fas fa-arrow-left"></i> Go Back</a>
				
			</div>
			
	<script>
			$(document).ready(function(){

				$("#pr").click(function(){
					html2canvas($("#pdiv")[0]).then(canvas => {
    saveAs(canvas.toDataURL(), 'Certificate.png');
});
				});
				function saveAs(uri, filename) {
    var link = document.createElement('a');
    if (typeof link.download === 'string') {
      link.href = uri;
      link.download = filename;

      //Firefox requires the link to be in the body
      document.body.appendChild(link);

      //simulate click
      link.click();

      //remove the link when done
      document.body.removeChild(link);
    } else {
      window.open(uri);
    }
  }
			});
			
		</script>
	</body>
</html>

