<?php 
	$title = "Feedback | Taalem Admin";
	include 'header.php';
	$dc = new Dataclass();

	$opmd="";

	$getmsgdt = $dc->getTable("select f.fbid,f.fbdate,f.detail,f.star,r.username,sih from feedback f,register r where f.regid=r.regid");
	

	if (isset($_GET['action']) and $_GET['action'] == "view") {
		$msid= $_GET['id'];
		$msgdt = $dc->getRow("select f.fbid,f.fbdate,f.detail,f.star,r.username from feedback f,register r where f.regid=r.regid and fbid=$msid");
		$opmd = "$('#msgview').modal('show');";
	}
?>

<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
	        <li class="breadcrumb-item">
	          <a href="index.php">Dashboard</a>
	        </li>
	        <li class="breadcrumb-item active ">FeedBack</li>
	    </ol>
	
	
	<div class="row">
        	<div class="col-12">
          		<div class="card mb-3">
			        <div class="card-header">
			        	<div class="row">
			        		<div class="col-md-6 pt-2">
			        			<i class="fa fa-table"></i> <b>Feedback</b>
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
			                  <th>Feedback Date</th>
			                  <th>username</th>
							  <th>Feedback</th>
							  <th>star</th>
							  <th>view</th>
							  <th>Show in Home</th>
			                </tr>
			              </thead>
			              <tbody class="text-center">
			              	<?php 
			              	$k=0;
							while ($msgrw = mysqli_fetch_assoc($getmsgdt)) {
												              		
			              	 ?>
			                <tr>
			                	<td><?= $msgrw['fbdate'] ?></td>
			                	<td><?= $msgrw['username'] ?></td>
			                	<td><?= $msgrw['detail'] ?></td>
			                	<td><?php 
			                	for ($i = 1; $i <=$msgrw['star'] ; $i++){
			                		echo '<i class="fa fa-star" style="color:#f4c150;"></i>';
			                	}
			                	 ?></td>
			                	<td><a href="feedback.php?id=<?= $msgrw['fbid'] ?>&action=view" class="a-black"><i class="fa fa-eye"></i> View</a></td>
			                	<td><input data-id="<?= $msgrw['fbid'] ?>" type="checkbox" <?php if($msgrw['sih'] == 1){ echo 'checked'; } ?> id="hecked<?= $k ?>" class="cbx hidden" />
    <label for="hecked<?= $k ?>" class="lbl"></label></td>
			                </tr>
			                <?php $k++; ?>
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
        <a href="feedback.php" class="a-black" style="font-size: 28px;">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
      	<table cellpadding="5px" cellspacing="5px">
      			<tr>
      				<td class="text-muted">Feedback From </td>
      				<td>:</td>
      				<td><b><?= $msgdt['username'] ?><b></td>
      			</tr>
      			<tr>
      				<td class="text-muted">Detail </td>
      				<td>:</td>
      				<td><?= $msgdt['detail'] ?></td>
      			</tr>
      			<tr>
      				<td class="text-muted" style="vertical-align: top;">Star </td>
      				<td  style="vertical-align: top;">:</td>
      				<td><?php 
			                	for ($i = 1; $i <=$msgdt['star'] ; $i++){
			                		echo '<i class="fa fa-star" style="color:#f4c150;"></i>';
			                	}
			                	 ?></td>
      			</tr>
      	</table>
      </div>
      <div class="modal-footer">
        <a href="feedback.php" class="btn btn-secondary">Close</a>
        
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php include 'footer.php'; ?>

<script type="text/javascript">
$(document).ready(function(){
		<?php echo $opmd; ?>
		$('input[type="checkbox"]').on('click', function(){

        var data = {};
        data.id = $(this).data('id');
        data.value = $(this).is(':checked') ? 1 : 0;

        console.log(data);

        $.ajax({
	    url: "inc/feedbackajax.php",
	    method: "POST",
	    data: data,
	    success: function(data){

	    }
	});
    });
});
</script>


<!-- Query -->

