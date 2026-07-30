<?php require_once('../sys_dbconnection.php');
  /*include '../dbconnectadmin.php';*/
  $result=mysqli_query($con,"select * from siteconfig where ID='1'");
  $fetch1=mysqli_fetch_array($result);
  //error_reporting(0);
 ?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Admin Profile</title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit"/>

    <!-- Favicon icon -->
      <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/css/plugins/select2.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css"> 
	<link rel="stylesheet" href="assets/css/popup.css">
	<!--popup css-->

	<style>
		body {
			background: #FDFAF5;
		}
		.admin-profileadmin-container {
			padding-top: 36px;
		}
		.admin-profileadmin-container .pc-container,
		.admin-profileadmin-container .pcoded-content {
			margin-top: 0 !important;
			padding-top: 0 !important;
		}
		.admin-profileadmin-container .card {
			border: 1px solid rgba(201,168,76,0.25);
			border-radius: 14px;
			box-shadow: 0 2px 20px rgba(45,31,61,0.08);
			overflow: hidden;
		}
		.admin-profileadmin-container .card-header {
			background: #fff;
			border-bottom: 1px solid rgba(201,168,76,0.25);
			padding: 18px 22px;
		}
		.admin-profileadmin-container .card-body {
			padding: 22px;
		}
		@media (max-width: 991px) {
			.admin-profileadmin-container {
				padding-top: 24px;
			}
		}
	</style>

</head>
<body class="pc-horizontal">
	
		<!-- [ Pre-loader ] start -->
		
		<!-- [ Pre-loader ] End -->
		<!-- [ Mobile header ] start -->
		

		<!-- [ Header ] end -->
		<!-- [ navigation menu ] start -->
		  <?php include('topheader.php');?>
		  <?php include('header.php');?>
		<!-- [ navigation menu ] end -->
		<!-- Modal -->
		  <?php include('notification.php');?>
		
		<!-- [ Header ] end -->
  
<!-- [ Main Content ] start -->
<div class="container admin-profileadmin-container">
<div class="pc-container">	
<div class="pcoded-content">	 
				<div class="row">
            
  <div class="col-xl-12">
			
 <div class="card ">
			<div class="card-header">
				<h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span class="p-l-5">Admin Details</span></h5>
			</div>
			<div class="card-body">
			<form  method="post" >
				
				  <div class="col-sm-12">
				  <div class="row">
					 
				
					<div class="col-sm-9" >
						<div class="form-group">
						  <h5 class=""><?php echo $fetch1['owner']; ?></h5>
							<a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-globe me-2 f-18"></i><?php echo $fetch1['copyright_footer']; ?></a>
							<a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="fas fa-briefcase me-2 f-18"></i> <?php echo $fetch1['companyname']; ?></a>
							 <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-phone me-2 f-18"></i><?php echo $fetch1['contactusmobile1']; ?></a>
							 <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-map-pin me-2 f-18"></i><?php echo $fetch1['address']; ?></a>
					</div>
				   </div>
				   </div>
				</div>
			</div>
			<div class="card-footer ">
					 Last Login - <?php $timestamp=$fetch1['lastlogin']; 
					  $time = date('H:i:s',strtotime($timestamp));
					  $date=date('d-m-Y',strtotime($timestamp));
					 echo $date; 
					  echo "  ";
					 echo $time;
				
				
				
				?>
				
				</form>
			 
			</div>
			

		</div>
	</div>
</div>	
				
</div>
</div>
</div>
</div>
<?php include('footersection.php');?>
<?php include('footer.php');?>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
<!-- Apex Chart -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

</body>
</html>
