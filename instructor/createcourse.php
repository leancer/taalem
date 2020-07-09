<?php

	$title="Create Course | Taalem | Online Course Learning";
	require_once 'dash-header.php';
  $msg;
  $st;
  $upst;
  include '../inc/createcoursedata.php';

  

    $parcat = $dc->getTable("select catid,catname from category where catparentid=0");

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
            <form method="post" action="" enctype="multipart/form-data">
            <div id="content">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <h1>Create Course</h1>
                        <span class="text-danger">* is Required</span>
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
                    
                        <button type="submit" name="submit-course" class="btn btn-custom" id="mainsubbtn">Submit For review</button>
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
                                            <label for="curname">Enter Course Name <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="curname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="curcat">Category<span class="text-danger">*</span></label>
                                            <select name="parcat" id="parcat" class="form-control" required>
                                              <option value="0">Select Category</option>
                                              <?php 
                                              while ($parcatrw = mysqli_fetch_assoc($parcat)) {
                                                  echo '<option value="'.$parcatrw['catid'].'">'.$parcatrw['catname'].'</option>';
                                              }
                                               ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="subcat">
                                          
                                        </div>

                                        <div class="form-group">
                                            <label for="tags">Tags / Keywords<span class="text-danger">*</span> (PHP,php mvc,Javascript, Jquery.....)</label>
                                            <input type="text" name="tags" class="form-control" title="Use coma for differentiate" required>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label for="curlang" >Language Of Course<span class="text-danger">*</span></label>
                                           <!--  <select name="curlang" id="curlang" class="form-control">
                                                <option value="">PHP</option>
                                                <option value="">.NET</option>
                                                <option value="">Python</option>
                                            </select> -->
                                            <select name="curlang" id="curlang" class="form-control" data-placeholder="Choose a Language..." required>
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
                                            <label for="Tubmnailimage">Tumbnail Image<span class="text-danger">*</span></label><br/>
                                            <div  id="prewimgcont">
                                                <input type="button" id="uploadBtnimg" class="btn btn-large btn-primary" value="Select File">
                                                <div class="progress" id="progressOuterimg" style="display: none;height: 25px;">
                                                    <div id="progressBarimg" class="progress-bar progress-bar-striped bg-success" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 0%;height: 100%;"></div>
                                                    
                                                </div>
                                            </div>
                                            <div id="msgBoximg"></div>
                                            <input type="text" name="tumbimage" id="tumbimage" class="form-control" style="display: none;" required> 
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="Tubmnailimage">Preview Video(optional)</label><br/>
                                            <div  id="prewvideocont">
                                                <input type="button" id="uploadBtnvid" class="btn btn-large btn-primary" value="Select File">
                                                <div class="progress" id="progressOutervid" style="display: none;height: 25px;">
                                                    <div id="progressBarvid" class="progress-bar progress-bar-striped bg-success" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 0%;height: 100%;"></div>
                                                    
                                                </div>
                                            </div>
                                            <div id="msgBoxvid"></div>
                                            <input type="text" name="tumbvideo" id="prewvideo" class="form-control" style="display: none;" readonly>
                                            
                                        </div>
                                    
                                </div>

                                <div id="aboutcur" class="container tab-pane"><br>
                                    
                                        <div class="mb-3">
                                            <h5>What will student learn<span class="text-danger">*</span></h5>
                                            <div id="addtb1">
                                            <div>
                                                <input type="text" class="form-control mb-1" name="whatwill[]" placeholder="Example:Built Web Application" required>
                                            </div> 
                                            </div>
                                            <button type="button" class="addans mr-2 btn btn-link" id="addww">+ Add answer</button>
                                            

                                        </div>
                                        
                                        <div class="mb-3">
                                            <h5>Requirements<span class="text-danger">*</span></h5>
                                            <div id="addtb2">
                                                <input type="text" class="form-control mb-1" name="req[]"
                                                placeholder="Example:Use PC at beginner level" required>
                                                
                                            </div>

                                                <button type="button" class="addans btn btn-link" id="addreq">+ Add answer</button>
                                                
                                        </div>
                                        <div class="mb-3">
                                            <h5>Skill Group<span class="text-danger">*</span></h5>
                                            <select name="skillg" class="form-control" id="" required> 
                                              <option value="beginner">beginner Level</option>
                                              <option value="intermediate">intermediate Level</option>
                                              <option value="advance">advance Level</option>
                                              <option value="all">All Level</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <h5>Description<span class="text-danger">*</span></h5>
                                            <textarea class="form-control" name="aboutcourse" required></textarea>
                                        </div>
                                    
                                </div>
                                
                                <div id="curriculum" class="container tab-pane "><br>
                                    <p style="">Put Your Course Video or Notes by creating a section.</p>
                                    
                                    <input type="button" id="addsec" value="Add Section" class="btn btn-custom btn-block">
                                    
                                    <div id="mainsecdiv">
                                        
                                    </div>
                                    

                                </div>

                                <div id="price" class="container tab-pane"><br>
                                    <div class="form-group">
                                        <h5>Select Price for your Course<span class="text-danger">*</span></h5>

                                        <label class="custom-control custom-radio">
                                            <input  name="rdoprice" type="radio" class="custom-control-input" id="pricefree" value="free" required>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Free</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input  name="rdoprice" type="radio" class="custom-control-input" id="pricepaid" value="paid">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Paid</span>
                                        </label>
                                    </div>

                                    <div class="form-group form-inline" id="pricelist">
                                        
                                    </div>

                                    <?php 

                                     ?>
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
                        <h4>Price</h4>
                        <p class="pl-1">If your course will paid so you get 80% out of your course price
                        
                        </p>
                        <h4>Review</h4>
                        <p class="pl-1">Your Course Will be Reviewed By Us for security purpose.<br> we will notifiy You via message for Approval or rejection
                        </p>
                    </div>
                </div>
            </div>
        </form>
</div>


<?php include 'dash-footer.php'; ?>
    <script src="../assests/js/SimpleAjaxUploader.js"></script>
    <script src="../assests/js/createcourse.js"></script>



    
</body>
</html>
