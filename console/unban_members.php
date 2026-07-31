<?php require_once('../sys_dbconnection.php');
	//session_start();
  	//include '../dbconnectadmin.php';
  	error_reporting(0);
 
?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Ban Member</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

    <!-- data tables css -->
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	<link rel="stylesheet" href="assets/css/popup.css">
	<style>
	.row {
    --bs-gutter-x: -0.5rem;
	}
	</style>
	
	
</head>
<body class="pc-horizontal">
	<div class="">
	
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

<section class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Zero config table start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ban Member</h5>
                    </div>
                    <div class="card-body">
                       
						<div class="dt-responsive table-responsive">
						  <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
										  <th>PROFILE ID</th>
										  <th>NAME</th>
										  <th>GENDER</th>
										  <th>MOBILE NO. </th>
										  <th>EMAIL ID</th>
										  <th>Unban</th>
								     </tr>
                                </thead>
                                <tbody>
										
										<?php  $result=mysqli_query($con,"select * from register where Status='Banned'");
												while($row=mysqli_fetch_array($result))
												{
													$MatriID=$row['MatriID'];
													$Name=$row['Name']; 
													$Gender=$row['Gender'];
													$Mobile=$row['Mobile'];
													$Address=$row['ConfirmEmail'];
													//$date=$row['delete_date'];?>
													
												 <tr>
													<td><a href="profile_view?ID=<?php echo $MatriID; ?>"><?php  echo $MatriID;?></a></td>
													<td><?php  echo $Name; ?></td>
													<td><?php  echo $Gender;?></td>
													<td><?php  echo $Mobile;?></td>
													<td><?php  echo $Address;?></td>
													<td><a href="unban_update?matriid=<?php  echo $MatriID;?>">Unban </a></td>
												  </tr>
												  <?php  }?>
									</tbody>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			</div>
			</div>
			</section>
	<?php include('footer.php');?>		
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->
<!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/pages/data-basic-custom.js"></script>

<!-- Apex Chart -->



<!-- trumbowyg editor -->
<script src="assets/js/plugins/trumbowyg.min.js"></script>

<script type="text/javascript">
    // tinymce editor
    $(window).on('load', function() {
        $('#tinymce-editor').trumbowyg({
            svgPath: 'assets/css/plugins/icons.svg',
            btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['insertImage'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        });
    });
</script>
<?php include('footersection.php');?>
</script>

   
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	 $(window).load(function(){        
	   $('#myModal15').modal('show');
		}); 
	</script>

<?php if(isset($_GET['msg'])){ ?>
<div id="myModal15" class="modal " role="dialog" style="margin-top: 100px;">
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
						<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo $_GET['msg'];?> </h2>
					</div>
					<div class="swal2-actions">
						<a href="unban_members" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
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

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
</script>

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
 