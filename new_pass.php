<?php require_once('includes/bootstrap.php');

require_once('includes/security.php');
$msg="";
$message="";

/* Security fix (C3): the reset page now requires the expiring, single-use,
   HMAC-signed token issued by forgot_password_submit.php. Previously anyone
   could reset any account knowing only the MatriID. */
$id    = isset($_GET['ID']) ? trim($_GET['ID']) : '';
$token = isset($_GET['token']) ? trim($_GET['token']) : '';

$forpass1 = null;
if ($id !== '') {
    $stmt = mysqli_prepare($con, "SELECT * FROM register WHERE MatriID=? LIMIT 1");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $forpass1 = $res ? mysqli_fetch_array($res) : null;
        mysqli_stmt_close($stmt);
    }
}

$linkValid = ($forpass1 && $token !== '' && svr_reset_token_verify($token, $forpass1['MatriID'], $forpass1['ConfirmPassword']));

if (!$linkValid) {
    header('location:forgot_password?action=invalidlink');
    exit;
}

if(isset($_POST['submit']))
{

/* Security fix (H3): CSRF token check. */
if (!svr_csrf_verify(isset($_POST['svr_csrf']) ? $_POST['svr_csrf'] : '')) {
    $msg='Your session has expired. Please retry from the email link.';
}
else if (!svr_throttle('new_pass:'.svr_client_ip(), 10, 600)) {
    $msg='Too many attempts. Please try again later.';
}
else
{
$new=$_POST['new'];
$confirm=$_POST['confirm'];
$matri=$forpass1['MatriID'];
		if($_POST['new'] === $_POST['confirm'])
		{
			/* NOTE: password storage intentionally unchanged (per project constraint). */
			$stmtU = mysqli_prepare($con, "UPDATE register SET ConfirmPassword=? WHERE MatriID=?");
			if ($stmtU) {
			    mysqli_stmt_bind_param($stmtU, "ss", $confirm, $matri);
			    mysqli_stmt_execute($stmtU);
			    mysqli_stmt_close($stmtU);
			}
			header('location:login?action1=Success');
			exit;
		}else{
		$msg='Password not Match';
		}
}

}
 ?> 





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

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

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
    <!--<section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1>Forgot Password</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Forgot Password</li>
            </ul>
        </div>
    </section>-->
    <!--End Page Title-->
	
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
                            <!--<div class="icon-box"><span class="fa fa-envelope"></span></div>-->
                            <br/><h2>Set New Password</h2>
                        </div>
                    </div>
                  
             <form method="post" action="#" id="contact-form">
               <?php echo svr_csrf_field(); ?>
			   <h5 class="w3ls-title w3ls-title1" align="center"><font color="#FF0000"><?php echo $msg;?></font></h5>
					     <div class="row clearfix">
						 <div class="col-lg-2 col-md-4 col-sm-4">
			         </div>
                   <div class="col-lg-8 col-md-8 col-sm-8 form-group" id="contact-form">
                       <input type="password" autofocus name="new" value="" placeholder="Enter Your New Password"  tabindex="1"  required>
					   <br>
                       <input type="password" autofocus name="confirm" value="" placeholder="Confirm Password"  tabindex="2"  required>

							    <br>
								   
								     <div class="btn-box">
								      <button class="theme-btn btn-style-one" type="submit" name="submit" value="LOGIN" style="width:100%"><span class="btn-title">Continue</span></button>
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
<div class="color-palate">
    <div class="color-trigger">
        <i class="fa fa-cog"></i>
    </div>
    <div class="color-palate-head">
        <h6>Choose Your Demo</h6>
    </div>
    <ul class="box-version option-box"> <li>Full width</li> <li class="box">Boxed</li> </ul>
    <ul class="rtl-version option-box"> <li>LTR Version</li> <li class="rtl">RTL Version</li> </ul>
    <div class="palate-foo">
        <span>You will find much more options for colors and styling in admin panel. This color picker is used only for demonstation purposes.</span>
    </div>
    <a href="#" class="purchase-btn">Purchase now</a>
</div>
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
</body>
</html>