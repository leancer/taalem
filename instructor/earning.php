<?php

	$title="Earning | Taalem | Online Course Learning";
	require_once 'dash-header.php';

    $courses = $dc->getTable("select courseid, coursename from course where instid='$_SESSION[regid]' and coursetype='paid'");
?>

<div class="wrapper">
            <nav id="sidebar" style="height:587px;">
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
                                <h5 class="float-left"><i class="fa fa-dollar-sign"></i> <b>Earning</b></h5>
                                <a href="earningreport.php" class="btn btn-warning float-right">Report</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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

    </div>
</div>



<?php include 'dash-footer.php'; ?>

    <script type="text/javascript">
$(document).ready(function(){
    $('#dataTable').DataTable({
        "order": [[ 3, "desc" ]],
    });
});
</script>
</body>
</html>