<?php 
	$title = "Message | Instructor | Taalem";
	include "dash-header.php";
	$dc = new Dataclass();

	$opmd="";

	$getmsgdt = $dc->getTable("select msgid,subject,r.username,msgdatetime from message,register r where senderregid=r.regid and receiverregid=$_SESSION[regid] order by msgid DESC");



	if (isset($_GET['action']) and $_GET['action'] == "view") {
		$msid= $_GET['id'];
		$msgdt = $dc->getRow("select msgid,r.username,subject,message from message,register r where senderregid=r.regid and msgid=$msid");

		$opmd = "$('#msgview').modal('show');";
	}
?>

<div class="wrapper">
            <nav id="sidebar">
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

            <div id="content" style="width: 100%;">
            	<div class="row mt-2">
		        	<div class="col-md-12">
		        		<div class="card mb-3">
		        			<div class="card-header" style="padding: 10px;">
		        				<h5><i class="fa fa-comments"></i> <b>Message</b></h5>
		        			</div>
		        			<div class="card-body">
		        				<div class="table-responsive">
			          			  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			          			  	<thead>
						                <tr class="text-center tblheading">
						                  <th>Message From</th>
						                  <th>Subject</th>
										  <th>View</th>
						                </tr>
						            </thead>

						            <tbody class="text-center">
						            	<?php 
										while ($msgrw = mysqli_fetch_assoc($getmsgdt)) {
															              		
						              	 ?>
						            	<tr>
											<td><?= $msgrw['username'] ?></td>
											<td><?= $msgrw['subject'] ?></td>
											<td><a href="message.php?id=<?= $msgrw['msgid'] ?>&action=view" class="a-black"><i class="fa fa-eye"></i> View</a></td>
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

<?php 
	if (isset($_GET['action']) and $_GET['action'] == "view") {
?>
<div class="modal fade" id="msgview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<table cellpadding="5px" cellspacing="5px">
      			<tr>
      				<td class="text-muted">Message From </td>
      				<td>:</td>
      				<td><b><?= $msgdt['username'] ?><b></td>
      			</tr>
      			<tr>
      				<td class="text-muted">Subject </td>
      				<td>:</td>
      				<td><?= $msgdt['subject'] ?></td>
      			</tr>
      			<tr>
      				<td class="text-muted" style="vertical-align: top;">Message </td>
      				<td  style="vertical-align: top;">:</td>
      				<td><?= $msgdt['message'] ?></td>
      			</tr>
      		</table>
      </div>
      <div class="modal-footer">
        <a href="message.php" class="btn btn-secondary">Close</a>
        
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php 
	include "dash-footer.php";
?>


<script type="text/javascript">
$(document).ready(function(){
    $('#dataTable').DataTable();
		<?php echo $opmd; ?>
});
</script>