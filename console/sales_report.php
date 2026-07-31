<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  
  //error_reporting(0);
  
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Sales Report</title>
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
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="assets/css/plugins/select2.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	<link rel="stylesheet" href="assets/css/newcss.css">
    
	<style>
	.incs{
		height:33px;
		margin-left:10px;
	}
	.incs1{
		
		margin-left:36px;
	}
	.stcs{
		margin-left:10px;
	}
	.tcs{
		margin-right:10px;
	}
	
	.row {
    --bs-gutter-x: -0.5rem;
	}
	.select2-container .select2-selection--single .select2-selection__rendered {
    padding: -0.325em 0rem;
    padding-right: 190px;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow b {
	margin-left: 8px;
	
	}
	.select2-container .select2-selection--single {
				height: calc(2.5em + 0.75rem + 2px);
		}
	</style>
<script type="text/javascript">
function print_report()
{
	 var divElements = document.getElementById('print').innerHTML;
            var oldPage = document.body.innerHTML;

            document.body.innerHTML ="<html><head><title>Report</title> </head><body>"+divElements+"</body></html>" ;

            window.print();

            document.body.innerHTML = oldPage;
}
</script>
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
                        <h5>Sales Report</h5>
                    </div>
                    <div class="card-body">
					   
                        <div class="col-sm-12">
						 <form action="sales_reportdatewise" method="post">
						
                       <strong>From Date</strong> <input type="date"  name="datefrom" class="incs">
					   <strong class="stcs">To Date</strong> <input type="date"  name="dateto" class="incs" > 
							<strong class="stcs tcs ">Select Member Type</strong> 
							  <select class="skill-mlt-select "  name="memtype">
							  <option value="">Select Membership Type</option>
							  <?php  $mempl=$con->query("select * from membershipplan"); 
							  while($fetch_mem=$mempl->fetch_array()) { ?>
							  <option value="<?php  echo $fetch_mem['plandisplayname'] ?>"><?php  echo $fetch_mem['plandisplayname'] ?></option>
							  <?php  } ?>
							  </select>	
									
							  <button type="submit" class="btn btn-primary incs1"  name="submit">Sumbit</button>
                           <!--<input type="submit" value="Submit" class="btn btn-default">-->
						  <!-- <input type="button" value="Print"  style="float:right; margin-right:10px; color:#FFF" onClick="print_report();" class="btn btn-primary"/>-->
						   </form> 
						   </div><br>
						   <div class="dt-responsive table-responsive" id="print">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
							
                                <thead>
                                    <tr>
										    <th>PROFILE ID</th>
											<th>MEMBERSHIP TYPE</th>
											<th>ACTIVE DATE</th>
											<th>PLAN DURATION</th>
											<th>NO. OF CONTACTS</th>
											<th>AMOUNT( <i class="fas fa-rupee-sign"></i> )</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                    <?php  	$relsql=$con->query("select * from paiddetails")or svr_db_fail($con);
											while($relrow = $relsql->fetch_assoc())  
												{  ?>
                
										  <tr>
											<td><a href="profile_view.php?ID=<?php  echo $relrow['Pmatriid'];?>"><?php  echo $relrow['Pmatriid'];?></a></td>
											<td><?php  echo $relrow['Pplan'];?></td>
											<td><?php  echo $relrow['Pactivedate'];?></td>
											<td><?php  echo $relrow['Pplanduration']?></td>
											<td><?php  echo $relrow['Pnocontct']?></td>
											<td><?php  echo $relrow['Pamount'];?></td>
										</tr>
									<?php  } ?>
									
									<tr>
										  <td  colspan="5" align="right"><strong>TOTAL AMOUNT( <i class="fas fa-rupee-sign"></i> )</strong></td>
										  <?php  $tot=$con->query("Select SUM(Pamount) from paiddetails"); 
										   while($totot=$tot->fetch_array()){?>
										   <td><?php  echo $totot['SUM(Pamount)'] ?></td>
										   <?php  } ?>
										  
										  </tr>
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

   <script src="assets/js/plugins/select2.full.min.js"></script>
<script>
    $(function() {
        $(".skill-mlt-select").select2();
    });
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

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
 