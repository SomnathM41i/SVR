<?php require_once('includes/bootstrap.php');

  //error_reporting(0);
  $seo=mysqli_query($con,"Select * from seo where catagory='faq'");
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
<meta name="keywords" content="<?php echo $seof['keyword']; ?>" />
<meta name="description" content="<?php echo $seof['description']; ?>" />


</head>

<body>
    
            <!-- Main Header-->
    <?php include('header3.php');?>

<div class="page-wrapper bg-light">
 	
    <!-- Preloader -->
    <!--<div class="preloader"></div>-->
 	<!-- Header span -->

    <!-- Header Span -->
    <!--<span class="header-span"></span>-->

    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">FAQ's</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>FAQ's</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- FAQ's Section -->
    <section class="about-section">
        <div class="auto-container">
            <!-- Sec Title -->
           
            
            <div class="row clearfix">
                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!--Accordian Box-->
                        <ul class="accordion-box">
                            <!--Block-->
                            <li class="accordion block active-block wow fadeInUp">
                                <div class="acc-btn active"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>How can I register on Manpasand Jodidar?</div>
                                <div class="acc-content current">
                                    <div class="content">
                                        <div class="text">Registering in our matrimony site is a simple process, you can register by filling the online registration  that runs for 3 pages or use the Quick registration form, a shorter and simpler process available </div>
                                    </div>
                                </div>
                            </li>

                            <!--Block-->
                            <li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>I did my registration, but my profile does not show up online ?</div>
                                <div class="acc-content ">
                                    <div class="content">
                                        <div class="text">Every new profile will be validated by our ADMIN (Backend Team) and upon activation, your profile will be visible to all ! Verification of profiles is done manually. Our support team checks each and every profile carefully for any invalid or incorrect information and also candidates are contacted over the phone for confirmation of authority. You will get a notification once the profile is active !</div>
                                    </div>
                                </div>
                            </li>
                            
                            <!--Block-->
                            <li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>Can I upload my photograph?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">You have the option of uploading your photograph on My Profile Page. You can upload a maximum of ten photographs.</div>
                                    </div>
                                </div>
                            </li>
							<li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>How do I upload Horoscope ?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">We have an exclusive interface to key in your horoscope details. Login to your Matrimony account and click Manage Horoscope.</div>
                                    </div>
                                </div>
                            </li>
							<li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>Can I edit all my details ?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">At any time, you can update your profile by clicking Modify My Profile button .</div>
                                    </div>
									<li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>I see a tab called MY MATCHES, What’s the use of it ?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">My Matches fetches the profiles matching your partner preferences that you keyed in while registering your profile. Its dynamically updated.</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!--Accordian Box-->
                        <ul class="accordion-box">
                            <!--Block-->
                            <li class="accordion block active-block wow fadeInUp">
                                <div class="acc-btn active"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>Can I shortlist/bookmark a Profile ?</div>
                                <div class="acc-content current">
                                    <div class="content">
                                        <div class="text">Yes, you can ! Its an useful feature to make a note of the interested profiles. You need to be logged in to use the shortlist feature.</div>
                                    </div>
                                </div>
                            </li>

                            <!--Block-->
                            <li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>How do I delete Shortlisted profiles?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">Login using your matrimonial "User ID" and "Password". Click on the "Shortlisted Profiles". You could view and delete the Bookmarked members!</div>
                                    </div>
                                </div>
                            </li>
                            
                            <!--Block-->
                            <li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>How do I change my password?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">After logging into your account, click on the change password link. The system will ask for your old password and then the new one then login with your new password.</div>
                                    </div>
                                </div>
                            </li>
							<li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>What are the benefits of a membership?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">
										
                         										1)Most trusted Matrimonial service<br>

                                                                     2)100% verified Matrimonial profiles.<br>

                                                                     3)Managed by Complete Professionals.<br>

                                                                    4)Dedicated Customer Care Service.<br>

																  5)Post your personal profile !<br>

																 6)Add more information about yourself and your family<br>

																7)Upload/add multiple photographs to your profile<br>

																	8)Display your contact details to paid members<br>

																			9)Express interest in other members<br>

																	10)Why should I choose your paid membership package?<br>

														11)A paid membership have various packages and options to help you access advanced features of Manpasand Jodidar.<br>

																			12)Search suitable profile through matrimonial Website<br>

														13)Contact suitable matches via contact number, personalized messages, and customer service.<br>

																			14)Send and receive personalized messages.<br>

																							15)Customer care support.<br>

																							16)Paid Matrimonial Members get top services.<br>

																17)Paid Matrimonial Members can express interest and write messages to other members of Manpasand Jodidar.<br>

																		18)Is my personal information safe?
																		
                                        </div>
                                    </div>
                                </div>
                            </li>
							 <li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>How can I upgrade my paid membership ?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">We provide various options for upgrading your membership. You can login to your matrimony account page and click upgrade button. Choose the right package for you, which will lead you to the payment page. You will be provided with various options for payment.</div>
                                    </div>
                                </div>
                            </li>
							<li class="accordion block wow fadeInUp">
                                <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-angle-down"></span> </div>How do I contact customer care?</div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">Manpasand Jodidar is eager to help you find your partner at the earliest. Customer Support is top priority to us. You can contact our customer care team in any of the following ways listed here.</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <!-- End FAQ's Section -->

    <!-- Faq Form Section -->
    
    <!--End Contact Section -->

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
</body>
</html>
