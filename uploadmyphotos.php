<?php require_once('includes/bootstrap.php'); 

	
	?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Upload Photo</title>
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
xmlhttp.open("GET","delete_photo.php?id="+id,true);
xmlhttp.send();
window.location='gallary.php';}



function dp(id)
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
   document.getElementById("dpchange"+id).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","setdp.php?id="+id,true);
xmlhttp.send();
window.location='gallary.php';
 }
</script>
</head>

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
            <h1>Upload Photo</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Upload Photo</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	        <?php 
$id=$_SESSION['matriid'];
$sqlgal=mysqli_query($con,"select * from gallary where matri_id='$id'");

$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
$rowreg=mysqli_fetch_array($sqlreg);
?>
    <!-- About Section -->
	   <div class="col-lg-12 col-md-12 col-sm-12 form-group page-title mt-3">
				 <a href="upload_photo_gallary">  <button class="theme-btn btn-style-one" type="submit" name="submit"><span class="btn-title">Upload Photos</span></button></a>
	   </div>
    <section class="about-section">
     
        <div class="auto-container">
            <div class="row">
			 <div class="anim-icons full-width">
            <span class="icon icon-circle-blue wow fadeIn"></span>
            <span class="icon icon-circle-1 wow zoomIn"></span>
        </div>
			
                <!-- Content Column -->
					<?php $gallaryfetch=mysqli_query($con,"select * from gallary where matri_id='$id'");
					if(mysqli_num_rows($gallaryfetch)>0){?>
						
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
						   <section class="">   
						   <?php $cnt=mysqli_num_rows($sqlgal);?>
							<?php	for($i=0;$i<$cnt;$i++) { ?>
							 <div class="auto-container">
							 
								<div class="row">
								<?php  while($row=mysqli_fetch_array($sqlgal))	 { ?>
									<!-- Gallery Item -->
									<div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
										<div class="image-box">
											<figure class="image"> <a href="gallary/<?php echo $row['photo_name'];?>" data-sub-html="Demo Description">
                                                   <img src="gallary/<?php echo $row['photo_name'];?>"></a> </figure>
										</div>
							<?php
								  if($row['photo_name']!=$rowreg['Photo1'])
								  {
										?>
						   <div class="row">
							 <div class="jsdemo-notification-button12" id="dpchange<?php echo $row['photo_id'] ?>">
								  <button type="button" id="dp1" onclick="dp(<?php echo $row['photo_id']?>)" class="btn btn-default pull-left disabled" > <strong>profile picture</strong></button>
								</div>
								<div class=" jsdemo-notification-button13">
								  <button type="button" id="delete" onClick="deletephoto(<?php echo $row['photo_id']?>)" class="btn btn-default pull-left disabled"  > Delete Photo</button>
								</div>
								 </div>
								<?php 
										$is_protected =$row['photo_protect'];
										if($is_protected=="No")
										{
									?>
							   
								<?php
										}
										else if($is_protected=="Yes")
										{?>
							   
								<?php }?>
								<?php }
										else
										{ 
											?>
								<div class="row">
								<button type="button" id="dp" onclick="window.location='upload_photo_gallary?id=<?php echo $row['photo_id']?>'" class="btn btn-default pull-left disabled" style="box-shadow:none; color:green;margin-left:6px;"> <strong>Selected Profile Picture</strong></button>
								</div>
								<?php 
										$is_protected =$row['photo_protect'];
										$reg_photo = $rowreg['PhotoProtect'];
										
										if($is_protected=="No"&&$reg_photo=="No"||$reg_photo=="")
										{?>
							   
								<?php
										}
										else if($is_protected=="Yes"||$reg_photo=="Yes")
										{?>
							   
								<?php }?>
								<?php	} ?>
								</ul>
							  </div>
							  <?php } ?>
							</div>
							<?php } ?>
						  </div>
						
								</div>
									<?php } else {?>
					
									<div class="alert alert-info mx-auto" align="center" role="alert" style="padding-top:-200px;">
										<?php
										echo "You have not upload any photos yet"?> 
										 </div>
									<?php }?><br>

								</div>

									</div>								 
								</div>

							</div>
						</section>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
    <!--End About Section -->

    <!-- Fun Fact Section -->
   
    <!--End Fun Fact Section -->

    <!-- Features Section Two -->
   
    <!--End Features Section -->

    <!-- Call to action -->
    
    <!--End Call to action -->

     <!-- Event Info Section -->
  
                <!-- Image Column -->
                
    <!--End Event Info Section -->

    <!-- App Section -->
   

                <!-- Image Box -->
                
    <!--End App Section -->

    <!-- Newsletter Section -->
    
    <!--End Newsletter Section -->

    <!-- Main Footer -->
    
  <?php include('footer.php');?>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->


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