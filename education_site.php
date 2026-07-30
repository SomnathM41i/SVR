<?php include('dbconnectadmin.php');?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Education</title>
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
document.getElementById("state").innerHTML='<option value="">Select State</option>';
document.getElementById("dist").innerHTML='<option value="">Select District</option>';
document.getElementById("taluka").innerHTML='<option value="">Select Taluka</option>';
document.getElementById("city_contact").innerHTML='<option value="">Select City</option>';
if (str=="") return;
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
xmlhttp.open("GET","fill_state.php?q="+encodeURIComponent(str),true);
xmlhttp.send();
}
 
function filldist(str)
{
  
var xmlhttp;
document.getElementById("dist").innerHTML='<option value="">Select District</option>';
document.getElementById("taluka").innerHTML='<option value="">Select Taluka</option>';
document.getElementById("city_contact").innerHTML='<option value="">Select City</option>';
if (str=="") return;
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
xmlhttp.open("GET","fill_dist.php?q="+encodeURIComponent(str),true);
xmlhttp.send();
}
function filltaluka(str) {
  var taluka=document.getElementById("taluka");
  var city=document.getElementById("city_contact");
  taluka.innerHTML='<option value="">Select Taluka</option>';
  city.innerHTML='<option value="">Select City</option>';
  if(str=="") return;
  var xmlhttp=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function(){
    if(xmlhttp.readyState==4&&xmlhttp.status==200) taluka.innerHTML=xmlhttp.responseText;
  };
  xmlhttp.open("GET","fill_taluka.php?q="+encodeURIComponent(str),true);
  xmlhttp.send();
}
function fillcity(str) {
  var city=document.getElementById("city_contact");
  var district=document.getElementById("dist").value;
  city.innerHTML='<option value="">Select City</option>';
  if(str=="") return;
  var xmlhttp=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function(){
    if(xmlhttp.readyState==4&&xmlhttp.status==200) city.innerHTML=xmlhttp.responseText;
  };
  xmlhttp.open("GET","fill_city.php?taluka="+encodeURIComponent(str)+"&district="+encodeURIComponent(district),true);
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
            <h1>Education Details</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Education Details</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
    <?php
    
$ID=$_GET['id'];
$register=mysqli_query($con,"select * from register where MatriID='$ID'");
$fetchrecord=mysqli_fetch_assoc($register);
if(isset($_POST['submit']))
{
$address= mysqli_real_escape_string($con,$_POST['address']);
$country= mysqli_real_escape_string($con,$_POST['country']);
$state= mysqli_real_escape_string($con,$_POST['state']);  
$city= mysqli_real_escape_string($con,$_POST['city']);
$phone= mysqli_real_escape_string($con,$_POST['phone']);
$dist= mysqli_real_escape_string($con,$_POST['dist']);
$taluka= mysqli_real_escape_string($con,$_POST['taluka'] ?? '');
$residence= mysqli_real_escape_string($con,$_POST['residence']);
$mobile2= mysqli_real_escape_string($con,$_POST['mobile2']);
$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
$pincode= mysqli_real_escape_string($con,$_POST['pincode']);
$calling= mysqli_real_escape_string($con,$_POST['calling']);
if(isset($login)&& $regvar=='9')
{
mysqli_query($con,"update register set Address='$address',Country='$country',dist='$dist',Taluka='$taluka',State='$state',City='$city',Phone='$phone',Residencystatus='$residence',Mobile2='$mobile2',calling_time='$calling',Pincode='$pincode',Mobile='$mobile' where MatriID='$login'");
header('location:education_site?message=success');
}
else
{
mysqli_query($con,"update register set Address='$address',Country='$country',dist='$dist',Taluka='$taluka',State='$state',City='$city',Phone='$phone',Residencystatus='$residence',Mobile2='$mobile2',calling_time='$calling',Pincode='$pincode',Mobile='$mobile' where MatriID='$ID'");
header('location:education?id='.$ID);
}
}
?>
    <!-- Contact Page Section -->
    <section class="contact-page-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="contact-column col-lg-4 col-md-12 col-sm-12 order-2">
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2>Contact Info</h2>
                        </div>
                        <ul class="contact-info">
                            <li>
                                <span class="icon fa fa-map-marker-alt"></span> 
                                <p><strong>32, Breaking Street,</strong></p>
                                <p>2nd cros, Newyork ,USA 10002</p>
                            </li>

                            <li>
                                <span class="icon fa fa-phone-volume"></span> 
                                <p><strong>Call Us</strong></p>
                                <p>+321 4567 89 012 & 79 023</p>
                            </li>

                            <li>
                                <span class="icon fa fa-envelope"></span> 
                                <p><strong>Mail Us</strong></p>
                                <p><a href="mailto:support@example.com">Support@example.com</a></p>
                            </li>

                            <li>
                                <span class="icon fa fa-clock"></span> 
                                <p><strong>Opening Time</strong></p>
                                <p>Mon - Sat: 09.00am to 18.00pm</p>
                            </li>
                        </ul>

                        <ul class="social-icon-two social-icon-colored">
                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Form Column -->
                  	<?php  if(isset($login)&& $regvar=='9')
                    {?>
				  <div class="form-column col-lg-8 col-md-12 col-sm-12">
         <div class="inner-column">
               <div class="contact-form">
                      <div class="sec-title">
                             <h2>Edit Education</h2>
                       </div>
                       <form method="post" action="#" id="contact-form">
                         <div class="row clearfix">
                             <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                             	 <label style="margin-top: -25px;">Country</label>
                               <select class="category2" name="country" id="country" onChange="fillstate(this.value)" tabindex="1" required >
                               <?php if($me['Country']=="")
							    {?>
                               <option value="India" selected>India</option>
							   <?php } else { ?>
							   <option value="<?php echo $me['Country'];?>" selected><?php echo $me['Country'];?>
								<?php }?>
							    </option>
                               <?php $sqlc = mysqli_query($con,"select * from e_country order by id ASC");
                                while ( $rowc = mysqli_fetch_array ( $sqlc ) ) 
                                {
                                echo '<option value="' . $rowc ['country'] . '">' . $rowc ['country'] . '</option>';
                                }
                                ?>
                             </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            	 <label style="margin-top: -25px;">State</label>
                               <select class="category2" name="state" id="state" onChange="filldist(this.value)"  tabindex="2" required>
                              <?php if($me['State']=="")
							   {?>
                               <option value=""> Select</option>
							   <?php } else { ?>
							   <option value="<?php echo $me['State'];?>" selected><?php echo $me['State'];?>
								<?php }?>
							   </option>
                              <?php $rrs=mysqli_query($con,"select * from e_state where cid='India'");
                              while($rrow=mysqli_fetch_array($rrs))
                              {?>
                              <option value="<?php echo $rrow['state'];?>"><?php echo $rrow['state'];?></option>
                                    <?php    }  ?>
                               </select>
                             </div>

                              <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label style="margin-top: -25px;">District</label>
                                <select class="category2" name="dist" tabindex="3" id="dist" onChange="filltaluka(this.value)">
                               <?php if($me['Dist']=="")
							{?>
                              <option value=""> Select</option>
							<?php } else { ?>
							<option value="<?php echo $me['Dist'];?>" selected><?php echo $me['Dist'];?>
								<?php }?>
							</option>
					  <?php if($me['State']!=""){ ?>
                      <?php 
		             $rrs=mysqli_query($con,"select * from e_dist where sid2='".$me['State']."'");
                      while($rrow=mysqli_fetch_array($rrs))
					{
						$_SESSION['dis']=$rrow['dist'];
						if($rrow['dist']==$row['dist'])
						{
							?>
                             <option value="<?php echo $rrow['Dist'];?>" selected><?php echo $rrow['Dist'];?></option>
                     <?php }else{?>
                            <option value="<?php echo $rrow['dist'];?>"><?php echo $rrow['dist'];?></option>
                      <?php	}   }}?>
					</select>
                               </div>

                               <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                  <label style="margin-top: -25px;">Taluka</label>
                                  <select class="category2" name="taluka" id="taluka" onChange="fillcity(this.value)" tabindex="4">
                                    <option value="<?php echo htmlspecialchars($me['Taluka'] ?? '', ENT_QUOTES); ?>" selected><?php echo htmlspecialchars($me['Taluka'] ?? 'Select Taluka'); ?></option>
                                    <?php $talukaRows=mysqli_query($con,"SELECT taluka FROM e_taluka WHERE dist_ref='".mysqli_real_escape_string($con,$me['Dist'])."' AND status='enable' ORDER BY taluka");
                                    while($talukaRows&&($talukaRow=mysqli_fetch_assoc($talukaRows))){if($talukaRow['taluka']!==($me['Taluka']??'')) echo '<option value="'.htmlspecialchars($talukaRow['taluka'],ENT_QUOTES).'">'.htmlspecialchars($talukaRow['taluka']).'</option>';} ?>
                                  </select>
                               </div>

                               <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                  <label style="margin-top: -25px;">City</label>
                                  <select class="category2" name="city" id="city_contact" tabindex="4">
                                    <option value="<?php echo htmlspecialchars($me['City'], ENT_QUOTES); ?>" selected><?php echo htmlspecialchars($me['City']); ?></option>
                                    <?php $cityRows=mysqli_query($con,"SELECT DISTINCT city FROM e_city WHERE taluka_ref='".mysqli_real_escape_string($con,$me['Taluka']??'')."' OR (taluka_ref='' AND dist_ref='".mysqli_real_escape_string($con,$me['Dist'])."') ORDER BY city ASC");
                                    while($cityRows&&($cityRow=mysqli_fetch_assoc($cityRows))){if($cityRow['city']!==$me['City']) echo '<option value="'.htmlspecialchars($cityRow['city'],ENT_QUOTES).'">'.htmlspecialchars($cityRow['city']).'</option>';} ?>
                                  </select>
                              </div> 
                                
                              <div class="col-lg-6 col-md-6 col-sm-12 form-group" >
                                <label style="margin-top: -25px;">Pincode</label>
                                 <input type="text" class="form-control" placeholder="Enter Here" name="pincode" id="myInput" maxlength="8" onKeyPress="return isNumber(event);" tabindex="5" value="<?php echo $me['Pincode']?>">
                               </div>
                                    
                              <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                               <label style="margin-top: -25px;">Residence In</label>
                               <select class="category2" name="residence" tabindex="6">
							   <?php if($me['Residencystatus']=="")
							{?>
                               <option value=""> Select</option>
							<?php } else { ?>
							<option value="<?php echo $me['Residencystatus'];?>" selected><?php echo $me['Residencystatus'];?>
								<?php }?>
							</option>
                               <option value="Citizen"  selected>Citizen</option>
                                <option value="Permanent Resident">Permanent Resident</option>
                                <option value="Student Visa">Student Visa</option>
                                <option value="Temporary Visa">Temporary Visa</option>
                                <option value="Work permit">Work permit</option>
                              </select>
                               </div>

							            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label style="margin-top: -25px;">Address</label>
                             <textarea type="text" name="address" class="form-control" value=""  placeholder="Enter Address" maxlength="100" tabindex="7"><?php echo $me['Address']?></textarea>
                            <span style="font-size: 14px">Specify house name, flat no, landmark, etc..</span>
                          </div>

							            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label style="margin-top: -25px;"> Alternate Phone</label>
                            <input type="text" class="form-control"  maxlength="14" placeholder="Phone Number" id="Phone" onkeypress="return isNumber(event)" name="phone" tabindex="8" value="<?php echo $me['Phone']?>">
                          </div>

							           <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label style="margin-top: -25px;">Mobile</label>
                            <input type="text" class="form-control"  maxlength="14" placeholder="Mobile Number"  onkeypress="return isNumber(event)" name="mobile"  readonly tabindex="9" value="<?php echo $me['Mobile']?>">
                            <span style="font-size: 14px">Primary & Verified Number</span>
                             </div>

							        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                          <label style="margin-top: -25px;">Whatsapp No</label>
                          <input type="text" class="form-control"  maxlength="14" placeholder="Whatsapp Number"  id="mobile2"  onkeypress="return isNumber(event)"
                         name="mobile2" tabindex="10" value="<?php echo $me['Mobile2']?>">
                      </div>

							       <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                         <label style="margin-top: -25px;">Convenient Time to Call</label>
                         <select class="category2" name="calling" tabindex="11">
                         <?php if($me['calling_time']=="")
			              {?>
						<option value="" selected>Select </option>
			           <?php }else{?>
			          <option value="<?php echo $me['calling_time']?>"><?php echo $me['calling_time']?></option>
			          <?php }?>	
                        <?php 
                         $calling=mysqli_query($con,"select * from calling_time");
                         while($callrow=mysqli_fetch_array($calling))
                         {?>
                          <option value="<?php echo $callrow['call_time'];?>" ><?php echo $callrow['call_time'];?></option>
                         <?php  }    ?>
                       </select>
                         </div>

							      <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                               <button class="theme-btn btn-style-one" type="submit" name="submit"><span class="btn-title">Submit Now</span></button>
                           </div>
                             </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else
	{?>
 <div class="form-column col-lg-8 col-md-12 col-sm-12">
         <div class="inner-column">
               <div class="contact-form">
                      <div class="sec-title">
                             <h2>Education Details</h2>
                       </div>
                       <form method="post" action="#" id="contact-form">
                         <div class="row clearfix">
                             <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                             	 <label style="margin-top: -25px;">Country</label>
                               <select class="category2" name="country" id="country" onChange="fillstate(this.value)" tabindex="1" required >
                               <option value="">Country</option>
                               <?php $sqlc = mysqli_query($con,"select * from e_country order by id ASC");
                                while ( $rowc = mysqli_fetch_array ( $sqlc ) ) 
                                {
                                echo '<option value="' . $rowc ['country'] . '">' . $rowc ['country'] . '</option>';
                                }
                                ?>
                             </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            	 <label style="margin-top: -25px;">State</label>
                               <select class="category2" name="state" id="state" onChange="filldist(this.value)"  tabindex="2" required>
                              <option value="">State</option>
                              <?php $rrs=mysqli_query($con,"select * from e_state where cid='India'");
                              while($rrow=mysqli_fetch_array($rrs))
                              {?>
                              <option value="<?php echo $rrow['state'];?>"><?php echo $rrow['state'];?></option>
                                    <?php    }  ?>
                               </select>
                             </div>

                              <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label style="margin-top: -25px;">District</label>
                                <select class="category2" name="dist" tabindex="3" id="dist" onChange="filltaluka(this.value)">
                               <option value="">District</option>
                            <?php if($row['State']!=""){ ?>
                    <?php 
			  $rrs=mysql_query("select * from e_dist where sid2='".$row['State']."'");
						while($rrow=mysql_fetch_array($rrs))
						{
							$_SESSION['dis']=$rrow['dist'];
							if($rrow['dist']==$row['dist'])
							{
								?>
       <option value="<?php echo $rrow['Dist'];?>" selected><?php echo $rrow['Dist'];?></option>
                    <?php }else{?>
       <option value="<?php echo $rrow['dist'];?>"><?php echo $rrow['dist'];?></option>
                    <?php	}   }}?>
					</select>
                               </div>

                               <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                  <label style="margin-top: -25px;">Taluka</label>
                                  <select class="category2" name="taluka" id="taluka" onChange="fillcity(this.value)" tabindex="4">
                                    <option value="">Select Taluka</option>
                                  </select>
                               </div>

                               <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                  <label style="margin-top: -25px;">City</label>
                                  <select class="category2" name="city" id="city_contact" tabindex="4">
                                    <option value="">Select City</option>
                                  </select>
                              </div> 
                                
                              <div class="col-lg-6 col-md-6 col-sm-12 form-group" >
                                <label style="margin-top: -25px;">Pincode</label>
                                 <input type="text" class="form-control" placeholder="Enter Here" name="pincode" id="myInput" maxlength="8" onKeyPress="return isNumber(event);" tabindex="5">
                               </div>
                                    
                              <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                               <label style="margin-top: -25px;">Residence In</label>
                               <select class="category2" name="residence" tabindex="6">
                               <option value="Citizen"  selected>Citizen</option>
                                <option value="Permanent Resident">Permanent Resident</option>
                                <option value="Student Visa">Student Visa</option>
                                <option value="Temporary Visa">Temporary Visa</option>
                                <option value="Work permit">Work permit</option>
                              </select>
                               </div>

							            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label style="margin-top: -25px;">Address</label>
                             <textarea type="text" name="address" class="form-control" value=""  placeholder="Enter Address" maxlength="100" tabindex="7"></textarea>
                            <span style="font-size: 14px">Specify house name, flat no, landmark, etc..</span>
                          </div>

							            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label style="margin-top: -25px;"> Alternate Phone</label>
                            <input type="text" class="form-control"  maxlength="14" placeholder="Phone Number" id="Phone" onkeypress="return isNumber(event)" name="phone" tabindex="8">
                          </div>

							           <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label style="margin-top: -25px;">Mobile</label>
                            <input type="text" class="form-control"  maxlength="14" placeholder="Mobile Number" value="<?php echo $fetchrecord['Mobile'];?>" onkeypress="return isNumber(event)" name="mobile"  readonly tabindex="9">
                            <span style="font-size: 14px">Primary & Verified Number</span>
                             </div>

							        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                          <label style="margin-top: -25px;">Whatsapp No</label>
                          <input type="text" class="form-control"  maxlength="14" placeholder="Whatsapp Number"  id="mobile2"  onkeypress="return isNumber(event)"
                         name="mobile2" tabindex="10">
                      </div>

							       <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                         <label style="margin-top: -25px;">Convenient Time to Call</label>
                         <select class="category2" name="calling" tabindex="11">
                         <option value="" selected>Select </option>
                        <?php 
                         $calling=mysqli_query($con,"select * from calling_time");
                         while($callrow=mysqli_fetch_array($calling))
                         {?>
                          <option value="<?php echo $callrow['call_time'];?>" ><?php echo $callrow['call_time'];?></option>
                         <?php  }    ?>
                       </select>
                         </div>

							      <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                               <button class="theme-btn btn-style-one" type="submit" name="submit"><span class="btn-title">Submit Now</span></button>
                           </div>
                             </div>
                            </form>
                        </div>
                    </div>
                </div>
                   <?php }?>
			</div>
        </div>
    </section>
	<?php include('footer.php')?>
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->
<div class="color-palate">
    <div class="color-trigger">
        <i class="fa fa-cog"></i>
    </div>
    <div class="color-palate-head">
        <h6>Choose Your Demo</h6>
    </div>
    <ul class="box-version option-box"> <li>Full width</li> <li class="box">Boxed</li> </ul>
    <ul class="rtl-version option-box"> <li>LTR Version</li> <li class="rtl">RTL Version</li> </ul>
    <div class="palate-foo">
        <span>You will find much more options for colors and styling in admin panel. This color picker is used only for demonstation purposes.</span>
    </div>
    <a href="#" class="purchase-btn">Purchase now</a>
</div><!-- End Color Switcher -->

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
</body>
</html>
