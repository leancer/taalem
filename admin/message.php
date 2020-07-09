<?php 
	$title = "Message | Taalem Admin";
	include 'header.php';
	$dc = new Dataclass();

	$opmd="";

	$getmsgdt = $dc->getTable("select msgid,subject,r.username,msgdatetime from message,register r where senderregid=r.regid and receiverregid=$_SESSION[regid]");
	

	if (isset($_GET['action']) and $_GET['action'] == "view") {
		$msid= $_GET['id'];
		$msgdt = $dc->getRow("select msgid,r.username,subject,message from message,register r where senderregid=r.regid and msgid=$msid");
		$opmd = "$('#msgview').modal('show');";
	}
?>

<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
	        <li class="breadcrumb-item">
	          <a href="index.php">Dashboard</a>
	        </li>
	        <li class="breadcrumb-item active ">Message</li>
	    </ol>
	
	
	<div class="row">
        	<div class="col-12">
          		<div class="card mb-3">
			        <div class="card-header">
			        	<div class="row">
			        		<div class="col-md-6 pt-2">
			        			<i class="fa fa-table"></i> <b>Message</b>
			        		</div>
			        		<div class="col-md-6 text-right">
			        			
			        		</div>
			        	</div>
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
</div>


<?php 
	if (isset($_GET['action']) and $_GET['action'] == "view") {
?>
<div class="modal fade" id="msgview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Message</h5>
        <a href="message.php" class="a-black" style="font-size: 28px;">
          <span aria-hidden="true">&times;</span>
        </a>
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

<?php include 'footer.php'; ?>

<script type="text/javascript">
$(document).ready(function(){
		<?php echo $opmd; ?>
});
</script>


<!-- Query -->

