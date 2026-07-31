<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  
  error_reporting(0);
  $q="select * from e_country";
$country_rec=mysqli_query($con,$q);
$country_count=mysqli_num_rows($country_rec);
?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Label Print</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
	<link href="ckeditor/sample.css" rel="stylesheet" type="text/css" />
	<link href="bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	 
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
	  <link rel="stylesheet" href="assets/css/stylenew.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">

<script language="javascript">

function fillstate(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("state").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("state").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_state.php?q="+str,true);
xmlhttp.send();
}


function filldist(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("dist").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dist").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_dist.php?q="+str,true);
xmlhttp.send();
}

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
		<div class="pc-mob-header pc-header">
			<div class="pcm-logo">
				<img src="http://localhost/SVR/css3/assets/shivraj-logo.png" alt="" class="logo logo-lg">
			</div>
			
			<div class="pcm-toolbar">
				<a href="#!" class="pc-head-link" id="mobile-collapse">
					<div class="hamburger hamburger--arrowturn">
						<div class="hamburger-box">
							<div class="hamburger-inner"></div>
						</div>
					</div>
				</a>
				<a href="#!" class="pc-head-link" id="headerdrp-collapse">
					<i data-feather="align-right"></i>
				</a>
				<a href="#!" class="pc-head-link" id="header-collapse">
					<i data-feather="more-vertical"></i>
				</a>
				
			</div>
		</div>
		
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
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
			<div class="card">
                    <div class="card-body">
                        <div class="container">
						
                            <form id="form1" name="form1" method="post" action="label_print_reports.php">
                            <h3><label class="form-label" for="exampleInputPassword1">Label Print</label></h3>
                          <div class="form-group">
							      
						    <div class="row">
								<div class="col-sm-2">
                                       <label class="form-label">Reg.Date</label> </div>
								 <div class="col-sm-10">
										   <label for="from">From</label>
											<input type="date" id="from" name="from" />
											<label for="to" class="ml-2">To</label>
											<input type="date" id="to" class="" name="to" /> 
                               </div>
										   
                                 </div><br>
								 
								 <div class="row">
								<div class="col-sm-2">
                                       <label class="form-label">Gender</label> </div>
								 <div class="col-sm-10">
										  <input type="radio" name="gender" value="Male" style="verticle-align:middle"/>
										    <label class="mr-2" for="from" style="verticle-align:middle;margin-right:8px">Male</label>
											<input type="radio" name="gender" value="Female" style="verticle-align:middle"/>
											 <label class="mr-2" for="from" style="verticle-align:middle;margin-right:8px">Female</label>
											<input type="radio" name="gender" value="All" checked="checked" style="verticle-align:middle"/>
											 <label class="mr-2" for="from" style="verticle-align:middle;margin-right:8px">All</label>
                               </div>
										   
                                 </div><br>
								  <div class="row">
								<div class="col-sm-2">
                                       <label class="form-label">Country </label> </div>
								 <div class="col-sm-10">
										  <select type=select name="country" id="country" onChange="fillstate(this.value);" style="width:300px;" class="form-control">
                                      <option value="">Any</option>
                                        <?php  
                                                $i=0;
                                                while($data=mysqli_fetch_assoc($country_rec) and $i< $country_count)
												{
											  
												?>
												<option value="<?php  echo $data['country'] ?>"><?php   echo $data['country'] ?> </option>
												<?php  
												$i++;
												}
												?>
												</select>
									</div>
										   
                                 </div><br>
								 <div class="row">
								<div class="col-sm-2">
                                       <label class="form-label">State</label> </div>
								 <div class="col-sm-10">
										   <select type=select name="state" id="state" onChange="filldist(this.value);" style="width:300px;" class="form-control">
										   <option value="">Any</option>
										  </select>
																  
									</div>
										   
                                 </div><br>
								  <div class="row">
								<div class="col-sm-2">
                                       <label class="form-label">City</label> </div>
								 <div class="col-sm-10">
										   <select type=select name="dist" id="dist"  onChange="fillcity(this.value);" style="width:300px;" class="form-control">
										   <option value="">Any</option>
										   </select>
										  
									</div>
										   
                                 </div><br>
								  
                                   
                            </div>
							
                            <button type="submit" class="btn btn-primary"  name="submit" onclick="MM_validateForm('txt1','','R');return document.MM_returnValue"> GET RESULTS </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>


    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

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
<?php include('footersection.php');?>
</script>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->
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


</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
