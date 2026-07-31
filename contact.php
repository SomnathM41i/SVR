<?php
ob_start();
require_once('includes/bootstrap.php');

$ID=$_GET['id'] ?? '';
$register=mysqli_query($con,"select * from register where MatriID='$ID'");
$fetchrecord=mysqli_fetch_assoc($register);

$login = $_SESSION['MatriID'] ?? '';
$row = $fetchrecord ?? [];
if(isset($login) && $login != '') {
  $my_profile = mysqli_query($con, "SELECT * FROM register where matriid='$login'");
  $me = mysqli_fetch_array($my_profile);
  $regvar = $me['reg_step'];
}

if(isset($_POST['submit']))
{
$address = $db->setfilter($_POST['address']);
$country = $db->setfilter($_POST['country']);
$state = $db->setfilter($_POST['state']);  
$city = $db->setfilter($_POST['city']);
$phone = $db->setfilter($_POST['phone']);
$dist = $db->setfilter($_POST['dist']);
$taluka = $db->setfilter($_POST['taluka'] ?? '');
$residence = $db->setfilter($_POST['residence']);
$mobile2 = $db->setfilter($_POST['mobile2']);
$mobile = $db->setfilter($_POST['mobile']);
$pincode = $db->setfilter($_POST['pincode']);
$calling = $db->setfilter($_POST['calling']);
$work_residence= $db->setfilter($_POST['work_residence']);
$work_address= $db->setfilter($_POST['work_address']);
$work_pincode= $db->setfilter($_POST['work_pincode']);
$working_city= $db->setfilter($_POST['working_city']);
$working_dist= $db->setfilter($_POST['working_dist']);
$working_taluka= $db->setfilter($_POST['working_taluka'] ?? '');
$working_state= $db->setfilter($_POST['working_state']);
$working_country= $db->setfilter($_POST['working_country']);

  if ( ($working_country == '') && ($working_state == '') && ($working_dist == '') && ($working_taluka == '') && ($working_city == '') && ($work_pincode == '') && ($work_address == '') && ($work_residence == '')  )
  {
    $working_country = $country;
    $work_address = $address;
    $work_pincode = $pincode;
    $working_city = $city;
    $work_residence = $residence;
    $working_dist = $dist;
    $working_taluka = $taluka;
    $working_state = $state;
  }

if(isset($login)&& $regvar=='9' )
{
 if( ($me['Address'] == $address ) && ($me['Country'] == $country ) && ($me['Dist'] == $dist ) && (($me['Taluka'] ?? '') == $taluka) && ($me['State'] == $state ) && ($me['City'] == $city ) && ($me['Phone'] == $phone ) && ($me['Residencystatus'] == $residence ) && ($me['Mobile2'] == $mobile2 ) && ($me['calling_time'] == $calling ) && ($me['Pincode'] == $pincode ) && ($me['Mobile'] == $mobile ) && ($me['working_country'] == $working_country ) && ($me['working_state'] == $working_state ) && ($me['working_dist'] == $working_dist ) && (($me['working_taluka'] ?? '') == $working_taluka) && ($me['working_city'] == $working_city ) && ($me['work_pincode'] == $work_pincode ) && ($me['work_address'] == $work_address  )&& ($me['work_residence'] == $work_residence ))
 {
    header('Location: index_dashboard'); exit;
 }
 else
 {
    mysqli_query($con,"update register set Address='$address',Country='$country',Dist='$dist',Taluka='$taluka',State='$state',City='$city',Phone='$phone',Residencystatus='$residence',Mobile2='$mobile2',calling_time='$calling',Pincode='$pincode',Mobile='$mobile',working_country='$working_country',working_state='$working_state',working_dist='$working_dist',working_taluka='$working_taluka',working_city='$working_city',work_pincode='$work_pincode',work_address='$work_address',work_residence='$work_residence' where MatriID='$login'");
 header('Location: index_dashboard'); exit;
 }
 }
else
{
    mysqli_query($con,"update register set Address='$address',Country='$country',Dist='$dist',Taluka='$taluka',State='$state',City='$city',Phone='$phone',Residencystatus='$residence',Mobile2='$mobile2',calling_time='$calling',Pincode='$pincode',Mobile='$mobile',reg_step='4',working_country='$working_country',working_state='$working_state',working_dist='$working_dist',working_taluka='$working_taluka',working_city='$working_city',work_pincode='$work_pincode',work_address='$work_address',work_residence='$work_residence' where MatriID='$ID'");
    header('Location: education?id='.$ID); exit;
}
}

$profileLocationType = $row['profile_location_type']
  ?? ($me['profile_location_type'] ?? ($_SESSION['registration_profile_type'] ?? 'Indian Resident'));
$isNriProfile = $profileLocationType === 'NRI';
?>
<?php $page_title = 'Contact Details - Manpasand Jodidar'; include('header3.php'); ?>
<style>
.mvv-form .mvv-checkbox-label {
  width: 100%;
  display: inline-flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  padding: 12px 14px;
  border: 1px solid var(--mvv-border);
  background: rgba(244,231,218,0.35);
  color: var(--mvv-text);
  font-size: 0.96rem;
  font-weight: 800;
  letter-spacing: 0;
  text-transform: none;
  user-select: none;
  transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
}

.mvv-form .mvv-checkbox-label:hover {
  border-color: rgba(212,164,55,0.58);
  background: rgba(244,231,218,0.62);
  box-shadow: 0 8px 22px rgba(58,42,34,0.07);
}

.mvv-form .mvv-checkbox-label input[type="checkbox"] {
  width: 22px !important;
  min-width: 22px !important;
  max-width: 22px !important;
  height: 22px !important;
  min-height: 22px !important;
  margin: 0 !important;
  padding: 0 !important;
  flex: 0 0 22px;
  cursor: pointer;
  accent-color: var(--mvv-maroon);
}

.mvv-form .mvv-checkbox-label span {
  display: inline-block;
  line-height: 1.35;
}

.mvv-form .mvv-checkbox-label input[type="checkbox"]:checked + span {
  color: var(--mvv-maroon);
}
</style>

<script type="text/javascript">
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}
function nospaces(t) {
    if(t.value.match(/\s/g)){ alert('Sorry, you are not allowed to enter any spaces'); t.value=t.value.replace(/\s/g,''); }
}
function ValidateAlpha(evt) {
    var keyCode = (evt.which) ? evt.which : evt.keyCode;
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) return false;
    return true;
}
function blockSpecialChar(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
function fillstate(str) {
    var xmlhttp;
    document.getElementById("state").innerHTML='<option value="">Select State</option>';
    document.getElementById("dist").innerHTML='<option value="">Select District</option>';
    document.getElementById("taluka").innerHTML='<option value="">Select Taluka</option>';
    document.getElementById("city_contact").innerHTML='<option value="">Select City</option>';
    if (str=="") return;
    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); }
    else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("state").innerHTML=xmlhttp.responseText; }
    };
    xmlhttp.open("GET","fill_state.php?q="+encodeURIComponent(str),true);
    xmlhttp.send();
}
function fillstate1(str) {
    var state = document.getElementById("working_state");
    var district = document.getElementById("working_dist");
    var taluka = document.getElementById("working_taluka");
    var city = document.getElementById("working_city");
    if (state) state.innerHTML='<option value="">Select State</option>';
    if (district) district.innerHTML='<option value="">Select District</option>';
    if (taluka) taluka.innerHTML='<option value="">Select Taluka</option>';
    if (city) city.innerHTML='<option value="">Select City</option>';
    if (str=="" || !state) return;
    var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) state.innerHTML=xmlhttp.responseText;
    };
    xmlhttp.open("GET","fill_state.php?q="+encodeURIComponent(str),true);
    xmlhttp.send();
}
function preventBack() { window.history.forward(); }
setTimeout("preventBack()", 0);
window.onunload = function() { null };
function check_box() {
    var chk = document.getElementById('chkPassport');
    var ids = ['working_coun_div','working_state_div','working_dist1_div','working_taluka_div','working_city_div','working_add_div','working_pin_div','working_residence_div'];
    ids.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.style.display = chk.checked ? '' : 'none';
    });
}
function check_box1() {
    var chk = document.getElementById('check');
    var ids = ['country_div','state_div','dist1_div','taluka_div','city_div','pin_div','add_div','add_desc_div','residence_div','info_div'];
    ids.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.style.display = chk.checked ? '' : 'none';
    });
}
function checkdiv1(str) {
    var hide = [], show = ['working_residence_div','working_add_div'];
    if (str=='Out of India' || str=='') {
        hide=['working_city_div','working_state_div','working_dist1_div','working_taluka_div','working_pin_div'];
    } else {
        show.push('working_city_div','working_state_div','working_dist1_div','working_taluka_div','working_pin_div');
    }
    hide.forEach(function(id){ var e=document.getElementById(id); if(e) e.style.display='none'; });
    show.forEach(function(id){ var e=document.getElementById(id); if(e) e.style.display=''; });
}
function checkdiv(str) {
    var hide=[], show=[];
    if (str=='Out of India') { hide=['state_div','city_div','dist1_div','taluka_div','pin_div']; show=['add_div']; }
    else { show=['state_div','city_div','dist1_div','taluka_div','pin_div','add_div']; }
    hide.forEach(function(id){ var e=document.getElementById(id); if(e) e.style.display='none'; });
    show.forEach(function(id){ var e=document.getElementById(id); if(e) e.style.display=''; });
}
function filldist(str) {
    var xmlhttp;
    document.getElementById("dist").innerHTML='<option value="">Select District</option>';
    document.getElementById("taluka").innerHTML='<option value="">Select Taluka</option>';
    document.getElementById("city_contact").innerHTML='<option value="">Select City</option>';
    if (str=="") return;
    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); }
    else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("dist").innerHTML=xmlhttp.responseText; }
    };
    xmlhttp.open("GET","fill_dist.php?q="+encodeURIComponent(str),true);
    xmlhttp.send();
}
function filldist1(str) {
    var xmlhttp;
    document.getElementById("working_dist").innerHTML='<option value="">Select District</option>';
    document.getElementById("working_taluka").innerHTML='<option value="">Select Taluka</option>';
    document.getElementById("working_city").innerHTML='<option value="">Select City</option>';
    if (str=="") return;
    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); }
    else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("working_dist").innerHTML=xmlhttp.responseText; }
    };
    xmlhttp.open("GET","fill_dist1.php?q="+encodeURIComponent(str),true);
    xmlhttp.send();
}
function filltaluka(str) {
    var taluka = document.getElementById("taluka");
    var city = document.getElementById("city_contact");
    taluka.innerHTML='<option value="">Select Taluka</option>';
    city.innerHTML='<option value="">Select City</option>';
    if (str=="") return;
    var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) taluka.innerHTML=xmlhttp.responseText;
    };
    xmlhttp.open("GET","fill_taluka.php?q="+encodeURIComponent(str),true);
    xmlhttp.send();
}

function filltaluka1(str) {
    var taluka = document.getElementById("working_taluka");
    var city = document.getElementById("working_city");
    taluka.innerHTML='<option value="">Select Taluka</option>';
    city.innerHTML='<option value="">Select City</option>';
    if (str=="") return;
    var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) taluka.innerHTML=xmlhttp.responseText;
    };
    xmlhttp.open("GET","fill_taluka.php?q="+encodeURIComponent(str),true);
    xmlhttp.send();
}

function fillcity(str) {
    var city = document.getElementById("city_contact");
    var district = document.getElementById("dist").value;
    city.innerHTML='<option value="">Select City</option>';
    if (str=="") return;
    var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) city.innerHTML=xmlhttp.responseText;
    };
    xmlhttp.open("GET","fill_city.php?taluka="+encodeURIComponent(str)+"&district="+encodeURIComponent(district),true);
    xmlhttp.send();
}

function fillcity1(str) {
    var city = document.getElementById("working_city");
    var district = document.getElementById("working_dist").value;
    city.innerHTML='<option value="">Select City</option>';
    if (str=="") return;
    var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) city.innerHTML=xmlhttp.responseText;
    };
    xmlhttp.open("GET","fill_city.php?taluka="+encodeURIComponent(str)+"&district="+encodeURIComponent(district),true);
    xmlhttp.send();
}
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Contact Details</div>
      <h1><?php echo $isNriProfile ? 'कुटुंबाचा पत्ता आणि संपर्क माहिती' : 'पत्ता आणि संपर्क माहिती'; ?></h1>
      <p><?php echo $isNriProfile
        ? 'तुमच्या कुटुंबाचा कायमचा पत्ता आणि तुमच्या कामाच्या ठिकाणाची माहिती भरा'
        : 'तुमचा कायमचा पत्ता आणि कामाची ठिकाणाची माहिती भरा'; ?></p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <?php if(isset($login)&& $regvar=='9') { ?>
        <a href="index_dashboard">Dashboard</a>
        <?php } else { ?>
        <a href="index">Home</a>
        <?php } ?>
        <span><?php echo $isNriProfile ? 'कुटुंबाचा पत्ता' : 'Contact Details'; ?></span>
      </nav>
      <?php if (($regvar ?? '') == '9') { ?>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
      <?php } ?>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(isset($_GET['message']) && $_GET['message']!='') { ?>
      <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:12px 18px;margin-bottom:20px;text-align:center;">
        <?php if($_GET['message']=='success') { ?>
          Your Details Updated Successfully
        <?php } if($_GET['message']=='flag') { ?>
          Please Select Atleast One Value For Upload.
        <?php } ?>
      </div>
      <?php } ?>

      <div class="row g-5 mvv-registration-row">
        <?php if(isset($login)&& $regvar=='9') { ?>
        <div class="col-lg-9 col-md-12">
          <form method="post" action="#" class="mvv-form">
            <div class="mvv-eyebox">Address &amp; Contact</div>
            <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.4vw,2rem);">तुमचा पत्ता एडिट करा</h2>

            <div class="mvv-form-grid">
              <div class="mvv-field" style="grid-column:1/-1;">
                <label class="mvv-checkbox-label">
                  <input type="checkbox" name="checkboxhide" id="check" onclick="check_box1();">
                  <span>Show Permanent Address</span>
                </label>
              </div>

              <div class="mvv-field" id="country_div" style="display:none">
                <label>Country</label>
                <select name="country" id="country" onchange="checkdiv(this.value);fillstate(this.value);" tabindex="1">
                  <?php if($me['Country']=="") { ?>
                  <?php } else { ?>
                  <option value="<?php echo $me['Country'];?>" selected><?php echo $me['Country'];?></option>
                  <?php }?>
                  <?php $sqlc = mysqli_query($con,"select * from e_country where status='enable' order by Country ASC");
                  while($rowc = mysqli_fetch_array($sqlc)) {
                    echo '<option value="' . $rowc['country'] . '">' . $rowc['country'] . '</option>';
                  }?>
                </select>
              </div>

              <?php if(true) { ?>
              <div class="mvv-field" id="state_div" style="display:none">
                <label>State</label>
                <select name="state" id="state" onchange="filldist(this.value)" tabindex="2">
                  <?php if($me['State']=="") { ?>
                  <?php } else { ?>
                  <option value="<?php echo $me['State'];?>" selected><?php echo $me['State'];?></option>
                  <?php }?>
                  <?php $rrs=mysqli_query($con,"select * from e_state where status='enable' AND cid='".$me['Country']."'");
                  while($rrow=mysqli_fetch_array($rrs)) {?>
                  <option value="<?php echo $rrow['state'];?>"><?php echo $rrow['state'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="dist1_div" style="display:none">
                <label>District</label>
                <select name="dist" tabindex="3" id="dist" onchange="filltaluka(this.value)">
                  <?php if($me['Dist']=="") { ?>
                  <?php } else { ?>
                  <option value="<?php echo $me['Dist'];?>" selected><?php echo $me['Dist'];?></option>
                  <?php }?>
                  <?php if($me['State']!="") {
                    $rrs=mysqli_query($con,"select * from e_dist where sid2='".$me['State']."' and status='enable'");
                    while($rrow=mysqli_fetch_array($rrs)) {
                      $_SESSION['dis']=$rrow['dist'];
                      if($rrow['dist']==$row['dist']) { ?>
                        <option value="<?php echo $rrow['Dist'];?>" selected><?php echo $rrow['Dist'];?></option>
                      <?php } else { ?>
                        <option value="<?php echo $rrow['dist'];?>"><?php echo $rrow['dist'];?></option>
                      <?php }
                    }
                  }?>
                </select>
              </div>

              <div class="mvv-field" id="taluka_div" style="display:none">
                <label>Taluka</label>
                <select name="taluka" id="taluka" onchange="fillcity(this.value)" tabindex="4">
                  <option value="<?php echo htmlspecialchars($me['Taluka'] ?? '', ENT_QUOTES); ?>" selected><?php echo htmlspecialchars($me['Taluka'] ?? 'Select Taluka'); ?></option>
                  <?php
                  $talukaResult = mysqli_query($con, "SELECT taluka FROM e_taluka WHERE dist_ref='".mysqli_real_escape_string($con, $me['Dist'])."' AND status='enable' ORDER BY taluka");
                  while($talukaResult && ($talukaRow = mysqli_fetch_assoc($talukaResult))) {
                    if($talukaRow['taluka'] !== ($me['Taluka'] ?? '')) echo '<option value="'.htmlspecialchars($talukaRow['taluka'], ENT_QUOTES).'">'.htmlspecialchars($talukaRow['taluka']).'</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="mvv-field" id="city_div" style="display:none">
                <label>City</label>
                <select name="city" id="city_contact" tabindex="5">
                  <option value="<?php echo htmlspecialchars($me['City'], ENT_QUOTES); ?>" selected><?php echo htmlspecialchars($me['City']); ?></option>
                  <?php
                  $cityResult = mysqli_query($con, "SELECT DISTINCT city FROM e_city WHERE (taluka_ref='".mysqli_real_escape_string($con, $me['Taluka'] ?? '')."' OR (taluka_ref='' AND dist_ref='".mysqli_real_escape_string($con, $me['Dist'])."')) ORDER BY city ASC");
                  while($cityResult && ($cityRow = mysqli_fetch_assoc($cityResult))) {
                    if($cityRow['city'] !== $me['City']) echo '<option value="'.htmlspecialchars($cityRow['city'], ENT_QUOTES).'">'.htmlspecialchars($cityRow['city']).'</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="mvv-field" id="pin_div" style="display:none">
                <label>Pincode</label>
                <input type="text" placeholder="Enter Pincode" name="pincode" id="myInput" maxlength="6" onKeyPress="return isNumber(event);" tabindex="5" value="<?php echo $me['Pincode']?>">
              </div>
              <?php } ?>

              <div class="mvv-field" id="residence_div" style="display:none">
                <label>Residence In</label>
                <select name="residence" tabindex="6">
                  <?php if($me['Residencystatus']=="") { ?>
                  <?php } else { ?>
                  <option value="<?php echo $me['Residencystatus'];?>" selected><?php echo $me['Residencystatus'];?></option>
                  <?php }?>
                  <?php $res = mysqli_query($con,"SELECT * FROM residency_status where status='enable'");
                  while($res_row=mysqli_fetch_array($res)) { ?>
                  <option value="<?php echo $res_row['residency_status'];?>"><?php echo $res_row['residency_status'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="add_div" style="grid-column:1/-1;display:none;">
                <label>Address</label>
                <textarea name="address" placeholder="Enter Address" maxlength="100" tabindex="7"><?php echo $me['Address']?></textarea>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;" id="add_desc_div">
                <small style="color:var(--mvv-muted);">Specify house name, flat no, landmark, etc.</small>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label class="mvv-checkbox-label">
                  <input type="checkbox" name="checkboxhide" id="chkPassport" onclick="check_box()">
                  <span>Working address is different</span>
                </label>
              </div>

              <div class="mvv-field" id="working_coun_div" style="display:none">
                <label>Working Country</label>
                <select name="working_country" id="working_country" onchange="checkdiv1(this.value);fillstate1(this.value)" tabindex="8">
                  <option value="<?php echo $me['working_country'];?>" selected><?php echo $me['working_country'];?></option>
                  <?php $sqlc = mysqli_query($con,"select * from e_country where status='enable' order by id ASC");
                  while($rowc = mysqli_fetch_array($sqlc)) {
                    echo '<option value="' . $rowc['country'] . '">' . $rowc['country'] . '</option>';
                  }?>
                </select>
              </div>

              <?php if(true) { ?>
              <div class="mvv-field" id="working_state_div" style="display:none">
                <label>Working State</label>
                <select name="working_state" id="working_state" onchange="filldist1(this.value)" tabindex="9">
                  <option value="<?php echo $me['working_state']?>" selected><?php echo $me['working_state']; ?></option>
                  <?php $rrs=mysqli_query($con,"select * from e_state where cid='".mysqli_real_escape_string($con, $me['working_country'])."' and status='enable'");
                  while($rrow=mysqli_fetch_array($rrs)) { ?>
                  <option value="<?php echo $rrow['state'];?>"><?php echo $rrow['state'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="working_dist1_div" style="display:none">
                <label>Working District</label>
                <select name="working_dist" tabindex="10" id="working_dist" onchange="filltaluka1(this.value)">
                  <?php if($me['working_dist'] == "") { ?>
                  <option value="">Select District</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['working_dist'];?>" selected><?php echo $me['working_dist'];?></option>
                  <?php }?>
                  <?php if($me['working_dist']!="") {
                    $rrs=mysqli_query($con,"select * from e_dist where sid2='".$me['working_state']."' and status='enable'");
                    while($rrow=mysqli_fetch_array($rrs)) {
                      $_SESSION['dis']=$rrow['dist'];
                      if($rrow['dist']==$row['dist']) { ?>
                        <option value="<?php echo $rrow['Dist'];?>" selected><?php echo $rrow['Dist'];?></option>
                      <?php } else { ?>
                        <option value="<?php echo $rrow['dist'];?>"><?php echo $rrow['dist'];?></option>
                      <?php }
                    }
                  }?>
                </select>
              </div>

              <div class="mvv-field" id="working_taluka_div" style="display:none">
                <label>Working Taluka</label>
                <select name="working_taluka" id="working_taluka" onchange="fillcity1(this.value)" tabindex="11">
                  <option value="<?php echo htmlspecialchars($me['working_taluka'] ?? '', ENT_QUOTES); ?>" selected><?php echo htmlspecialchars($me['working_taluka'] ?? 'Select Taluka'); ?></option>
                  <?php
                  $workingTalukaResult = mysqli_query($con, "SELECT taluka FROM e_taluka WHERE dist_ref='".mysqli_real_escape_string($con, $me['working_dist'])."' AND status='enable' ORDER BY taluka");
                  while($workingTalukaResult && ($workingTalukaRow = mysqli_fetch_assoc($workingTalukaResult))) {
                    if($workingTalukaRow['taluka'] !== ($me['working_taluka'] ?? '')) echo '<option value="'.htmlspecialchars($workingTalukaRow['taluka'], ENT_QUOTES).'">'.htmlspecialchars($workingTalukaRow['taluka']).'</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="mvv-field" id="working_city_div" style="display:none">
                <label>Working City</label>
                <select name="working_city" id="working_city" tabindex="12">
                  <option value="<?php echo htmlspecialchars($me['working_city'], ENT_QUOTES); ?>" selected><?php echo htmlspecialchars($me['working_city']); ?></option>
                  <?php
                  $workingCityResult = mysqli_query($con, "SELECT DISTINCT city FROM e_city WHERE (taluka_ref='".mysqli_real_escape_string($con, $me['working_taluka'] ?? '')."' OR (taluka_ref='' AND dist_ref='".mysqli_real_escape_string($con, $me['working_dist'])."')) ORDER BY city ASC");
                  while($workingCityResult && ($workingCityRow = mysqli_fetch_assoc($workingCityResult))) {
                    if($workingCityRow['city'] !== $me['working_city']) echo '<option value="'.htmlspecialchars($workingCityRow['city'], ENT_QUOTES).'">'.htmlspecialchars($workingCityRow['city']).'</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="mvv-field" id="working_pin_div" style="display:none">
                <label>Working Pincode</label>
                <input type="text" placeholder="Enter Pincode" name="work_pincode" id="myInput" maxlength="6" onKeyPress="return isNumber(event);" tabindex="12" value="<?php echo $me['work_pincode']; ?>">
              </div>
              <?php } ?>

              <div class="mvv-field" id="working_residence_div" style="display:none">
                <label>Working Residence In</label>
                <select name="work_residence" tabindex="13">
                  <option value="<?php echo $me['work_residence']?>" selected><?php echo $me['work_residence']?></option>
                  <?php $w_res = mysqli_query($con,"SELECT * FROM residency_status WHERE status='enable'");
                  while($w_row=mysqli_fetch_array($w_res)) { ?>
                  <option value="<?php echo $w_row['residency_status']?>"><?php echo $w_row['residency_status']?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="working_add_div" style="grid-column:1/-1;display:none;">
                <label>Working Address</label>
                <textarea name="work_address" placeholder="Enter Address" maxlength="100" tabindex="14"><?php echo $me['work_address'];?></textarea>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <small style="color:var(--mvv-muted);">Specify house name, flat no, landmark, etc.</small>
              </div>

              <div class="mvv-field">
                <label>Alternate / WhatsApp Number</label>
                <input type="text" maxlength="10" placeholder="Alternate/Whatsapp Number" id="mobile2" onkeypress="return isNumber(event)" name="mobile2" tabindex="15" value="<?php echo $me['Mobile2']?>">
              </div>

              <div class="mvv-field">
                <label>Mobile</label>
                <input type="text" maxlength="14" placeholder="Mobile Number" onkeypress="return isNumber(event)" name="mobile" readonly value="<?php echo $me['Mobile']?>" tabindex="16">
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>Convenient Time to Call</label>
                <select name="calling" tabindex="17">
                  <?php if($me['calling_time'] == "") { ?>
                  <option value="" selected>Convenient Time to Call</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['calling_time']?>" selected><?php echo $me['calling_time']?></option>
                  <?php } ?>
                  <?php $calling=mysqli_query($con,"select * from calling_time");
                  while($callrow=mysqli_fetch_array($calling)) { ?>
                  <option value="<?php echo $callrow['call_time'];?>"><?php echo $callrow['call_time'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="mvv-field" style="grid-column:1/-1;margin-top:12px;">
              <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" tabindex="18">Update</button>
            </div>
          </form>
        </div>
        <?php } else { ?>
        <div class="col-lg-9 col-md-12">
          <form method="post" action="#" class="mvv-form">
            <div class="mvv-eyebox">Address &amp; Contact</div>
            <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.4vw,2rem);">
              <?php echo $isNriProfile ? 'तुमच्या कुटुंबाचा पत्ता' : 'तुमचा पत्ता भरा'; ?>
            </h2>

            <div class="mvv-form-grid">
              <div class="mvv-field">
                <label>Country <span class="text-danger">*</span></label>
                <select name="country" id="country" onchange="checkdiv(this.value);fillstate(this.value)" tabindex="1" required>
                  <option value="">Select Country</option>
                  <?php $sqlc = mysqli_query($con,"select * from e_country where status='enable' order by id ASC");
                  while($rowc = mysqli_fetch_array($sqlc)) {
                    echo '<option value="' . $rowc['country'] . '">' . $rowc['country'] . '</option>';
                  }?>
                </select>
              </div>

              <div class="mvv-field" id="state_div" style="display:none">
                <label>State <span class="text-danger">*</span></label>
                <select name="state" id="state" onchange="filldist(this.value)" tabindex="2" required>
                  <option value="">Select State</option>
                  <?php $rrs=mysqli_query($con,"select * from e_state where cid='India' and status='enable'");
                  while($rrow=mysqli_fetch_array($rrs)) { ?>
                  <option value="<?php echo $rrow['state'];?>"><?php echo $rrow['state'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="dist1_div" style="display:none">
                <label>District <span class="text-danger">*</span></label>
                <select name="dist" tabindex="3" id="dist" onchange="filltaluka(this.value)" required>
                  <option value="">Select District</option>
                  <?php if($row['State']!=""){
                    $rrs=mysqli_query($con,"select * from e_dist where sid2='".$row['State']."' and status='enable'");
                    while($rrow=mysqli_fetch_array($rrs)) {
                      $_SESSION['dis']=$rrow['dist'];
                      if($rrow['dist']==$row['dist']) { ?>
                        <option value="<?php echo $rrow['Dist'];?>" selected><?php echo $rrow['Dist'];?></option>
                      <?php } else { ?>
                        <option value="<?php echo $rrow['dist'];?>"><?php echo $rrow['dist'];?></option>
                      <?php }
                    }
                  }?>
                </select>
              </div>

              <div class="mvv-field" id="taluka_div" style="display:none">
                <label>Taluka <span class="text-danger">*</span></label>
                <select name="taluka" id="taluka" onchange="fillcity(this.value)" tabindex="4" required>
                  <option value="">Select Taluka</option>
                </select>
              </div>

              <div class="mvv-field" id="city_div" style="display:none">
                <label>City <span class="text-danger">*</span></label>
                <select name="city" id="city_contact" tabindex="5" required>
                  <option value="">Select City</option>
                </select>
              </div>

              <div class="mvv-field" id="pin_div" style="display:none">
                <label>Pincode</label>
                <input type="text" placeholder="Enter Pincode" name="pincode" id="myInput" maxlength="6" onKeyPress="return isNumber(event);" tabindex="5">
              </div>

              <div class="mvv-field">
                <label>Residence In <span class="text-danger">*</span></label>
                <select name="residence" tabindex="6">
                  <option value="" selected>Select Residence In</option>
                  <?php $restatus = mysqli_query($con,"SELECT * FROM residency_status WHERE status='enable'");
                  while($row_res = mysqli_fetch_array($restatus)) { ?>
                  <option value="<?php echo $row_res['residency_status']?>"><?php echo $row_res['residency_status']?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="add_div" style="grid-column:1/-1;max-width:84%">
                <label>Address</label>
                <textarea name="address" placeholder="Enter Address" maxlength="100" tabindex="7"></textarea>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label class="mvv-checkbox-label">
                  <input type="checkbox" name="checkboxhide" id="chkPassport" onclick="check_box()">
                  <span>Working address is different</span>
                </label>
              </div>

              <div class="mvv-field" id="working_coun_div" style="display:none">
                <label>Working Country</label>
                <select name="working_country" id="working_country" onchange="checkdiv1(this.value);fillstate1(this.value)" tabindex="8">
                  <option value="">Select Country</option>
                  <?php $rs2=mysqli_query($con,"select * from e_country where status='enable'");
                  while($rss1=mysqli_fetch_array($rs2)){
                    echo '<option value="' . $rss1['country'] . '">' . $rss1['country'] . '</option>';
                  }?>
                </select>
              </div>

              <div class="mvv-field" id="working_state_div" style="display:none">
                <label>Working State</label>
                <select name="working_state" id="working_state" onchange="filldist1(this.value)" tabindex="9">
                  <option value="">Select State</option>
                  <?php $rrs=mysqli_query($con,"select * from e_state where cid='India' and status='enable'");
                  while($rrow=mysqli_fetch_array($rrs)) { ?>
                  <option value="<?php echo $rrow['state'];?>"><?php echo $rrow['state'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="working_dist1_div" style="display:none">
                <label>Working District</label>
                <select name="working_dist" tabindex="10" id="working_dist" onchange="filltaluka1(this.value)">
                  <option value="">Select District</option>
                  <?php if($row['State']!=""){
                    $rrs=mysqli_query($con,"select * from e_dist where sid2='".$row['State']."' and status='enable'");
                    while($rrow=mysqli_fetch_array($rrs)) {
                      $_SESSION['dis']=$rrow['dist'];
                      if($rrow['dist']==$row['dist']) { ?>
                        <option value="<?php echo $rrow['Dist'];?>" selected><?php echo $rrow['Dist'];?></option>
                      <?php } else { ?>
                        <option value="<?php echo $rrow['dist'];?>"><?php echo $rrow['dist'];?></option>
                      <?php }
                    }
                  }?>
                </select>
              </div>

              <div class="mvv-field" id="working_taluka_div" style="display:none">
                <label>Working Taluka</label>
                <select name="working_taluka" id="working_taluka" onchange="fillcity1(this.value)" tabindex="11">
                  <option value="">Select Taluka</option>
                </select>
              </div>

              <div class="mvv-field" id="working_city_div" style="display:none">
                <label>Working City</label>
                <select name="working_city" id="working_city" tabindex="12">
                  <option value="">Select City</option>
                </select>
              </div>

              <div class="mvv-field" id="working_pin_div" style="display:none">
                <label>Working Pincode</label>
                <input type="text" placeholder="Enter Pincode" name="work_pincode" id="myInput" maxlength="6" onKeyPress="return isNumber(event);" tabindex="12">
              </div>

              <div class="mvv-field" id="working_residence_div" style="display:none">
                <label>Working Residence In</label>
                <select name="work_residence" tabindex="13">
                  <option value="" selected>Select Residence In</option>
                  <?php $w_restatus = mysqli_query($con,"SELECT * FROM residency_status WHERE status='enable'");
                  while($work_row = mysqli_fetch_array($w_restatus)) { ?>
                  <option value="<?php echo $work_row['residency_status']?>"><?php echo $work_row['residency_status']?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="working_add_div" style="grid-column:1/-1;display:none;max-width:84%">
                <label>Working Address</label>
                <textarea name="work_address" placeholder="Enter Address" maxlength="100" tabindex="14"></textarea>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <small style="color:var(--mvv-muted);">Specify house name, flat no, landmark, etc.</small>
              </div>

              <div class="mvv-field">
                <label>Alternate / WhatsApp Number</label>
                <input type="text" maxlength="10" placeholder="Alternate/Whatsapp Number" id="mobile2" onkeypress="return isNumber(event)" name="mobile2" tabindex="15">
              </div>

              <div class="mvv-field">
                <label>Mobile <span class="text-danger">*</span></label>
                <input type="text" maxlength="14" placeholder="Mobile Number" onkeypress="return isNumber(event)" name="mobile" readonly value="<?php echo $me['Mobile']?>" tabindex="16">
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>Convenient Time to Call</label>
                <select name="calling" tabindex="17">
                  <option value="" selected>Select Convenient Time to Call</option>
                  <?php $calling=mysqli_query($con,"select * from calling_time");
                  while($callrow=mysqli_fetch_array($calling)) { ?>
                  <option value="<?php echo $callrow['call_time'];?>"><?php echo $callrow['call_time'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="mvv-field" style="grid-column:1/-1;margin-top:12px;">
              <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" tabindex="18">Submit Now</button>
            </div>
          </form>
        </div>
        <?php } ?>

        <div class="col-lg-3 col-md-12">
          <?php include('contactinfo.php');?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

<script>
document.querySelectorAll('button[type="submit"]').forEach(function(btn) {
  btn.addEventListener('click', function() {
    if (this.innerHTML.indexOf('fa-spinner') === -1) {
      this.dataset.originalText = this.innerHTML;
      this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading';
      setTimeout(function() { btn.innerHTML = btn.dataset.originalText; }, 500);
    }
  });
});
</script>
