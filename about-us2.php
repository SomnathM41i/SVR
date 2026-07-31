<?php require_once('includes/bootstrap.php');
	
	$qry1 = "SELECT * FROM cms WHERE link ='aboutus'";
	$result=mysqli_query($con,$qry1)or svr_db_fail($con);
	$row = mysqli_fetch_array($result);
	$txt = $row['content'];
	$sqldata=mysqli_query($con,"select * from siteconfig");
    $rowdata=mysqli_fetch_array($sqldata); 
	$seo=mysqli_query($con,"Select * from seo where catagory='aboutus'");
    $seof=mysqli_fetch_array($seo);
	
?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $seof['title']; ?></title><!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css?v=202020.1" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="keywords" content="<?php echo $seof['keyword']; ?>" />
<meta name="description" content="<?php echo $seof['description']; ?>" />

<style>
	@media screen and (max-width:768px)
	{
		.about-section .icon-circle-blue 
		{
			display: none;
		}
	}
	@media screen and (max-width:568px)
	{
		.about-section .icon-circle-blue 
		{
			display: none;
		}
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

    <!-- Main Header-->
   <?php include('header.php')?>
    <!--End Main Header -->
    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">About Us</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- About Section -->
    <section class="about-section">
        <div class="auto-container">
            <div class="row">
			 <div class="anim-icons full-width">
            <span class="icon icon-circle-blue wow fadeIn"></span>
            <span class="icon icon-dots wow fadeInleft"></span>
            <span class="icon icon-circle-1 wow zoomIn"></span>
        </div>
                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="title">ABOUT US</span>
                            <h2>Welcome to <?php $domain=$rowdata['Webname'];
								             echo $domain; ?> </h2>
                            <div class="text"><?php echo $txt; ?></div>
                        </div>
              
                       
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="image-box">
                        <figure class="image wow fadeIn"><img src="images/resource/about-img-1.jpg" alt="" style="max-width: 100%;"></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section -->

    <!-- Fun Fact Section -->
   
    <!--End Fun Fact Section -->

    <!-- Features Section Two -->
   
    <!--End Features Section -->

    <!-- Call to action -->
    
    <!--End Call to action -->

     <!-- Event Info Section -->
  
                <!-- Image Column -->
                
    <!--End Event Info Section -->

    <!-- App Section -->
   

                <!-- Image Box -->
                
    <!--End App Section -->

    <!-- Newsletter Section -->
    
    <!--End Newsletter Section -->

    <!-- Main Footer -->
    
  <?php include('footer.php');?>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->


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