<?php require_once('sys_dbconnection.php');
/*include('dbconnectadmin.php');*/
//error_reporting(0);
include('smtp2.php');
$email = addslashes($_POST['user']);

	$mememail=$_POST['user'];

  
if (filter_var($email, FILTER_VALIDATE_EMAIL)){

			
$query="SELECT * FROM siteconfig where ID='1'";
$configdata=mysqli_query($con,$query) or die(mysqli_error()); 
$info=mysqli_fetch_array($configdata);

	$mememail=$_POST['user'];
	$query1="SELECT * FROM register where ConfirmEmail='$mememail'";
	$forpass=mysqli_query($con,$query1) or die(mysqli_error()); 
	$forpass1=mysqli_fetch_array($forpass);
	$qry="select * from cms where link='contact us'";
	$qry1=mysqli_query($con,$qry);
	$row=mysqli_fetch_array($qry1);
  $query11="SELECT * FROM register where ConfirmEmail='$mememail' and Status='Banned'";
     //echo" SELECT * FROM register where ConfirmEmail='$mememail' and Status='Banned'";
	$forpass2=mysqli_query($con,$query11) or die(mysqli_error()); 
	$count=mysqli_num_rows($forpass2);
	//echo $count;
	if($count==0)
	{
		
if($forpass1>0)
{
		$address=$row['content'];
		$Name=$forpass1['Name'];
		$email=$forpass1['ConfirmEmail'];
		$_SESSION['email']=$email;
		$Mobile=$forpass1['Mobile'];
		$ConfirmPassword=$forpass1['ConfirmPassword'];
		$MatriID=$forpass1['MatriID'];
		$webfriendlyname=$info['WebFriendlyname'];

		$logo =$info['Weblogopath'];
		$site_name=$info['Webname'];
		$webname=$info['WebFriendlyname'];
		$dates=date('d-m-Y');
		
		$message ="<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Forgot Password</title>

</head>

<body>
<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='222'><img src='http://localhost/SVR/css3/assets/shivraj-logo.png' width='168' height='50'  alt=''/></td>
    <td colspan='2' align='center' valign='middle'>Date: $dates</td>
  </tr>
  <tr>
   
  </tr>
  <tr>
    <td height='20' colspan='3'><p>Dear ".$forpass1['Name'].",<br>
      We have received your forgot password request. <br>
      Your Matrimony ID: <strong style='font-size:26px'>".$forpass1['MatriID']."</strong><br>
    </p></td>
  </tr>
  
  <tr>
    <td colspan='2' valign='top'>Use the link to recover password: <br>
      <a href='#'><a href='https://weddingsparampara.com/new_pass.php?ID=$MatriID'>Click Here</a><br></td>
    <td width='24'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Warm Regards,</td>
    <td width='221'>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='2'>Team: <a href='$site_name'>$site_name </a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
";

	$subject="Reset Password Request";
	$email=$mememail;
	$mail->Subject=$subject;
	$mail->MsgHTML($message);
	$msg="";
	if($email!="")
			{
					set_time_limit(30);
					$mail->ClearAddresses();
					$mail->AddAddress($email);
					$mail->Send();
				
					$msg="Reset instructions have been mailed to: <strong>'".$_SESSION['email']."'</strong><br><br>

		Be sure to check your Junk folder if you do not see an email from us in your Inbox within a few minutes.";
			}
	
 ?>
 <?php
function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}

}
else
{
	$msg="Oops.! We Can't Found Your Record.";
}



} else {
	$msg="Your account has been Blocked.";
	}

	} else {
		$email = stripslashes($email);
		$msg="$email is not a valid email address";
	}
		
?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Forgot Password</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">



<script type="text/javascript">
 function checkdiv(str)
{

  if (str=='Unmarried')
  {
    $('#noofchild').hide();
    $('#childstatus').hide();
    
  }
    else
  {
    $('#noofchild').show();
    $('#childstatus').show();
    
  }
}
</script>
<!-- not allowed to enter any spaces-->
<script type="text/javascript">
  function nospaces(t)
{
if(t.value.match(/\s/g)){
alert('Sorry, you are not allowed to enter any spaces');
t.value=t.value.replace(/\s/g,'');
}}
</script>
<!-- end allowed to enter any spaces-->
<!-- check password length-->
<script type="text/javascript">
  function CheckLengthPassword(el) {
  document.getElementById("passeror").style.display = 'none';
  if(el.value.length!=0){
  if (el.value.length < 5 ) {
  document.getElementById("passeror").style.display = 'block';
  document.getElementById("passeror").style.color = "#ff0000";
  document.getElementById('pass').value="";
  document.getElementById('pass').focus();
  return false;
     } 
   }
} 
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
function check_exist123(str)
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
    document.getElementById("emailerror").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","check_email_exist.php?q="+str,true);
xmlhttp.send();
} 

</script>
<!-- end check password length-->
<style>

/* Add a right margin to each icon */
.fas {
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
            <h1  class="d-none d-lg-block d-xl-block d-md-block">Forgot Password</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Forgot Password</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!-- Signup Form -->
    <section class="newsletter-section">
        <div class="anim-icons full-width">
            <!--<span class="icon icon-shape-3 wow fadeIn"></span>-->
            <span class="icon icon-line-1 wow fadeIn"></span>
        </div>
        <div class="auto-container">
            <!--Subscribe Form-->
            <div class="subscribe-form wow fadeInUp" data-wow-delay="500ms " >
             
                <div class="form-inner">
                    <div class="upper-box">
                        <div class="sec-title text-center mt-5">
                       
                            <div class="text"><?php echo $msg;?><br>
							<a href="forgot_password"><button class="theme-btn btn btn-style-three mt-3" type="submit" name="submit" ><span class="btn-title"> Go Back</span></button></a>
                        </div>
                    </div>
                   
            
                   
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

<!-- Color Palate / Color Switcher -->
<!-- End Color Switcher -->

<!--Search Popup-->


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
    var loadingText = '<i class="fa fa-spinner fa-spin  fas"></i><span class="btn-title">Loading</span> ';
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