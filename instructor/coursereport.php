<?php

	$title="course Report | Taalem | Online Course Learning";
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
        <div class="row mt-3">
            <div class="col-md-12">
                <ul class="nav nav-tabs mx-5" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#bycat" role="tab" aria-controls="home" aria-selected="true">By Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#byprice" role="tab" aria-controls="bydate" aria-selected="false">By Price</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#bydate" role="tab" aria-controls="bydate" aria-selected="false">By Date</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#enrollstu" role="tab" aria-controls="bydate" aria-selected="false">Enroll Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#nosales" role="tab" aria-controls="bydate" aria-selected="false">No of Sales</a>
                    </li>
                </ul>
                <div class="tab-content mx-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="bycat" role="tabpanel" aria-labelledby="home-tab">
                        <div class=" mt-3">
                            <form action="coursereport.php" method="post">
                                <div class="form-group">
                                            <label for="curcat">Category<span class="text-danger">*</span></label>
                                            <select name="parcat" id="parcat" class="form-control" required>
                                              <option value="no">Select Category</option>
                                              <?php 
                                              $parcat = $dc->getTable("select catid,catname from category where catparentid=0");
                                              while ($parcatrw = mysqli_fetch_assoc($parcat)) {
                                                  echo '<option value="'.$parcatrw['catid'].'">'.$parcatrw['catname'].'</option>';
                                              }
                                               ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="subcat">
                                          
                                        </div>
                                        <div class="form-group">
                                    <button type="submit" name="btncat" class="btn btn-primary">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="byprice" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="mt-3">
                            <label for="">Search By Price</label>
                            <select name="dpcat" id="dpcat" class="form-control" onchange="location = this.value;" style="width: 300px;">
                                <option value="">Select</option>
                                <option value="coursereport.php?price=free#byprice">Free</option>
                                <option value="coursereport.php?price=paid#byprice">Paid</option>
                            </select>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bydate" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="coursereport.php#bydate" method="post">
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
                    <div class="tab-pane fade" id="enrollstu" role="tabpanel" aria-labelledby="profile-tab">
                        <div class=" mt-3">
                            <form action="coursereport.php#enrollstu" method="post">
                                <div class="form-group">
                                    <label for="">Sort</label><br>
                                    <input type="radio" name="sort" value="asc"> Ascending Order
                                    <input type="radio" name="sort" value="desc"> Descending Order
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btnenroll" class="btn btn-primary">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nosales" role="tabpanel" aria-labelledby="profile-tab">
                        <div class=" mt-3">
                            <form action="coursereport.php#nosales" method="post">
                                <div class="form-group">
                                    <label for="">Sort</label><br>
                                    <input type="radio" name="sort" value="asc"> Ascending Order
                                    <input type="radio" name="sort" value="desc"> Descending Order
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btnsale" class="btn btn-primary">apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                if (isset($_POST['btncat'])) {
                    if ($_POST['parcat'] != 'no') {
                        
                    $catid = $_POST['parcat'];
                    if ($_POST['subcat'] != "no") { $catid = $_POST['subcat'];  }
                    $dttb = $dc->getTable("SELECT c.coursename,i.instname, c.coursedate from instructor i, course c where i.regid=c.instid and c.instid=$_SESSION[regid] and c.catid=$catid");
                }
                }
                if (isset($_GET['price'])) {
                    $dttb = $dc->getTable("SELECT c.coursename,i.instname, c.coursedate from instructor i, course c where i.regid=c.instid and c.instid=$_SESSION[regid] and coursetype='$_GET[price]'");
                }
                if (isset($_POST['btnenroll'])) {
                    $dttb = $dc->getTable("select c.coursename, count(e.enrollid) as totalEnroll from course c,courseenroll e where c.courseid=e.courseid and c.instid=$_SESSION[regid] GROUP by e.courseid order by totalEnroll $_POST[sort]");
                }
                if (isset($_POST['btnsale'])) {
                    $dttb = $dc->getTable("select c.coursename, count(e.earnid) as totalSale from course c,earning e where c.courseid=e.courseid and e.regid=$_SESSION[regid] GROUP by e.courseid order by totalSale $_POST[sort]");
                }
                if (isset($_POST['btnsearchdt'])) {
                    $dttb = $dc->getTable("SELECT c.coursename,i.instname, c.coursedate from instructor i, course c where i.regid=c.instid and c.instid=$_SESSION[regid] and c.coursedate between '$_POST[txtstartdt]' and '$_POST[txtenddt]'");
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
                        <tbody class="text-center">
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

        $("body").on("change","#parcat",function(){
              var parcat = $("#parcat").val();
              $.ajax({
                type:"POST",
                url:"../inc/getsubcat.php",
                data:{ parct : parcat },
                success:function(response){
                  $("#subcat").html(response);
                }
              });
            });
    });
</script>

</body>
</html>