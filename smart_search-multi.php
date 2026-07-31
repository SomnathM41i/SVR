<?php require_once('sys_dbconnection.php');
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Eventrox - Digital Events HTML Template | Error Page</title>
 <link rel="stylesheet" href="docs/css/bootstrap-3.3.2.min.css" type="text/css">
        <link rel="stylesheet" href="multiselect-master/docs/css/bootstrap-example.min.css" type="text/css">
        <link rel="stylesheet" href="multiselect-master/docs/css/prettify.min.css" type="text/css">

        <script type="text/javascript" src="multiselect-master/docs/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="multiselect-master/docs/js/bootstrap-3.3.2.min.js"></script>
        <script type="text/javascript" src="multiselect-master/docs/js/prettify.min.js"></script>

        <link rel="stylesheet" href="multiselect-master/multiselect-master/dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="multiselect-master/dist/js/bootstrap-multiselect.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                window.prettyPrint() && prettyPrint();
            });
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>








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
.btn-style-two
{
   padding: 10px 50px;
}
label
{
   margin-right: 176px;
}
.error-section .icon-line-1 
{
   bottom: 17%;
}
.designation
{
  font-size: 20px;;
}
</style>
<style>
.page-title {
      padding: 20px 0;
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
            <h1>Smart Search</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Smart Search</li>
            </ul>
        </div>
    </section>
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
		   <div class="contact-form">
            <div class="error-title">Smart Search</div>
           
            <div class="text">Sorry, we couldn't find the page you're looking for</div>
			<div class="col-lg-12">
				 <form class="form-horizontal" action="smart_search_result.php" method="post">
                  <div class="row">		
                   	  		

							 <div class="col-lg-3 col-md-3 col-sm-12 form-group ">
								 <label>Looking  For </label> 
								 <select class="category2" name="gender" required >
									<option value="Male"  >Male</option>
									<option value="Female">Female</option>
									
								</select> 	
							</div> 	



                               <div class="example">
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#example-getting-started').multiselect();
                                    });
                                </script>
<select id="example-getting-started" class="mvv-multiselect-source" multiple="multiple" data-searchable-multi="off">
                                    <option value="cheese">Cheese</option>
                                    <option value="tomatoes">Tomatoes</option>
                                    <option value="Mozzarella">Mozzarella</option>
                                    <option value="Mushrooms">Mushrooms</option>
                                    <option value="Pepperoni">Pepperoni</option>
                                    <option value="Onions">Onions</option>
                                </select>
                            </div>
                    

						
                          
				          
						  </div>
				
                </div>
		      </form>		
		   </div>
        </section>
    <!--Error Section-->

    <!-- Main Footer -->
<?php include('footer.php')?>
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
<?php include('popup.php')?>
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
