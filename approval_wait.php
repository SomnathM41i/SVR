<?php require_once('includes/bootstrap.php');


include('memprotect1.php');


$mid=$_GET['id'];
unset($_SESSION['MatriID']);
unset($_SESSION['matri_login']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Register Success</title>
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

<style>
.text
{
	
}
.sec-title .text {
    margin-top: 10px;
}
/* Add a right margin to each icon */
.fas {
  margin-left: -12px;
  margin-right: 8px;
}
</style>
<script>
    function preventBack() {
        window.history.forward();
    }

    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
</head>

<body>

    <div class="page-wrapper">
 	
    <!-- Preloader -->
        <div class="preloader"></div>
 	<!-- Header span -->

    <!-- Header Span -->
        <span class="header-span"></span>

    <!-- Main Header-->
        <?php include('header.php');?>
    <!--End Main Header -->

    <!--Page Title-->
    
    <!--End Page Title-->

    <!--Error Section-->
        <section class="about-section-two">
            <!-- <div class="anim-icons full-width">
                <span class="icon icon-circle-blue wow fadeIn"></span>
                <span class="icon icon-dots wow fadeInleft"></span>
              
                <span class="icon icon-circle-1 wow zoomIn"></span>
            </div>-->

            <?php /*<div class="auto-container">
                <h4>Welcome, ND89568</h4>
                <h3>Thank You.. For Connecting With Us.</h3>
                <div class="text">Important: None of The Uploaded Documents Will Be Visible To Your Prospects, Except For Your Salary Slip That Is Visible Only To Paid Members.</div>
                <a href="index.html" class="theme-btn btn-style-three"><span class="btn-title">Matrimonial Executive ID: ND89568 </span></a>
                <a href="contact.html" class="theme-btn btn-style-two"><span class="btn-title">Go ></span></a>
            </div>*/?>
		    <form action="#" method="post">
		        <div class="auto-container">
                    <div class="row">
                        <!-- Content Column -->
                        <div class="sec-title col-lg-6 col-md-12 col-sm-12 ">
				        <?php
                            $mid=$_GET['id'];
						    $fet=mysqli_query($con,"select * from register where MatriID='$mid'");
						    $fetrow=mysqli_fetch_array($fet);
						?>
							<div class="text"> Otp Step Verified </div>
                            <span class="title mt-3">Register Success</span>
                            <h2>Welcome, <h4 class="title"><span ><?php echo $fetrow['MatriID'];?>, <?php echo $fetrow['Name'];?></span></h4></h2>
                            <div class="text"><b>Important:</b> Your Profile is under Observation.</div>
                        </div>
						
						 <!-- Image Column -->
						

                       
                        
		            </div>

                </div>

            </form>
        </section>

    <!--Error Section-->

    <!-- Main Footer -->
    
        <!--Footer Bottom-->
        <?php include('footer.php')?>
    <!-- End Footer -->

    </div>
    <!--End pagewrapper-->


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
            }, 3000);
          });
        })
    </script>


</body>
</html>
