<html>
	<head>
		<title>404 Page Not Found.</title>
		
		<?php
		$blah = explode('/', $_SERVER['REQUEST_URI']);
		if (count($blah) == 3) { ?>
			<link rel="icon" href="assests/img/taalem-T.png">
			<link rel="stylesheet" href="assests/libs/fontawesome/css/fontawesome-all.min.css" />
		<link rel="stylesheet" href="assests/libs/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assests/css/main.css">
		<?php }else{ ?>
			<link rel="icon" href="../assests/img/taalem-T.png">
			<link rel="stylesheet" href="../assests/libs/fontawesome/css/fontawesome-all.min.css" />
		<link rel="stylesheet" href="../assests/libs/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assests/css/main.css">
		<?php } 
		?>
		
		<style rel="text/css">
					
			body
			{
				background:linear-gradient(to bottom,#fdfcfb,#e2d1c3);
			}
			.container
			{
				position:absolute;
				top:50%;
				left:50%;
				transform:translate(-50%,-50%);
			}
			.head{
				font-size:4em;
				color:#474747;
				margin:0;
				padding:0;
				text-align:center;
				text-shadow:0 0 13px rgba(0,0,0,.5);
			}
			.subhead{
				font-size:2.5em;
				margin:14px 0;
				padding:0;
				color:#575757;
				text-align:center;
			}
			.text
			{
				font-size:14px;
				letter-spacing:1px;
				margin:0;
				font-style:italic;
				font-weight:bold;
				font-family:Verdana;
				text-align:center;
			}
			.btn
			{
				position:relative;
				left:32%;
				margin:5px 0;
				font-weight:bold;
			}
			.title{
				position:absolute;
				top:10px;
				
			}
			.brand
			{
				text-align:center;
				position:relative;
				top:10px;
				font-size:4em;
			}
		</style>
	</head>

	<body>
		<div class="text-center mt-3">
			<?php if (count($blah) == 3) { ?>
				<img src="assests/img/taalem-512.png" alt="">
			<?php }else{ ?>
				<img src="../assests/img/taalem-512.png" alt="">
			<?php } ?>
		</div>
		<div class="container">
			<h1 class="head">Oops!</h1>
			<h1 class="subhead">404 Not Found</h1>
			<p class="text">Sorry, an error has occured,Requested page not found.</p>
			<a href="index.php"class="btn btn-primary btn-lg"><i class="fas fa-home"></i> Take Me Home</a>
			<a href="#" class="btn btn-danger btn-lg"><i class="fas fa-envelope"></i> Contact Support</a>
		</div>
	</body>
</html>