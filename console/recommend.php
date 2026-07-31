<?php require_once('../includes/bootstrap.php');
include('protect.php');

  
  //TO CHANGE LANDING PAGE VIA .HTACCESS :- (DirectoryIndex index1.html index.php)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Recommend</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Manpasand Jodidar - Admin Panel"/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon"> ?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">

    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
	  <link rel="stylesheet" href="assets/css/stylenew.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
		<link rel="stylesheet" href="assets/css/responsive.css">
    <!-- STYLESHEETS-->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">    
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/popup.css">

        <!--Color Switcher Mockup-->
    <link href="css/color-switcher-design.css" rel="stylesheet">
    <style type="text/css">
        .chart_wrap 
        {
            position: relative;
            padding-bottom: 100%;
            height: 500;
            overflow:hidden;
        }
        .piechart 
        {
            position: absolute;
            top: 0;
            left: 0;
            
            height:500px;
        }
		
    </style>
    <style>
.dropselect{
    padding: 15px 30px;
    height: 60px;
    width: 115%;
}
.labelcss
{
    vertical-align: middle;
    margin-left:10px;
}


.card-body {
    flex: 1 1 auto;
    padding: 25px 15px;
}
</style>
<style>
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
.subscribe-form .sec-title {
    margin-bottom: 19px;
}
.rbcss
{
    margin-left: 1.5rem!important;
}


.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
	
    color: #ffffff;
    background-color: #f0f2f8;
}
.spancs
{
	color:#474646;
}
.feed-card h6, .feed-card .h6 {
    margin-top: 0px;
}
.note{
	height:505px;
	position:relative;
	
}
</style>
<style>
@media screen and (max-width: 768px) {
.card-bodyme {
    flex: 1 1 auto;
    padding: 10px 7px;
}
.note{
	height:547px;
	position:relative;
}
}
@media screen and (max-width: 568px) { 
.card-bodyme {
    flex: 1 1 auto;
    padding: 10px 4px;
}
.note{
	height:547px;
	position:relative;
}
}
.alert-danger {
    color: #8c2e2e;
    background-color: #fbdbdb;
    border-color: #f9caca;
    margin-top: 20px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
     $(window).load(function(){        
       $('#myModal').modal('show');
        }); 
    </script>
</head>
<body class="pc-horizontal">
	<div class="container">
		<!-- [ Pre-loader ] start -->
		<div class="loader-bg">
			<div class="loader-track">
				<div class="loader-fill"></div>
			</div>
		</div>
		<!-- [ Pre-loader ] End -->
		<!-- [ Mobile header ] start -->
		
		
		<!-- [ Mobile header ] End -->
		<!-- [ Header ] start -->
        
		<!-- [ Header ] end -->
		<!-- [ navigation menu ] start -->
		  <?php include('topheader.php');?>
		  <?php include('header.php');?>
		<!-- [ navigation menu ] end -->
		<!-- Modal -->
		<?php include('notification.php');?>
		<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
        <div class="pc-container">
            <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        
                <div class="col-sm-12">
                    <div class="row justify-content-center text-center">
                            <div class="col-xl-12 col-md-12 ">
                                <?php 
                                    if($_REQUEST['flag'] == 1)
                                    {
                                ?>
                                 <div class="alert alert-danger alert-dismissible " role="alert" >
                                    <h5 class="alert-heading" style="color:Black">
                                        <i class="feather icon-alert-circle me-2"></i> 
                                        <b>Please Enter Existing Profile ID.</b>
                                    </h5>                                
                                </div>
                                <?php 
                                    }
                                ?>
							<form action="add_recommendation" method="POST">
                     		    <div class="input-group mb-4 mt-4 col-md-12">
								    <div class="input-group-text" id="btnGroupAddon2"> <b>Recommend And Suggestions</b> </div>
								    <input type="text" class="form-control"  placeholder="Enter Matrimonial ID"  aria-label="Input group example" aria-describedby="btnGroupAddon2" name="search" required >
								    <button type="submit" class="btn  btn-icon btn-secondary" name="submit"><i class="fas fa-search">
                                    </i></button>
							    </div>
							  </form>                      
                            </div>
                        </div>
				    
                </div>
            </div>
        </div><!-- end of chart -->
    
	</div>
	
	
<?php include('footer.php');?>
<?php
    if($_GET['msg'] == "success")
    {
?>

<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
    <div class="modal-dialog">
        <div class="modal-content">     
            <div class="modal-body modalb">     
                <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                    <div class="swal2-header">
                        <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                            <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div> 
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                        </div>
                        
                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Member Deleted Successfully</h2>
                       
                       
                        
                    </div>
                    <div class="swal2-actions">
                       <a href="index.php" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>
<?php
    }
?>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>
</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
