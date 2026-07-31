<?php 
ob_start();
require_once('sys_dbconnection.php');

include('register_submit.php');

?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Signup</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/regcss1.css" rel="stylesheet">

<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="_so/js?//stackoverflow.com/questions/23729750/dont-allow-invalid-characters-to-be-pasted-on-textbox" id="so"></script>


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
<style>

/* Add a right margin to each icon */
.fas {
  margin-left: -12px;
  margin-right: 8px;
}
.contact-form .form-group input[type="date"]
{
		
    position: relative;
    display: block;
    width: 100%;
    font-size: 14px;
    color: #312d2dba;
    line-height: 32px;
    padding: 0px 13px;
    border: 1px solid #168e1d;
    background-color: ffffff;
    font-weight: 400;
    height: 50px;
    -webkit-transition: all 300ms ease;
    -moz-transition: all 300ms ease;
    -ms-transition: all 300ms ease;
    -o-transition: all 300ms ease;
    transition: all 300ms ease;
    border-radius: 3px;

}
.labma
{
	margin-top:4px;
}
@media screen and (max-width:768px)
{
	.contact-form 
	{
		margin-top: -30px
	}
}
@media screen and (max-width:576px)
{
	.contact-form 
	{
		margin-top: -30px
	}
}
</style>


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
function fillday(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("day").innerHTML="";
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
    document.getElementById("day").innerHTML=xmlhttp.responseText;
    }
  }
  //alert(str);
xmlhttp.open("GET","fillday.php?q="+str,true);
xmlhttp.send();
}
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
function getage()
{  
   //alert("hello");
   var year=document.getElementById("year").value;
  // alert(year);
   var month=document.getElementById("month").value;
   //alert(month);
   var day=document.getElementById("day").value;
  // alert(day);
   if((month=="02" && day=="30") || (month=="02" && day=="31") || (month=="04" && day=="31") || (month=="06" && day=="31") || (month=="11" && day=="31") || (month=="09" && day=="31"))
   {
	  // alert("heeeeeeee");
     //alert("step2");
      document.getElementById("doberror").style.display = 'block';
      //alert("hello");
      var year=document.getElementById("year").value='';
        var month=document.getElementById("month").value='';
        var day=document.getElementById("day").value='';
      var day=document.getElementById("day").focus();
          return false
   }
   if(year !="" && month !="" && day !="")
       {
          document.getElementById("doberror").style.display = 'none';
          document.getElementById("doberror1").style.display = 'none';
          document.getElementById("doberror2").style.display = 'none';
          var today = new Date();
          var birthDate = new Date();
          
          birthDate.setYear(year);
          birthDate.setMonth(month);
          birthDate.setDate(day);
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() -  birthDate.getMonth();
          var d=today.getDate()- birthDate.getDate();
          if (m < 0 )
           {
            age--;
            //alert(m);
            m=12+m;
           }
          if(d<0)
          {
            d=30+d;
          }
          var page="";
          var pmonth="";
          var pday="";
          if(age>1)
          {
          page=age+" Years ";
          }
          else
          {
            page=age+" Year ";
          }
          if(m>1)
          {
          pmonth=m+" Mounths ";
          }
          else
          {
            pmonth=m+" Mounth ";
          }
          if(d>1)
          {
          pday=d+" Days ";
          }
          else
          {
            pday=d+" Day ";
          }
          document.getElementById('age').value =page+pmonth+pday; 
		 
          document.getElementById('age1').value =age; 
		  //alert(age);
		 
          if (document.getElementById('age1').value < 21 && matri.gender[0].checked) {
			 alert("Your age must be over 21 to register");
			//document.getElementById("doberror1").style.display = 'block';
          var year=document.getElementById("year").value='';
          var month=document.getElementById("month").value='';
          var day=document.getElementById("day").value='';
          return false
          }
          else if (document.getElementById('age1').value < 18 && matri.gender[1].checked) {
          alert("Your age must be over 18 to register");
		  
         //document.getElementById("doberror2").style.display = 'block';
          var year=document.getElementById("year").value='';
          var month=document.getElementById("month").value='';
          var day=document.getElementById("day").value='';
          return false
		}
  // other validation
  return true;
}    
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
</script>


<!-- end check password length-->

</head>

<body>
 
 

    <!-- Header Menu -->
     <?php include('header3.php')?>

<div class="page-wrapper bg-light">
  
    <!-- Preloader -->
    <!--<div class="preloader"></div>-->
  <!-- Header span -->

    <!-- Header Span -->
    <!--<span class="header-span"></span>-->
     <!-- End Header Menu -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Signup</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Signup</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
  
  <!-- Signup Form -->
    <section class="newsletter-section">
        <div class="anim-icons full-width">
            <span class="icon icon-shape-3 wow fadeIn"></span>
            <span class="icon icon-line-1 wow fadeIn"></span>
        </div>
        <div class="auto-container">
                         
                    <div class="upper-box">
                        <div class="sec-title text-center">
                          
                            <div class="text"><h2 class="title">Matches Within Your community,</h2>Verified Profile | Safe and Secured | Entire Profile Description.</div>
                        </div>
                    </div>
					   
				   <div class="row ">
					 <div class="col-lg-12 alert alert-info " id="doberror" style="display:none"><?php echo "Select valid Birth Date"; ?></div>
                          <div class="col-lg-12 alert alert-info" id="doberror1" style="display:none"><?php 
                            <div class="col-lg-12 alert alert-info " id="doberror2" style="display:none"><?php 
				   <div class="col-lg-2 col-md-4 col-sm-4">
			         </div>
					  <div class="form-column col-lg-8 col-md-12 col-sm-12">
					  <div class="inner-column">
                    <div class="contact-form ">
					
				 <form method="post" action="#" id="contact-form" onsubmit="return getage()" name="matri">
				        
			               <div class="row clearfix">
						   
						   
						   <div class="col-md-2">
						          <?php if ($gender !='Male') {?>
								   <input  type="radio" style="vertical-align: text-bottom"  id="man" name="gender" value="Male" tabindex="1"  checked> <label class="labelcss" value="<?php echo $gender; ?>" for="man"> I'm Man</label>
								  <?php } else { ?>
								   <input  type="radio" style="vertical-align: text-bottom"  id="man" name="gender" value="Male" checked tabindex="1" ><label class="labelcss" value="<?php echo $gender; ?>" for="man"> I'm Man</label>
								  <?php } ?>
							</div>
							 <div class="col-md-4">
                                    <?php if ($gender !='Female') {?>
									<input type="radio"  style="vertical-align: text-bottom"  id="woman" name="gender" value="Female" tabindex="2" ><label class="labelcss"  value="<?php echo $gender; ?>" for="woman"> I'm Woman</label>
									<?php } else { ?>
									<input type="radio" style="vertical-align: text-bottom"  id="woman" name="gender" value="Female" checked tabindex="2"><label class="labelcss"  value="<?php echo $gender; ?>" for="woman"> I'm Woman</label>
									<?php } ?>
						    </div>
                
              							
							<div class="col-lg-12 col-md-12 col-sm-12 form-group mt-3" id="emailerror">
								<input type="email"  autofocus  name="email" value="" placeholder="Your E-mail" onBlur="check_exist123(this.value);" value="<?php echo $email;?>" required tabindex="3" maxlength="45"  onkeyup="nospaces(this)">
							    <div class="mt-2 "><font color="#FF0000"><?php echo $email_error;?></font></div>

							 </div>
                  
                   <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <input type="password"  name="pass" placeholder="Set New Password"  maxlength="35" onblur="CheckLengthPassword(this)" id="pass" tabindex="4" value="<?php echo $pass;?>"  required>
                   
					<font color="#FF0000"><?php echo $pass_error;?></font>
					<div class="mt-2 " id="passeror" style="display:none"><?php echo "Password is too weak";?></div> 
                  </div>
				 <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                       <input type="text" name="fname" placeholder="Candidate Name"  tabindex="5" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" maxlength="35" onkeyup="nospaces(this)" value="<?php echo $fname;?>" required>
                        <div class=""><font color="#FF0000"><?php echo $fname_error;?></font></div>   
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 form-group ">
                     <input type="text" name="lname" placeholder="Surname"  tabindex="6" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" maxlength="35" onkeyup="nospaces(this)" value="<?php echo $lname;?>" required>
                     <div class=""><font color="#FF0000"><?php echo $lname_error;?></font></div>
                </div>
				        <div class="col-lg-4 col-md-4 col-sm-12 form-group ">
                  <select class="custom-select-box"    name="dobMonth"    tabindex="7" required id="month">
                  <?php if(isset($_POST['dobMonth'])){ ?>
                  <option value="<?php echo $sMonth;?>" selected><?php echo $sMonth;?></option>
                  <?php } ?>
                  <option value="">Birth Month</option>
                  <option  value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">Jun</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                 </select>
                </div>
   
               <div class="col-lg-4 col-md-4 col-sm-12 form-group " >
                  <select  name="dob"  class="custom-select-box"   tabindex="8" required  id="day">
                  <?php if(isset($_POST['dob'])){ ?>
                   <option value="<?php echo $sDay;?>" selected><?php echo $sDay;?></option>
                   <?php } ?>
                    <option value="">Birth Day</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                   </select>
                </div>
                
        <div class="col-lg-4 col-md-4 col-sm-12 form-group ">
                <select name="dobYear"  class="custom-select-box"  tabindex="9" required  id="year">
                <?php if(isset($_POST['dobYear'])){ ?>
                <option value="<?php echo $syear;?>" selected><?php echo $syear;?></option>
                <?php } ?>
               <option value="">Birth Year</option>
                <?php $result=mysqli_query($con,"select * from year order by year desc");
                while($row=mysqli_fetch_array($result)) { ?>
                <option value="<?php echo $row['year']?>" ><?php echo $row['year']?></option>
                     <?php } ?>
                </select>
					<input type="hidden" name="age" id="age" size="25" readonly >
                   <input type="hidden" size="4" id="age1" name="age1">
                 <div class=""><font color="#FF0000"><?php echo $dob_error;?></font></div>
        </div>
		
			<!-- <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                       <input type="text" name="regno" placeholder="Enter SMT No."  tabindex="10" onKeyPress="" maxlength="20" onkeyup="nospaces(this)">
					   <label>(Note: Fill SMT Number if you have)</label>
              </div> -->
			 <!-- <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                       <input type="date" name="regdate1" tabindex="11"> 
					   <label class="labma">(Note: Fill Registration Date if you know)</label>
              </div> -->
			  
			  
			  
             
                <div class="col-lg-12 col-md-12 col-sm-12">
                 <div class="btn-box">
                 <div class="text"><input type="checkbox" checked tabindex="10" style="vertical-align: text-bottom">  I have read and agree to the <a href="terms-conditions" target=_blank><u><label>terms, conditions</label></u></a> and <a href="privacy-policy" target=_blank><u><label>privacy policy.</label></u> </a></div>
                        </div>
                 <a><button class="btn btn-danger mt-4 mb-4"  type="submit" name="submit" style="width:100%"> <span tabindex="11" class="btn-title">Submit Now</span></button></a>
                </div> 
              
			  
              
                 </div>
             </div>
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
    <?php include('footer3.php');?>
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->
<!-- End Color Switcher -->

<!--Search Popup-->

<!--Scroll to top-->
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
<div id="status">
</div>
<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
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