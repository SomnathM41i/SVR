<?php require_once('../sys_dbconnection.php'); 	
  /*include '../dbconnectadmin.php';*/
  //error_reporting(0);
 ?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Change Password</title>
   
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
		@media (max-width: 575.98px)
		{
			.pc-container .pcoded-content {
				padding: 0px;
			}
		}
	 </style>


</head>
<body class="pc-horizontal">
	<div class="container">
	
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
<div class="pc-container">	
<div class="pcoded-content">	 
				<div class="row">
            
            <div class="col-xl-12">
			
			     <div class="card ">
                            <div class="card-header">
                                <h5><i data-feather="lock" class="icon-svg-primary wid-20"></i><span class="p-l-5">Change Password</span></h5>
                            </div>
                            <div class="card-body">
							<form  method="post" action="change_password_submit" >
                                <div class="row">
                                  <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Current Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Enter Your current password" maxlength="15" name="cupass" required>
                                            <!--<small class="form-text text-muted">Forgot password? <a href="#!">Click here</a></small>-->
                                        </div>
                                    </div>
                                </div>
								
                                <div class="row">
                                    <div class="col-sm-6">
									 
                                        <div class="form-group">
                                            <label class="form-label">New Password<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Enter New password" maxlength="15" id="newpwd" name="newpwd" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Enter your New password again" id="confirmpwd" maxlength="15" name="confirmpwd" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                               <button class=" btn btn-success" name="submit" type="submit">Change Password</button>
							    </form>
                              <a href="clearbtn"> <button class="btn btn-outline-dark ms-2" type="submit">Clear</button></a>
                            </div>
							
			
                        </div>
                    </div>
				</div>	
				
</div>
</div>
</div>

</div>
</script>
<?php include('footersection.php');?>


</script>
<?php include('footer.php');?>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	 $(window).load(function(){        
	   $('#myModal13').modal('show');
		}); 
	</script>

<?php if($_GET['msg']!="") { ?>

<div id="myModal13" class="modal " role="dialog" style="margin-top: 100px;">
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
						<?php if($_GET['msg']=="success1") { ?>
						<h2 class="swal2-title" id="swal2-title" style="display: flex;">Password Change Successfully</h2>
						<?php } elseif($_GET['msg']=="success2") { ?>
						<h2 class="swal2-title" id="swal2-title" style="display: flex;">New passord and Confirmed Password must be same</h2>
						<?php }elseif($_GET['msg']=="success3") { ?>
						<h2 class="swal2-title" id="swal2-title" style="display: flex;">Your New passord must be differ from Current Password</h2>
						<?php }elseif($_GET['msg']=="success4") { ?>
						<h2 class="swal2-title" id="swal2-title" style="display: flex;">Your old Password is incorrect!!</h2>
						<?php } ?>
	
					</div>
					<div class="swal2-actions">
						<a href="changepassword" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      				</div>
    			</div> 
			</div>
		</div>   
	</div>
</div>
<?php } ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

</body>
</html>
