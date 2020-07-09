$(function(){

        
        // About Section JS(What will learn AND Required)
        var i=1;
        $("#addww").on('click',function(){
        
            var data='<div><input type="text" class="form-control mb-1" name="whatwill[]" placeholder="Example:Built Web Application" style="width:95%;float:left;border-top-right-radius:0;border-bottom-right-radius:0;"><button style="float:left" type="button" id="deltxt"><i class="fas fa-trash"></i></button><div class="clearfix"></div></div>';
            $('#addtb1').append(data);
            
        });

        $("#addreq").on('click',function(){
        
            var data2='<div><input type="text" class="form-control mb-1" name="req[]" placeholder="Example:Use PC at beginner level" style="width:95%;float:left;border-top-right-radius:0;border-bottom-right-radius:0;"><button style="float:left" type="button" id="deltxt"><i class="fas fa-trash"></i></button><div class="clearfix"></div></div>';
            $('#addtb2').append(data2);
            i++;
        });

        $('body').on('click','#deltxt', function () {
            $(this).closest("div").remove();
        });

        var secno = 1;
        var nextID='';
        /*curriculum code*/
        //section code
        $("#addsec").on('click',function(){
            nextID = 'id' + (new Date()).getTime();
            var datacon = '<div class="mt-2" id="accordion" role="tablist" aria-multiselectable="true" >  <div class="card"><button type="button" id="delsec"><i class="fas fa-trash"></i></button><div class="card-header" role="tab" id="heading' + secno + '"><h5 class="mb-0"><a data-toggle="collapse" data-parent="#accordion" href="#collapse' + secno + '" aria-expanded="true" aria-controls="collapse' + secno + '">Section  </a></h5></div><div id="collapse' + secno + '" class="collapse show" role="tabpanel" aria-labelledby="heading' + secno + '"><div class="card-block p-2"><div class="form-group"><label for="">Enter Section Title</label><input type="text" name="secname[]" class="form-control" required></div><div class="form-group"><label for="">Enter Section description(optional)</label><input type="text" name="secdesc[]" class="form-control"></div><h3>Add Content</h3><div id="mcont' + nextID + '"> <div id="acont' + nextID + '"></div><input type="button" value="Add Content" class="btn btn-custom addcnt"><input type="text" name="nooflecture[]" style="display: none;" id="nol' + nextID + '" class="form-control" readonly></div></div></div></div></div>';

            $('#mainsecdiv').append(datacon);
            secno++;
        });


        $('body').on('click','#delsec', function () {
            $(this).closest("div").remove();
            secno--;
        });
        //content code
        $("body").on("click",".addcnt",function(){
                    nextID = 'id' + (new Date()).getTime();
                    var parentelement = $(this).closest("div").attr("id");
                    // console.log($(this).closest("div").attr("id"));
                    var htmlcont = "<div class='mt-2' id=\"div"+nextID+"\">";
                    htmlcont += "<div class=\"row\"><div class=\"col-md-6\"><label>Enter Content Title</label>";
                    htmlcont += "<input type=\"text\" name=\"contname[]\" class=\"form-control\" required><label>Enter Content Description(Optional)</label><input type=\"text\" name=\"contdesc[]\" class=\"form-control\"><a href=\"javascript:void(0);\" id='rem"+nextID+"' class=\"remcont\">Remove</a></div>";
                    htmlcont += "<div class=\"col-md-6\"><label >Upload Video/Notes</label>";
                    htmlcont += "<div class=\"\" id=\"contfilecontrol" + nextID + "\"><input type=\"button\" value='Select' id=\"uploadBtn\" class=\"btn btn-large btn-primary\"><div id=\"progressOuter\" class=\"progress\" style=\"display:none;height: 25px;\"><div id=\"progressBar\" class=\"progress-bar progress-bar-striped bg-success\"  role=\"progressbar\" aria-valuenow=\"45\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%;height:100%;\"></div></div></div><div id=\"msgBox" + nextID + "\"></div>";
                    htmlcont += "<input type=\"text\" name=\"contfileurl[]\" style=\"display: none;\" id=\"contfileurlcrl" + nextID + "\" class=\"form-control\"></div></div><hr/>";
                    var num = ($("#"+parentelement+" > #acont"+parentelement.substring(5)).children().length)+1;
                    $("#nol"+parentelement.substring(5)).val(num);
                    
                    $("#" + parentelement).children("div:first").append(htmlcont);
                });

                $("body").on('click','.remcont',function(){
                    var currentid = $(this).attr("id");
                    var parentid = $("#div"+ currentid.substring(3)).parent().attr("id");
                    var valurl = $("#contfileurlcrl"+ currentid.substring(3)).val();
                    console.log(valurl);
                    $("#nol"+parentid.substring(5)).val($("#nol"+parentid.substring(5)).val()-1);
                    $("#" + currentid).parents("#div"+ currentid.substring(3)).remove();

                    $.ajax({
                      type: "POST",
                      url: '../inc/uploadfiledelete.php',
                      data: { fileurl : valurl },
                      success: function(data)
                      {
                      }
                    });

                });
                $("body").on("click", "#uploadBtn", function() {
                    var currentid = $(this).parent().attr("id");

                    var btn = $("#"+currentid + " > #uploadBtn");
                    
                    var progressOuter = $("#"+currentid + " > #progressOuter");
                    var progressBar = $("#"+currentid + " > #progressOuter > #progressBar");
                    var msgBox = $("#msgBox" +currentid.substring(15));

                      var uploader = new ss.SimpleUpload({
                            button: btn,
                            url: '../inc/file_upload.php',
                            name: 'uploadfile',
                            multipart: true,
                            allowedExtensions: ['doc', 'mkv', 'docx', 'pdf','mp4'],
                            debug:true,
                            hoverClass: 'hover',
                            focusClass: 'focus',
                            responseType: 'json',
                            startXHR: function() {
                                //progressOuter.style.display = 'block'; // make progress bar visible
                                $(progressOuter).css('display', 'block');
                                $(msgBox).html('');
                                this.setProgressBar(progressBar);
                            },
                            onExtError: function() {
                                  //msgBox.innerHTML = ;
                                  $(msgBox).css('color','red');
                                $(msgBox).html('Invalid file type. Please select a docx, PDF, Mp4, MKV.');
                              },
                              onProgress:function(pct){
                                //$(btn).val("Uploading...Please wait "+ pct);
                                $(progressBar).html(pct+'%');
                              },
                            onSubmit: function() {
                                $(msgBox).html('');
                                //btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
                                $(btn).css('display', 'none');
                                $("#mainsubbtn").attr("disabled","");
                              },
                            onComplete: function( filename, response ) {
                                btn.innerHTML = 'Choose Another File';
                                //progressOuter.style.display = 'none'; // hide progress bar when upload is completed
                                $(progressOuter).css('display', 'none');
                                $("#mainsubbtn").removeAttr("disabled");

                                if ( !response ) {
                                    $(msgBox).css('color','red');
                                    msgBox.innerHTML = 'Unable to upload filedasdsad';
                                    return;
                                }

                                if ( response.success === true ) {
                                    
                                    $("#contfileurlcrl"+ currentid.substring(15)).val(response.msg);
                                        $("#"+currentid).remove();
                                    $(msgBox).html("<p style='width:100%'><span style='width:80%;'> "+ filename + "</span> <button type='button' class='btnupldel'><i class='fas fa-trash'></i></button></p>");
                                } else {
                                    if ( response.msg )  {
                                        msgBox.innerHTML = escapeTags( response.msg );

                                    } else {
                                        $(msgBox).css('color','red');
                                        msgBox.innerHTML = 'An error occurred and the upload failed.';
                                    }
                                }
                              },
                            onError: function() {
                                //progressOuter.style.display = 'none';
                                $(progressOuter).css('display', 'none');
                                $(msgBox).css('color','red');
                                msgBox.innerHTML = 'Unable to upload file csadfsa';
                              }
                        });
                    // var inputValue = $(this).val();
                    // var item = inputValue.split("\\");
                    // var lastItem = item.pop();
                    
                    // $("#contfileurlcrl"+ currentid.substring(15)).val(lastItem);
                    // var tmppath = URL.createObjectURL(event.target.files[0]);
                    // $("#pre" + $(this).attr("id") + " img").attr('src', tmppath);
                });

            $("body").on("click",".btnupldel",function(){
                var currentid = $(this).closest("div").attr("id");
               var valurl = $("#contfileurlcrl"+ currentid.substring(6)).val(); 
               $("#"+currentid).remove();
               $("#contfileurlcrl"+ currentid.substring(6)).val('');
               var htmldata = "<div class=\"\" id=\"contfilecontrol" + currentid.substring(6) + "\"><input type=\"button\" value='Select' id=\"uploadBtn\" class=\"btn btn-large btn-primary\"><div id=\"progressOuter\" class=\"progress\" style=\"display:none;height: 25px;\"><div id=\"progressBar\" class=\"progress-bar progress-bar-striped bg-success\"  role=\"progressbar\" aria-valuenow=\"45\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%;height:100%;\"></div></div></div><div id=\"msgBox" + currentid.substring(6) + "\"></div>";
               $("#contfileurlcrl"+ currentid.substring(6)).before(htmldata);

               $.ajax({
                      type: "POST",
                      url: '../inc/uploadfiledelete.php',
                      data: { fileurl : valurl },
                      success: function(data)
                      {
                      }
                    });
            });

            //preview video JS
            $('#prewvideocont > #uploadBtnvid').on('click',function(){

                var btn = $(this);
                    var progressOutervid = $("#prewvideocont > #progressOutervid");
                    var progressBarvid = $("#prewvideocont > #progressOutervid > #progressBarvid");
                    var msgBox = $("#msgBoxvid");

                      var uploader = new ss.SimpleUpload({
                            button: btn,
                            url: '../inc/file_upload.php',
                            name: 'uploadfile',
                            multipart: true,
                            allowedExtensions: ['mkv', 'mp4'],
                            debug:true,
                            hoverClass: 'hover',
                            focusClass: 'focus',
                            responseType: 'json',
                            startXHR: function() {
                                //$(progressOuter).css('display', 'block');
                                $(progressOutervid).css('display', 'block');
                                this.setProgressBar( progressBarvid );
                            },
                            onExtError: function() {
                                  //msgBox.innerHTML = ;
                                  $(msgBox).css('color','red');
                                $(msgBox).html('Invalid file type. Please select a Mp4, MKV.');
                              },
                              onProgress:function(pct){
                                //$(btn).val("Uploading...Please wait "+ pct);
                                $(progressBarvid).html(pct+'%');
                              },
                            onSubmit: function() {
                                $(msgBox).html('');
                                //btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
                                $(btn).css('display', 'none');
                              },
                            onComplete: function( filename, response ) {
                                btn.innerHTML = 'Choose Another File';
                                //progressOuter.style.display = 'none'; // hide progress bar when upload is completed
                                $(progressOutervid).css('display', 'none');

                                if ( !response ) {
                                        $(msgBox).css('color','red');
                                    msgBox.innerHTML = 'Unable to upload File';
                                    return;
                                }

                                if ( response.success === true ) {
                                    
                                    $("#prewvideo").val(response.msg);
                                        $("#prewvideocont").remove();
                                         $(msgBox).css('color','green');
                                        $(msgBox).html("<p style='width:100%'><span style='width:80%;'> "+ filename + "</span> <button type='button' class='btnupldelvid' id='btnupldelvid'><i class='fas fa-trash'></i></button></p>");
                                } else {
                                    if ( response.msg )  {
                                        msgBox.innerHTML = escapeTags( response.msg );

                                    } else {
                                        $(msgBox).css('color','red');
                                        msgBox.innerHTML = 'An error occurred and the upload failed.';
                                    }
                                }
                              },
                            onError: function() {
                                //progressOuter.style.display = 'none';
                                // $(progressOutervid).css('display', 'none');
                                $(msgBox).css('color','red');
                                msgBox.innerHTML = 'Unable to upload file';
                              }
                        });

                

            });

            //delete thumbnail Video
            $("body").on("click","#btnupldelvid",function(){
                var currentid = $(this).closest("div").attr("id");
                var valurl = $("#prewvideo").val();
                $("#"+currentid).remove();
                $("#prewvideo").val('');
                var htmldata = "<div  id=\"prewvideocont\"><input type=\"button\" id=\"uploadBtnvid\" class=\"btn btn-large btn-primary\" value=\"Select File\"><div class=\"progress\" id=\"progressOutervid\" style=\"display: none\"><div id=\"progressBarvid\" class=\"progress-bar progress-bar-striped bg-success\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div></div></div><div id=\"msgBoxvid\"></div>";
               $("#prewvideo").before(htmldata);

               $.ajax({
                      type: "POST",
                      url: '../inc/uploadfiledelete.php',
                      data: { fileurl : valurl },
                      success: function(data)
                      {
                      }
                    });
            });


            //tumbnail image
            $('#prewimgcont > #uploadBtnimg').on('click',function(){

                var btn = $(this);
                    var progressOutervid = $("#prewimgcont > #progressOuterimg");
                    var progressBarvid = $("#prewimgcont > #progressOuterimg > #progressBarimg");
                    var msgBox = $("#msgBoximg");

                      var uploader = new ss.SimpleUpload({
                            button: btn,
                            url: '../inc/file_upload.php',
                            name: 'uploadfile',
                            multipart: true,
                            allowedExtensions: ['png', 'jpg', 'jpeg', 'bmp'],
                            debug:true,
                            hoverClass: 'hover',
                            focusClass: 'focus',
                            responseType: 'json',
                            startXHR: function() {
                                //$(progressOuter).css('display', 'block');
                                $(progressOutervid).css('display', 'block');
                                this.setProgressBar( progressBarvid );
                            },
                            onExtError: function() {
                                  //msgBox.innerHTML = ;
                                  $(msgBox).css('color','red');
                                $(msgBox).html('Invalid file type. Please select a png, jpg, jpeg, bmp.');
                              },
                              onProgress:function(pct){
                                //$(btn).val("Uploading...Please wait "+ pct);
                                $(progressBarvid).html(pct+'%');
                              },
                            onSubmit: function() {
                                $(msgBox).html('');
                                //btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
                                $(btn).css('display', 'none');
                              },
                            onComplete: function( filename, response ) {
                                btn.innerHTML = 'Choose Another File';
                                //progressOuter.style.display = 'none'; // hide progress bar when upload is completed
                                $(progressOutervid).css('display', 'none');

                                if ( !response ) {
                                        $(msgBox).css('color','red');
                                    msgBox.innerHTML = 'Unable to upload File';
                                    return;
                                }

                                if ( response.success === true ) {
                                    
                                    $("#tumbimage").val(response.msg);
                                        $("#prewimgcont").remove();
                                         $(msgBox).css('color','green');
                                        $(msgBox).html("<p style='width:100%'><span style='width:80%;'> "+ filename + "</span> <button type='button' class='btnupldelimg' id='btnupldelimg'><i class='fas fa-trash'></i></button></p>");
                                } else {
                                    if ( response.msg )  {
                                        msgBox.innerHTML = escapeTags( response.msg );

                                    } else {
                                        $(msgBox).css('color','red');
                                        msgBox.innerHTML = 'An error occurred and the upload failed.';
                                    }
                                }
                              },
                            onError: function() {
                                //progressOuter.style.display = 'none';
                                // $(progressOutervid).css('display', 'none');
                                $(msgBox).css('color','red');
                                msgBox.innerHTML = 'Unable to upload file';
                              }
                        });

            });

            //delete thumbnail image
            $("body").on("click","#btnupldelimg",function(){
                var currentid = $(this).closest("div").attr("id");
                var valurl = $("#tumbimage").val();
                $("#"+currentid).remove();
                $("#tumbimage").val("");
                var htmldata = "<div  id=\"prewimgcont\"><input type=\"button\" id=\"uploadBtnimg\" class=\"btn btn-large btn-primary\" value=\"Select File\"><div class=\"progress\" id=\"progressOuterimg\" style=\"display: none\"><div id=\"progressBarimg\" class=\"progress-bar progress-bar-striped bg-success\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div></div></div><div id=\"msgBoximg\"></div>";
               $("#tumbimage").before(htmldata);

               $.ajax({
                      type: "POST",
                      url: '../inc/uploadfiledelete.php',
                      data: { fileurl : valurl },
                      success: function(data)
                      {
                      }
                    });
            });
            // select price javascript
            $("body").on("change","#pricepaid",function(){
                var htmldata = "<label for=\"\" style=\"font-size:24px;\">INR ₹ :</label><select name=\"drpprice\" class=\"ml-1 form-control\" style=\"width:200px\" required><option value=\"\">Select...</option><option value=\"500\">₹500.00</option><option value=\"2500\">₹2,500.00</option><option value=\"5000\">₹5,000.00</option><option value=\"7500\">₹7,500.00</option><option value=\"10000\">₹10,000.00</option><option value=\"12500\">₹12,500.00</option><option value=\"15000\">₹15,000.00</option></select>";
                $("#pricelist").append(htmldata);
            });
            $("body").on("change","#pricefree",function(){
                if ($("#pricelist").length > 0) {
                    $("#pricelist").empty();
                }
            });

            //category
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