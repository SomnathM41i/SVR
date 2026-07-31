 <?php 
	
	require_once('includes/bootstrap.php');
?>
 
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Member Login</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<script>

 
</script>



<script type="text/javascript">
 function checkdiv(str)
{

  if (str=='Unmarried')
  {
    $('#noofchild').hide();
    $('#childstatus').hide();
    
  }
    else
  {
    $('#noofchild').show();
    $('#childstatus').show();
    
  }
}
</script>
<!-- not allowed to enter any spaces-->
<script type="text/javascript">
function nospaces(t)
{
if(t.value.match(/\s/g)){
alert('Sorry, you are not allowed to enter any spaces');
t.value=t.value.replace(/\s/g,'');
}}
</script>
<!-- end allowed to enter any spaces-->
<!-- check password length-->
<script type="text/javascript">
  function CheckLengthPassword(el) {
  document.getElementById("passeror").style.display = 'none';
  if(el.value.length!=0){
  if (el.value.length < 5 ) {
  document.getElementById("passeror").style.display = 'block';
  document.getElementById("passeror").style.color = "#ff0000";
  document.getElementById('pass').value="";
  document.getElementById('pass').focus();
  return false;
     } 
   }
} 
function ValidateAlpha(evt)
{
var keyCode = (evt.which) ? evt.which : evt.keyCode
if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

return false;
return true;
}
function blockSpecialChar(e){ 
var k;
document.all ? k = e.keyCode : k = e.which;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
function check_exist123(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("emailerror").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","check_email_exist.php?q="+str,true);
xmlhttp.send();
} 

</script>
<!-- end check password length-->
<style>
.butnsub{   
   position: absolute;
    right: 0px;
    top: 0px;
    height: 60px;
    width: 60px;
    text-align: center;
    line-height: 30px;
    font-size: 18px;
    line-height: 60px;
    background-color: #ffffff;
    color: #222222;
    cursor: pointer;
}
.subscribe-form .sec-title {
    margin-bottom: 19px;
}


</style>
<style>
.buttonload {
  background-color: #04AA6D; /* Green background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 24px; /* Some padding */
  font-size: 16px; /* Set a font-size */
}

/* Add a right margin to each icon */
.fas {
  margin-left: -12px;
  margin-right: 8px;
}
</style>
</head>

<body>
  

<div class="page-wrapper">
 	
    <!-- Preloader -->
     <div class="preloader"></div> 
 	<!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Header Menu -->
     <?php include('header.php')?>
     <!-- End Header Menu -->

    <!--Page Title-->
   
    <!--End Page Title-->
	
	<!-- Signup Form -->
  
	
    <section class="newsletter-section">
        <div class="anim-icons full-width">
            <span class="icon icon-shape-3 wow fadeIn"></span>
            <span class="icon icon-line-1 wow fadeIn"></span>
        </div>
        <div class="auto-container">
            <!--Subscribe Form-->
			<div class="row">
			 <div class="col-lg-2 col-md-4 col-sm-4">
			 </div>
             <div class="form-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="contact-form">
                             <div class="sec-title text-center"> 
                            <!--<div class="icon-box"><span class="fa fa-envelope"></span></div>-->
                            <br/><h2>Login</h2> 
                            <div class="text">Existing Member? Login</div>
                        </div>
						 <?php if(isset($_GET['action'])){
                    ?><h5 class="text mb-5" align="center" ><font color="#FF0000">You are enter Wrong Username or Password <br>Please reenter and submit </font></h5>
                    <?php } ?>
                    <?php if(isset($_GET['action1'])){
                    ?><h5 class="w3ls-title w3ls-title1" align="center"><font color="#FF0000">Your Password Change Successfully</font></h5>
                    <?php } ?>
                            <form method="post" action="login_submit.php" class="form" id="contact-form">
                              <?php require_once('includes/security.php'); echo svr_csrf_field(); ?>
                                <div class="row clearfix">
															
							   <div class="col-lg-12 col-md-12 col-sm-12 form-group" id="emailerror">
                                       <input type="text"  autofocus name="txtusername" placeholder="Email ID / Username / Mobile No." tabindex="1"   required value="<?php if(isset($_COOKIE["user_login"])) 
                      { echo $_COOKIE["user_login"]; } ?>" >
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
									 <input type="password" name="txtpassword" placeholder="Enter Password" maxlength="35"  id="pass" tabindex="2" required autocomplete="current-password">

											</div>
							<div class="col-lg-9 col-md-9 col-sm-9 mb-2">   
                         <label class="labelcss" style="vertical-align: middle" >
							  <input type="checkbox" checked style="vertical-align: middle"   >
								</label> 
								 	I Acknowledge <a href="terms-conditions" target=_blank tabindex="3"><u>Terms Of Service </u></a>  And <a href="privacy-policy" target=_blank><u>Privacy Policy*</u></a>

							
                                </div>
						 <div class="col-lg-9 col-md-9 col-sm-9 mt-2">            
						  <li class="switch-agileits float-left"></li>
							<label class="labelcss" style="vertical-align: middle">
							  <input type="checkbox" style="vertical-align: middle" name="remember_me" value="1"  tabindex="4">
								<span class="slider-switch round " ></span>
									Keep me signed in
							</label>
						  
							</div>
              
							<div class="col-lg-3 col-md-3 col-sm-3 mt-2 "  >	  
                               <a href="forgot_password" class="ml-4" tabindex="5">Trouble login in?</a>
			                </div>		
                                   
                                    
                                    
                                    
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-3 ">
							   <div class="btn-box">	
								<button class="theme-btn btn btn-style-one " tabindex="6" type="submit" name="submit" style="width:100%"><span class="btn-title">Log In</span></button>
                            							
							   </div> 
							   
							    
                           </div>
									 <div class="col-lg-9 col-md-9 col-sm-9 mt-3">
						    <span class="">  New Candidate Register ?<a href="signup"  tabindex="7"> SignUp</a></span>
							   
						   </div>
						   	
                                </div>
                            </form>
							
                        </div>
                    </div>
                </div>
        </div>
		</div>
    </section>

	<?php /*<div class="col-lg-3 col-md-3 col-sm-3 mt-3 ">	

                  <fb:login-button scope="public_profile,email" onlogin="fblogin();">
                  </fb:login-button>
                  <div id="status">
                  </div>
                  <!-- Load the JS SDK asynchronously -->
                  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>               
			        </div>*/?>
    <!--End Signup Form -->

    <!-- Main Footer -->
    <?php include('footer.php');?>
    <!-- End Footer -->

</div>


 
<script src="http://code.jquery.com/jquery.js"></script>
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->
<!-- End Color Switcher -->

<!--Search Popup-->


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>


<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/validate.js"></script>
<script src="js/script.js"></script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
	<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin fas"></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script>
</body>
</html>
