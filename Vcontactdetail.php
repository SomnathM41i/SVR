<?php require_once('includes/bootstrap.php');

$login=$_SESSION['MatriID']; //or sender id	
 
$searchid=base64_decode( urldecode($_GET['id']) );




?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Get Contact Details</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/regcss.css" rel="stylesheet">
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<!--<script src="_so/js?//stackoverflow.com/questions/23729750/dont-allow-invalid-characters-to-be-pasted-on-textbox" id="so"></script>-->
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="css/stylenew.css" type="text/css" media="all" />

<!-- not allowed to enter any spaces-->
<script type="text/javascript">
function isNumber(evt) 
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) 
    {
        return false;
    }
    return true;
}
 
function nospaces(t)
{
  if(t.value.match(/\s/g))
  {
    alert('Sorry, you are not allowed to enter any spaces');
    t.value=t.value.replace(/\s/g,'');
  }
}
  
</script>
 <script>
   
function ValidateAlpha(evt)
{
  var keyCode = (evt.which) ? evt.which : evt.keyCode
  if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
    return false;
  return true;
}
   
function blockSpecialChar(e)
{ 
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
  xmlhttp.open("GET","fillstate.php?q="+str,true);
  xmlhttp.send();
}
 

</script>
<script>
    function preventBack() {
        window.history.forward();
    }

    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
<script type="text/javascript">

//WORKING ADDRESS
function check_box()
{

  $(document).ready(function (){

  $('#chkPassport').change(function (){
    if ($(this).is(":checked")) {
      $("#working_coun_div").show();
      $("#working_state_div").show();
      $("#working_dist1_div").show();
      $("#working_city_div").show();
      $("#working_add_div").show();
      $("#working_pin_div").show();
      $("#working_residence_div").show();
    } 
    else 
    {
      $("#working_coun_div").hide();
      $("#working_state_div").hide();
      $("#working_dist1_div").hide();
      $("#working_city_div").hide();
      $("#working_add_div").hide();
      $("#working_pin_div").hide();
      $("#working_residence_div").hide();
    }
  });
});

}


//PERMANENT ADDRESS
function check_box1()
{
  $(document).ready(function () 
  {
    $("#check").change(function () 
    {
      if ($(this).is(":checked")) 
      {
        
        $("#country_div").show();
        $("#state_div").show();
        $("#dist1_div").show();
        $("#city_div").show();
        $("#pin_div").show();
        $("#add_div").show();
        $("#add_desc_div").show();
        $("#residence_div").show();
        $('#info_div').show();
        
      } 
      else 
      {
        $("#country_div").hide();
        $("#state_div").hide();
        $("#dist1_div").hide();
        $("#city_div").hide();
        $("#add_div").hide();
        $("#add_desc_div").hide();
        $("#pin_div").hide();
        $("#residence_div").hide();
      }
    });
  });

}
  

  
  
//WORKING ADDRESS 
function checkdiv1(str)
{

  if (str=='Out of India')
  {
    $('#working_city_div').hide();
    $('#working_state_div').hide();
    $('#working_dist1_div').hide();
    $('#working_pin_div').hide();
    $('#working_residence_div').show();
    
  }
  else if( str= 'India')
  {
    $('#working_add_div').show();
    $('#working_city_div').show();
    $('#working_state_div').show();
    $('#working_dist1_div').show();
    $('#working_pin_div').show();
    $('#working_residence_div').show();
  
  }
  else
  {
    
  }
}

//PERMANENT ADDRESS
function checkdiv(str)
{

  if (str=='Out of India')
  {
    $('#state_div').hide();
    $('#city_div').hide();
    $('#dist1_div').hide();
    $('#pin_div').hide();
  }
  else
  {
    $('#state_div').show();
    $('#city_div').show();
    $('#dist1_div').show();
    $('#pin_div').show();
    $('#add_div').show();
    
  }
}
</script>

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


/* Add a right margin to each icon */
.faio {
  margin-left: -12px;
  margin-right: 8px;
}

.alert-info1 
{
  color: #fff;
  background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);
  border-color: #fff;
  font-size: 17px;
  margin-left: 0px;
  
  width: 100%;
  justify-content: center;
  align-items: center;
  
}
@media screen and (max-width: 767px) {
	.alert-info1 {
		margin-left: -30px;
	}
	.alertmes{
		    margin-right: -136px;
    margin-left: -188px;
	}
}
@media screen and (max-width: 568px) {
	.alert-info1 {
		margin-left: -30px;
	}
	.alertmes{
		    margin-right: -136px;
    margin-left: -188px;

	}
}
.sec-title .title {
z
    font-size: 20px !important;
}
</style>
<script type="text/javascript" src ="js/hide.js"></script>
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
  <?php  if(isset($login)&& $regvar=='9') { ?>
   <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Get Contact Details</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Get Contact Details</li>
            </ul>
        </div>
    </section>
  <?php } else { ?>
  <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Get Contact Details</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Get Contact Details</li>
            </ul>
        </div>
    </section>
  <?php } ?>
    <!--End Page Title-->
 
    <!-- Contact Page Section -->
  <section class="newsletter-section">
      			   <div class="auto-container">

		
            <div class=" mt-3">
						<div class="sec-title text-center">
						<?php $refamount= mysqli_query($con,"select * from contactpaidamount where cid='1'");
							$refamt1= mysqli_fetch_array($refamount); ?>
							<span class="title"> Received <?php echo $refamt1['contactamount']?> Rupees Successfully
</span><br>
							<div class="btn-box">
							 <?php 
							
						 
										 
										 //{
											
                             $sqlview=mysqli_query($con,"select * from viewedaddress where who1='$login' and whom1='$searchid' ");
							
							 if(mysqli_num_rows($sqlview)>0)
					          {							 
							  }
							  else 
							  {
								  $insert = mysqli_query($con,"insert into viewedaddress (who1,whom1,when1) values ('$login', '$searchid', '$strviewdate')"); 
								  
								  $qry1=mysqli_query($con,"select * from notification where noti_sender='$login' AND noti_receiver='$searchid' and notification_type='Viewed Contact'");
					
								$row2=mysqli_fetch_array($qry1);
								
								$type=$row2['notification_type']; 
									
								if(mysqli_num_rows($qry1)==0)
								{
								mysqli_query($con,"insert into notification(noti_sender,noti_receiver,notification_type,notification_desc,seen,date_time)values('$login','$searchid','Viewed Contact','Viewed Contact','unseen',NOW())");
								} 							
								
								$viewedmem=  mysqli_query($con,"select * from register where MatriID ='$searchid'"); 
								$viewedmem_rec=mysqli_fetch_array($viewedmem);
							 } 
				            ?>
					
							<?php
							$viewedmem=  mysqli_query($con,"select * from register where MatriID ='$searchid'");
                           
							$viewedmem_rec=mysqli_fetch_array($viewedmem);
							$email2=mysqli_query($con,"select * from emailverify where MatriID ='$searchid' ");
							$emailver=mysqli_fetch_array($email2);
							$doc2=mysqli_query($con,"select * from document where MatriID ='$searchid' ");
							$docver=mysqli_fetch_array($doc2);
                            $planname=$row['memtype'];
							$memty=mysqli_query($con,"select * from   membershipplan where plandisplayname='$planname'");
                            $plannm=mysqli_fetch_array($memty);
							
							?>
							</div>
						</div>
						<div class="pricing-block-three " data-wow-delay="400ms">
							<div class="inner-box">
								<div class="title"><?php echo $viewedmem_rec['MatriID']; ?></div>
								   
								<ul class="features">
								    <li>Name: <?php echo $viewedmem_rec['Name'];?></li>
									  <li>Father Name: <?php echo $viewedmem_rec['Fathername']; ?></li>
									    <li>Mother Name: <?php echo $viewedmem_rec['Mothersname'];?></li>
									<li><?php echo $viewedmem_rec['ConfirmEmail'];?> , <?php echo $viewedmem_rec['Mobile']?> , <?php echo $viewedmem_rec['Mobile2']?></li>
									<li>Date of birth- <?php $explodedate=explode("-",$viewedmem_rec['DOB']);
					                $explodedatedisplay=$explodedate[2]."-".$explodedate[1]."-".$explodedate[0];echo $explodedatedisplay;?>, Place of birth-  <?php echo $viewedmem_rec['POB']?>, Time of birth-  <?php echo $viewedmem_rec['TOB']?></li>
									<li>Address-  <?php echo $viewedmem_rec['Address']?></li>
									<li>Country-  <?php echo $viewedmem_rec['Country']?>,
									State-  <?php echo $viewedmem_rec['State']?>,
									District-  <?php echo $viewedmem_rec['Dist']?>,
									City-  <?php echo $viewedmem_rec['City']?></li>
									<li>Working Address-  <?php echo $viewedmem_rec['work_address']?></li>
									<li>Working Country-  <?php echo $viewedmem_rec['working_country']?>,
									Working State-  <?php echo $viewedmem_rec['working_state']?>,
									Working District-  <?php echo $viewedmem_rec['working_dist']?>,
									Working Taluka- <?php echo $viewedmem_rec['working_taluka'] ?? ''?><br>
									Working City- <?php echo $viewedmem_rec['working_city']?></li>
									<li class="true">Mobile verified <?php if($viewedmem_rec['verifymobile']==1){ ?><i class="fa fa-check-square mr-3"></i><?php } else {?> <i class="fa fa-window-close mr-3"></i><?php } ?>
											IDProof verified<?php if($viewedmem_rec['idproof_approve']=='Yes') { ?><i class="fa fa-check-square mr-3"></i><?php } else {?> <i class="fa fa-window-close mr-3"></i><?php } ?><br>
											Email verified<?php if($emailver['verification']=='Yes'){?> <i class="fa fa-check-square mr-3"></i><?php } else { ?> <i class="fa fa-window-close mr-3"></i><?php } ?>
											Document verified <?php if($docver['docapprove']=='Yes'){?> <i class="fa fa-check-square mr-3"></i><?php } else { ?> <i class="fa fa-window-close mr-3"></i><?php } ?>
									</li>
									<?php if(($viewedmem_rec['HorosApprove']=='Yes')&&($viewedmem_rec['horoscope']!='')) {?>
									<li> 
											Horoscope Details: <img class="ml-1" src="kundli/<?php echo $viewedmem_rec['horoscope'];?>" style="height:20px;width:20px" />
					     				<a href="kundli/<?php echo $viewedmem_rec['horoscope'];?>" style="color:#6f42c1" target="_blank"><span class="ml-1">View<span></a> 
									</li>
									<?php } else { }?>
									<li>
									</li>
								</ul>
								
							</div>
						</div>
					</div>
										
						
						<?php //}?>
						
						</div>
							   
                <!-- Form Column -->
                    </div>
    </div>
  </section>
  <?php include('footer.php')?>
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->
<!-- End Color Switcher -->

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
<script src="css2/jquery.min.js"></script>
<script src="css2/bootstrap.bundle.min.js"></script>
<script src="css2/bootstrap-select.min.js"></script>

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>

<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/validate.js"></script>
<script src="js/script.js"></script>

<!--<script>
$('select').selectpicker();
</script>-->


<!-- Color Setting -->
<script src="js/color-settings.js"></script>
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
<script type="text/javascript">
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
   
function filldist1(str)
{
  
  var xmlhttp;
  if (str=="")
    {
      document.getElementById("working_dist").innerHTML="";
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
        document.getElementById("working_dist").innerHTML=xmlhttp.responseText;
      }
  }
  xmlhttp.open("GET","fill_dist1.php?q="+str,true);
  xmlhttp.send();
}


</script>
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
</script>


</body>
</html>
