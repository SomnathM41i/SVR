<?php //include_once('siteconfig.php');
require_once('includes/bootstrap.php');?>
<?php //include_once('memprotect.php');

error_reporting(0);


?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Delete Profile</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link href="css/pagination.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css/pagination.css" rel="stylesheet">
<style>

.register-form .form-group textarea {
    
	height: 150px;
	
    top: 15px;
}
.speaker-block-three .info-box:before 
{   
right: -43px;
}
.speakers-section-three 
{
padding: 36px 0 90px
}
.speakers-section:before 
{   
 background-color: #ffffff;
}
</style>
<style>
.page-title 
{
  padding: 20px 0;
}
</style>

<style>
.register-form input[type="submit"] {
width:50%;
}
.price{
font-size: 14px;
color: #848484;
display: inline;
padding: 5px;
margin-left: 1px;
margin-bottom:2px;
font-weight: 500;

}
.radiostye{
vertical-align: middle;
}

</style>
<script>
function getFeedback(id)
{			
	var str = "";
	if(id==1)
	{
		str="<textarea rows='3' maxlength='150' class='' name='reason' value='I Found My Match on This Site' required>I Found My Match on This Site</textarea><br>";
		}
	if(id==3)
	{
		str="<textarea rows='3' maxlength='150' class='' name='reason' placeholder='Give Your Reason' value='I Found My Match Elsewhere' required>I Found My Match Elsewhere</textarea><br>";	
	}
	if(id==5)
	{		str="<textarea rows='2' maxlength='150' class='' name='reason' placeholder='Give Your Reason' required></textarea><br>";		
	}
	if(id==2)
	{
		str="<textarea class='form-control' name='reason' placeholder='Please Mention The Site' required></textarea><br>";			
	}
	if(id==4)
	{		
	      str="<textarea  maxlength='150' class='' name='reason' placeholder='Give Your Reason' required>I'm Unhappy With Matrimonial Services</textarea><br>";		
	}

	str = str+"<div  class='register-form'><a><button class='theme-btn btn-style-one' type='submit' style=''><span class='btn-title'>Confirm Delete</span></button></a><br><br></div>"
	document.getElementById("input").innerHTML = str;
	document.getElementById("type").value=id;
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

<?php include('header.php')?>

	</div>
<section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1> Delete Profile</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Delete Profile</li>
            </ul>
        </div>
</section>
<section class="about-section">
<div class="anim-icons full-width">
<span class="icon icon-circle-blue wow fadeIn"></span>
<span class="icon icon-circle-1 wow zoomIn"></span>
</div>
<div class="auto-container">
<div class="row">
<!-- Content Column -->
<div class="content-column col-lg-12 col-md-12 col-sm-12">
	<div class="inner-column">
		<div class="sec-title">
		  <div class="comments-area">
			
		  <form method="post" action="delete_confirm" class="register-form">
			 
			<div class="comment-box">
				<div class="comment ml-auto">								
					<div class="comment-info">									
					 <div class="form-group option-box">    
			<label>Tell Us The Reason That Why You Are Going To Delete Your Profile  </label>   <br><br>


					1.	 <span class="price" style="font-size:17px;"><a style="cursor:pointer" id="1" onClick="getFeedback(this.id)">I Found My Match on This Site</a></span>  <br>
					2.   <span class="price" style="font-size:17px;"><a style="cursor:pointer" id="2" onClick="getFeedback(this.id)">I Found My Match on Another Matrimonial site </a></span>  <br>
					3.   <span class="price" style="font-size:17px;"><a style="cursor:pointer" id="3" onClick="getFeedback(this.id)">I Found My Match Elsewhere</a></span>  <br>
					4.   <span class="price" style="font-size:17px;"><a style="cursor:pointer" id="4" onClick="getFeedback(this.id)">I'm Unhappy With Matrimonial Services</a></span>  <br>
					5.   <span class="price" style="font-size:17px;"><a style="cursor:pointer" id="5" onClick="getFeedback(this.id)">Any Other Reason</a></span>   <br>
					<input id='type' type="hidden" name="type">

					<br>
					<input type="checkbox" class="radiostye"  value="Yes"  id="ig_checkbox"  checked>
					<label><a href="terms-conditions" target="_blank"> I Have Understood & Agreed To The 'Terms & Condition' & 'Privacy Policy'.</a>
					</label><br>
                    <div id="input"> </div>					
					</div>	
						
						
					</div>     
				  
				 </div> 									
				</div>
				</form>
			  
		   </div>
						
	   

		  
		</div>
	  
</div> 
</div>
</div>

</section>						 
		
<?php include('footer.php')?>
</div>            


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
<script src="js/color-settings.js"></script>
</body>
</html>