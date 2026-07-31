<?php require_once('../includes/bootstrap.php');
include("protect.php"); 

$strid=$_GET['id']; 
$row=mysqli_query($con,"select * from register where MatriID='$strid'");
$fetch=mysqli_fetch_array($row);
$img=$fetch['Photo1'];
?>

<LINK href="style.css" rel="stylesheet" type="text/css">
<script src="assets/crop/jquery-3.3.1.min.js"></script>
<script src="assets/crop/cropper.js"></script>

<link rel="stylesheet" type="text/css" href="assets/crop/cropper.css">
<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">

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
<div align="center"><span class="biggertext"><strong class="bigtext">Photo has been Saved </strong><br />
  </span><br />
  <img src="<?php  echo "../gallary/".$img; ?>" >
  <br/>
  
  

<SCRIPT language=JavaScript>

}
</SCRIPT>
  <br />
  <br />
  <input name="submit" type="submit"  class="btn  btn-success" value="Close Window" onclick="win();"  />
  <br />
  <br />
</div>