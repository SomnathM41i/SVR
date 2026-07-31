<?php require_once('sys_dbconnection.php');
/*include('dbconnectadmin.php');*/
 include('memprotect.php');

?>
 <?php

$today = date("d-m-Y");
 $login=$_SESSION['MatriID'];
 $row1=mysqli_query($con,"select * from register where MatriID='$login'");
$rowfetch=mysqli_fetch_array($row1);
$rowverify=mysqli_query($con,"select * from emailverify where MatriID='$login'");
$fetch=mysqli_fetch_array($rowverify);

$check = $fetch['verification'];
 if(isset($_POST['submit']))
{
	


/*echo $check;
exit;*/
//echo "select * from emailverify where MatriID='login'";
$code=$fetch['code'];
$verify=$_POST['verify'];
echo $code;
echo $verify;

if($code==$verify)
{
	$verifymail=mysqli_query($con,"update  emailverify  set verification='Yes' where MatriID='$login'");
	//echo "update  emailverify  set verification='Yes' where MatriID='$login'";
	header('location:verifycode?msg=success');
	
	
}
else
{
	$verifymail=mysqli_query($con,"update  emailverify  set verification='no' where MatriID='$login'");
	//echo "update  emailverify  set verification='no' where MatriID='$login'";
	header('location:verifycode?msg=fail');

}
}
?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Email Verification</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">



<style>
.butnsub
{   
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
.subscribe-form .sec-title 
{
  margin-bottom: 19px;
}
.comments-area .comment
{
  position: relative;
  min-height: 50px;
  padding-left:0px;
}
.comment-info1
{
  position: relative;
  display: block;
  margin-bottom: 5px;
  font-size: 16px;
  line-height: 25px;   
  color: #12114a;
}
.alert-info1 
{
  color: #fff;
  background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);
  border-color: #fff;
  font-size: 17px;
  margin-left: 0px;
  
  width: 100%;
  justify-content: center;
  align-items: center;
  
}
.close
{
  color: #fff;
  opacity: 20;
}

/* Add a right margin to each icon */
.fas {
  margin-left: -12px;
  margin-right: 8px;
}
</style>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
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
    <!--Page Title-->
   
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
      <div class="auto-container">
        <h1 class="d-none d-lg-block d-xl-block d-md-block">Email Verification</h1>
        <ul class="bread-crumb clearfix">
          <li><a href="index_dashboard">Home</a></li>
          <li>Email Verification</li>
        </ul>
      </div>
    </section>
   
    <!--End Page Title-->
   
    <!--End Page Title-->
	
	  <!-- Signup Form -->
    <section class="newsletter-section">
      <div class="anim-icons full-width">
        
        <span class="icon icon-line-1 wow fadeIn"></span>
      </div>
      <div class="auto-container">
        <!--Subscribe Form-->
        	
          <div class="envelope-image"></div> 
            <div class="form-inner"> 
              <?php 
                if( $_GET['msg'] != "success")
                {
              ?>
              <div class="upper-box"> 
			  <div class="alert alert-info1 col-md-12 " align="center" role="alert">Note: If Email ID is not confirmed account will be suspended automatically in few days.</div>
              </div>  
                <div class="text-center"> 
					We have sent the verification code to Registered Mail ID:<label><?php echo $rowfetch['ConfirmEmail']?> </label>. open your email ID and verify the code here.<br>
					
                            <!--<div class="icon-box"><span class="fa fa-envelope"></span></div>-->
                            <!--<br/><h2>Change Password</h2> 
                            -->
					</div>
          <?php 
            }
          ?>
					
              <div class="col-lg-12 col-md-12 col-sm-12 form-group">
              </div>
               <?php
				$rowverify=mysqli_query($con,"select * from emailverify where MatriID='$login'");
				$fetch=mysqli_fetch_array($rowverify);
                $verification=$fetch['verification'];
			    if($verification!='Yes'){?>
              
              
				<div class="contact-form ">
                <form method="post" action="#" id="contact-form" >
				    <div class="row clearfix">
                        <?php if($_GET['msg']=="success") { ?>
              <div class="alert alert-info1 col-md-12 " align="center" role="alert">
                
                  Your Email Verified Sucessfully.
              </div>
              <?php } else  { ?>
                          
              <?php } ?>
              <?php if($_GET['msg']=="fail") { ?>
              <div class="alert alert-info1 col-md-12 " align="center" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                You Enter Wrong Email Verification Code. 
              </div>
              <?php } else { ?>
                          
              <?php } ?>
             
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group"> 
						   <input type="text" name="verify" placeholder="Enter Verification Code" maxlength="6" onkeypress="return isNumber(event)"  required  >
                          <?Php 
                            /*if( ($fetch['date'] != $today) && ($fetch['verification'] != 'Yes') )*/
                            if( ( $fetch['date'] != $today ) )
                            {
                          ?>
                          <a href="resend_mail.php?id=<?php echo $login?>">Resend mail</a>     
                          <?php 
                            }
                                
                          ?>
                        </div>
                       
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
				            <div class="btn-box">	

							  <button class="theme-btn btn  btn-style-one " type="submit" name="submit" style="width:100%" required tabindex="4"><span class="btn-title">Submit</span></button>
                            </div> 
                        </div>
						
						
						
                    </div>
				</form>
              </div>
				<?php } else { ?>  
				
				 <div class="alert alert-info1 col-md-12 " align="center" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						Your Email Verified Sucessfully.
              </div>
				<?php }?>
            </div>
		  
		  
          </div> 
        
      </section>
    <br><br>
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
<script>

const togglePassword = document.querySelector('#togglePassword');
const togglePassword1 = document.querySelector('#togglePassword1');
const togglePassword2 = document.querySelector('#togglePassword2');

const password = document.querySelector('#pass');
const password1 = document.querySelector('#pass1');
const password2 = document.querySelector('#pass2');

togglePassword.addEventListener('click', function (e) {
// toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

togglePassword1.addEventListener('click', function (e) {
// toggle the type attribute
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

togglePassword2.addEventListener('click', function (e) {
// toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');

});

</script>
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