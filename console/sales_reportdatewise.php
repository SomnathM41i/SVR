<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  
  error_reporting(0);
  $datefrom=$_POST['datefrom'];
  
$dateto=$_POST['dateto'];

  $memtype=$_POST['memtype'];?>



<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Sales Report</title>
   
    <!-- Meta -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Manpasand Jodidar - Admin Panel"/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
	<link rel="stylesheet" href="assets/css/plugins/select2.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/mpj-brand.css">
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
		margin-left:20px;
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
					 
					   <form action="sales_reportdatewise" method="post">
                         <div class="col-sm-12">
						 <?php  
							   $a = explode('-',$_POST["datefrom"]);
								$fromdate = $a[2].'-'.$a[1].'-'.$a[0];
								 $a = explode('-',$_POST["dateto"]);
								$todate = $a[2].'-'.$a[1].'-'.$a[0];
							   ?>
							   <?php  if($datefrom!="" && $dateto!="") { ?>
							       <h5>Date From : <u><?php  echo $fromdate ?></u> TO <u><?php  echo $todate ?></u> 
							   <?php  } if($memtype!="") { ?> And Membership Type : <u><?php echo $memtype ?></u><?php } ?></h5>
							   </div>
							   
							   <div class="col-sm-12">
							<strong>From Date</strong><input type="date"  name="datefrom" class="incs" value="<?php  echo $datefrom ?>"> 
							<strong class="stcs">To Date</strong><input type="date"  name="dateto" class="incs"  value="<?php  echo $dateto ?>"> 
							<strong class="stcs tcs">Select Member Type</strong> 
							  <select class="skill-mlt-select" name="memtype">		
							  <?php if ($memtype!="") { ?>
							   <option value="<?php echo $memtype?>" selected><?php echo $memtype ?></option>	
							    <option value=""> Select Membership Type</option>
								<?php  $mempl=$con->query("select * from membershipplan where plandisplayname!='$memtype'"); 
							  while($fetch_mem=$mempl->fetch_array()) { ?>
							  <option value="<?php  echo $fetch_mem['plandisplayname'] ?>"><?php  echo $fetch_mem['plandisplayname'] ?></option>
							  <?php  }  ?>
							  <?php } else { ?>
							  <option value="" selected> Select Membership Type</option>
								<?php  $mempl=$con->query("select * from membershipplan"); 
							  while($fetch_mem=$mempl->fetch_array()) { ?>
							  <option value="<?php  echo $fetch_mem['plandisplayname'] ?>"><?php  echo $fetch_mem['plandisplayname'] ?></option>
							  <?php  } } ?>
							  </select>			
							  <button type="submit" class="btn btn-primary incs1"  name="submit">Sumbit</button>
                           <!--<input type="submit" value="Submit" class="btn btn-default">
						   <input type="button" value="Print"  style="float:right; margin-right:10px; color:#FFF" onClick="print_report();" class="btn btn-primary"/>-->
						   </form> </div> <br>
						   <?php  ?>
							 <div class="dt-responsive table-responsive" id="print"> 
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
							
                                <thead>
                                    <tr>
										    <th>PROFILE ID</th>
											<th>MEMBERSHIP TYPE</th>
											<th>ACTIVE DATE</th>
											<th>PLAN DURATION</th>
											<th>NO. OF CONTACTS</th>
											<th>AMOUNT(<i class="fas fa-rupee-sign"></i> )</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                    <?php  
		  $flag=0;
		  $queryString="select * from paiddetails";
		  if($datefrom!="" && $dateto!="")
			{
				if($flag==0)
				{
					$queryString .=" Where ";
					$flag=1;
				}
				else
				{
					$queryString .=" AND ";
				}
				$da1=explode("-",$datefrom);
				$da2=$da1[2]."-".$da1[1]."-".$da1[0];
				$da3=explode("-",$dateto);
				$da4=$da3[2]."-".$da3[1]."-".$da3[0];
			$queryString=$queryString." Pactivedate Between '$da2' and '$da4'";
			
			
			}
			if($memtype!="")
			{
				if($flag==0)
				{
					$queryString .=" Where ";
					$flag=1;
				}
				else
				{
					$queryString .=" AND ";
				}
			$queryString=$queryString." Pplan='$memtype'";
			}
			
		  $relsql=$con->query($queryString)or svr_db_fail($con);
				while($relrow = $relsql->fetch_assoc())
				{  ?>
                
										  <tr>
											<td><?php  echo $relrow['Pmatriid'];?></td>
											<td><?php  echo $relrow['Pplan'];?></td>
											<td><?php  echo $relrow['Pactivedate']?></td>
											<td><?php  echo $relrow['Pplanduration']?></td>
											<td><?php  echo $relrow['Pnocontct']?></td>
											<td><?php  echo $relrow['Pamount'];?></td>
										</tr>
									<?php  } ?>
									
									<tr>
										  <td  colspan="5" align="right"><strong>TOTAL AMOUNT(<i class="fas fa-rupee-sign"></i> )</strong></td>
										   <?php  
		  $flag=0;
		  $queryString1="Select SUM(Pamount) from paiddetails";
		  if($datefrom!="" && $dateto!="")
			{
				if($flag==0)
				{
					$queryString1 .=" Where ";
					$flag=1;
				}
				else
				{
					$queryString1 .=" AND ";
				}
				
				
			$queryString1=$queryString1." Pactivedate Between '$da2' and '$da4'";
			}
			if($memtype!="")
			{
				if($flag==0)
				{
					$queryString1 .=" Where ";
					$flag=1;
				}
				else
				{
					$queryString1 .=" AND ";
				}
			$queryString1=$queryString1." Pplan='$memtype'";
			}
		  
		   $tot=$con->query($queryString1); 
		   while($totot=$tot->fetch_array()){?>
           <td><?php  echo $totot['SUM(Pamount)'] ?></td>
           <?php  }?>
										  
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

</script>

   
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>
   <script src="assets/js/plugins/select2.full.min.js"></script>
<script>
    $(function() {
        $(".skill-mlt-select").select2();
    });
</script>
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
 