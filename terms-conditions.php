<?php 
    require_once('sys_dbconnection.php');
	/*include('dbconnectadmin.php');*/
	$qry1 = "SELECT * FROM cms WHERE link ='terms and conditions'";
	$result=mysqli_query($con,$qry1)or die(mysql_error());
	$row = mysqli_fetch_array($result);
	$txt = $row['content'];
    $seo=mysqli_query($con,"Select * from seo where catagory='term_and_condition'");
    $seof=mysqli_fetch_array($seo);
    ?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $seof['title']; ?></title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css?v=202020.2" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="keywords" content="<?php echo $seof['keyword']; ?>" />
<meta name="description" content="<?php echo $seof['description']; ?>" />


</head>

<body>

   <?php include('header3.php');?>

<div class="page-wrapper bg-white">
 	
    <!-- Preloader -->
    <!--<div class="preloader"></div>-->
 	<!-- Header span -->

    <!-- Header Span -->
    <!--<span class="header-span"></span>-->



    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Terms & Conditions</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Terms & Conditions</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Pricing Section -->
    <!-- About Section -->
    <section class="about-section">
       
        <div class="auto-container">
            <div class="row text-dark">
                <!-- Content Column -->
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="title">Terms & Conditions</span>
							<?php echo $txt?>
                            <?php /*<h2>Welcome to the World Digital Conference 2020</h2>*/?>
                            <?php /*<div class="text">Dolor sit amet consectetur elit sed do eiusmod tempor incd idunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat.</div>*/?>
                        </div>
                       <?php /* <ul class="list-style-one">
                            <li>Multiple Announcements during the event.</li>
                            <li>Logo & company details on the WordCamp.</li>
                            <li>Dedicated blog post thanking each Gold.</li>
                            <li>Acknowledgment and opening and closing.</li>
                        </ul>
                        <div class="btn-box"><a href="contact.html" class="theme-btn btn-style-three"><span class="btn-title">Register Now</span></a></div>
                    </div>*/?>
                </div> 
            </div>
        </div>
    </section>

    

    <!-- Main Footer -->
     <?php include('footer3.php');?>
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
</div><!-- End Color Switcher -->

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
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
</body>
</html>