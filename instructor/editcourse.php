<?php

	$title="Edit Course | Taalem Instructor | Online Course Learning";
	require_once 'dash-header.php';

  if (!isset($_GET['id'])) {
    header("location: dashboard.php");
  }
  $id = $_GET['id'];
  $parcatid;
  $msg;
  $st;
  $upst;
  include '../inc/editcoursedata.php';

  function getContent($sectionid)
  {
    global $dc;
    $cntid = "id".uniqid();
    $htmlcont = "";
    $cnt = $dc->getTable("select * from content where sectionid='$sectionid'");
    while ($cntrw = mysqli_fetch_assoc($cnt)) {

    $htmlcont .= "<div id=\"div".$cntid."\">";
                    $htmlcont .= "<div class=\"row\"><div class=\"col-md-6\"><input type=\"text\" id=\"contid".$cntid."\" name=\"cntid[]\" value=\"".$cntrw['contentid']."\" readonly><label>Enter Content Title</label>";
                    $htmlcont .= "<input type=\"text\" value='".$cntrw['contentname']."' name=\"contname[]\" class=\"form-control\"><label>Enter Content Description(Optional)</label><input type=\"text\" name=\"contdesc[]\" value='".$cntrw['contentdesc']."' class=\"form-control\"><a href=\"javascript:void(0);\" id='rem".$cntid."' class=\"remcont\">Remove</a></div>";
                    $htmlcont .= "<div class=\"col-md-6\"><label >Upload Video/Notes</label>";
                    $htmlcont .= "<div id=\"msgBox".$cntid."\"><p style='width:100%'><span style='width:80%;'> ".$cntrw['contentname']."</span> <button type='button' class='btnupldel'><i class='fas fa-trash'></i></button></p></div>";
                    $htmlcont .= "<input type=\"text\" value='".$cntrw['contenturl']."' name=\"contfileurl[]\" id=\"contfileurlcrl".$cntid."\" class=\"form-control\" readonly></div></div></div>";
    }
    return $htmlcont;
  }

  

    $coursed = $dc->getRow("select * from course where courseid='$id'");

    if ($coursed['instid'] != $_SESSION['regid']) {
      header("location: dashboard.php");
    }

    $wwl = explode('`', $coursed['whatlearn']);
    $req = explode('`', $coursed['prerequirement']);

    $pricetable = array("500","2500","5000","7500","10000","12500","15000");
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
            <form method="post" enctype="multipart/form-data">
            <div id="content">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <h1>Edit Course</h1>
                        <?php if (isset($msg) and $st == false): ?>
                          <div class="alert alert-danger" role="alert">
                            <?= $msg ?>
                          </div>
                          <?php endif ?>
                        <?php if (isset($msg) and $st == true): ?>
                          <div class="alert alert-success" role="alert">
                              <?= $msg ?>
                          </div>
                        <?php endif ?>
                    </div>
                    <div class="col-md-6 text-right pt-2">
                    
                        <button type="Submit" name="submit-course" class="btn btn-custom">Submit For review</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div style="width:750px;">
                            <ul class="curtab nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" data-toggle="tab" href="#general">General</a>
                                  
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" data-toggle="tab" href="#aboutcur">About Course
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" data-toggle="tab" href="#curriculum">Curriculum
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" data-toggle="tab" href="#price">Price
                                  </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="general" class="container tab-pane active"><br>
                                    
                                        <div class="form-group">
                                            <label for="curname">Enter Course Name</label>
                                            <input type="text" class="form-control" name="curname" value="<?= $coursed['coursename'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="curcat">Category</label>
                                            <select name="parcat" id="parcat" class="form-control" required>
                                              <?php 
                                              $parcatid = $dc->getRow("select catparentid from category where catid='$coursed[catid]'");
                                              if ($parcatid['catparentid'] == 0) {
                                                $parnewcatid = $coursed['catid'];
                                              }else{
                                                $parnewcatid = $parcatid['catparentid'];
                                              }
                                              $parcat = $dc->getTable("select catid,catname,catparentid from category where catparentid=0");
                                                while ($parcatrw = mysqli_fetch_assoc($parcat)) {
                                                  if ($parcatrw['catid'] == $coursed['catid'] or $parcatrw['catid'] == $parcatid['catparentid']) {
                                                      echo '<option value="'.$parcatrw['catid'].'" selected>'.$parcatrw['catname'].'</option>';
                                                  }else{
                                                    echo '<option value="'.$parcatrw['catid'].'">'.$parcatrw['catname'].'</option>';  
                                                  }
                                                  
                                              }
                                               ?>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group" id="subcat">
                                          <label>SubCategory</label><select name='subcat' class='form-control'>
                                            <option value='no'>No SubCategory</option>
                                            <?php $subcat = $dc->getTable("select catid,catname,catparentid from category where catparentid='$parnewcatid'");
                                                while ($subrw = mysqli_fetch_assoc($subcat)) {
                                                    if ($subrw['catid'] == $coursed['catid']) {
                                                      echo '<option value="'.$subrw['catid'].'" selected>'.$subrw['catname'].'</option>';
                                                  }else{
                                                    echo '<option value="'.$subrw['catid'].'">'.$subrw['catname'].'</option>';  
                                                  }
                                                }

                                            ?>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tags">Tags (PHP,Javascript,.....)</label>
                                            <input type="text" name="tags" class="form-control" value="<?= $coursed['keyword'] ?>" required>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label for="curlang">Language Of Course</label>
                                            <select name="curlang" id="curlang" class="form-control" data-placeholder="Choose a Language..." required>
                                              <option value="<?= $coursed['lang'] ?>" selected><?= $coursed['lang'] ?></option>
                                              <option value="Afrikanns">Afrikanns</option>
                                              <option value="Albanian">Albanian</option>
                                              <option value="Arabic">Arabic</option>
                                              <option value="Armenian">Armenian</option>
                                              <option value="Basque">Basque</option>
                                              <option value="Bengali">Bengali</option>
                                              <option value="Bulgarian">Bulgarian</option>
                                              <option value="Catalan">Catalan</option>
                                              <option value="Cambodian">Cambodian</option>
                                              <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                                              <option value="Croation">Croation</option>
                                              <option value="Czech">Czech</option>
                                              <option value="Danish">Danish</option>
                                              <option value="Dutch">Dutch</option>
                                              <option value="English">English</option>
                                              <option value="Estonian">Estonian</option>
                                              <option value="Fiji">Fiji</option>
                                              <option value="Finnish">Finnish</option>
                                              <option value="French">French</option>
                                              <option value="Georgian">Georgian</option>
                                              <option value="German">German</option>
                                              <option value="Greek">Greek</option>
                                              <option value="Gujarati">Gujarati</option>
                                              <option value="Hebrew">Hebrew</option>
                                              <option value="Hindi">Hindi</option>
                                              <option value="Hungarian">Hungarian</option>
                                              <option value="Icelandic">Icelandic</option>
                                              <option value="Indonesian">Indonesian</option>
                                              <option value="Irish">Irish</option>
                                              <option value="Italian">Italian</option>
                                              <option value="Japanese">Japanese</option>
                                              <option value="Javanese">Javanese</option>
                                              <option value="Korean">Korean</option>
                                              <option value="Latin">Latin</option>
                                              <option value="Latvian">Latvian</option>
                                              <option value="Lithuanian">Lithuanian</option>
                                              <option value="Macedonian">Macedonian</option>
                                              <option value="Malay">Malay</option>
                                              <option value="Malayalam">Malayalam</option>
                                              <option value="Maltese">Maltese</option>
                                              <option value="Maori">Maori</option>
                                              <option value="Marathi">Marathi</option>
                                              <option value="Mongolian">Mongolian</option>
                                              <option value="Nepali">Nepali</option>
                                              <option value="Norwegian">Norwegian</option>
                                              <option value="Persian">Persian</option>
                                              <option value="Polish">Polish</option>
                                              <option value="Portuguese">Portuguese</option>
                                              <option value="Punjabi">Punjabi</option>
                                              <option value="Quechua">Quechua</option>
                                              <option value="Romanian">Romanian</option>
                                              <option value="Russian">Russian</option>
                                              <option value="Samoan">Samoan</option>
                                              <option value="Serbian">Serbian</option>
                                              <option value="Slovak">Slovak</option>
                                              <option value="Slovenian">Slovenian</option>
                                              <option value="Spanish">Spanish</option>
                                              <option value="Swahili">Swahili</option>
                                              <option value="Swedish ">Swedish </option>
                                              <option value="Tamil">Tamil</option>
                                              <option value="Tatar">Tatar</option>
                                              <option value="Telugu">Telugu</option>
                                              <option value="Thai">Thai</option>
                                              <option value="Tibetan">Tibetan</option>
                                              <option value="Tonga">Tonga</option>
                                              <option value="Turkish">Turkish</option>
                                              <option value="Ukranian">Ukranian</option>
                                              <option value="Urdu">Urdu</option>
                                              <option value="Uzbek">Uzbek</option>
                                              <option value="Vietnamese">Vietnamese</option>
                                              <option value="Welsh">Welsh</option>
                                              <option value="Xhosa">Xhosa</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="Tubmnailimage">Tumbnail Image</label><br/>
                                            
                                            <div id="msgBoximg"><p style='width:100%'><span style='width:80%;'>Current tumbnail</span> <button type='button' class='btnupldelimg' id='btnupldelimg'><i class='fas fa-trash'></i></button></p></div>
                                            <input type="hidden" name="tumbimage" id="tumbimage" class="form-control" value="<?= $coursed['thumbnailurl'] ?> " required readonly>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="Tubmnailimage">Preview Video(optional)</label><br/>
                                            <?php if ($coursed['thumbvidurl'] == ""): ?>
                                            <div  id="prewvideocont">
                                                <input type="button" id="uploadBtnvid" class="btn btn-large btn-primary" value="Select File">
                                                <div class="progress" id="progressOutervid" style="display: none;height: 25px;">
                                                    <div id="progressBarvid" class="progress-bar progress-bar-striped bg-success" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 0%;height: 100%;"></div>
                                                    
                                                </div>
                                            </div>
                                            <div id="msgBoxvid"></div>

                                            <?php else: ?>  
                                            <div id="msgBoxvid"><p style='width:100%'><span style='width:80%;'>current Prewiew Video </span> <button type='button' class='btnupldelvid' id='btnupldelvid'><i class='fas fa-trash'></i></button></p></div>
                                            <?php endif ?>
                                            <input type="hidden" name="tumbvideo" id="prewvideo" class="form-control" value="<?= $coursed['thumbvidurl'] ?>" readonly>
                                        </div>
                                    
                                </div>

                                <div id="aboutcur" class="container tab-pane"><br>
                                    
                                        <div class="mb-3">
                                            <h5>What will student learn</h5>
                                            <div id="addtb1">
                                              <?php for ($i = 0 ; $i < count($wwl)-1 ; $i++) {
                                                  if ($i == 0) {
                                                    ?>  
                                                     <div>
                                                        <input type="text" class="form-control mb-1" name="whatwill[]" placeholder="Example:Built Web Application" value="<?= $wwl[$i] ?>" required>
                                                    </div> 

                                                    <?php
                                                  }else{
                                                  ?>
                                                   <div><input type="text" class="form-control mb-1" name="whatwill[]" placeholder="Example:Built Web Application" value="<?= $wwl[$i] ?>" style="width:95%;float:left;border-top-right-radius:0;border-bottom-right-radius:0;"><button style="float:left" type="button" id="deltxt"><i class="fas fa-trash"></i></button><div class="clearfix"></div></div> 
                                                  <?php
                                                  }                                                    
                                              } ?>
                                             
                                            </div>
                                            <a href="#" class="addans mr-2" id="addww">+ Add answer</a>
                                            

                                        </div>
                                        
                                        <div class="mb-3">
                                            <h5>Requirements</h5>
                                            <div id="addtb2">

                                                <?php for ($i = 0 ; $i < count($req)-1 ; $i++) {
                                                  if ($i == 0) {
                                                    ?> 
                                                    <div> 
                                                     <input type="text" class="form-control mb-1" name="req[]"
                                                placeholder="Example:Use PC at beginner level" value="<?= $req[$i] ?>" required>
                                                    </div>
                                                    <?php
                                                  }else{
                                                  ?>
                                                   <div><input type="text" class="form-control mb-1" name="req[]" placeholder="Example:Use PC at beginner level" value="<?= $req[$i] ?>" style="width:95%;float:left;border-top-right-radius:0;border-bottom-right-radius:0;"><button style="float:left" type="button" id="deltxt"><i class="fas fa-trash"></i></button><div class="clearfix"></div></div>
                                                  <?php
                                                  }                                                    
                                              } ?>
                                             
                                                
                                                
                                            </div>

                                                <a href="#" class="addans" id="addreq">+ Add answer</a>
                                                
                                        </div>


                                        <div class="mb-3">
                                            <h5>Skill Group</h5>
                                            <select name="skillg" class="form-control" id="">
                                              <option value="<?= $coursed['skilllevel'] ?>" selected><?= $coursed['skilllevel'] ?> Level</option>
                                              <option value="beginner">beginner Level</option>
                                              <option value="intermediate">intermediate Level</option>
                                              <option value="advance">advance Level</option>
                                              <option value="all">All Level</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <h5>Description</h5>
                                            <textarea class="form-control" name="aboutcourse"
                                            placeholder="Short Summary About Your Course...."><?= $coursed['description'] ?></textarea>
                                        </div>
                                    
                                </div>
                                
                                <div id="curriculum" class="container tab-pane "><br>
                                    <p style="">Put Your Course Video or Notes by creating a section.</p>
                                    
                                    <input type="button" id="addsec" value="Add Section" class="btn btn-custom btn-block">
                                    
                                    <div id="mainsecdiv">
                                      <?php 
                                      $secno=1;
                                      $sectioncnt = $dc->getTable("select * from section where courseid='$id'"); 
                                      while ($scrw = mysqli_fetch_assoc($sectioncnt)){
                                        $secid = "id".uniqid();
                                       ?>
                                        <div class="mt-2" id="accordion" role="tablist" aria-multiselectable="true" >  
                                          <div class="card">
                                            <button type="button" id="delsec"><i class="fas fa-trash"></i></button>
                                            <div class="card-header" role="tab" id="heading<?= $secno ?>">
                                              <h5 class="mb-0"><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $secno ?>" aria-expanded="true" aria-controls="collapse<?= $secno ?>">Section  </a></h5>
                                              </div>
                                              <div id="collapse<?= $secno ?>" class="collapse show" role="tabpanel" aria-labelledby="heading<?= $secno ?>">
                                                <div class="card-block p-2" id="seccard">
                                                  <input type="text" id="secno<?= $secid ?>" name="secid[]" value="<?= $scrw['sectionid'] ?>" readonly>
                                                  <div class="form-group">
                                                  <label for="">Enter Section Title</label>
                                                  <input type="text" value="<?= $scrw['sectionname'] ?>" name="secname[]" class="form-control">
                                                  <div class="form-group">
                                                    <label for="">Enter Section description(optional)</label>
                                                    <input type="text" value="<?= $scrw['sectiondesc'] ?>" name="secdesc[]" class="form-control">
                                                  </div>
                                                  </div>
                                                  <h3>Add Content</h3>
                                                  <div id="mcont<?= $secid ?>"> 
                                                    <div id="acont<?= $secid ?>">
                                                        <?php echo getContent($scrw['sectionid']); ?>
                                                    </div>
                                                    <input type="button" value="Add Content" class="btn btn-custom addcnt">
                                                    <?php $cntcount = $dc->getRow("select count(contentid) as total from content where sectionid='$scrw[sectionid]'"); ?>
                                                    <input type="text" value="<?= $cntcount['total'] ?>" name="nooflecture[]" id="nol<?= $secid ?>" class="form-control" readonly>
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        

                                        <?php 
                                        $secno++;
                                      } ?>
                                      <p id="nextsecno" style="display: none"><?= $secno ?></p>
                                    </div>
  

                                </div>

                                <div id="price" class="container tab-pane"><br>
                                    <div class="form-group">
                                        <h5>Select Price for your Course</h5>

                                        <label class="custom-control custom-radio">
                                            <input  name="rdoprice" type="radio" class="custom-control-input" id="pricefree" <?php if ($coursed['coursetype'] == 'free') { echo "checked"; } ?> value="free" required>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Free</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input  name="rdoprice" type="radio" class="custom-control-input" id="pricepaid" <?php if ($coursed['coursetype'] == 'paid') { echo "checked"; } ?> value="paid" required>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Paid</span>
                                        </label>
                                    </div>

                                    <div class="form-group form-inline" id="pricelist">
                                        <?php if ($coursed['coursetype'] == 'paid'): ?>
                                          <label for="" style="font-size:24px;">INR ₹ :</label>
                                          <select name="drpprice" class="ml-1 form-control" style="width:200px" required>
                                            <?php foreach ($pricetable as $value) {
                                              if ($coursed['price'] == $value) {
                                                echo '<option value="'.$value.'" selected>₹'.$value.'</option>';
                                              }else{
                                                echo '<option value="'.$value.'">₹'.$value.'</option>';
                                              }
                                              
                                            } ?>
                                          </select>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <!-- </form> -->
                    <div class="col-md-3 pl-2">
                        <h2>HelpFull Tips</h2>
                        <hr>
                        <h4>Content</h4>
                        <p class="pl-1">For video : <br>
                        Format Should be Mp4 and 720p videos<br>
                        audio quality......<br>
                        For Notes : <br>
                        Format Should be PDF, Docx format
                        </p>
                        <h4>Content</h4>
                        <p class="pl-1">For video : <br>
                        Format Should be Mp4 and 720p videos<br>
                        audio quality......<br>
                        For Notes : <br>
                        Format Should be PDF, Docx format
                        </p>
                        <h4>Content</h4>
                        <p class="pl-1">For video : <br>
                        Format Should be Mp4 and 720p videos<br>
                        audio quality......<br>
                        For Notes : <br>
                        Format Should be PDF, Docx format
                        </p>
                        <h4>Content</h4>
                        <p class="pl-1">For video : <br>
                        Format Should be Mp4 and 720p videos<br>
                        audio quality......<br>
                        For Notes : <br>
                        Format Should be PDF, Docx format
                        </p>
                    </div>
                </div>
            </div>
        </form>
</div>

<?php include 'dash-footer.php'; ?>
    <script src="../assests/js/SimpleAjaxUploader.js"></script>
    <script src="../assests/js/editcourse.js"></script>
    
</body>
</html>
