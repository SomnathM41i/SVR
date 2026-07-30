<?php include('dbconnectadmin.php');
include('sys_dbconnection.php');
//include('memprotect.php');
?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Basics & Lifestyle</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="modal.css" rel="stylesheet">
<script src="css2/tick.js"></script>
<link href="css/boostrapnewtick.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link href="css/regcss.css" rel="stylesheet">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="css/stylenew.css" type="text/css" media="all" />

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
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script> 
<script type="text/javascript">
  function getfocustxt()
  {
  document.querySelector('[tabindex="1"]').focus();
}
</script>
<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
		function showotherdist()
	   {
			
		if(document.getElementById("scases").value=="None")
		{
		document.getElementById("otherdist").style.visibility="hidden";
		}
		else
		{
			document.getElementById("otherdist").style.visibility="visible";
		}
		
	}
	</script>
	<style>


.dropselect
{
	padding: 15px 30px;
	height: 60px;
	width: 115%;
}
		.close
{
  color: #fff;
  opacity: 20;
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
	<?php  if(isset($login)&& $regvar=='9') { ?>
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1>Basics & Lifestyle</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Basics & Lifestyle</li>
            </ul>
        </div>
    </section>
	<?php } else { ?>
	<section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1>Basics & Lifestyle</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Basics & Lifestyle</li>
            </ul>
        </div>
    </section>
	<?php } ?>
	<?php 
$ID=$_GET['id'];
$hiddenregstep=mysqli_query($con,"select * from register where MatriID='$ID'");
$hiddenfetch=mysqli_fetch_array($hiddenregstep);
if($hiddenfetch['reg_step']=="4")
{
mysqli_query($con,"update register set reg_step='5' where MatriID='$ID'");
}
if(isset($_POST['submit']))
{
$height=mysqli_real_escape_string($con,$_POST['height']);
$weight=mysqli_real_escape_string($con,$_POST['weight']);
$bgroup=mysqli_real_escape_string($con,$_POST['bgroup']);
$complexion= mysqli_real_escape_string($con,$_POST['complexion']);
$btype=mysqli_real_escape_string($con,$_POST['btype']);
$scases=mysqli_real_escape_string($con,$_POST['scases']);
$diet=mysqli_real_escape_string($con,$_POST['diet']);
$smoke=mysqli_real_escape_string($con,$_POST['smoke']);
$drink=mysqli_real_escape_string($con,$_POST['drink']);
$sreason=mysqli_real_escape_string($con,$_POST['otherdist']);  
$ohobbies=mysqli_real_escape_string($con,$_POST['ohobbies']);
$spec=mysqli_real_escape_string($con,$_POST['spec']);
if(isset($login)&& $regvar=='9') {
if($scases=="None")
{
mysqli_query($con,"update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',OtherHobbies='$ohobbies',Spectacles='$spec' where MatriID='$login'");
//echo "update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',Hobbies='$hobbies',OtherHobbies='$ohobbies',Interests='$interest',OtherInterests='$ointerest' where MatriID='$login'";
//exit;
}
else
{
mysqli_query($con,"update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',spe_reason='$sreason',OtherHobbies='$ohobbies',Spectacles='$spec' where MatriID='$login'");
//echo "update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',spe_reason='$sreason',Hobbies='$hobbies',OtherHobbies='$ohobbies',Interests='$interest',OtherInterests='$ointerest' where MatriID='$login'";
//exit;	

}
header('Location: index_dashboard');
exit;
}
else
{
if($scases=="None")
{
mysqli_query($con,"update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',OtherHobbies='$ohobbies',Spectacles='$spec',reg_step='6' where MatriID='$ID'");
//echo "update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',Hobbies='$hobbies',OtherHobbies='$ohobbies',Interests='$interest',OtherInterests='$ointerest',Spectacles='$spec',reg_step='6' where MatriID='$ID'";
//exit;
}
else
{
mysqli_query($con,"update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',spe_reason='$sreason',OtherHobbies='$ohobbies',Spectacles='$spec',reg_step='6' where MatriID='$ID'");
//echo "update register set Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',Bodytype='$btype',spe_cases='$scases',Diet='$diet',Smoke='$smoke',Drink='$drink',spe_reason='$sreason',Hobbies='$hobbies',OtherHobbies='$ohobbies',Interests='$interest',OtherInterests='$ointerest',Spectacles='$spec',reg_step='6' where MatriID='$ID'";
//exit;
}

header('location:family?id='.$ID);
}
}

?>
	
	
	
	
    <!--End Page Title-->

    <!-- Contact Page Section -->
    <section class="newsletter-section contact-page-section">
        <div class="auto-container">
		<?php if($_GET['message']=='success') {?>
		<div class="alert alert-info" align="center" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Your Details Updated Successfully 
				  </div>
		<?php } ?>
		
            <div class="row clearfix mt-3">
            
                <!-- Form Column -->
				<?php  if(isset($login)&& $regvar=='9')
                    {?>
				  <div class="form-column col-lg-9 col-md-12 col-sm-12">
				  <div class="subscribe-form wow fadeInUp" data-wow-delay="500ms">
                <div class="envelope-image"></div>
         <div class="form-inner">
                <!-- <div class="contact-form">
                    <div class="sec-title">
                             <h2>Edit Basics & Lifestyle</h2>
                       </div>-->
                       <form method="post" action="#">
                         <div class="row clearfix mt-2">
                             <div class="col-lg-5 col-md-5 col-sm-12 form-group green mr-2">
                             	 <!--<label style="margin-top: -25px;">Height</label>-->
                                  <select class="selectpicker dropcss drop" multiple data-max-options="1" data-live-search="true" data-width="90%" title="Select Height" name="height" tabindex="1" required>
							<?php if($me['Height']=="")
			{
				 ?>
                        <option value="">Select Height</option>
                        <?php } else
			  { $strheight = $me['Height'];
if($strheight =="1") { $height= "4ft"; }
else if($strheight =="2") { $height= "4Ft 1 inch"; }
else if($strheight =="3") { $height= "4Ft 2 inch"; }
else if($strheight =="4") { $height= "4Ft 3 inch"; }
else if($strheight =="5") { $height= "4Ft 4 inch"; }
else if($strheight =="6") { $height= "4Ft 5 inch"; }
else if($strheight =="7") { $height= "4Ft 6 inch"; }
else if($strheight =="8") { $height= "4Ft 7 inch"; }
else if($strheight =="9") { $height= "4Ft 8 inch"; }
else if($strheight =="10") { $height= "4Ft 9 inch"; }
else if($strheight =="11") { $height= "4Ft 10 inch"; }
else if($strheight =="12") { $height= "4Ft 11 inch"; }
else if($strheight =="13") { $height= "5Ft"; }
else if($strheight =="14") { $height= "5Ft 1 inch"; }
else if($strheight =="15") { $height= "5Ft 2 inch"; }
else if($strheight =="16") { $height= "5Ft 3 inch"; }
else if($strheight =="17") { $height= "5Ft 4 inch"; }
else if($strheight =="18") { $height= "5Ft 5 inch"; }
else if($strheight =="19") { $height= "5Ft 6 inch"; }
else if($strheight =="20") { $height= "5Ft 7 inch"; }
else if($strheight =="21") { $height= "5Ft 8 inch"; }
else if($strheight =="22") { $height= "5Ft 9 inch"; }
else if($strheight =="23") { $height= "5Ft 10 inch"; }
else if($strheight =="24") { $height= "5Ft 11 inch"; }
else if($strheight =="25") { $height= "6Ft"; }
else if($strheight =="26") { $height= "6Ft 1 inch "; }
else if($strheight =="27") { $height= "6Ft 2 inch"; }
else if($strheight =="28") { $height= "6Ft 3 inch"; }
else if($strheight =="29") { $height= "6Ft 4 inch"; }
else if($strheight =="30") { $height= "6Ft 5 inch"; }
else if($strheight =="31") { $height= "6Ft 6 inch"; }
else if($strheight =="32") { $height= "6Ft 7 inch"; }
else if($strheight =="33") { $height= "6Ft 8 inch"; }
else if($strheight =="34") { $height= "6Ft 9 inch"; }
else if($strheight =="35") { $height= "6Ft 10 inch"; }
else if($strheight =="36") { $height= "6Ft 11 inch"; }
else if($strheight =="37") { $height= "7Ft"; }
 ?>
                        <option value="<?php echo $strheight; ?>"  selected><?php echo $height; ?></option>
                        <?php } ?>
						  
                         <option value="1" >4Ft </option>
                        <option value="2" >4Ft 1 inch </option>
                        <option value="3" >4Ft 2 inch </option>
                        <option value="4" >4Ft 3 inch </option>
                        <option value="5" >4Ft 4 inch </option>
                        <option value="6" >4Ft 5 inch </option>
                        <option value="7" >4Ft 6 inch </option>
                        <option value="8" >4Ft 7 inch </option>
                        <option value="9" >4Ft 8 inch </option>
                        <option value="10" >4Ft 9 inch </option>
                        <option value="11" >4Ft 10 inch </option>
                        <option value="12" >4Ft 11 inch </option>
                        <option value="13" >5Ft </option>
                        <option value="14" >5Ft 1 inch </option>
                        <option value="15" >5Ft 2 inch </option>
                        <option value="16" >5Ft 3 inch </option>
                        <option value="17" >5Ft 4 inch </option>
                        <option value="18" >5Ft 5 inch </option>
                        <option value="19" >5Ft 6 inch </option>
                        <option value="20" >5Ft 7 inch </option>
                        <option value="21" >5Ft 8 inch </option>
                        <option value="22" >5Ft 9 inch </option>
                        <option value="23" >5Ft 10 inch </option>
                        <option value="24" >5Ft 11 inch </option>
                        <option value="25" >6Ft </option>
                        <option value="26" >6Ft 1 inch </option>
                        <option value="27" >6Ft 2 inch </option>
                        <option value="28" >6Ft 3 inch </option>
                        <option value="29" >6Ft 4 inch </option>
                        <option value="30" >6Ft 5 inch </option>
                        <option value="31" >6Ft 6 inch </option>
                        <option value="32" >6Ft 7 inch </option>
                        <option value="33" >6Ft 8 inch </option>
                        <option value="34" >6Ft 9 inch </option>
                        <option value="35" >6Ft 10 inch </option>
                        <option value="36" >6Ft 11 inch </option>
                        <option value="37" >7Ft </option>
						</select>
						<span></span>
                             
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                            	<!--<label>Weight</label>-->
                    <select class="selectpicker dropcss drop" multiple data-max-options="1" data-live-search="true" title="Select Weight" data-width="90%" name="weight" tabindex="2">
                         <?php
					$default="";
                    for($i=40;$i<=150;$i++)
					{
						if($me['Weight']==$i)
							$default="selected";
						else
							$default="";
						?>
                        <option value="<?php echo $i;?>" <?php echo $default?>><?php echo $i." kg" ?></option>
                        <?php
					}
					?>
                    </select>
                             </div>

                              <div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2">
                                <!--<label style="margin-top: -25px;">Blood Group</label>-->
                                <select class="selectpicker dropcss drop" multiple data-max-options="1" title="Select Blood Group" data-live-search="true" data-width="90%" name="bgroup" tabindex="3">
                              <?php if($me['BloodGroup']=="")
                            { ?>
                        <!--<option value="" selected>Select Blood Group</option>-->
                        <?php } else { ?>
                        <option value="<?php echo $me['BloodGroup'];?>" selected><?php echo $me['BloodGroup'];?></option>
                        <?php } ?>
                               <?php
                                $BloodGroup=mysqli_query($con,"select * from blood_group ");
                                while($edurow=mysqli_fetch_array($BloodGroup))
                                {?>
                                <option value="<?php echo $edurow['type'] ?>"><?php echo $edurow['type'] ?></option>
                              <?php } ?>
                                 </select>
                               </div>

                               <div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                                    <!--<label>Complexion</label>-->
						<select class="selectpicker dropcss drop" title="Select Complexion" multiple data-max-options="1" data-live-search="true" data-width="90%" name="complexion" tabindex="4">
							 <?php if($me['Complexion']=="")
                            { ?>
                        <!--<option value="" selected>Select Complexion</option>-->
                        <?php } else { ?>
                        <option value="<?php echo $me['Complexion'];?>" selected><?php echo $me['Complexion'];?></option>
                        <?php } ?>                                   
								    <?php 	            
			           $Complexionsql=mysqli_query($con,"select * from complexion where complexion!='".$me['Complexion']."' ");
			           while($Complexionrow=mysqli_fetch_array($Complexionsql))
			          { ?>
                       <option value="<?php echo $Complexionrow['complexion'];?>" ><?php echo $Complexionrow['complexion'];?></option>
                       <?php	
				     }?>
                  </select>
                              </div> 
                                
                              <div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2" >
                                 <!--<label>Body type</label>-->
						<select class="selectpicker form-control dropcss drop" title="Select Body type" multiple data-max-options="1" data-live-search="true" data-width="90%" name="btype" tabindex="5">
							<?php if($me['Bodytype']=="") { ?>
                        <!--<option value="" selected>Select Body type</option>-->
                        <?php } else { ?>
                        <option value="<?php echo $me['Bodytype'];?>" selected><?php echo $me['Bodytype'];?></option>
                        <?php } ?>
                   <?php 	            
			           $Bodytypesql=mysqli_query($con,"select * from body_type where body_type!='".$me['Bodytype']."'");
			           while($Bodytype=mysqli_fetch_array($Bodytypesql))
			          { ?>
				        
                       <option value="<?php echo $Bodytype['body_type'];?>" ><?php echo $Bodytype['body_type'];?></option>
                       <?php	
				        }?>
						</select>
                               </div>
                                    
                              <div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                                <!--<label>Diet</label>-->
						<select class="selectpicker dropcss drop" multiple data-max-options="1" title="Select Diet"  data-live-search="true" data-width="90%" name="diet" tabindex="6">
							<?php if($me['Diet']=="")
							{ ?>
                        <!--<option value="" selected>Select Diet</option>-->
                        <?php } else { ?>
                        <option value="<?php echo $me['Diet'];?>" selected><?php echo $me['Diet'];?></option>
                        <?php } ?>
                      <?php 	            
			           $Dietsql=mysqli_query($con,"select * from diet where diet_type!='".$me['Diet']."'");
			           while($Dietsq=mysqli_fetch_array($Dietsql))
			          { ?>
                      <option value="<?php echo $Dietsq['diet_type'];?>" ><?php echo $Dietsq['diet_type'];?></option>
                      <?php } ?>
                   
						</select>
                               </div>

						<div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2">
                           <!--<label>Smoke</label>-->
						<select class="selectpicker dropcss drop" multiple data-max-options="1" title="Select Smoke" data-live-search="true" data-width="90%" name="smoke" tabindex="7">
							<?php if($me['Smoke']=="")
						{ ?>
                        <!--<option value="" selected>Select Smoke</option>-->
                        <?php } else { ?>
                        <option value="<?php echo $me['Smoke'];?>" selected><?php echo $me['Smoke'];?></option>
                        <?php } ?>
							
                      <?php 	            
			           $Smokesql=mysqli_query($con,"select * from smoke where smoke_type!='".$me['Smoke']."'");
			           while($smokesq=mysqli_fetch_array($Smokesql))
			          { ?>
                      
                      <option value="<?php echo $smokesq['smoke_type'];?>" ><?php echo $smokesq['smoke_type'];?></option>
                      <?php } ?>
						</select>
                          </div>

				 <div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                           <!--<label>Drink</label>-->
                   <select name="drink" class="selectpicker dropcss drop" title="Select Drink" multiple data-max-options="1" data-live-search="true" data-width="90%" style="margin-top:0px" tabindex="8">
                   	<?php if($me['Drink']==""){ ?>
                        <!--<option value="">Select Drink</option>-->
                    <?php } else {?>    
                        <option value="<?php echo $me['Drink']; ?>" selected><?php echo $me['Drink']; ?></option><?php }?>
                        
						 <?php 	            
			           $Drinksql=mysqli_query($con,"select * from drink where Drink_type!='".$me['Drink']."'");
			           while($drink=mysqli_fetch_array($Drinksql))
			          { ?>
                      
                      <option value="<?php echo $drink['Drink_type'];?>" ><?php echo $drink['Drink_type'];?></option>
                      <?php } ?>
     				 </select>
                          </div>
						 <div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2">
						<!--<label>Spectacles </label>-->
						<select class="selectpicker dropcss drop" title="Select Spectacles" multiple data-max-options="1" data-live-search="true" data-width="90%" name="spec" id="spec" tabindex="9">
							<?php if($me['Spectacles']=="")
						         {?>
					         <!--<option value="" selected>Select Spectacles</option>-->
						       <?php } else { ?>
						     <option value="<?php echo $me['Spectacles']?>" selected><?php echo $me['Spectacles']?></option>
							<?php } ?>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
								
						</select>
						 </div>
					 <div class="col-lg-5 col-md-5 col-sm-12 form-group red ">
                         <!--<label>Hobbies/Interests</label>-->
                         <textarea type="text"  cols="1" rows="2" name="ohobbies" class="agile-ltext"  MAXLENGTH="100" placeholder="Enter Hobbies/Interest" tabindex="10" style="height:60px;" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" value="<?php echo $me['OtherHobbies']?>"><?php echo $me['OtherHobbies']?></textarea>
						 
                     </div>
					 <div class="styled-input col-md-8 offset-md-5 mb-2">
					 <span style="font-size: 14px">Please enter your hobbies/interests</span>
					</div>

			       <div class="col-lg-11 col-md-11 col-sm-12 form-group red" style="max-width:84%">
                            <!--<label>Special Cases</label>-->
                   <select name="scases" id="scases" tabindex="11" title="Select Special Cases" class="selectpicker dropcss drop colm" multiple data-max-options="1" data-live-search="true" data-width="90%" style="margin-top:0px" onChange="showotherdist(this.value);">
                   	 <?php if($me['spe_cases']=="") { ?>
                       <!--<option value="" selected >Select Special Cases</option>-->
                        <?php } else { ?>
                        <option value="<?php echo $me['spe_cases'];?>" selected><?php echo $me['spe_cases'];?></option>
                        <?php } ?>
                    
      						 <?php 	            
			          $special=mysqli_query($con,"select * from special_case where case_type!='".$me['spe_cases']."'");
						while($case=mysqli_fetch_array($special))
						{ ?>
                          <option value="<?php echo $case['case_type'];?>" ><?php echo $case['case_type'];?></option>
							
						   <?php }  ?>
     				 </select>
                    </div>
					
                    
                    <?php if($me['spe_cases']=="None"){ ?>
                    <div class="col-lg-11 col-md-11 col-sm-12 form-group red" style="visibility:hidden;max-width:84%" id="otherdist">
						
                    	  <textarea type="text" rows="2"  name="otherdist" class="form-control"  onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" placeholder="Please Specify" maxlength="150"><?php echo $me['spe_reason'];?></textarea>
					</div>
					 <?php } else { ?>
					 	<div class="col-lg-11 col-md-11 col-sm-12 form-group red"   style="max-width:84%" id="otherdist" tabindex="11">
						<!--<label>Special Reason</label>-->
                        <textarea type="text" name="otherdist" rows="2" MAXLENGTH="150" class="agile-ltext"  placeholder="Please Specify"><?php echo $me['spe_reason'];?></textarea>
                    </div>
					<?php }?>
					        

						<!--<div class="col-lg-6 col-md-6 col-sm-6 form-group">
                          <label>Hobbies</label>
<select class="category2 selectpicker" name="hobbies[]" multiple rows="5" required data-live-search="true" style="height:140px;">
						 
							<option value="<?php //echo $me['Hobbies']?>" selected><?php //echo $me['Hobbies']?></option>
						   <?php //$Hobbies=mysqli_query($con,"select * from hobbies ");
						//while($hobbies=mysqli_fetch_array($Hobbies))
						//{ ?>
                          <option value="<?php //echo $hobbies['hobbies'];?>" ><?php //echo $hobbies['hobbies'];?></option>
						   <?php //}  ?>
						</select>
						<span style="font-size: 14px">Please use Ctrl+ for multiple selection</span>
						<span></span>
                      </div>

							       <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                         <!--<label>Interests</label>
<select class="category2 selectpicker" name="interest[]" multiple data-live-search="true" style="height:140px;">
							<option value="<?php //echo $me['Interests']?>" selected><?php //echo $me['Interests']?></option>
						   <?php //$Interests=mysqli_query($con,"select * from interest");
						//while($interest=mysqli_fetch_array($Interests))
						//{ ?>
                          <option value="<?php //echo $interest['interest'];?>" ><?php //echo $interest['interest'];?></option>
						   <?php //}  ?>
						</select>
						<span style="font-size: 14px">Please use Ctrl+ for multiple selection</span>
						<span></span>
                         </div>
						 
						 <div class="styled-input form-group col-md-6">
					  <!--<label>Other Hobbies </label>
                        <textarea type="text"  rows="2" name="ohobbies" class="form-control"  placeholder="Enter Here" value="<?php //echo $me['OtherHobbies']?>"><?php //echo $me['OtherHobbies']?></textarea>
					</div>
                    
                    <div class="styled-input form-group col-md-6">
					  <!--<label> Other Interests</label>
                        <textarea type="text"  rows="2" name="ointerest" class="form-control"  placeholder="Enter Here" value="<?php //echo $me['OtherInterests']?>"><?php// echo $me['OtherInterests']?></textarea>
					</div>-->

							      <div class="col-lg-10 col-md-10 col-sm-12">
                           
                          <button class="theme-btn btn-style-one mt-4" type="submit" name="submit" style="width:100%"><span class="btn-title" tabindex="12">Update</span></button>
                      </div>
                             </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else {?>
     <div class="form-column col-lg-9 col-md-12 col-sm-12">
	 <div class="subscribe-form wow fadeInUp" data-wow-delay="500ms">
                <div class="envelope-image"></div>
         <div class="form-inner">
               <!--<div class="contact-form">
                      <div class="sec-title">
                             <h2>Basics & Lifestyle</h2>
                       </div>-->
                       <form method="post" action="#" >
                         <div class="row clearfix">
                             <div class="col-lg-5 col-md-5 col-sm-12 form-group green mr-2">
                             <!--<label>Height</label>-->
                             <select class="selectpicker dropcss drop" title="Select height" multiple data-max-options="1" data-live-search="true" data-width="90%" name="height" required tabindex="1">
                              <!--<option value="" selected>Select height</option>-->
                              <option value="1" >4Ft </option>
                              <option value="2" >4Ft 1 inch </option>
                              <option value="3" >4Ft 2 inch </option>
                              <option value="4" >4Ft 3 inch </option>
                              <option value="5" >4Ft 4 inch </option>
                              <option value="6" >4Ft 5 inch </option>
                              <option value="7" >4Ft 6 inch </option>
                              <option value="8" >4Ft 7 inch </option>
                              <option value="9" >4Ft 8 inch </option>
                              <option value="10" >4Ft 9 inch </option>
                              <option value="11" >4Ft 10 inch </option>
                              <option value="12" >4Ft 11 inch </option>
                              <option value="13" >5Ft </option>
                              <option value="14" >5Ft 1 inch </option>
                              <option value="15" >5Ft 2 inch </option>
                              <option value="16" >5Ft 3 inch </option>
                              <option value="17" >5Ft 4 inch </option>
                              <option value="18" >5Ft 5 inch </option>
                              <option value="19" >5Ft 6 inch </option>
                              <option value="20" >5Ft 7 inch </option>
                              <option value="21" >5Ft 8 inch </option>
                              <option value="22" >5Ft 9 inch </option>
                              <option value="23" >5Ft 10 inch </option>
                              <option value="24" >5Ft 11 inch </option>
                              <option value="25" >6Ft </option>
                              <option value="26" >6Ft 1 inch </option>
                              <option value="27" >6Ft 2 inch </option>
                              <option value="28" >6Ft 3 inch </option>
                              <option value="29" >6Ft 4 inch </option>
                              <option value="30" >6Ft 5 inch </option>
                              <option value="31" >6Ft 6 inch </option>
                              <option value="32" >6Ft 7 inch </option>
                              <option value="33" >6Ft 8 inch </option>
                              <option value="34" >6Ft 9 inch </option>
                              <option value="35" >6Ft 10 inch </option>
                              <option value="36" >6Ft 11 inch </option>
                              <option value="37" >7Ft </option>
                             </select>
                          </div>

                            <div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                            	 <!--<label>Weight</label>-->
                               <select class="selectpicker dropcss drop" title="Select Weight" multiple data-max-options="1" data-live-search="true" data-width="90%" name="weight" tabindex="2">
                               <!--<option value="" selected>Select Weight</option>-->                  
							   <?php
                              $default="";
                              for($i=40;$i<=150;$i++)
                              {
                                if($me['Weight']==$i)
                                  $default="";
                                else
                                  $default="";
                                ?>
                                <option value="<?php echo $i;?>" <?php echo $default?>><?php echo $i." kg" ?></option>
                                <?php
                              }
                              ?>
                              </select>
                            </div>

                              <div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2">
                                <!--<label>Blood Group</label>-->
                                <select class="selectpicker dropcss drop" title="Select Blood Group"  multiple data-max-options="1" data-live-search="true" data-width="90%" name="bgroup" tabindex="3">
                                <!--<option value="" selected>Select Blood Group</option>-->
                               <?php
                                $BloodGroup=mysqli_query($con,"select * from blood_group ");
                                while($edurow=mysqli_fetch_array($BloodGroup))
                                {?>
                                <option value="<?php echo $edurow['type'] ?>"><?php echo $edurow['type'] ?></option>
                              <?php } ?>
                                 </select>
                              </div>

                               <div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                                 <!--<label>Complexion</label>-->
                                <select class="selectpicker dropcss drop" title="Select Complexion" multiple data-max-options="1" data-live-search="true" data-width="90%" name="complexion" tabindex="4">
                                <!--<option value="" selected>Select Complexion</option>-->
                                <?php               
                                $Complexionsql=mysqli_query($con,"select * from complexion where complexion!='".$row['Complexion']."' ");
                                while($Complexionrow=mysqli_fetch_array($Complexionsql))
                                { ?>
                                <option value="<?php echo $Complexionrow['complexion'];?>" ><?php echo $Complexionrow['complexion'];?></option>
                                           <?php  
                                 }?>
                                      </select>
                              </div> 
                                
                              <div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2">
                                <!--<label>Body type</label>-->
                                <select class="selectpicker dropcss drop" title="Select Body type" multiple data-max-options="1" data-live-search="true" data-width="90%" name="btype" tabindex="5">
                                 <!--<option value="" selected>Select Body type</option>-->
                                   <?php              
                                 $Bodytypesql=mysqli_query($con,"select * from body_type ");
                                 while($Bodytype=mysqli_fetch_array($Bodytypesql))
                                 { ?>
                                  <option value="<?php echo $Bodytype['body_type'];?>" ><?php echo $Bodytype['body_type'];?></option>
                                       <?php  
                                }?>
                              </select>
                            </div>
                                    
                              <div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                               <!--<label>Diet</label>-->
                               <select class="selectpicker dropcss drop" title="Select Diet" multiple data-max-options="1" data-live-search="true" data-width="90%" name="diet" tabindex="6">
                              <!-- <option value="" selected>Select Diet</option>-->
                               <?php              
                               $Dietsql=mysqli_query($con,"select * from diet");
                               while($Dietsq=mysqli_fetch_array($Dietsql))
                               { ?>
                              <option value="<?php echo $Dietsq['diet_type'];?>" ><?php echo $Dietsq['diet_type'];?></option>
                              <?php } ?>
                              </select>
                              </div>

						<div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2">
                            <!--<label>Smoke</label>-->
                            <select class="selectpicker dropcss drop" title="Select Smoke" multiple data-max-options="1" data-live-search="true" data-width="90%" name="smoke" tabindex="7">
                            <!--<option value="" selected>Select Smoke</option>-->
                            <?php               
                            $Smokesql=mysqli_query($con,"select * from smoke");
                            while($smokesq=mysqli_fetch_array($Smokesql))
                            { ?>
                            <option value="<?php echo $smokesq['smoke_type'];?>" ><?php echo $smokesq['smoke_type'];?></option>
                          <?php } ?>
                             </select>
                          </div>

						<div class="col-lg-5 col-md-5 col-sm-12 form-group red">
                            <!--<label>Drink</label>-->
                            <select name="drink" class="selectpicker dropcss drop" title="Select Drink" multiple data-max-options="1" data-live-search="true" data-width="90%" style="margin-top:0px" tabindex="8">
                            <!--<option value="" selected>Select Drink</option>-->
                            <?php              
                            $Drinksql=mysqli_query($con,"select * from drink");
                            while($drink=mysqli_fetch_array($Drinksql))
                            { ?>
                           <option value="<?php echo $drink['Drink_type'];?>" ><?php echo $drink['Drink_type'];?></option>
                          <?php } ?>
                           </select>
                        </div>

						
					    <div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2">
						<!--<label>Spectacles </label>-->
						<select class="selectpicker dropcss drop" title="Select Spectacles/Lens" multiple data-max-options="1" data-live-search="true" data-width="90%" name="spec" id="spec" tabindex="9" >
							<!--<option value="" selected>Select Spectacles/Lens</option>-->
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
						 </div>
						 <div class="col-lg-5 col-md-5 col-sm-12 form-group red mr-2"  tabindex="10" >
                         <!--<label>Hobbies/Interests</label>-->
                         <textarea type="text"  cols="1" name="ohobbies" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" class="agile-ltext"  MAXLENGTH="100" placeholder="Enter Hobbies/Interest" tabindex="10" style="height:60px;"></textarea>
                     </div>
					 <div class="styled-input col-md-8 offset-md-5 mb-2">
					 <span style="font-size: 14px">Please enter your hobbies/interests</span>
					</div>

					 <div class="col-lg-11 col-md-11 col-sm-12 form-group red" style="max-width:84%">
                           <!--<label>Special Cases</label>-->
                          <select name="scases" id="scases" class="selectpicker dropcss drop colm" title="Special Cases" multiple data-max-options="1" data-live-search="true" data-width="90%" style="margin-top:0px" onChange="showotherdist(this.value);" tabindex="11">
                          <!--<option value="" selected >Select Special Cases</option>-->
                          <?php               
                         $special=mysqli_query($con,"select * from special_case");
                         while($case=mysqli_fetch_array($special))
                         { ?>
                        <option value="<?php echo $case['case_type'];?>" ><?php echo $case['case_type'];?></option>
                       <?php }  ?>
                        </select>
                             </div>

						<div class="col-lg-11 col-md-11 col-sm-12 form-group red" style="visibility:hidden;max-width:84%" id="otherdist">
                         <!--<label>Special Reason</label>-->
                         <textarea type="text"  cols="1" name="otherdist" class="form-control"  MAXLENGTH="150" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" placeholder="Please Specify" style="height:60px;" tabindex="12"></textarea>
                     </div>

						<!--<div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <label>Hobbies</label>
<select class="category2 selectpicker" name="hobbies[]" multiple required tabindex="11" data-live-search="true" style="height:140px;">
                        <?php //$Hobbies=mysqli_query($con,"select * from hobbies");
                        //while($hobbies=mysqli_fetch_array($Hobbies))
                        //{ ?>
                        <option value="<?php //echo $hobbies['hobbies'];?>" ><?php //echo $hobbies['hobbies'];?></option>
                      <?php //}  ?>
                     </select>
                      <span style="font-size: 14px">Please use Ctrl+ for multiple selection</span>
                         </div>

                         <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                         <label>Interests</label>
<select class="category2 selectpicker" name="interest[]" multiple tabindex="12" data-live-search="true" style="height:140px;">
                         <?php //$Interests=mysqli_query($con,"select * from interest");
                         //while($interest=mysqli_fetch_array($Interests))
                         //{ ?>
                          <option value="<?php //echo $interest['interest'];?>"><?php //echo $interest['interest'];?></option>
                         <?php //}  ?>
                        </select>
                        <span style="font-size: 14px">Please use Ctrl+ for multiple selection</span>
                         </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <label>Other Hobbies </label>
                        <textarea type="text"  rows="2" name="ohobbies" class="form-control"  placeholder="Enter Here" maxlength="100"  tabindex="13"></textarea>
                         </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                         <label> Other Interests</label>
                        <textarea type="text"  rows="2" name="ointerest" class="form-control"  placeholder="Enter Here" maxlength="100"  tabindex="14"></textarea>
                         </div>-->

                        <div class="col-lg-10 col-md-10 col-sm-12">
                           
                          <button class="theme-btn btn-style-one mt-4 mb-4" type="submit" name="submit" style="width:100%"><span class="btn-title" tabindex="13">Submit Now</span></button>
                      </div>
                       </div>
                      </form>
                     </div>
                    </div>
                </div>
	<?php }?>
	     <?php include('contactinfo.php');?>
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
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script>
$('select').selectpicker();
</script>
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="css2/jquery.min.js"></script>
<script src="css2/bootstrap.bundle.min.js"></script>
<script src="css2/bootstrap-select.min.js"></script>
<script src="js/jquery.js"></script><script src="js/appear.js"></script>

<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/validate.js"></script>
<script src="js/script.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>

<!--End Google Map APi-->
</body>
</html>
