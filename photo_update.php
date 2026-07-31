<?php require_once('includes/bootstrap.php');

error_reporting(0) ;


?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>gallary</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<link rel="icon" href="branding/favicons/favicon.ico" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<script>
function preview_images() 
{
 var total_file=document.getElementById("upload").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
  document.getElementById("buttonupload").disabled = false; 
 }
}
</script>

<script>
    function FileDetails() {

           var numFiles = $("input:file")[0].files.length;
          document.getElementById ("fp").innerHTML = numFiles;
			document.getElementById("display").style.display='block';
			document.getElementById("butt").style.display='none';
			document.getElementById("buttonupload").style.display='block';

	}
</script>

<script>
function showMyImage(fileInput) {
	var oFile = document.getElementById("upload1").files[0];
            if (oFile.size > 3145728 ) // 3 mb for bytes.
            {
                document.getElementById('thumbnil1').style.display='block'; 
                return;
            }
	
	  document.getElementById('thumbnil').style.display='block';
	  document.getElementById('continue123').style.display='block';
	  document.getElementById('skip1').style.display='none';
	  
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
				document.getElementById('thumbnil1').style.display='block';
				document.getElementById('thumbnil').style.display='none';
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
	
</script>


<!-- end check password length-->
<style>
.subscribe-form .form-group {
box-shadow: 0 0 0px rgba(0,0,0,0.10);
}
</style>
<style>
.btn-primary {
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
}
.bg-grey {
    color: #fff;
    background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);
    border-color: #fff;
	font-size: 17px;
	margin-left:51px;
}
.close
{
	color: #fff;
	 opacity: 20;
}
.textlabel
{
	font-size:16px;
	color: #555;
}
a
{
	color: #fff;
}

.subscribe-form .form-inner {
    position: relative;
    max-width: 81%;
}
</style>
</head>

<body>

<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	<!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Header Menu -->
     <?php include('header.php')?>
     <!-- End Header Menu -->

        <?php 
$id=$_SESSION['matriid'];
$sqlgal=mysqli_query($con,"select * from gallary where matri_id='$id'");
$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
$rowreg=mysqli_fetch_array($sqlreg);
?>
	
	<!-- Signup Form -->
    <section class="newsletter-section">
        <div class="anim-icons full-width">
            <span class="icon icon-shape-3 wow fadeIn"></span>
            <span class="icon icon-line-1 wow fadeIn"></span>
        </div>
        <div class="auto-container">
            <!--Subscribe Form-->
		<div class="subscribe-form wow fadeInUp" data-wow-delay="500ms">
			<div class="envelope-image"></div>
			  <div class="form-inner">
				<div class="upper-box">
				  <div class="sec-title text-center">
				    <div class="text">
				     <div class="alert bg-grey alert-dismissible" role="alert">
								Your Photo Has Been Submitted. <a href="upload_photo_gallary"><u>View</u></a>   Upload More Photos. <a href="upload_photo_gallary"><u>Click Here</u></a> </div><br>
								
								
								<sup class="textlabel"><i class="fa fa-check-square" aria-hidden="true"></i> You can upload 10 photos to your profile.</sup><br>								
							    </i><sup class="textlabel"> <i class="fa fa-check-square" aria-hidden="true"></i> Each photos must be less than 5 MB and in jpg format.</sup><br>
								<sup class="textlabel"> <i class="fa fa-check-square" aria-hidden="true"></i> All photos uploaded are screened as per Photo Guidelines and 98% of those get activated within an hour.</sup><br>
								
								</i><sup class="textlabel"> <i class="fa fa-check-square" aria-hidden="true"></i> Other ways to upload your photos. E-mail your photos to <?php echo $siteinfo['FeedbackEmail'] ?> Mention your Profile ID and Name in the mail.</sup> 

                       <br>
					</div>
				 </div>
     		 </div>
         <div class="">
         
							
							 
							   </div>
						 </div>
						 
			

					</div>
                  </form>
              </div>
           </div> 
       </div>
    </section>
	
			
    <!--End Signup Form -->

    <!-- Main Footer -->
    <?php include('footer.php');?>
    <!-- End Footer -->
</div>
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
<script src="js/validate.js"></script>
<script src="js/script.js"></script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
</body>
</html>