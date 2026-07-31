<?php require_once('sys_dbconnection.php');
include('memprotect.php');
$ry=mysqli_query($con,"select * from basic_saveandsearch where id='".$_GET['id']."'");             
$fethc=mysqli_fetch_array($ry);
$count=mysqli_num_rows($ry);
if($count==1)
{
	$txt="Search1";
}if($count==2)
{
	$txt="Search2";
}if($count==3)
{
	$txt="Search3";
}if($count==4)
{
	$txt="Search4";
}if($count==5)
{
	$txt="Search5";
}
mysqli_query($con,"update basic_saveandsearch set search_name='$txt' where id='".$_GET['id']."'");

?> 
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Enter Search Name</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="_so/js?//stackoverflow.com/questions/23729750/dont-allow-invalid-characters-to-be-pasted-on-textbox" id="so"></script>
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">




<!-- not allowed to enter any spaces-->
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
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
<style>

/* Add a right margin to each icon */
.faio {
  margin-left: -12px;
  margin-right: 8px;
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

    <!--Page Title-->
   <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Enter Search Name</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Enter Search Name</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    
    <!-- Contact Page Section -->
    <section class="contact-page-section">
	  <div class="auto-container">
            <div class="row clearfix">
              

                <!-- Form Column -->

 <div class="form-column col-lg-8 col-md-12 col-sm-12 offset-sm-4">
         <div class="inner-column">
               <div class="contact-form">
                      <div class="sec-title">
                             <h2 class="ml-5">Enter Search Name</h2>
                       </div>
					   <form action="regular_search_result?page=1&id=<?php echo $_GET['id'];?>" method="post">
                       <!--<form method="post" action="#" id="contact-form">-->
                         <div class="row clearfix">
                             <div class="col-lg-6 col-md-12 col-sm-12 form-group">
							  
						          <input name="search_name" placeholder="Enter search name" value="" class="" type="text" required >
                             	  </div>
                                  <div class="col-lg-12 col-md-12 col-sm-12 form-group offset-sm-2" style="margin-left:93px;">
                               <button class="theme-btn btn btn-style-one" type="submit" name="basicsaveandsearch" ><span class="btn-title">Search Submit </span></button>
							
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
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->

<!--Search Popup-->


<!--Scroll to top-->
	<script>
$('input').on('input', function(){
  this.value = this.value.replace(/[^\w]/g,"");
});
</script>
	<script>
 $('#mobile2').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
$('#Phone').bind("cut copy paste",function(e) {
  e.preventDefault();
});
$('#myInput').bind("cut copy paste",function(e) {
  e.preventDefault();
});
</script>
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
    var loadingText = '<i class="fa fa-spinner fa-spin faio"></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script><script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin fas"></i><span class="btn-title">Loading</span> ';
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