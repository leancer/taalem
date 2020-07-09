<?php

	$title="Courses | Taalem | Online Course Learning";
	require_once 'dash-header.php';
	$regid = $_SESSION['regid'];
?>

<div class="wrapper">
            <nav id="sidebar" style="position: relative;height:587px;">
                <ul class="list-unstyled components">
                    
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

            <div class="container m-4">
            	<div class="row">
					<div class="col-md-8">
						<h1 >My Courses</h1>
					</div>
					<div class="col-md-4">
						<a href="coursereport.php" class="float-right mt-3 btn btn-custom ml-2">Reports</a>
						<a href="createcourse.php" class="float-right mt-3 btn btn-custom">Create Course</a>
					</div>
				</div>
            	<div class="row">
					<div class="col-md-12">
						<div style="width:100%;">
							<ul class="curtab nav nav-tabs" role="tablist">
							    <li class="nav-item">
							      <a class="nav-link active" data-toggle="tab" href="#publish">Publish Course</a>
							      
							    </li>
							    <li class="nav-item">
							      <a class="nav-link" data-toggle="tab" href="#unpublish">Unpublish Course
							      </a>
							    </li>
							</ul>

							<div class="tab-content">
						    	<div id="publish" class="container tab-pane active"><br>
								<div class="row">

									<?php
									$pubc = $dc->getTable("select courseid,coursename,thumbnailurl from course where instid='$regid' and status=1");
										if ($pubc->num_rows == 0) {
											echo '<div class="col-md-12"><p class="text-center">No Course</p></div>';
										}else{
											while ($pbrw = mysqli_fetch_assoc($pubc)){
									 ?>
									<div class="col-md-4">
										<div class="card single-card" style="width: 15rem;height: auto">
											<img class="card-img-top imgr" src="../content/<?= $pbrw['thumbnailurl'] ?>" alt="Card image cap" height="120px">
											<div class="card-body">
												<p class="card-title"> <?= $pbrw['coursename'] ?></p>
												<p class="card-text"><span class="text-muted"> By you</span></p>
												<hr/>
												
												<a href="editcourse.php?id=<?= $pbrw['courseid'] ?>" class="btn btn-custom btn-md">Edit</a>
												<a href="../singlecourse.php?id=<?= $pbrw['courseid'] ?>" class="btn btn-custom btn-md">View</a>
											</div>
									</div>
									</div>
									<?php 	}
										} ?>
								</div>
								</div>

								<div id="unpublish" class="container tab-pane fade"><br>
								<div class="row">

									<?php
									$pendingc = $dc->getTable("select courseid,coursename,thumbnailurl from course where instid='$regid' and status=0");
										if ($pendingc->num_rows == 0) {
											echo '<div class="col-md-12"><p class="text-center">No Pending Course</p></div>';
										}else{
											while ($prw = mysqli_fetch_assoc($pendingc)){
									 ?>
									<div class="col-md-4">
										<div class="card single-card" style="width: 15rem;height: auto">
											<img class="card-img-top imgr" src="../content/<?= $prw['thumbnailurl'] ?>" alt="Card image cap" height="120px">
											<div class="card-body">
												<p class="card-title"> <?= $prw['coursename'] ?></p>
												<p class="card-text"><span class="text-muted"> By you</span></p>
												<hr/>
												
												<a href="editcourse.php?id=<?= $prw['courseid'] ?>" class="btn btn-custom btn-md">Edit</a>
												<a href="../singlecourse.php?id=<?= $prw['courseid'] ?>" class="btn btn-custom btn-md">View</a>
											</div>
									</div>
									</div>
									<?php 	}
										} ?>
								</div>
						    		
								</div>
							</div>
		            	</div>	
            		</div>
        		</div>
    		</div>
			
	<?php include 'dash-footer.php'; ?>

</body>
</html>

