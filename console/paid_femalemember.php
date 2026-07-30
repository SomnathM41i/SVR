<?php require_once('../sys_dbconnection.php'); 
  /*include '../dbconnectadmin.php';*/
  error_reporting(0);
  $result=mysqli_query($con,"SELECT * FROM register where Status ='Paid' and Gender='Female' order by ID desc");
?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Paid Female Member</title>
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
                        <h5>Paid Female Member</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="table_paid_female" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
										<th>Profile ID</th>
										<th>Name/Email</th>
										<th>Mobile/DOB </th>
										<th>Reg date/Status</th>
										<th>Religion/Caste</th>
										<th>IP/Last login </th>
										<th>Photo/ID</th>
										<th>Payment Mode</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                   <?php  while($row =mysqli_fetch_assoc($result)){ 
                                   			$p_id = $row['MatriID'];
	                                   		$pay_details = mysqli_query($con,"SELECT * from paiddetails where Pmatriid='$p_id'");
	                                   		$fetch_paid = mysqli_fetch_assoc($pay_details);
                                   	?>
                
										  <tr>
											<?php  
										$number =  $_SESSION['ConfirmPassword'];
										$masked =  str_pad(substr($number, -3), strlen($number), '*', STR_PAD_LEFT);
										?>
										  <td><a href="profile_view?ID=<?php  echo $row['MatriID'];?>"><?php  echo $row['MatriID'];?><br> Manage:<?php  echo $row['Profilecreatedby'];?></a></td>
										  <td><?php  echo $row['Name'];?><br> <?php  echo $row['ConfirmEmail'];?></td>
										  <td><?php  echo $row['Mobile'];?><br><?php $explodedate=explode("-",$row['DOB']);
											$explodedatedisplay=$explodedate[2]."-".$explodedate[1]."-".$explodedate[0];echo $explodedatedisplay;?></td>
										  <td><?php $explodedate1 =explode("-", $row['Regdate']);
										  $explodedatedisplay1=$explodedate1[2]."-".$explodedate1[1]."-".$explodedate1[0];echo $explodedatedisplay1;?><br> Status:<?php  echo $row['Status'];?></td>
										 <td><?php  echo $row['Religion'];?><br>Caste: <?php  echo $row['Caste'];?></td> 
											
									        <td><?php  if($row['IP']=="") { echo "NULL"; } else { echo $row['IP']; }?> <br>Last Login:
											
											 <?php  $login = explode(' ', $row['Thislogin'], 2);
												 $lastlogin1 =explode("-",$login[0]);
												 $lastlogin=$lastlogin1[2]."-".$lastlogin1[1]."-".$lastlogin1[0];?>
												 <?php  if($row['Thislogin']=="") { echo "NULL"; } else 
												 { echo $lastlogin; }?></td>
												<td>Photo:
												<?php  
												if($row['Photo1']=="nophoto.jpg")
												{  echo  "No";  }  else {  echo "Yes"; }   
													?>  <br>ID: <?php  if($row['adhar']=="")
													{  echo "No";  }  else {  echo "Yes"; }   
													?>  
												
												</td>
												<td>
													<?php  
														echo $fetch_paid['Ppaymode'];
													?> 
												</td>
												
												   
													 
												 
										</tr>
									<?php  } ?>
									</tbody>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			</div>
			</div>
			</section>
			<?php include('footer.php') ?>
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
<script>
    $(document).ready(function () {
    $('#table_paid_female').DataTable({
     "order": [[ 1, "desc" ]],
     "columnDefs": [ { type: 'date', 'targets': [1] } ]
    });
    $('.dataTables_length').addClass('bs-select');
    });
</script>

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
 