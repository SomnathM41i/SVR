<?php require_once('includes/bootstrap.php'); 
	 ?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Upload ID Proof</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<style>
color:#000000
</style>


<script>
function deletephoto(id)
{  
	var xmlhttp;
if (id=="")
  {
  
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
   // document.getElementById("delete").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","delete_idproof.php?id="+id,true);
xmlhttp.send();
window.location='uploadidproof.php';}




</script>
</head>
<style>

.labcss
{
	margin-top: 18px;
    height: 37px;
    font-size: 14px;
	
}
	.close
{
  color: #fff;
  opacity: 20;
}

</style>

<body>

<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	<!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Main Header-->
   <?php include('header.php')?>
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1>Upload ID Proof</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Upload ID Proof</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->


<?php 
$id=$_SESSION['matriid'];
$sqlgal = mysqli_query($con,"select * from register where MatriID='$id' AND adhar!='' ");
$check = mysqli_query($con,"select * from register where MatriID='$id'");


$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
$rowreg=mysqli_fetch_array($sqlreg);
?>
    <!-- About Section -->
	 
	     <!-- Content Column -->
				<?php $gallaryfetch=mysqli_query($con,"select * from register where MatriID='$id'");
				if(mysqli_num_rows($gallaryfetch)>0){?>

	<?php 
	
	if(mysqli_num_rows($sqlgal)<1){ ?>

		


	  <div class="col-lg-12 col-md-12 col-sm-12 form-group page-title mt-3">

	  	<?php if( $rowreg['idproof_approve'] == 'No' ) {?>
		<div class="alert alert-info" align="center" role="alert">
			<a href="contact" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		 		Your ID Proof is Rejected by Admin
				  </div>
		<?php } ?>
			<a href="upload_id_proof">  <button class="theme-btn btn-style-one" type="submit" name="submit"><span class="btn-title">Upload ID Proof</span></button></a>
	   </div>
	<?php } ?>
    <section class="about-section">
     
        <div class="auto-container">

            <div class="row">
			 				<div class="anim-icons full-width">
            		<span class="icon icon-circle-blue wow fadeIn"></span>
            		<span class="icon icon-circle-1 wow zoomIn"></span>
        			</div>
                <!-- Content Column -->
			
					
			<div class="content-column col-lg-12 col-md-12 col-sm-12">
				<div class="inner-column">
					<div class="sec-title">
					
					   <?php $cnt=mysqli_num_rows($sqlgal);?>
						<?php	for($i=0;$i<$cnt;$i++) { ?>
						 <div class="auto-container">
						 
							<div class="row">
							<?php  while($row=mysqli_fetch_array($sqlgal))	 { ?>
								<!-- Gallery Item -->
								<div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
									<div class="image-box">
									<?php  $ext=".pdf";

									function endsWith($img, $ext){
									$extLength = strlen($ext);
									if(substr($img, -$extLength) == $ext){
										return true;
									}
									return false;
									} 
									If(endsWith($row['adhar'], ".pdf")){ //executes if return is true
										
										
										<iframe src="adhar/<?php echo $row['adhar']?>"></iframe><p>
									<?php }
									else
									{   //executes if return is false
										echo '<figure class="image"> <a href="adhar/'.$row['adhar'].'"> <img src="adhar/'.$row['adhar'].'" ;/></a></figure>';

										} ?>
										
											   
											   
									</div>
									 <?php
			  
			  //{
					?>
           <div class="row">
             
                <div class=" jsdemo-notification-button13">
                  <button type="button" id="delete" onclick="deletephoto(<?php echo $row['photo_id']?>)" class="btn btn-default pull-left disabled btndel"  > Delete ID Proof</button>
                </div>
				 </div>
                <?php 
						
						
						//{
					?>
               
                <?php
						//}
						
						//{?>
               
                <?php //}?>
                <?php //}
						
						//{ 
							?>
							
							<?php 
									
									
									
									
									//{?>
						   
							<?php
									//}
									
									//{?>
						   
							<?php //}?>
							<?php //} ?>
							</ul>
						  </div>
						  <?php } ?>
						</div>
						<?php } ?>
                           </div>
		
						</div>
		  		    </div>
				  </div>								 
				</div>
				
			</div>					
		</div>
	</div>
  </div>
</div>
</div>

</section>
<?php } else {?>
			  <section class="error-section">
					<div class="anim-icons full-width">
						<span class="icon icon-circle-blue wow fadeIn"></span>
						<span class="icon icon-dots wow fadeInleft"></span>
						<span class="icon icon-line-1 wow zoomIn"></span>
						<span class="icon icon-circle-1 wow zoomIn"></span>
					</div>

					<div class="auto-container">
						<div class="error-title">OOP'S</div>
						<h4>Sorry Result Not Found</h4>
						<div class="text">You have not yet any photos.</div>
					 <div class="col-lg-12 col-md-12 col-sm-12 form-group page-title mt-3">
				 <a href="upload_id_proof">  <button class="theme-btn btn-style-one" type="submit" name="submit"><span class="btn-title">Upload ID Proof</span></button></a>
	   </div>
						<!--<a href="contact.html" class="theme-btn btn-style-two"><span class="btn-title">Contact Us</span></a>-->
					</div>
				</section>
					<?php }?>

    <!--End About Section -->
   <!-- Main Footer -->
    
  <?php include('footer.php');?>
<!--End pagewrapper-->
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
</body>
</html>