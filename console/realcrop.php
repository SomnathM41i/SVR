<?php  require_once('../sys_dbconnection.php'); 
include("protect.php"); 


 $strid=$_GET['matid']; 



if (isset($_FILES['croppedImage']['tmp_name']) && !empty($_FILES['croppedImage']['tmp_name'])){
 $strid1=$_POST['matid'];

$stroldphoto1 = $_POST['op'];
$myFile = "../gallary/".$stroldphoto1;
unlink($myFile); 

$photoid1=$_POST['photoid'];
$strimg = $_POST['op'];
$rand=rand(111111,999999);
$save_path = $rand.$strimg;
$targetfile="../gallary/$save_path";

 move_uploaded_file($_FILES["croppedImage"]["tmp_name"], $targetfile);

$photoid=$_GET['photoid']; 


mysqli_query($con,"update gallary set photo_approve='Yes',photo_name='$save_path' where photo_id='$photoid1'");

$update1 = mysqli_query($con,"update register set Photo1 ='$save_path' ,Photo1Approve= 'Yes' where MatriID='$strid1'") or die("Could not update data because ".mysqli_error());


}
?>


  



<LINK href="style.css" rel="stylesheet" type="text/css">
<script src="assets/crop/jquery-3.3.1.min.js"></script>
<script src="assets/crop/cropper.js"></script>

<link rel="stylesheet" type="text/css" href="assets/crop/cropper.css">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- font css -->
<link rel="stylesheet" href="assets/fonts/feather.css">
<link rel="stylesheet" href="assets/fonts/fontawesome.css">
<link rel="stylesheet" href="assets/fonts/material.css">

<!-- vendor css -->
<link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
<link rel="stylesheet" href="assets/css/stylenew.css" id="main-style-link">
<link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
<link rel="stylesheet" href="assets/css/customizer.css">
<!-- STYLESHEETS-->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">    
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">


<script>
	$(function () {
		
		$("#image").cropper({
			zoomable: false
		});
	});

	function crop() {
		$("#image").cropper("getCroppedCanvas").toBlob(function (blob) {
			var formData = new FormData(myform);
			formData.append("croppedImage", blob);

			$.ajax({
				url: "realcrop.php",				
				method: "POST",				
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					alert('Crop image has been uploaded');
					window.location.href = "simplecrop?id=<?php echo $strid?>";
				}, error: function (xhr, status, error) {
					console.log(status, error);
				}
			});
		}, "image/jpeg", "0.75");
	}
	
	
	
	
</script>

<style>
	.cropper-crop {
		display: none;
	}
	.cropper-bg {
		background: none;
	}
	

</style>

<title>Edit my photo</title>
<form name="myform" action="" method="POST">
  <div align="center"> <br />
    <strong class="bigtext">Hit the Mouse Pointer on the image then <span class="style1">Drag the Position </span>. Click Save now Button.</strong> 
	</div>
 <?php  $photochk = mysqli_query($con,"SELECT MatriID,Photo1 FROM register where MatriID='$strid'");
?>
  <?php   while($row = mysqli_fetch_array($photochk)){ ?>
  <?php  if ($_GET['Choice']=="1") { ?>
  <?php  $img =   $row['Photo1']; ?>
  <div align="center">
    <div id="testWrap"> 
	<img src="../gallary/<?php  echo $img; ?>" class="border" name="image" id="image" /> 
	 
      <input name="op" type="hidden" id="op" value="<?php  echo $img; ?>" />
      <input type="hidden" name="photoid" value="<?php  echo $_GET['photoid'] ?>" />
      <input type="hidden" name="matid" id="matid" value="<?php  echo $strid; ?>" />
      <input name="txtchoice" type="hidden" id="txtchoice" value="1" />
      <br />
      <br />
    </div>
  </div>
  <?php  } } ?>
  <div align="center"><br/>
  <button type="button" onclick="crop();"  value="Save Now" class="btn  btn-success">Save Now</button>
     <button type="button" value="Cancel" class="btn  btn-danger" onclick="window.close()">Cancel</button>
 
  </div>
</form>
