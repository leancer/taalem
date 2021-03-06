<?php 
	$title = "users | Taalem Admin";
	include 'header.php';
	$dc = new Dataclass();
	$opmd="";

	$userd = $dc->getTable("SELECT r.regid,s.name, s.gender, r.username,r.regdate,r.email from student s, register r where s.regid=r.regid");

	if (isset($_GET['id'])) {
		$studid = $_GET['id'];

		$opmd = "$('#userdt').modal('show');";
	}

	if (isset($_GET['action']) and $_GET['action'] == "view") {
		$studvw = $_GET['id'];
		$singlevw = $dc->getRow("SELECT r.regid,s.name,s.gender,s.interest,s.photo, r.username,r.regdate,r.email from student s, register r where s.regid=r.regid and r.regid='$studvw'");

		$opmd = "$('#userdt').modal('show');";
	}

	

 ?>
 <div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
	        <li class="breadcrumb-item">
	          <a href="index.php">Dashboard</a>
	        </li>
	        <li class="breadcrumb-item active ">Users</li>
	    </ol>
	    <div class="row">
        	<div class="col-12">
          		<div class="card mb-3">
			        <div class="card-header">
			        	<div class="row">
			        		<div class="col-md-6 pt-2">
			        			<i class="fa fa-table"></i> <b>Users</b>
			        		</div>
			        		<div class="col-md-6 text-right">
			        			
			        		</div>
			        	</div>
			          </div>
			        <div class="card-body">
			          <div class="table-responsive">
			            <table class="table table-bordered" id="dtstu" width="100%" cellspacing="0">
			              <thead>
			                <tr class="text-center tblheading">
			                  <th>Name</th>
			                  <th>Gender</th>
			                  <th>Username</th>
			                  <th>Email</th>
			                  <th>Date of Register</th>
			                  <th>Action</th>
			                </tr>
			              </thead>
			              <tbody class="text-center">
			              	<?php 
							while ($userrw = mysqli_fetch_assoc($userd)) {
												              		
			              	 ?>
			                <tr>
			                	<td><?= $userrw['name'] ?></td>
			                	<td><?= $userrw['gender'] ?></td>
			                	<td><?= $userrw['username'] ?></td>
			                	<td><?= $userrw['email'] ?></td>
			                	<td><?php echo $userrw['regdate']; ?></td>
			                	<td class="text-center" style="font-size: 20px"><a href="users.php?id=<?= $userrw['regid'] ?>&action=view" class="mx-1 a-black" title="View"><i class="fa fa-eye"></i></a>
								
								
			                	</td>
			                	
			                </tr>
			                <?php } ?>
			              </tbody>
			            </table>
			          </div>
			        </div>
			    </div>
        	</div>
      	</div>
	</div>
</div>

<div class="modal fade" id="userdt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row mt-2">
      		
      		<div class="col-md-6 text-center">
      			<img class="rounded-circle " 
      			src="../<?= $singlevw['photo'] ?>" width="120px" height="120px" alt="">

      			<h4 class="text-muted pt-2" style="text-shadow: 1px 2px 3px rgba(0,0,0,.5);"><?= $singlevw['name'] ?></h4>
				<?php 
						if ($singlevw['gender'] == 'm') {
							echo '<div class="text-muted text-center"><i class="fa fa-intersex"></i>Male</div>';
						}
						else
						{
							echo "Female";
						}
				 ?>
      		</div>

      		<div class="col-md-6" style="">
      			<table cellpadding="5px" cellspacing="5px">
      				<tr>
      					<td class="text-muted">Username</td>
      					<td><b><?= $singlevw['username'] ?></b></td>
      				</tr>
      				<tr>
      					<td class="text-muted">Date</td>
      					<td><b><?= $singlevw['regdate'] ?></b></td>
      				</tr>
      				<tr>
      					<td class="text-muted">Email</td>
      					<td><b><?= $singlevw['email'] ?></b></td>
      				</tr>
      				
      				<tr>
      					<td class="text-muted">Interest</td>
      					<td><b><?= $singlevw['interest'] ?></b></td>
      				</tr>
      				
      			</table>
      		</div>
      		
      	</div>
      </div>
      <div class="modal-footer">
        <a href="users.php" class="btn btn-secondary">Close</a>
        
      </div>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>


<script>
	$(document).ready(function(){
		$('#dtstu').DataTable( {
        "order": [[ 4, "desc" ]]
    } );
		<?php echo $opmd; ?>
	});
</script>

</body>
</html>