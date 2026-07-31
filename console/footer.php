<?php require_once(dirname(__FILE__).'/protect.php'); ?>
<style>
 
.link{
color:#b5bdca;
}



</style>
<?php
$result=mysqli_query($con,"select * from siteconfig where ID='1'");
$fetch1=mysqli_fetch_array($result);?>
<link rel="stylesheet" href="assets/css/stylenew.css">
<link rel="stylesheet" href="assets/css/mpj-brand.css">

<nav class="topbar1 mt-5 ">
  <div class="container">
	<div class="navbar-wrapper">
	<div class="row">			
	<div class="col-md-10">			
					
  <span class="link"> &copy 2024 <?php echo $fetch1['copyright_footer']; ?> All Rights Reserved.</span>
	</div>		
	
		</div>
	</div>
  </div>

</nav>