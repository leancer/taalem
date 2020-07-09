<?php
	$title = "User Report | Taalem Admin";
	include 'header.php';
	$dc = new Dataclass();
	$msg;
	$upst;
	$dttb;
?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.php">Dashboard</a>
			</li>
			<li class="breadcrumb-item active ">User Report</li>
		</ol>
		<div class="row text-center">
			<div class="col-md-6 offset-md-3" id="stmsgbox">
				<?php if (isset($msg) and $upst == false): ?>
				<div class="alert alert-danger" role="alert">
					<?= $msg ?>
				</div>
				<?php endif ?>
				<?php if (isset($msg) and $upst == true): ?>
				<div class="alert alert-success" role="alert">
					<?= $msg ?>
				</div>
				<?php endif ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs mx-5" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#bytype" role="tab" aria-controls="home" aria-selected="true">By Usertype</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#bydate" role="tab" aria-controls="bydate" aria-selected="false">By Date</a>
					</li>
					
				</ul>
				<div class="tab-content mx-5" id="myTabContent">
					<div class="tab-pane fade show active" id="bytype" role="tabpanel" aria-labelledby="home-tab">
						<div class="text-center mt-3">
							<form action="" method="post"><button type="submit" name="getins" class="btn btn-primary btn-lg mr-2" style="width: 25%;">Instructors</button>
								<button type="submit" name="getstd" class="btn btn-primary btn-lg ml-2" style="width: 25%;">Users</button>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="bydate" role="tabpanel" aria-labelledby="profile-tab">
						<form action="userreports.php#bydate" method="post">
							<div class="row mt-3">
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Starting Date</label>
										<input type="date" class="form-control" name="txtstartdt" required="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Ending Date</label>
										<input type="date" class="form-control" name="txtenddt" required="">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">UserType</label>
										<select name="type" id="" class="form-control">
											<option value="student">Student</option>
											<option value="instructor">instructor</option>
										</select>
									</div>
								</div>
								<div class="col-md-2" style="margin-top:30px;">
									<button type="submit" name="btnsearchdt" class="btn btn-primary">Search</button>
								</div>
							</div>
						</form>
					</div>
					
				</div>
			</div>
			
		</div>
		<div class="row mt-3">
			<div class="col-md-12">
				<?php
				if (isset($_POST['getins'])) {
					$dttb = $dc->getTable("select regdate,username,email,usertype from register where usertype='instructor'");
				}
				if (isset($_POST['getstd'])) {
					$dttb = $dc->getTable("select regdate,username,email,usertype from register where usertype='student'");
				}
				if (isset($_POST['btnsearchdt'])) {
					$dttb = $dc->getTable("select regdate,username,email,usertype from register where usertype='$_POST[type]' and  regdate between '$_POST[txtstartdt]' and '$_POST[txtenddt]'");
				}
				if (isset($dttb)) {
					$fieldinfo=mysqli_fetch_fields($dttb);
					$fnm = array();
				?>
				<div class="forprint">
					<div class="float-left">
						Numbers Of Records: <?= $dttb->num_rows ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="table-responsive p-5">
					<table class="table table-bordered" id="dttable" width="100%" cellspacing="0">
						<thead>
							<tr class="tblheading">
								<?php
								
								foreach ($fieldinfo as $val)
								{
								echo '<th>'.$val->name.'</th>';
								array_push($fnm, $val->name);
								}
								?>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($rw = mysqli_fetch_assoc($dttb)) {
							?>
							<tr>
								<?php foreach ($fnm as $value) {
									echo '<td>'.$rw[$value].'</td>';
								}?>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
				</div>
				<?php
				 } ?>
			
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<!-- <script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.print.min.js"></script> -->
<script>
	$(document).ready(function() {
		$('#dttable').DataTable({
			dom: 'Bfrtip',
      buttons: [
      {
           extend: 'pdfHtml5',
           text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
           orientation: 'landscape',
           pageSize: 'A4'
           
       },
       {
           extend: 'csv',
           text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> CSV'
          
       },
       {
           extend: 'print',
           text: '<i class="fa fa-print" aria-hidden="true"></i> PRINT'
       }
      ]
		});
		var url = document.location.toString();
		if (url.match('#')) {
		    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
		    window.location.hash = e.target.hash;
		})
	});
</script>
</body>
</html>