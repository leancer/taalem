<?php

	$title="Dashboard | Taalem | Online Course Learning";
	require_once 'dash-header.php';
?>

<div class="wrapper">
            <nav id="sidebar" >
                <ul class="list-unstyled components" >
                    
                    <li class="active">
                        <a href="dashboard.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="mycourses.php"><i class="fas fa-video mr-2"></i>Courses</a>
                    </li>
                    <li>
                        <a href="earning.php"><i class="fas fa-dollar-sign mr-3"></i>Earning</a>
                    </li>
					<li>
                        <a href="message.php"><i class="fas fa-comments mr-3"></i>Message</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-question mr-3"></i>Help</a>
                    </li>
                </ul>
            </nav>

            <div id="content" style="width: 100%;">

            	<div class="row ml-2 mt-3">
						<div class="col-md-3">
							<div class="card insinfo">
								<div class="card-block">
									<?php $totalstud = $dc->getRow("select count(DISTINCT ce.regid) as totals from courseenroll ce,course c where ce.courseid = c.courseid and c.instid = '$_SESSION[regid]'"); ?>
									<h4><?= $totalstud['totals'] ?></h4>
									<div class="card-text">Student Enrolled</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card insinfo">
								<div class="card-block">
									<?php $totalcourse = $dc->getRow("select count(courseid) as totalc from course where instid='$_SESSION[regid]'"); ?>
									<h4><?= $totalcourse['totalc'] ?></h4>
									<div class="card-text">Courses</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card insinfo">
								<div class="card-block">
									<?php $totalsale = $dc->getRow("SELECT COUNT(courseid) as totalsell FROM earning where regid='$_SESSION[regid]'"); ?>
									<h4><?= $totalsale['totalsell'] ?></h4>
									<div class="card-text">Total sales</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card insinfo">
								<div class="card-block">
									<?php $totalincome = $dc->getRow("select sum(amount) as totalincome from earning where regid='$_SESSION[regid]'"); ?>
									<h4><?= $totalincome['totalincome'] ?></h4>
									<div class="card-text">Earning</div>
								</div>
							</div>
						</div>
				</div>

				<div class="row ml-2 mt-3">
					<div class="col-md-12">
						<div class="card" >
						  <div class="card-header">
						    <p class="text-muted" style="font-weight: bold"><i class="fas fa-chart-bar mr-2"></i>Monthly Earning</p>
						  </div>
						  <div class="card-body">
							<canvas id="earningChart" width="100%" height="30"></canvas>
						  </div>
						</div>
					</div>
				</div>
        	</div>

</div>



	<?php include 'dash-footer.php'; ?>

</body>
</html>
