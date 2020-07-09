
	/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
// particlesJS.load('particles-js', 'assests/js/particlesjs-config.json', function() {
// });

var urnamest;
var emailst;

new WOW().init();

//Autocomplete of header Search

$( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#header-search" ).autocomplete({
      source: availableTags
    });
  });
     

$(document).ready(function(){
	/*Upload Icon*/
	$(".uplicon").hide();

    $(".dpdiv").mouseover(function(){

          $(".uplicon").show();

          $(".dpdiv").mouseleave(function(){

              $(".uplicon").hide();

          });
    });





	/*Card Silder*/
	
//counter

$(".fea").hide();
	$("#btns").change(function(){
				// var value = $(this).attr("data-filter");

				
				if(this.value == 1)
				{
					$(".rec").show("1000");
					$(".fea").hide("1000");
				}
				else
				{
					$(".rec").hide("1000");
					$(".fea").show("1000");
				}


			});


	$('.count').each(function () {
	    $(this).prop('Counter',0).animate({
	        Counter: $(this).text()
	    }, {
	        duration: 5000,
	        easing: 'swing',
	        step: function (now) {
	            $(this).text(Math.ceil(now));
	        }
	    });
	});

	



	$(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
        	
            $('.scrollup').fadeOut();
        }
    });


	/*Demo*/

		

	/*Demo*/

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    //exist username check ajax
    $("#username").keyup(function(event){
    	var currentval = $(this).val();
    		$.ajax({
    			type:"POST",
    			url:"veremailusername.php",
    			data:{ username : currentval },
    			success : function ( data ){
    				console.log(data);
    				if (data == 'true') {
    					$("#resultur").html("username is available");
    					$("#resultur").css("color","green");
    					$("#username").css("border-color","green");
    					urnamest = true;
    				}else{
    					$("#resultur").html("username is taken");
    					$("#resultur").css("color","red");
    					$("#username").css("border-color","red");
    					urnamest = false;
    				}
    			}
    		});

    });

    //exist email check ajax
	$("#email").keyup(function(event){

    	var currentval = $(this).val();
    		$.ajax({
    			type:"POST",
    			url:"veremailusername.php",
    			data:{ email : currentval },
    			success : function ( data ){
    				if (data == 'true') {
    					$("#resultemail").html("Email is available");
    					$("#resultemail").css("color","green");
    					emailst = true;
    				}else{
    					$("#resultemail").html("Email is taken");
    					$("#resultemail").css("color","red");
    					emailst = false;
    				}
    			}
    		});

    });

});
// credit card validator

function checkCreditCard(){

	var no = document.getElementById("ccno").value;
	var mastercardno = /^(?:5[1-5][0-9]{14})$/;
	var visacardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;

	if (no.match(mastercardno)) {
		return true;
	}else if (no.match(visacardno)) {
		return true;
	}else{
		document.getElementById("resultmsg").innerHTML = "Please enter Valid Card Number";
		return false;
	}
}

//debit card validator
function checkDebitCard(){
	var no = document.getElementById("dcno").value;
	var cvvno = document.getElementById("cvvno").value;
	var cardname = document.getElementById("cardname").value;
	var mastercardno = /^(?:5[1-5][0-9]{14})$/;
	var visacardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
	var rupaycardno = /^(?:6[0-9]{15})$/;

	document.getElementById("resultcvv").innerHTML = "";

	if (cvvno.length == 3) {
		if (cardname == "mastercard") {
			if (no.match(mastercardno)) {
			return true;
			} else{
				document.getElementById("resultdc").innerHTML = "Please enter Valid Master Card Number";
			return false;
			}

		} else if (cardname == "visacard"){
			if (no.match(visacardno)) {
			return true;
			} else{
				document.getElementById("resultdc").innerHTML = "Please enter Valid Visa Card Number";
			return false;
			}
		} else if (cardname == "rupaycard"){
			if (no.match(rupaycardno)) {
			return true;
			} else{
				document.getElementById("resultdc").innerHTML = "Please enter Valid rupay Card Number";
			return false;
			}
		} else {

			return false;
		}

	}else{
		document.getElementById("resultcvv").innerHTML = "Please enter Valid CVV Number";
		return false;
	}

}
function notSpace(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 32) {
        return false;
        }
        return true;
        }

function userRegVal()
{
	var user=document.getElementById('username').value;
	var fname=document.getElementById('firstname').value;
	var lname=document.getElementById('lastname').value;
	var userreg = /^([^0-9][0-9A-Za-z-]*)$/;
	var namereg = /^([a-zA-z]*)$/;
	var pwd=document.getElementById('password').value;
	var pwdreg= /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{7,19}$/;
	var repwd=document.getElementById('repass').value;

	if (fname.match(namereg) && lname.match(namereg))
	{
		if (user.length>=3 && user.length<=20)
		{
			if (user.match(userreg))
			{
				if(pwd.length >= 6 && pwd.length <= 20)
				{
					if(pwd.match(pwdreg))
					{
						if(repwd==pwd)
						{
							if (urnamest) {
								if (emailst) {
									return true;
								}else{
									return false;
								}
							}else{
								return false;
							}		
						}
						else
						{
							document.getElementById("resultrepwd").innerHTML = "Password Mismatch.";
							return false;		
						}
					}
					else
					{
						document.getElementById("resultpwd").innerHTML = "Contain atlest one alpha one number and one special char.";
						return false;	
					}
				}
				else
				{
					document.getElementById("resultpwd").innerHTML = "Must Between 6 to 20.";
					return false;
				}
			}else{
				document.getElementById("resultur").style.color = "red";
				document.getElementById("resultur").innerHTML = "Username Can't Start With Number.";
			return false;	
			}
		}else{
			document.getElementById("resultur").style.color = "red";
			document.getElementById("resultur").innerHTML = "Charcter Must Be Between 3 to 20";
			return false;
		}
	}else{
		document.getElementById("fname").innerHTML = "First Name or Last name Can't Contain Number.";
		return false;	
	}	
}



