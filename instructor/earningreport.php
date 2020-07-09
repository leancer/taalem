<?php

	$title="Dashboard | Taalem | Online Course Learning";
	require_once 'dash-header.php';
?>

<div class="wrapper">
            <nav id="sidebar">
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
            <div class="col-md-12">
                <ul class="nav nav-tabs mx-5" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#bytype" role="tab" aria-controls="home" aria-selected="true">Earning by Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#bydate" role="tab" aria-controls="bydate" aria-selected="false">By Date</a>
                    </li>
                    
                </ul>
                <div class="tab-content mx-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="bytype" role="tabpanel" aria-labelledby="home-tab">
                        <div class="mt-3">
                            <form action="earningreport.php#bytype" method="post">
                                <div class="form-group">
                                    <label for="">Sort</label><br>
                                    <input type="radio" name="sort" value="asc"> Ascending Order
                                    <input type="radio" name="sort" value="desc"> Descending Order
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btnsort" class="btn btn-primary">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bydate" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="earningreport.php#bydate" method="post">
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Starting Date</label>
                                        <input type="date" class="form-control" name="txtstartdt" >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Ending Date</label>
                                        <input type="date" class="form-control" name="txtenddt">
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
                if (isset($_POST['btnsort'])) {
                    $dttb = $dc->getTable("select c.coursename, sum(e.amount) as totalEarning from course c,earning e where c.courseid=e.courseid and e.regid=$_SESSION[regid] GROUP by e.courseid order by totalEarning $_POST[sort]");
                }
                if (isset($_POST['btnsearchdt'])) {
                    $dttb = $dc->getTable("select c.coursename,e.earndate, e.amount  from course c,earning e where c.courseid=e.courseid and e.regid=$_SESSION[regid] and e.earndate between '$_POST[txtstartdt]' and '$_POST[txtenddt]'");
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
                            <tr class="text-center tblheading">
                                <?php
                                
                                foreach ($fieldinfo as $val)
                                {
                                echo '<th>'.$val->name.'</th>';
                                array_push($fnm, $val->name);
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody class="">
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

<?php include 'dash-footer.php'; ?>
<script type="text/javascript">
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
    });
</script>

</body>
</html>