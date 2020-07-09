<?php 
	$title = "Earning | Taalem Admin";
	include 'header.php';
	$dc = new Dataclass();

	$courses = $dc->getTable("select courseid, coursename from course where coursetype='paid'");
?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
	        <li class="breadcrumb-item">
	          <a href="index.php">Dashboard</a>
	        </li>
	        <li class="breadcrumb-item active ">Earning</li>
	    </ol>
	
	
	<div class="row">
        	<div class="col-12">
          		<div class="card mb-3">
			        <div class="card-header">
			        	<div class="row">
			        		<div class="col-md-6 pt-2">
			        			<i class="fa fa-table"></i> <b>Earnings</b>
			        		</div>
			        		<div class="col-md-6 text-right">
			        			
			        		</div>
			        	</div>
			         </div>
			        <div class="card-body">
			          <div class="table-responsive">
			            <table class="table table-bordered" id="earningTable" width="100%" cellspacing="0">
			              <thead>
			                <tr class="text-center tblheading">
                                <th>Course Name</th>
                                <th>Enroll Students</th>
                                <th>Total Sales</th>
                                <th>Total Earning</th>
                            </tr>
			              </thead>
			              <tbody class="text-center">
			              	<?php 
                                        while ($rw = mysqli_fetch_assoc($courses)) {
                                                                                
                                         ?>
                                        <tr>
                                            <td><?= $rw['coursename'] ?></td>
                                            <?php 
                                            $enrs = $dc->getRow("select count(enrollid) as totalen from courseenroll where courseid='$rw[courseid]'");
                                            echo "<td>".$enrs['totalen']."</td>";
                                            $tsale = $dc->getRow("SELECT COUNT(courseid) as totalsell FROM earning where courseid='$rw[courseid]' and regid='$_SESSION[regid]'");
                                            echo "<td>".$tsale['totalsell']."</td>";
                                            $totalincome = $dc->getRow("select sum(amount) as totalincome from earning where courseid='$rw[courseid]' and regid='$_SESSION[regid]'");
                                            echo "<td>".$totalincome['totalincome']."</td>";


                                             ?>
                                        </tr>
			                <?php } ?>
			              </tbody>
			            </table>
			          </div>
			        </div>
			    </div>
        	</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="card mb-3">
	        <div class="card-header">
	          <i class="fa fa-area-chart"></i> Last 5 Days Earning</div>
	        <div class="card-body">
	          <canvas id="earningChart" width="100%" height="30"></canvas>
	        </div>
	      </div>
    	</div>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>

   <script type="text/javascript">
$(document).ready(function(){
    $('#earningTable').DataTable({
        "order": [[ 3, "desc" ]],
    });
});
</script>
</body>
</html>