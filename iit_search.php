<?php 
require_once('includes/bootstrap.php');
include('memprotect.php');
error_reporting(0); 
$login=$_SESSION['MatriID'];
$seo=mysqli_query($con,"Select * from seo where catagory='search'");
$seof=mysqli_fetch_array($seo);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>IIT/NIT/IIM Search</title>
  <link rel="icon" type="image/png" sizes="32x32" href="branding/favicons/icon-32.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>.mvv-page-hero h1 { text-transform:none; }</style>
  <link rel="stylesheet" href="css2/bootstrap-select.css" />
</head>
<body>
<?php include('header.php'); ?>
<main>
  <?php  if(isset($login)&& $regvar=='9') { ?>
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <p class="mvv-eyebrow">Matrimony</p>
      <h1>IIT/NIT/IIM Search</h1>
      <p>Find Your Special Someone Here</p>
      <nav class="mvv-breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>IIT/NIT/IIM Search</span>
      </nav>
    </div>
  </section>
  <?php }else{?>
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <p class="mvv-eyebrow">Matrimony</p>
      <h1>IIT/NIT/IIM Search</h1>
      <p>Find Your Special Someone Here</p>
      <nav class="mvv-breadcrumb">
        <a href="index">Home</a>
        <span>IIT/NIT/IIM Search</span>
      </nav>
    </div>
  </section>
  <?php } ?>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="contact-form">
        <div class="w3ls-title1 mb-4">
          <?php  if(!(isset($login)&& $regvar=='9')) { ?>
          <span style="font-size:20px;color:#1d95d2;">Advance Search, Id Search, Save Search Will Enable After Login</span><br>
          <?php } ?>
        </div>
        <div class="col-lg-12 mt-3">
          <form class="form-horizontal" action="#" method="post" name="form1">
            <div class="row">
              <?php 
                if($me['Gender']=="Male")
              {?>
                <div class="col-lg-3 col-md-3 col-sm-12 form-group">
<select class="selectpicker" multiple data-max-options="1" data-live-search="true" title="Select Gender"  name="gender" required  tabindex="1">
                    <option value="Female" selected>Female</option>
                  </select> 
                </div>
              <?php }
              else if($me['Gender']=="Female"){?>
              <div class="col-lg-3 col-md-3 col-sm-12 form-group">
<select class="selectpicker" multiple data-max-options="1" data-live-search="true" title="Select Gender"  name="gender" required  tabindex="1">
                  <option value="Male" selected>Male</option>
                </select> 	
              </div> 	
              <?php } else {?>	
              <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                <select class="selectpicker" multiple data-max-options="1" data-live-search="true" title="Select Gender"  name="gender" required  tabindex="1" multiple>
                  <option value="Male">Male</option>
                  <option value="Female" selected>Female</option>
                </select> 	
              </div> 	
              <?php } ?>								

              <div class="col-lg-3 col-md-3 col-sm-3  form-group">
                <select class="custom-select-box ages selcs"   id="fromage"  name="txtSAge"  onChange="fillage(this.value)" required  tabindex="2" >
                  <option value="" selected> From Age</option>				
                  <?php 
                    $rrsfromage=mysqli_query($con,"SELECT * FROM fromage");
                    while($rrowfromage=mysqli_fetch_array($rrsfromage))
                    {
                    ?>
                  <option value="<?php echo $rrowfromage['fromage'];?>"><?php echo $rrowfromage['fromage'];?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="custom-select-box ages selcs"  title="To Age"  id="toage" name="txtEAge" required  tabindex="3"   size="1" >
                  <option value="" selected> To Age</option>				
                  <?php 
                    $rrstoage=mysqli_query($con,"SELECT * FROM toage");
                    while($rrowtoage=mysqli_fetch_array($rrstoage))
                    {
                    ?>
                  <option value="<?php echo $rrowtoage['toage'];?>"><?php echo $rrowtoage['toage'];?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
<select class="selectpicker" data-live-search="true" title="Select Maritial" name="looking[]"  tabindex="4" multiple  >
                  <option value="Unmarried" selected>Unmarried</option>
                  <option value="Separated">Separated</option>
                  <option value="Widowed">Widowed</option>
                  <option value="Divorced">Divorced</option>
                  <option value="Any">Any</option>
                </select> 
              </div>  
              <div class="col-lg-6 col-md-6 col-sm-6 form-group">
<select class="selectpicker" data-live-search="true" title="Select Religion" name="religion[]" id="religion" multiple  onChange="fillcaste(this.value)"  tabindex="5">
                <option value="Any" selected>Any Religion</option>							
                  <?php 
                    $rrs=mysqli_query($con,"SELECT * FROM religion WHERE status='enable' ORDER BY Religion ASC");
                    while($rrow=mysqli_fetch_array($rrs))
                    {
                      if($rrow['Religion']==$row['Religion'])
                      {
                    ?>
                    <option value="<?php echo $rrow['Religion'];?>" selected><?php echo $rrow['Religion'];?></option>
                    <?php
                      }
                      else
                    {?>
                    <option value="<?php echo $rrow['Religion'];?>"><?php echo $rrow['Religion'];?></option>
                    <?php }
                      }
                    ?>
                   </select>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-6 form-group">
<select class="selectpicker" data-live-search="true" title="Select Institute" name="iit[]" id="iit" multiple tabindex="6">
                <option value="Any" selected>Any Institute</option>							
                  <?php 
                    $rrs=mysqli_query($con,"SELECT * FROM iit WHERE status='enable' ORDER BY Inst_nm ASC");
                    while($rrow=mysqli_fetch_array($rrs))
                    {
                      ?>
                  <option value="<?php echo $rrow['Inst_nm'];?>"><?php echo $rrow['Inst_nm'];?></option>
                    <?php 
                      }
                    ?>
                   </select>
              </div>
            </div>
          </div>	

          <?php  if(!isset($login))
          {?>
          <div class="styled-input agile-styled-input-top form-group col-md-12">
            <input type="hidden">
            <span></span>
            <button class="mvv-btn mvv-btn-primary" type="submit" name="Search"  onClick="getsearch1()" > Let's Begin</button>
          </div>
          <?php } else { ?>

          <?php $ty=mysqli_query($con,"select * from basic_saveandsearch where MatriID='".$_SESSION['matri_login']."'");
            if(mysqli_num_rows($ty)>=5) { ?>
          <a href="#dialog_send_message" data-toggle="modal">
          <button class="mvv-btn mvv-btn-primary mt-3" type="Submit" name=""  >Save Search</button></a>
          <?php } else { ?>
          <!--<button class="theme-btn btn btn-style-three mt-3" type="Submit" name="basic"  onClick="getsearch2();"><span class="btn-title">Save Search</span></button>-->
          <?php }?>
          <button class="mvv-btn mvv-btn-primary mt-3" type="submit" name="Search"  onClick="getsearch1()"> Let's Begin</button>
          </div>
        </form>		
      </div>
    <?php } ?>		
    </div>
  </section>
  <div class="modal fade" id="dialog_send_message" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="dialog_content">
        <div class="modal-header">
          <h4 class="modal-title">Error</h4>
        </div>        		
        <div class="modal-body" align="center">
          Already You Have Done 5 Save & Search.  <br>
          Please Delete Old and then try again
        </div>
        <div class="modal-footer" style="padding:1.5rem">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php include('popup.php')?>
</main>

<?php include('footer3.php')?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>window.jQuery || document.write('<script src="css2/jquery.min.js"><\/script>')</script>
<script src="css2/bootstrap.bundle.min.js"></script>
<script src="css2/bootstrap-select.min.js"></script>
<script>
function fillage(str)
{
  var xmlhttp;
  if (str=="")
  {
    document.getElementById("toage").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest)
  {
    xmlhttp=new XMLHttpRequest();
  }
  else
  {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("toage").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","filltoage.php?q="+str,true);
  xmlhttp.send();
}
$('select').selectpicker();
function getsearch1()
{
  document.form1.action="iit_search_result?page=1";
}
$(document).ready(function() {
  $('.mvv-btn').on('click', function() {
    var $this = $(this);
    var loadingText = 'Loading';
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
<style>
.contact-form .form-group select { text-align:left !important; }
@media screen and (max-width: 768px) {
  .selcs { max-width:83%; margin-left:22px; }
  .errsec { margin-top:30px; }
}
@media screen and (max-width: 568px) {
  .selcs { max-width:83%; margin-left:22px; }
  .errsec { margin-top:30px; }
}
.bootstrap-select > .dropdown-toggle { position:relative; width:100%; z-index:1; text-align:right; white-space:nowrap; height:3rem; line-height:34px; border-color:#a1a7a1; }
.contact-form .form-group select { position:relative; width:100%; max-width:100%; z-index:1; text-align:right; margin:0; white-space:nowrap; height:3rem; line-height:34px; border-color:#a1a7a1; }
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) { width:100% !important; }
</style>
</body>
</html>
