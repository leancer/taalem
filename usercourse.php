<?php

	$title="Courses | Taalem | Online Course Learning";
	require_once 'header.php';
?>

		<div class="titlepage">
			<div class="row">
				<div class="col-md-12">
					<h1>Courses</h1>
					<p><a href="<?= URL ?>" class="a-white"><i class="fas fa-home"></i></a> <i class="fas fa-angle-right a-white"></i> Courses</p>
				</div>	
			</div>
		</div>
		
		<div class="container mt-3">
			<div class="row">
				<div class="col-md-12">
					<h1>My Courses</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div style="width:100%;">
						<ul class="curtab nav nav-tabs" role="tablist">
						    <li class="nav-item">
						      <a class="nav-link active" data-toggle="tab" href="#course"> Course</a>
						      
						    </li>
						    
						</ul>

						<div class="tab-content">
					    	<div id="publish" class="container tab-pane active"><br>
					    		<div class="row">
					    		<?php 	
					    			$getusercourse = $dc->getTable("select c.courseid, c.coursetype, c.thumbnailurl, c.coursename, i.instname from courseenroll ce, course c, instructor i where ce.courseid=c.courseid and c.instid = i.regid and ce.regid='$_SESSION[regid]'");

					    			while ($gucrw = mysqli_fetch_assoc($getusercourse)) {    
					    			
					    		 ?>
					    			<div class="col-md-4">
					    				<div class="card single-card" style="width: 15rem;height: auto">
										<img class="card-img-top imgr" src="content/<?= $gucrw['thumbnailurl'] ?>" alt="Card image cap" height="120px">
										<div class="card-body">
											<p class="card-title"><a href="singlecourse.php?id=<?= $gucrw['courseid'] ?>" class="a-black"> <?= $gucrw['coursename'] ?></a></p>
											<p class="card-text"><span class="text-muted"> By <?= $gucrw['instname'] ?></span></p>
											<hr/>
											
											<a href="lecture.php?cid=<?= $gucrw['courseid'] ?>" class="btn btn-custom btn-block">View</a>
											<?php $totalcnt=$dc->getRow("select count(contentid) as totalcontent from content where courseid='$gucrw[courseid]'");
											$totalf=$dc->getRow("select noc from cmprecord where courseid='$gucrw[courseid]' and regid='$_SESSION[regid]'");
										 	if ($totalf['noc'] == '') {
										 		$totalf['noc'] = 0;
										 	}
										 	if ($totalf['noc'] == $totalcnt['totalcontent'] and $gucrw['coursetype'] != 'free') {
										 	 ?>
											<a href="certificate.php?cid=<?= $gucrw['courseid'] ?>" class="btn btn-success btn-block">Get Certificate</a>
										<?php } ?>
										</div>
										</div>
					    			</div>
								<?php } ?>
					    		</div>
									

							</div>

							<div id="unpublish" class="container tab-pane fade"><br>
					    		<div class="card single-card" style="width: 15rem;height: auto">
										<img class="card-img-top imgr" src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="Card image cap" height="120px">
										<div class="card-body">
											<p class="card-title"> Feature IT Security And Ethical Hacking Learn</p>
											<p class="card-text"><span class="text-muted"> By Someone</span></p>
											<hr/>
											
											<button class="btn btn-custom btn-block">View</button>
										</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

<?php require_once 'footer.php'; ?>
</body>
</html>

