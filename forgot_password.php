<?php  require_once('includes/bootstrap.php'); ?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Forgot Password</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<link rel="icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<!-- MPJ: brand icons -->
<link rel="apple-touch-icon" href="branding/favicons/apple-touch-icon.png">
<link rel="manifest" href="branding/site.webmanifest">
<meta name="theme-color" content="#5E1426">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">



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
.sub{
	
    margin-bottom: 2.8rem!important;
}

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
</style>
<style>

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

   
	
	<!-- Signup Form -->
    <section class="newsletter-section">
        <div class="anim-icons full-width">
            <!--<span class="icon icon-shape-3 wow fadeIn"></span>-->
            <span class="icon icon-line-1 wow fadeIn"></span>
        </div>
        <div class="auto-container">
            <!--Subscribe Form-->
                <div class="envelope-image "></div>
				 
				<div class="contact-form ">
                <div class="form-inner">
                    <div class="upper-box">
                        <div class="sec-title text-center">
                            <br/><h2>Forgot Password</h2>
                            <div class="text">Please enter your email address to search for your account..</div>
                        </div>
                    </div>
                    <?php if(isset($_GET['action']) && $_GET['action']=='throttled'){ ?>
              <h5 class="w3ls-title w3ls-title1" align="center"><font color="#FF0000">Too many reset requests. Please try again later.</font></h5><br>
                <?php } elseif(isset($_GET['action']) && $_GET['action']=='invalidlink'){ ?>
              <h5 class="w3ls-title w3ls-title1" align="center"><font color="#FF0000">This password reset link is invalid or has expired. Please request a new one.</font></h5><br>
                <?php } elseif(isset($_GET['action'])){ ?>
              <h5 class="w3ls-title w3ls-title1" align="center"><font color="#FF0000">You enter Wrong Username and Password </font></h5><br>
                <?php } ?>
                <?php if(isset($_GET['action1'])){ ?> 
              <h5 class="w3ls-title w3ls-title1" align="center"><font color="#FF0000">Your Password Change Successfully</font></h5>
             
                <?php } ?>
              
            				  
             <form method="post" action="forgot_password_submit" id="contact-form">
               <?php require_once('includes/security.php'); echo svr_csrf_field(); ?>
					     <div class="row clearfix">
						 <div class="col-lg-2 col-md-4 col-sm-4">
			         </div>
                   <div class="col-lg-8 col-md-8 col-sm-8 form-group" id="contact-form">
                       <input type="email" autofocus name="user" value="" placeholder="Enter Email ID"  tabindex="1"  required>
							     
							    <br>
								   
								     <div class="btn-box">
								      <button class="theme-btn btn btn-style-one mb-3" type="submit" name="submit" style="width:100%"><span class="btn-title">Submit</span></button>
							       </div> 
                               </div>
						</div>
					</div>
                    </form>
                </div>
				 </div>
            </div> 
        </div>
    </section>
    <!--End Signup Form -->

    <!-- Main Footer -->
    <?php include('footer.php');?>
    <!-- End Footer -->

</div>
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
    var loadingText = '<i class="fa fa-spinner fa-spin fas "></i><span class="btn-title">Loading</span> ';
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