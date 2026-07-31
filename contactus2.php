<?php require_once('includes/bootstrap.php');

  //error_reporting(0);
  $seo=mysqli_query($con,"Select * from seo where catagory='contact'");
  $seof=mysqli_fetch_array($seo);
?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $seof['title']; ?></title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="keywords" content="<?php echo $seof['keyword']; ?>" />
<meta name="description" content="<?php echo $seof['description']; ?>" />


<script type="text/javascript">
 function nospaces(t)
{
if(t.value.match(/\s/g)){
alert('Sorry, you are not allowed to enter any spaces');
t.value=t.value.replace(/\s/g,'');
}}
</script>
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
 function check_exist1(str)
{
var xmlhttp;
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
    document.getElementById("mobileerror").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","check_mobile_exist.php?q="+str,true);
xmlhttp.send();
}

</script>
<script>
 document.addEventListener("keyup", function (e) {
	 alert("print screen disabled!");
    var keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode == 44) 
				alert("print screen disabled!");
                stopPrntScr();
            }
        });
		
function stopPrntScr() {

            var inpFld = document.createElement("input");
			 alert("print screen disabled!");
            inpFld.setAttribute("value", ".");
            inpFld.setAttribute("width", "0");
            inpFld.style.height = "0px";
            inpFld.style.width = "0px";
            inpFld.style.border = "0px";
            document.body.appendChild(inpFld);
            inpFld.select();
            document.execCommand("copy");
            inpFld.remove(inpFld);
        }
       function AccessClipboardData() {
            try {
                window.clipboardData.setData('text', "Access   Restricted");
            } catch (err) {
            }
        }
        setInterval("AccessClipboardData()", 300);
		
</script>
<style>
.subscribe-form .form-inner {
    position: relative;
    max-width: 89%;
    width: 100%;
    margin: 0 auto;
}
.ta{
    height: 134px;
    width: 110%;
}
.map-section {
    position: relative;
    display: block;
    padding-bottom: 34px;
    margin-top: -135px;
}
/* Add a right margin to each icon */
.fas {
  margin-left: -12px;
  margin-right: 8px;
}
iframe
{
	height:456px;
	width:100%;
}
@media screen and (max-width:767px)
{
	.contact-page-section{
    padding: 0px 0  20px;
}
.contact-page-section .contact-column {
    position: relative;
    margin-bottom: -20px;
}
.map-section {
	margin-top: -165px;
	}
}
@media screen and (max-width:567px)
{
	.contact-page-section{
    padding: 0px 0  20px;
}
	.map-section {
	margin-top: -165px;
	}
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

    <!-- Main Header-->
    <?php include('header.php')?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Contact Us</h1>
            <ul class="bread-crumb clearfix">
                <?php 
                    $login=$_SESSION['MatriID'];
                    if(!(isset($login)==0))
                    { 
                ?>
                <li><a href="index_dashboard">Home</a></li>
                <li>Contact Us</li>
                <?php
                    }
                    else
                    {
                ?>
                <li><a href="index">Home</a></li>
                <li>Contact Us</li>
                <?php
                    }
                ?>
                
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Contact Page Section -->
    <section class="newsletter-section contact-page-section">
        <div class="auto-container">
            <div class="row clearfix mt-3">
            <?php include('contactus-info.php');?>
                <!-- Form Column -->
                <div class="form-column col-lg-9 col-md-12 col-sm-12">
				
                <div class="envelope-image"></div>
				
                    <div class="form-inner">
					   <div class="contact-form ">
                            <div class="sec-title">
                                <h2>Address</h2>  
                              <?php  $result=mysqli_query($con,"SELECT * FROM cms where cms_id='9'");
									$rowdata=mysqli_fetch_array($result);?>
							<p class="mt-3"><?php echo $rowdata['content'];?> </p>								
								</div>
							
								

                        <div class="contact-form">
                            <div class="sec-title">
                                <h2>Feedback</h2>
                            </div>
                            <form method="post" action="emailsend" id="contact-form">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" maxlength="40" name="name" placeholder="Name" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" tabindex="1" required>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" maxlength="10" name="phone" placeholder="Phone"  maxlength="10" tabindex="2" onBlur="check_exist1(this.value);"  onkeypress="return isNumber(event)" required>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="email"  name="email" maxlength="35" placeholder="Email"  onkeyup="nospaces(this)" tabindex="3" required="">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="subject" maxlength="70" placeholder="Subject" tabindex="4" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" required>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
									
                                        <textarea  name="message"   maxlength="250" placeholder="Message" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" tabindex="5"></textarea>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                          
                          <button class="theme-btn btn btn-style-one" type="submit" name="submit" style="width:100%"><span class="btn-title" tabindex="11">Submit Now</span></button>
                      </div><canvas id="c"></canvas>
                                </div>
                            </form>
                        </div>
					  </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Contact Page Section -->

    <!-- Map Section -->
    <section class="map-section">
        <div class="auto-container mb-4">
		 <?php   $result1=mysqli_query($con,"SELECT * FROM cms where cms_id='18'");
				 $rowdata1=mysqli_fetch_array($result1);
			
			<iframe src=<?php echo $rowdata1['content'];?>> </iframe>
			
        </div>
    </section>
	
	
    <!-- End Map Section -->

    <!-- Main Footer -->
    <?php include('footer.php')?>
    <!-- End Footer -->

</div>
<!--End pagewrapper-->


<script>
	 function copyToClipboard() {

  var aux = document.createElement("input");
  aux.setAttribute("value", "print screen disabled!");      
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  // Remove it from the body
  document.body.removeChild(aux);
  alert("Print screen disabled!");
}

$(window).keyup(function(e){
  if(e.keyCode == 44){
    copyToClipboard();
  }
});
</script>

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
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin fas "></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script>
</body>
</html>