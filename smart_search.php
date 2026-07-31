<?php 
require_once('includes/bootstrap.php');
require_once('includes/annual_income.php');
include('memprotect.php');
error_reporting(0); 
$login=$_SESSION['MatriID'];
$seo=mysqli_query($con,"Select * from seo where catagory='search'");
$seof=mysqli_fetch_array($seo);

$heightOptions = [
  1=>'4Ft', 2=>'4Ft 1 inch', 3=>'4Ft 2 inch', 4=>'4Ft 3 inch',
  5=>'4Ft 4 inch', 6=>'4Ft 5 inch', 7=>'4Ft 6 inch', 8=>'4Ft 7 inch',
  9=>'4Ft 8 inch', 10=>'4Ft 9 inch', 11=>'4Ft 10 inch', 12=>'4Ft 11 inch',
  13=>'5Ft', 14=>'5Ft 1 inch', 15=>'5Ft 2 inch', 16=>'5Ft 3 inch',
  17=>'5Ft 4 inch', 18=>'5Ft 5 inch', 19=>'5Ft 6 inch', 20=>'5Ft 7 inch',
  21=>'5Ft 8 inch', 22=>'5Ft 9 inch', 23=>'5Ft 10 inch', 24=>'5Ft 11 inch',
  25=>'6Ft', 26=>'6Ft 1 inch', 27=>'6Ft 2 inch', 28=>'6Ft 3 inch',
  29=>'6Ft 4 inch', 30=>'6Ft 5 inch', 31=>'6Ft 6 inch', 32=>'6Ft 7 inch',
  33=>'6Ft 8 inch', 34=>'6Ft 9 inch', 35=>'6Ft 10 inch', 36=>'6Ft 11 inch',
  37=>'7Ft'
];

$workingCities = [];
$workingCityResult = mysqli_query(
  $con,
  "SELECT DISTINCT workinglocation FROM register WHERE workinglocation<>'' ORDER BY workinglocation"
);
while ($workingCityRow = mysqli_fetch_assoc($workingCityResult)) {
  $workingCities[] = $workingCityRow['workinglocation'];
}

$nativeCities = [];
$nativeCityResult = mysqli_query(
  $con,
  "SELECT DISTINCT City FROM register WHERE City<>'' ORDER BY City"
);
while ($nativeCityRow = mysqli_fetch_assoc($nativeCityResult)) {
  $nativeCities[] = $nativeCityRow['City'];
}

$talukas = [];
$talukaResult = mysqli_query(
  $con,
  "SELECT DISTINCT taluka
   FROM e_taluka
   WHERE status='enable'
   ORDER BY taluka"
);
while ($talukaRow = mysqli_fetch_assoc($talukaResult)) {
  $talukas[] = $talukaRow['taluka'];
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $seof['title']; ?></title>
  <link rel="icon" type="image/png" sizes="32x32" href="css3/assets/shivraj-logo.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <meta name="keywords" content="<?php echo $seof['keyword']; ?>" />
  <meta name="description" content="<?php echo $seof['description']; ?>" />
  <style>
    .mvv-page-hero { overflow: visible !important; isolation: isolate; }
    .mvv-page-hero h1 { text-transform: none; }

    .selcs { max-width: 100%; }
    .mvv-search-card {
      max-width: 1120px; margin: 0 auto;
      background: rgba(255,255,255,.96);
      border: 1px solid var(--mvv-border);
      border-radius: 18px;
      padding: clamp(20px,4vw,38px);
      box-shadow: 0 14px 36px rgba(58,42,34,.09);
    }
    .mvv-search-head {
      padding-bottom: 20px; margin-bottom: 24px;
      border-bottom: 1px solid var(--mvv-border);
    }
    .mvv-search-head .text {
      margin: 0 0 6px !important;
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.5rem,3vw,2rem); font-weight: 700;
      color: var(--mvv-maroon);
    }
    .mvv-search-note { margin:0; color:var(--mvv-muted); font-size:.92rem; }
    .mvv-search-grid { row-gap: 18px; }
    .mvv-search-grid .form-group { margin-bottom: 0; }
    .mvv-id-search {
      display: grid;
      grid-template-columns: minmax(0,1fr) minmax(320px,520px);
      align-items: center;
      gap: 22px;
      margin-bottom: 26px;
      padding: 18px 20px;
      border: 1px solid #ead8ca;
      border-radius: 13px;
      background: linear-gradient(135deg,#fff8f1,#fff);
    }
    .mvv-id-search-copy { display:flex;align-items:center;gap:12px;min-width:0; }
    .mvv-id-search-icon {
      display:inline-flex;align-items:center;justify-content:center;
      flex:0 0 42px;width:42px;height:42px;border-radius:11px;
      background:#fff0e5;color:var(--mvv-saffron);font-size:1rem;
    }
    .mvv-id-search-copy h3 { margin:0 0 3px;color:var(--mvv-maroon);font-size:1rem;font-weight:700; }
    .mvv-id-search-copy p { margin:0;color:var(--mvv-muted);font-size:.82rem;line-height:1.4; }
    .mvv-id-search-form { display:flex;gap:8px; }
    .mvv-id-search-form input {
      min-width:0;flex:1;height:46px;padding:0 14px;
      border:1px solid var(--mvv-border);border-radius:9px;background:#fff;
      color:var(--mvv-text);font:inherit;text-transform:uppercase;
    }
    .mvv-id-search-form input:focus {
      outline:none;border-color:var(--mvv-gold);
      box-shadow:0 0 0 4px rgba(201,146,26,.13);
    }
    .mvv-id-search-form button {
      flex:0 0 auto;min-height:46px;padding:0 18px;border:0;border-radius:9px;
      background:var(--mvv-maroon);color:#fff;font-weight:700;cursor:pointer;
    }
    .mvv-id-search-form button:hover { background:#8B1A1A; }

    /* Native single selects (Gender, With Photo) */
    .mvv-smart-form select.mvv-sel {
      width: 100%;
      min-height: 50px; height: 50px;
      padding: 0 38px 0 14px;
      font-size: .94rem; font-weight: 400;
      color: var(--mvv-text);
      border: 1px solid var(--mvv-border);
      border-radius: 9px;
      background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%237A5C4A' d='M1.41.59L6 5.17 10.59.59 12 2l-6 6-6-6z'/%3E%3C/svg%3E") no-repeat right 14px center;
      background-size: 12px 8px;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      cursor: pointer;
      transition: border-color .2s;
      font-family: inherit;
    }
    .mvv-smart-form select.mvv-sel:focus {
      border-color: var(--mvv-gold);
      outline: none;
      box-shadow: 0 0 0 4px rgba(201,146,26,.13);
    }

    /* Age selects — native look + SVG caret */
    .mvv-smart-form select.custom-select-box {
      -webkit-appearance: auto;
      -moz-appearance: auto;
      appearance: auto;
      background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%237A5C4A' d='M1.41.59L6 5.17 10.59.59 12 2l-6 6-6-6z'/%3E%3C/svg%3E") no-repeat right 14px center;
      padding: 0 38px 0 14px;
      cursor: pointer;
      width: 100%;
      min-height: 50px; height: 50px;
      font-size: .94rem;
      border: 1px solid var(--mvv-border);
      border-radius: 9px;
      color: var(--mvv-text);
    }

    /* Multi-select custom widget */
    .mvv-msel { position: relative; width: 100%; }
    .mvv-msel > select { display: none; }

    .mvv-msel-btn {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      min-height: 50px; height: 50px;
      padding: 0 38px 0 14px;
      font-size: .94rem; font-weight: 400;
      font-family: inherit;
      color: var(--mvv-text);
      background: #fff;
      border: 1px solid var(--mvv-border);
      border-radius: 9px;
      cursor: pointer;
      text-align: left;
      transition: border-color .2s;
    }
    .mvv-msel-btn:hover { border-color: var(--mvv-gold); }
    .mvv-msel-btn:focus,
    .mvv-msel-btn.active {
      border-color: var(--mvv-gold);
      box-shadow: 0 0 0 4px rgba(201,146,26,.13);
      outline: none;
    }
    .mvv-msel-arrow {
      font-size: .65rem;
      color: var(--mvv-muted);
      transition: transform .25s;
      flex-shrink: 0;
      margin-left: 8px;
    }
    .mvv-msel-btn.active .mvv-msel-arrow {
      transform: rotate(180deg);
    }
    .mvv-msel-text {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      flex: 1;
    }

    .mvv-msel-drop {
      display: none;
      position: absolute;
      top: 100%; left: 0; right: 0;
      z-index: 9999;
      margin-top: 5px;
      padding: 6px;
      background: #fff;
      border: 1px solid var(--mvv-border);
      border-radius: 10px;
      box-shadow: 0 12px 30px rgba(58,42,34,.16);
      max-height: 280px;
      overflow-y: auto;
    }
    .mvv-msel-drop.show { display: block; }
    .mvv-msel-search-wrap {
      position: sticky;
      top: -6px;
      z-index: 2;
      margin: -6px -6px 4px;
      padding: 7px;
      background: #fff;
      border-bottom: 1px solid var(--mvv-border);
    }
    .mvv-msel-search {
      width: 100%;
      min-height: 38px;
      padding: 7px 10px;
      border: 1px solid var(--mvv-border);
      border-radius: 7px;
      color: var(--mvv-text);
      font: inherit;
    }
    .mvv-msel-search:focus {
      outline: none;
      border-color: var(--mvv-gold);
      box-shadow: 0 0 0 3px rgba(201,146,26,.13);
    }
    .mvv-msel-empty {
      display: none;
      padding: 12px 11px;
      color: var(--mvv-muted);
      font-size: .88rem;
    }

    .mvv-msel-opt {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 11px;
      border-radius: 6px;
      cursor: pointer;
      transition: background .12s;
      margin: 0;
      font-weight: 400;
    }
    .mvv-msel-opt:hover { background: var(--mvv-cream); }
    .mvv-msel-opt.selected { background: var(--mvv-cream); }
    .mvv-msel-opt.selected .mvv-msel-opt-text { color: var(--mvv-maroon); font-weight: 600; }

    .mvv-msel-opt input[type="checkbox"] {
      width: 18px; height: 18px;
      accent-color: var(--mvv-maroon);
      cursor: pointer;
      flex-shrink: 0;
      margin: 0;
    }
    .mvv-msel-opt-text {
      font-size: .9rem;
      color: var(--mvv-text);
      line-height: 1.3;
    }

    /* Action buttons */
    .mvv-search-actions {
      display: flex; flex-wrap: wrap; gap: 10px;
      justify-content: flex-end;
      margin-top: 26px; padding-top: 22px;
      border-top: 1px solid var(--mvv-border);
    }
    .mvv-btn.mvv-btn-primary {
      background: var(--mvv-maroon); color: #fff;
      border: 0; border-radius: 9px;
      padding: 12px 22px; font-weight: 700;
      transition: background .2s;
    }
    .mvv-btn.mvv-btn-primary:hover { background: #8B1A1A; }
    .mvv-search-actions .mvv-btn { margin: 0 !important; }

    @media screen and (max-width:768px) {
      .mvv-search-card { padding: 22px 16px; }
      .mvv-id-search { grid-template-columns:1fr;gap:13px;padding:15px;margin-bottom:20px; }
      .mvv-id-search-form { flex-direction:column; }
      .mvv-id-search-form button { width:100%; }
      .mvv-search-actions { justify-content: stretch; }
      .mvv-search-actions .mvv-btn { flex: 1; }
      .mvv-smart-form select.mvv-sel,
      .mvv-msel-btn,
      .mvv-smart-form select.custom-select-box {
        min-height: 48px; height: 48px;
      }
    }
  </style>
<script>
function fillage(str) {
  var xmlhttp;
  if (str=="") { document.getElementById("toage").innerHTML=""; return; }
  if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest();
  else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      document.getElementById("toage").innerHTML=xmlhttp.responseText;
  }
  xmlhttp.open("GET","filltoage.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>
<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Search</div>
      <h1>Search Profile</h1>
      <p>प्रोफाइल शोधा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <?php if(isset($login)&& $regvar=='9') { ?>
        <a href="index_dashboard">Home</a>
        <?php }else{ ?>
        <a href="index">Home</a>
        <?php } ?>
        <span>Search Profile</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="contact-form mvv-search-card">
        <div class="mvv-search-head">
          <div class="text">Find Your Special Someone</div>
          <p class="mvv-search-note">Choose the preferences that matter to you and discover compatible profiles.</p>
          <?php if(!(isset($login)&& $regvar=='9')) { ?>
          <p class="mvv-search-note" style="margin-top:8px;color:var(--mvv-saffron);">Advanced, ID, and saved searches are available after login.</p>
          <?php } ?>
        </div>
        <?php if(isset($login) && $regvar=='9') { ?>
        <section class="mvv-id-search" aria-labelledby="mvvIdSearchTitle">
          <div class="mvv-id-search-copy">
            <span class="mvv-id-search-icon" aria-hidden="true"><i class="fas fa-id-badge"></i></span>
            <div>
              <h3 id="mvvIdSearchTitle">Search by Matrimony ID</h3>
              <p>Already know the profile ID? Find that member directly.</p>
            </div>
          </div>
          <form class="mvv-id-search-form" method="post" action="idsearch_result">
            <input type="search" name="matriid" placeholder="Enter Matrimony ID" aria-label="Matrimony ID" autocomplete="off" required>
            <button type="submit" name="submit_id"><i class="fas fa-search" aria-hidden="true"></i> Search Profile</button>
          </form>
        </section>
        <?php } ?>
        <div class="col-lg-12 mt-3">
          <form class="form-horizontal mvv-smart-form" action="#" method="post" name="form1">
            <div class="row mvv-search-grid">		
              <?php
                if($me['Gender']=="Male")
              {?>
                <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                  <select class="mvv-sel" name="gender" required tabindex="1">
                    <option value="Female" selected>Female</option>
                  </select>
                </div>
              <?php }
              else if($me['Gender']=="Female"){?>
              <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                <select class="mvv-sel" name="gender" required tabindex="1">
                  <option value="Male" selected>Male</option>
                </select>
              </div>
              <?php } else {?>
              <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                <select class="mvv-sel" name="gender" required tabindex="1">
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
                <select class="mvv-sel" name="height_from" id="height_from" tabindex="4">
                  <option value="">From Height</option>
                  <?php foreach ($heightOptions as $heightValue => $heightLabel) { ?>
                    <option value="<?php echo $heightValue; ?>"><?php echo htmlspecialchars($heightLabel, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="mvv-sel" name="height_to" id="height_to" tabindex="5">
                  <option value="">To Height</option>
                  <?php foreach ($heightOptions as $heightValue => $heightLabel) { ?>
                    <option value="<?php echo $heightValue; ?>"><?php echo htmlspecialchars($heightLabel, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="mvv-sel" name="working_taluka" id="working_taluka" tabindex="6">
                  <option value="">Any Working Taluka</option>
                  <?php foreach ($talukas as $taluka) { ?>
                    <option value="<?php echo htmlspecialchars($taluka, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($taluka, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="mvv-sel" name="working_city" id="working_city" tabindex="6">
                  <option value="">Any Working City</option>
                  <?php foreach ($workingCities as $workingCity) { ?>
                    <option value="<?php echo htmlspecialchars($workingCity, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($workingCity, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="mvv-sel" name="native_taluka" id="native_taluka" tabindex="7">
                  <option value="">Any Native Taluka</option>
                  <?php foreach ($talukas as $taluka) { ?>
                    <option value="<?php echo htmlspecialchars($taluka, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($taluka, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="mvv-sel" name="native_city" id="native_city" tabindex="7">
                  <option value="">Any Native City</option>
                  <?php foreach ($nativeCities as $nativeCity) { ?>
                    <option value="<?php echo htmlspecialchars($nativeCity, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($nativeCity, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <div class="mvv-msel">
                  <select name="looking[]" tabindex="8" multiple>
                    <option value="Unmarried" selected>Unmarried</option>
                    <option value="Separated">Separated</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Any">Any</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <div class="mvv-msel">
                  <select name="religion[]" id="religion" multiple onChange="fillcaste(this.value)" tabindex="9">
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
              </div>	
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <div class="mvv-msel">
                  <select name="edu[]" id="education" tabindex="10" multiple>
                    <option value="Any" selected>Any Education</option>
                    <?php 
                      $edusql=mysqli_query($con,"select * from education ");
                      while($edurow=mysqli_fetch_array($edusql))
                      {
                        if($edurow['edu']==$row['Education'] && $edurow['edu']!="")
                        {
                    ?>
                    <option value="<?php echo $edurow['edu']; ?>" selected><?php echo $edurow['edu']; ?></option>
                    <?php
                      }else
                      {
                        $str="";
                        if($edurow['status']=='disabled')
                        {
                          $str="disabled";	
                        }
                    ?>
                    <option value="<?php echo $edurow['edu']; ?>" <?php echo $str; ?>><?php echo $edurow['edu']; ?></option>
                    <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <div class="mvv-msel">
                  <select name="occu[]" id="occupation" tabindex="11" multiple>
                    <option value="Any" selected>Any Occupation</option>
                    <?php 
                      $occsql=mysqli_query($con,"select * from occupation ");
                      while($occrow=mysqli_fetch_array($occsql))
                      {
                        if($occrow['occu']==$row['Occupation'] )
                        {
                    ?>
                    <option value="<?php echo $occrow['occu']; ?>" selected><?php echo $occrow['occu']; ?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $occrow['occu']; ?>" ><?php echo $occrow['occu']; ?></option>
                    <?php }  }  ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="mvv-sel" name="income_from" id="income_from" tabindex="12">
                  <option value="">From Annual Income</option>
                  <?php echo annual_income_select_options('', true); ?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                <select class="mvv-sel" name="income_to" id="income_to" tabindex="13">
                  <option value="">To Annual Income</option>
                  <?php echo annual_income_select_options('', true); ?>
                </select>
              </div>
            </div>
          </div>	
          
          <?php if(!isset($login))
          {?>
          <div class="mvv-search-actions">
            <input type="hidden">
            <span></span>
            <button class="mvv-btn mvv-btn-primary" type="submit" name="Search"  onClick="getsearch1()" ><span class="btn-title"> Let's Begin</span></button>
          </div>
          <?php } else { ?>
          <div class="mvv-search-actions">

          <?php $ty=mysqli_query($con,"select * from basic_saveandsearch where MatriID='".$_SESSION['matri_login']."'");
            if(mysqli_num_rows($ty)>=5) { ?>
          <a href="#dialog_send_message" data-bs-toggle="modal" style="display:none">
          <button class="mvv-btn mvv-btn-primary mt-3" type="Submit" name=""  style="display:none"><span class="btn-title">Save Search</span></button></a>
          <?php } else { ?>
          <button class="mvv-btn mvv-btn-primary mt-3" type="Submit" name="basic"  onClick="getsearch2();" style="display:none"><span class="btn-title">Save Search</span></button>
          <?php }?>
          <button class="mvv-btn mvv-btn-primary mt-3" type="submit" name="Search"  onClick="getsearch1()"><span class="btn-title"> Let's Begin</span></button>
        </div>
        <?php } ?>		
      </form>
    </div>
  </div>
</section>

<div class="modal fade" id="dialog_send_message" tabindex="-1" aria-hidden="true">
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
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</main>

<?php include('footer3.php')?>

<script>
function getsearch1() {
  document.form1.action = "smart_search_result?page=1";
}
function getsearch2() {
  document.form1.action = "step_smart";
}
</script>
<script>
(function() {
  'use strict';

  var STORAGE_KEY = 'mvv_smart_search';

  function saveSelections() {
    var data = {};
    document.querySelectorAll('.mvv-msel').forEach(function(w) {
      var sel = w.querySelector('select');
      if (!sel || !sel.name) return;
      var vals = [];
      for (var k = 0; k < sel.options.length; k++) {
        if (sel.options[k].selected) vals.push(sel.options[k].value);
      }
      data[sel.name] = vals;
    });
    ['height_from', 'height_to', 'working_taluka', 'working_city', 'native_taluka', 'native_city', 'income_from', 'income_to'].forEach(function(name) {
      var field = document.querySelector('[name="' + name + '"]');
      if (field) data[name] = field.value;
    });
    try { sessionStorage.setItem(STORAGE_KEY, JSON.stringify(data)); } catch(e) {}
  }

  function restoreSelections() {
    var raw;
    try { raw = sessionStorage.getItem(STORAGE_KEY); } catch(e) {}
    if (!raw) return;
    var data;
    try { data = JSON.parse(raw); } catch(e) {}
    if (!data) return;
    document.querySelectorAll('.mvv-msel').forEach(function(w) {
      var sel = w.querySelector('select');
      if (!sel || !sel.name || !data[sel.name]) return;
      var vals = data[sel.name];
      for (var k = 0; k < sel.options.length; k++) {
        sel.options[k].selected = vals.indexOf(sel.options[k].value) !== -1;
      }
    });
    ['height_from', 'height_to', 'working_taluka', 'working_city', 'native_taluka', 'native_city', 'income_from', 'income_to'].forEach(function(name) {
      var field = document.querySelector('[name="' + name + '"]');
      if (field && typeof data[name] === 'string') field.value = data[name];
    });
  }

  function initMultiSelects() {
    /* restore saved state before building widgets */
    restoreSelections();

    var wrappers = document.querySelectorAll('.mvv-msel');
    if (!wrappers.length) return;

    wrappers.forEach(function(wrapper) {
      var native = wrapper.querySelector('select');
      if (!native) return;

      native.style.display = 'none';

      /* -- Build toggle button -- */
      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'mvv-msel-btn';
      btn.setAttribute('aria-haspopup', 'true');

      var textSpan = document.createElement('span');
      textSpan.className = 'mvv-msel-text';
      btn.appendChild(textSpan);

      var arrow = document.createElement('span');
      arrow.className = 'mvv-msel-arrow';
      arrow.innerHTML = '&#9660;';
      btn.appendChild(arrow);

      /* -- Build dropdown panel -- */
      var drop = document.createElement('div');
      drop.className = 'mvv-msel-drop';
      drop.setAttribute('role', 'listbox');
      var searchWrap = document.createElement('div');
      searchWrap.className = 'mvv-msel-search-wrap';
      var search = document.createElement('input');
      search.type = 'search';
      search.className = 'mvv-msel-search';
      search.placeholder = 'Search options...';
      search.setAttribute('aria-label', 'Search options');
      searchWrap.appendChild(search);
      drop.appendChild(searchWrap);
      var empty = document.createElement('div');
      empty.className = 'mvv-msel-empty';
      empty.textContent = 'No matching options';

      var options = native.options;
      var firstIsAny = options.length > 0 && (options[0].value === '' || options[0].text.indexOf('Any') === 0);

      for (var i = 0; i < options.length; i++) {
        (function(opt) {
          var item = document.createElement('div');
          item.className = 'mvv-msel-opt';
          if (opt.selected) item.classList.add('selected');
          if (opt.disabled) { item.style.opacity = '0.5'; item.style.cursor = 'not-allowed'; }

          var cb = document.createElement('input');
          cb.type = 'checkbox';
          cb.value = opt.value;
          cb.checked = opt.selected;
          cb.disabled = opt.disabled;
          cb.setAttribute('aria-label', opt.text);

          var span = document.createElement('span');
          span.className = 'mvv-msel-opt-text';
          span.textContent = opt.text;

          item.appendChild(cb);
          item.appendChild(span);
          drop.appendChild(item);

          if (!opt.disabled) {
            /* Checkbox change fires on both direct click and our manual toggle */
            cb.addEventListener('change', function() {
              opt.selected = this.checked;
              item.classList.toggle('selected', this.checked);
              updateLabel();
              native.dispatchEvent(new Event('change', { bubbles: true }));
              saveSelections();
            });

            /* Click on the item row toggles the checkbox */
            item.addEventListener('click', function(e) {
              if (e.target.tagName === 'INPUT') return;
              cb.checked = !cb.checked;
              cb.dispatchEvent(new Event('change'));
            });
          }
        })(options[i]);
      }
      drop.appendChild(empty);

      search.addEventListener('click', function(e) {
        e.stopPropagation();
      });
      search.addEventListener('input', function() {
        var query = search.value.trim().toLocaleLowerCase();
        var visible = 0;
        drop.querySelectorAll('.mvv-msel-opt').forEach(function(item) {
          var matches = !query || item.textContent.toLocaleLowerCase().indexOf(query) !== -1;
          item.style.display = matches ? '' : 'none';
          if (matches) visible++;
        });
        empty.style.display = visible ? 'none' : 'block';
      });

      wrapper.appendChild(btn);
      wrapper.appendChild(drop);

      /* -- Toggle dropdown -- */
      btn.addEventListener('click', function(e) {
        e.stopPropagation();
        var wasOpen = drop.classList.contains('show');
        closeAllMultiSelects();
        if (!wasOpen) {
          drop.classList.add('show');
          btn.classList.add('active');
          window.setTimeout(function() { search.focus(); }, 0);
        }
      });

      /* -- Close on outside click -- */
      document.addEventListener('click', function(e) {
        if (!wrapper.contains(e.target)) {
          drop.classList.remove('show');
          btn.classList.remove('active');
        }
      });

      /* -- Escape key -- */
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && drop.classList.contains('show')) {
          drop.classList.remove('show');
          btn.classList.remove('active');
          btn.focus();
        }
      });

      function updateLabel() {
        var checked = [];
        for (var j = 0; j < options.length; j++) {
          if (options[j].selected) checked.push(options[j]);
        }
        if (checked.length === 0) {
          textSpan.textContent = firstIsAny ? options[0].text : 'Select';
        } else if (checked.length === 1) {
          textSpan.textContent = checked[0].text;
        } else {
          textSpan.textContent = checked.length + ' selected';
        }
      }
      updateLabel();
    });

    ['height_from', 'height_to', 'working_taluka', 'working_city', 'native_taluka', 'native_city', 'income_from', 'income_to'].forEach(function(name) {
      var field = document.querySelector('[name="' + name + '"]');
      if (field) field.addEventListener('change', saveSelections);
    });

    function closeAllMultiSelects() {
      document.querySelectorAll('.mvv-msel-drop.show').forEach(function(d) {
        d.classList.remove('show');
      });
      document.querySelectorAll('.mvv-msel-btn.active').forEach(function(b) {
        b.classList.remove('active');
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMultiSelects);
  } else {
    initMultiSelects();
  }
})();
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.mvv-btn[type="submit"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';
      if (this.innerHTML !== loading) {
        this.dataset.originalText = this.innerHTML;
        this.innerHTML = loading;
      }
      var self = this;
      setTimeout(function() {
        self.innerHTML = self.dataset.originalText || '';
      }, 500);
    });
  });
});
</script>

</body>
</html>
