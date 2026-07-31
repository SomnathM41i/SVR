<?php require_once('includes/bootstrap.php');

error_reporting(0);
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
            <h4> This profile is currently inactive</h4>
			<?php $query="SELECT * FROM siteconfig where ID='1'";
                  $configdata=mysqli_query($con,$query);
				  $Webname=$info['Webname'];?>
			 <div class="text"> Please contact your administrator<?php echo $Webname ?><br>
				</div>
            <a href="index_dashboard" class="theme-btn btn-style-three"><span class="btn-title">Home Page</span></a>
           
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