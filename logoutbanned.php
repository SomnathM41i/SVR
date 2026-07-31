 <?php  require_once('sys_dbconnection.php');
error_reporting(0);
$MatriID = $_SESSION['MatriID'];
$checkquery="SELECT * FROM register WHERE MatriID='$MatriID'";
$checkdata=mysqli_query($con,$checkquery);
$checkresult=mysqli_fetch_array($checkdata);
$Status=$checkresult['Status'];
$deletestatus=$checkresult['deletestatus'];


$data_config = $db->get_siteconfig();
$contact_email = $data_config-> ContactEmail;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Banned</title>
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
</head>

<body>

<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	<!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Main Header-->
   
    <!--End Main Header -->

    <!--Page Title-->
  
    <!--End Page Title-->

    <!--Error Section-->
    <section class="error-section">
        <div class="anim-icons full-width">
            <span class="icon icon-circle-blue wow fadeIn"></span>
            <span class="icon icon-dots wow fadeInleft"></span>
            <span class="icon icon-line-1 wow zoomIn"></span>
            <span class="icon icon-circle-1 wow zoomIn"></span>
        </div>

        <div class="auto-container">
            <div class="error-title">404</div>
            <?php
            if($Status == "Banned" && $deletestatus == 1)
            {
                ?>
                <h4>Your Account has been Deactivate</h4>
                <?php
            }
            else
            {
                ?>
                <h4>Your Account has been Banned</h4>
                <?php
            }
            ?>
            
			 <div class="text">Account has been locked. Please contact your administrator <?php echo $contact_email  ?> id or try logging in after some time.<br>
				</div>
            <a href="index" class="theme-btn btn-style-three"><span class="btn-title">Home Page</span></a>
            <a href="contactus" class="theme-btn btn-style-two"><span class="btn-title">Contact Us</span></a>
        </div>
    </section>
    <!--Error Section-->

   
        <!--Footer Bottom-->
       
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->

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
<script src="js/script.js"></script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
</body>
</html>
<?php 
unset($_SESSION['MatriID']);
unset($_SESSION['matri_login']);
?>