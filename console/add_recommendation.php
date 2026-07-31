<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
/*include '../dbconnectadmin.php';*/
	$q  = $_POST['search'] ? $_POST['search'] : $_GET['id'];
	$matriid = $q;
	$flag = 0;
	/*$result = mysqli_query($con,"SELECT * FROM register where MatriID LIKE '%$q%'");*/
	$check = mysqli_query($con, "SELECT * FROM register WHERE MatriID = '$q'");
	$count = mysqli_num_rows($check );
	//echo $count;

	if( $count == 0)
	{
		$flag = 1;
		header("location:recommend?flag=1");
	}
	
	$check_recommendation = mysqli_query($con,"SELECT * from recommendation WHERE MatriID='$matriid'");
	$get_count_recommend = mysqli_num_rows($check_recommendation);


?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Add Recommendation</title>
    
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
	<link rel="stylesheet" href="assets/css/popup.css">
<style>
input[type=checkbox], input[type=radio] {
    box-sizing: border-box;
    padding: 0;
    height: 20px;
    width: 20px;
}
.form-control1 {
	border: 2px solid transparent;
}
</style>	
	
<script>
function ValidateAlpha(evt)
{
var keyCode = (evt.which) ? evt.which : evt.keyCode
if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
return false;
return true;
}
function blockSpecialChar(e){ 
var k;
document.all ? k = e.keyCode : k = e.which;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>
<script type="text/javascript">
 function nospaces(t)
{
if(t.value.match(/ \s/g)){
alert('Sorry,Only one space allowed');
t.value=t.value.replace(/ \s/g,'');
}}
</script>
<script type="text/javascript">
function nospaceses(t)
{
if(t.value.match(/,+/g)){
//alert('Sorry,Only one comma allowed');
t.value=t.value.replace(/,+/g,',');
}
}
</script>
<script type="text/javascript">
function nospaceses1(t)
{
if(t.value.match(/^,/g)){
 alert('Sorry,you cannot enter comma as a first letter');
t.value=t.value.replace(/^,/g,'');
}
}
</script>
<script>
	function check() {
		var checkBox = document.getElementById("check_description");
	  	var text = document.getElementById("desc");
	  	/*console.log(checkBox);
	  	console.log(text);*/
	  	if (checkBox.checked == true){
	    text.style.display = "block";
	  	} else {
	    	text.style.display = "none";
	  	}
	}
	function check_biodata() {
		var checkBox = document.getElementById("check_bio");
	  	var text = document.getElementById("biodata");
	  	/*console.log(checkBox);
	  	console.log(text);*/
	  	if (checkBox.checked == true){
	    text.style.display = "block";
	  	} else {
	    	text.style.display = "none";
	  	}
	}
	function check_photo_condition() {
		var checkBox = document.getElementById("check_photo");
	  	var text = document.getElementById("photo");
	  	/*console.log(checkBox);
	  	console.log(text);*/
	  	if (checkBox.checked == true){
	    text.style.display = "block";
	  	} else {
	    	text.style.display = "none";
	  	}
	}
	
</script>
<style>
.des{
		height:115px;
	}
	  

</style>
<!-- <script type="text/javascript">
	 $(window).load(function(){        
	   $('#myModal').modal('show');
		}); 
</script> -->
	
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
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
            	<div class="card">
            		<div class="card-body">
            			<div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
							  <h3>Add Recommendation</h3>
							  <?php include 'profile_details.php'?>

                            </div>
                            <?Php if($get_count_recommend != 0 ){
                            ?>
                            <div class="col-sm-6 text-end">
                                <a href="view_recommendation?id=<?php echo $matriid; ?>"><button class="btn btn-primary btn-sm mb-3 btn-round"> View Recommendation</button></a>
                            </div>
                       	 	<?php } ?>
                        </div>
                    	<div class="container">
                        	<form action="upload_bio_photo" method="post" enctype="multipart/form-data">
                        		<div class="form-group">
                        			 <div class="row">
	                               <div class="col-sm-4 mt-2">
	                                     <input type="checkbox" name="check_bio" id="check_bio" onclick="check_biodata()" class="form-check-input" style="vertical-align: middle;"> <label class="form-label ">Biodata</label> 
	                                      <div class="col-sm-12 mt-2" id="biodata" style="display:none">
	                                   
	                                    <input name="uploaded_file1"  class="form-control " id="upload_photo" type="file" />
	                                   
											</div>     
	                              	</div>
	                              	<div class="col-sm-4 mt-2">
	                                     <input type="checkbox" name="check_photo" id="check_photo" onclick="check_photo_condition()" style="vertical-align: middle;" class="form-check-input"> <label class="form-label"> Photo </label>      
									<div class="col-sm-12 mt-2" id="photo" style="display:none">
	                                    
	                                    <input name="uploaded_photo" class="form-control" id="upload_photo1" type="file" />
									</div>
									
									</div>
									
									
									<div class="col-sm-4">
	                                   <input type="checkbox" name="check_description" id = "check_description" onclick="check()" style="vertical-align: middle;" class="form-check-input"> <label class="form-label">Description</label>
	                                  <div class="col-sm-12 mt-2" id="desc"style="display:none">
	                                    
	                                    <textarea class="form-control des" name="data" id="data"  placeholder="Recommend Description" maxlength="700"></textarea>
									</div>
								   </div>
								   
									</div >
									<input type="text" value="<?php echo $matriid; ?>" name="matid" id='matid' hidden>
									
							 	</div>
							 	<button type="submit" class="btn btn-success btn-sm mb-3 btn-round" id="submit" name="submit">Send Recommendation</button>
							 	
                        	</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
</div>
<?php include('footer.php');?>

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
    
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
	 $(window).load(function(){        
	   $('#recommendModal').modal('show');
		}); 
	</script> 
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>



<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<?php if( isset($_GET['flag'] ) ) { 
		$flag = $_GET['flag'];
?>
<div id="recommendModal" class="modal " role="dialog" style="margin-top: 100px;">
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
                        <?Php if($flag == 'none'){?>
                        	<h2 class="swal2-title" id="swal2-title" style="display: flex;">Please Choose Atlest One Value</h2>
                        <?php } ?>
                        <?Php if($flag == 1){?>
                        	<h2 class="swal2-title" id="swal2-title" style="display: flex;">Your Photo is not an image.</h2>
                        <?php } ?>
                        <?Php if($flag == 2){?>
                        	<h2 class="swal2-title" id="swal2-title" style="display: flex;">Sorry, Photos  are  allow only JPG, JPEG Format.</h2>
                        <?php } ?>
                        <?Php if($flag == 3){?>
                        	<h2 class="swal2-title" id="swal2-title" style="display: flex;">Sorry, your photo was not uploaded.</h2>
                        <?php } ?>
                        <?Php if($flag == 4){?>
                        	<h2 class="swal2-title" id="swal2-title" style="display: flex;">Sorry, there was an error uploading your photo.</h2>
                        <?php } ?>

	                   
	                </div>
	                <div class="swal2-actions">
	                   <a href="add_recommendation?id=<?Php echo $matriid;?>" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
                    </div>
                </div> 
            </div>
        </div>   
    </div>
</div>
<?Php } ?>
</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>