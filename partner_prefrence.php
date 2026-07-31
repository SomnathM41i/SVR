<?php ob_start();
require_once('sys_dbconnection.php');
include('memprotect1.php');
require_once('includes/annual_income.php');

$query12 = mysqli_query($con,"SELECT * FROM religion where status='enable' ORDER BY Religion ASC");
$query1 = mysqli_query($con,"SELECT * FROM complexion");
$query2 = mysqli_query($con,"SELECT * FROM residency_status where status='enable'");
$query3 = mysqli_query($con,"SELECT * FROM education where status='enable'");
$query4 = mysqli_query($con,"SELECT * FROM occupation where status='enable'");
$query5 = mysqli_query($con,"SELECT * FROM e_country where status='enable'");
$query6 = mysqli_query($con,"SELECT * FROM caste where status='enable'");
$query7 = mysqli_query($con,"SELECT * FROM e_state where cid='India' and status='enable'");
$query8 = mysqli_query($con,"SELECT DISTINCT dist FROM e_dist where status='enable' ORDER BY dist ASC");
$query9 = mysqli_query($con,"SELECT DISTINCT city FROM e_city ORDER BY city ASC");

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

$ageOptions = range(18,65);

$ID = $_GET['id'] ?? '';
$login = $_SESSION['MatriID'] ?? '';
$me = [];
if($login) {
  $myq = mysqli_query($con,"SELECT * from register where MatriID='$login'");
  $me = mysqli_fetch_array($myq) ?? [];
}
$regvar = $me['reg_step'] ?? '';

$income_from_inr = '';
$income_to_inr = '';

$q2 = [];
if($ID) {
  $q2q = mysqli_query($con,"select * from register where MatriID='$ID'");
  $q2 = mysqli_fetch_assoc($q2q) ?? [];
}

if(isset($_POST['submit'])) {
  $looking = $db->setfilter(implode(" , ", (array)($_POST['looking'] ?? [])));
  $fromage = $db->setfilter($_POST['fromage']);
  $toage = $db->setfilter($_POST['toage']);
  $expectation = $db->setfilter(addslashes($_POST['expectation']));
  $heightfrom = $db->setfilter($_POST['heightfrom']);
  $heightto = $db->setfilter($_POST['heightto']);
  $caste = isset($_POST['caste1']) ? $db->setfilter($_POST['caste1']) : (isset($_POST['caste']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['caste']))) : '');
  $religion = isset($_POST['religion1']) ? $db->setfilter($_POST['religion1']) : (isset($_POST['religion']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['religion']))) : '');
  $complexion = isset($_POST['complexion1']) ? $db->setfilter($_POST['complexion1']) : (isset($_POST['complexion']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['complexion']))) : '');
  $rstatus = isset($_POST['rstatus1']) ? $db->setfilter($_POST['rstatus1']) : (isset($_POST['rstatus']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['rstatus']))) : '');
  $country = isset($_POST['country1']) ? $db->setfilter($_POST['country1']) : (isset($_POST['country']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['country']))) : '');
  $pestate = isset($_POST['state1']) ? $db->setfilter($_POST['state1']) : (isset($_POST['cbostate']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['cbostate']))) : '');
  $pedistrict = isset($_POST['district']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['district']))) : '';
  $petaluka = isset($_POST['taluka']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['taluka']))) : '';
  $pecity = isset($_POST['city']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['city']))) : '';
  $education = isset($_POST['education1']) ? $db->setfilter($_POST['education1']) : (isset($_POST['education']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['education']))) : '');
  $Occupation = isset($_POST['occupation1']) ? $db->setfilter($_POST['occupation1']) : (isset($_POST['Occupation']) ? $db->setfilter(ltrim(implode(",", (array)$_POST['Occupation']))) : '');
  // Validate before setfilter(): its empty() check turns the valid string "0"
  // into null, even though zero is allowed by the income fields.
  $income_from_raw = trim((string)($_POST['income_from'] ?? ''));
  $income_to_raw = trim((string)($_POST['income_to'] ?? ''));
  if (
    !annual_income_is_valid($income_from_raw, true)
    || !annual_income_is_valid($income_to_raw, true)
    || (int)$income_from_raw > (int)$income_to_raw
  ) {
    header('location:partner_prefrence?message=income'); exit;
  }
  $income_from_inr = (string)(int)$income_from_raw;
  $income_to_inr = (string)(int)$income_to_raw;

  if(isset($login) && $regvar=='9') {
    if(($me['Looking']==$looking) && ($me['PE_FromAge']==$fromage) && ($me['PE_ToAge']==$toage) && ($me['PartnerExpectations']==$expectation) && ($me['PE_Countrylivingin']==$country) && ($me['PE_from_Height']==$heightfrom) && ($me['PE_to_Height']==$heightto) && ($me['PE_Complexion']==$complexion) && ($me['PE_Education']==$education) && ($me['PE_Religion']==$religion) && ($me['PE_Caste']==$caste) && ($me['PE_Residentstatus']==$rstatus) && ($me['PE_State']==$pestate) && (($me['PE_District']??'')==$pedistrict) && (($me['PE_Taluka']??'')==$petaluka) && (($me['PE_City']??'')==$pecity) && ($me['PE_income_from']==$income_from_inr) && ($me['PE_income_to']==$income_to_inr) && ($me['PE_Occupation']==$Occupation)) {
      header('Location: index_dashboard'); exit;
    } else {
      mysqli_query($con,"update register set Looking='$looking',
        PE_FromAge='$fromage', PE_ToAge='$toage',
        PartnerExpectations='$expectation', PE_Countrylivingin='$country',
        PE_from_Height='$heightfrom', PE_to_Height='$heightto',
        PE_Complexion='$complexion', PE_Education='$education',
        PE_Religion='$religion', PE_Caste='$caste',
        PE_Residentstatus='$rstatus', PE_State='$pestate', PE_District='$pedistrict', PE_Taluka='$petaluka', PE_City='$pecity',
        PE_income_from='$income_from_inr', PE_income_to='$income_to_inr',
        PE_Occupation='$Occupation', PartnerExpectations_approve='No'
        where MatriID='$login'");
      unset($_SESSION['_partner_100_count'][$login]);
      header('Location: index_dashboard'); exit;
    }
  } else {
    $completedMatriID = $login !== '' ? $login : $ID;
    mysqli_query($con,"update register set Looking='$looking',
      PE_FromAge='$fromage', PE_ToAge='$toage',
      PartnerExpectations='$expectation', PE_Countrylivingin='$country',
      PE_from_Height='$heightfrom', PE_to_Height='$heightto',
      PE_Complexion='$complexion', PE_Education='$education',
      PE_Religion='$religion', PE_Caste='$caste',
      PE_Residentstatus='$rstatus', PE_State='$pestate', PE_District='$pedistrict', PE_Taluka='$petaluka', PE_City='$pecity',
      PE_income_from='$income_from_inr', PE_income_to='$income_to_inr',
      PE_Occupation='$Occupation', reg_step='9',
      PartnerExpectations_approve='No' where MatriID='$completedMatriID'");
    unset($_SESSION['_partner_100_count'][$completedMatriID]);
    // Registration already created an authenticated member session. Sending the
    // stored password through login_submit encodes it again and causes ?action=wrong.
    $_SESSION['MatriID'] = $completedMatriID;
    $_SESSION['matriid'] = $completedMatriID;
    header('location:pageloader1');
    exit;
  }
}
?>
<?php $page_title = 'जोडीदाराबद्दल अपेक्षा - Manpasand Jodidar'; include('header3.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<style>
.mvv-page-hero h1 { text-transform:none; }
.mvv-multi-wrap { position:relative; }
.mvv-multi-btn { display:flex; align-items:center; justify-content:space-between; width:100%; min-height:44px; padding:8px 14px; border:1px solid var(--mvv-border); border-radius:6px; background:#fff; cursor:pointer; font-size:0.92rem; color:#666; text-align:left; }
.mvv-multi-btn:hover { border-color:var(--mvv-maroon); }
.mvv-multi-btn .caret { border-left:5px solid transparent; border-right:5px solid transparent; border-top:6px solid #999; margin-left:8px; flex-shrink:0; }
.mvv-multi-drop { position:absolute; top:100%; left:0; right:0; z-index:50; background:#fff; border:1px solid var(--mvv-border); border-radius:0 0 8px 8px; box-shadow:0 6px 24px rgba(0,0,0,0.12); max-height:220px; overflow-y:auto; display:none; margin-top:2px; }
.mvv-multi-drop.open { display:block; }
.mvv-multi-search-wrap { position:sticky; top:0; z-index:2; padding:8px; background:#fff; border-bottom:1px solid var(--mvv-border); }
.mvv-multi-search { width:100%; min-height:38px; padding:7px 10px; border:1px solid var(--mvv-border); border-radius:6px; font:inherit; color:#333; }
.mvv-multi-search:focus { outline:none; border-color:var(--mvv-gold); box-shadow:0 0 0 3px rgba(212,164,55,.14); }
.mvv-multi-empty { display:none; padding:12px 14px; color:var(--mvv-muted); font-size:.88rem; }
.mvv-multi-drop label { display:flex; align-items:center; gap:8px; padding:7px 14px; cursor:pointer; margin:0; font-size:0.9rem; color:#333; }
.mvv-multi-drop label:hover { background:var(--mvv-cream); }
.mvv-multi-drop input[type=checkbox] { width:16px; height:16px; accent-color:var(--mvv-maroon); flex-shrink:0; }
</style>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">जोडीदाराबद्दल अपेक्षा</div>
      <h1>जोडीदाराबद्दल अपेक्षा</h1>
      <p>तुमच्या जोडीदाराबद्दलच्या अपेक्षा निवडा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <?php if(isset($login) && $regvar=='9') { ?>
        <a href="index_dashboard">Home</a>
        <?php } else { ?>
        <a href="index">Home</a>
        <?php } ?>
        <span>जोडीदाराबद्दल अपेक्षा</span>
      </nav>
      <?php if (($regvar ?? '') == '9') { ?>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
      <?php } ?>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(isset($_GET['message']) && $_GET['message']!='') { ?>
      <div style="background:<?php echo $_GET['message']=='success' ? '#28a745' : 'var(--mvv-maroon)'; ?>;color:#fff;border-radius:8px;padding:14px 20px;margin-bottom:20px;text-align:center;position:relative;max-width:800px;margin-left:auto;margin-right:auto;">
        <?php if($_GET['message']=='success') { echo 'Your Details Updated Successfully'; } ?>
        <?php if($_GET['message']=='flag') { echo 'No changes were detected.'; } ?>
        <?php if($_GET['message']=='income') { echo 'Please enter a valid annual income range.'; } ?>
        <button type="button" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;color:#fff;font-size:1.3rem;cursor:pointer;" onclick="this.parentElement.style.display='none'">&times;</button>
      </div>
      <?php } elseif(isset($me) && $me['PartnerExpectations_approve']=="Rejected") { ?>
      <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:14px 20px;margin-bottom:20px;text-align:center;max-width:800px;margin-left:auto;margin-right:auto;">
        Your Partner Expectation Is Rejected By Admin.
      </div>
      <?php } elseif(isset($me) && $me['PartnerExpectations_approve']=="Yes") { ?>
      <div style="background:#28a745;color:#fff;border-radius:8px;padding:14px 20px;margin-bottom:20px;text-align:center;max-width:800px;margin-left:auto;margin-right:auto;">
        Your Partner Expectation Is Approved By Admin.
      </div>
      <?php } ?>

      <div class="row" style="justify-content:center;">
        <div class="col-lg-9">
          <div class="mvv-form">
            <form method="post" action="#" id="contact-form">
              <div style="padding:14px 16px;margin-bottom:18px;border:1px solid var(--mvv-border);border-radius:8px;background:#fff8ef;color:var(--mvv-maroon);font-size:.88rem;">
                <strong>10-Point Partner Match:</strong> Marital status, age, height, religion, caste, complexion, education, occupation, location and annual income are used to calculate your match percentage.
              </div>
              <div class="mvv-form-grid">

                <!-- Looking For -->
                <div class="mvv-field">
                  <label class="mvv-label">Looking For</label>
                  <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    <?php
                    $maritalOpts = ['Unmarried','Divorced','Widower','Widowed'];
                    $savedLooking = isset($login) && $regvar=='9' ? ($me['Looking']??'') : ($q2['Maritalstatus']??'');
                    $arrlooking = explode(" , ", $savedLooking);
                    foreach($maritalOpts as $mo) {
                      $checked = in_array($mo,$arrlooking) ? 'checked' : '';
                    ?>
                    <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;background:var(--mvv-cream);border:1px solid var(--mvv-border);border-radius:6px;padding:6px 16px;">
                      <input type="checkbox" value="<?php echo $mo; ?>" name="looking[]" <?php echo $checked; ?>>
                      <?php echo $mo; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>

                <!-- Age From -->
                <div class="mvv-field">
                  <label class="mvv-label">Age From</label>
                  <select class="mvv-input" name="fromage" required>
                    <?php
                    $savedFrom = (isset($login) && $regvar=='9') ? ($me['PE_FromAge']??'') : '';
                    $sel = $savedFrom ?: 21;
                    $found = false;
                    foreach($ageOptions as $a) {
                      $s = ($a==$sel) ? 'selected' : '';
                      if($s) $found = true;
                      echo "<option value=\"$a\" $s>$a</option>";
                    }
                    ?>
                  </select>
                </div>

                <!-- Age To -->
                <div class="mvv-field">
                  <label class="mvv-label">Age To</label>
                  <select class="mvv-input" name="toage" required>
                    <?php
                    $savedTo = (isset($login) && $regvar=='9') ? ($me['PE_ToAge']??'') : '';
                    $sel = $savedTo ?: 28;
                    foreach($ageOptions as $a) {
                      $s = ($a==$sel) ? 'selected' : '';
                      echo "<option value=\"$a\" $s>$a</option>";
                    }
                    ?>
                  </select>
                </div>

                <!-- Height From -->
                <div class="mvv-field">
                  <label class="mvv-label">Height From</label>
                  <select class="mvv-input" name="heightfrom">
                    <option value="">Select Height From</option>
                    <?php
                    $hf = (isset($login) && $regvar=='9') ? ($me['PE_from_Height']??'') : '';
                    foreach($heightOptions as $k=>$v) {
                      $s = ($k==$hf) ? 'selected' : '';
                      echo "<option value=\"$k\" $s>$v</option>";
                    }
                    ?>
                  </select>
                </div>

                <!-- Height To -->
                <div class="mvv-field">
                  <label class="mvv-label">Height To</label>
                  <select class="mvv-input" name="heightto">
                    <option value="">Select Height To</option>
                    <?php
                    $ht = (isset($login) && $regvar=='9') ? ($me['PE_to_Height']??'') : '';
                    foreach($heightOptions as $k=>$v) {
                      $s = ($k==$ht) ? 'selected' : '';
                      echo "<option value=\"$k\" $s>$v</option>";
                    }
                    ?>
                  </select>
                </div>

                <?php
                function multiSelect($id, $label, $options, $saved='', $placeholder='Select...') {
                  $savedArr = $saved ? array_map('trim', explode(',', $saved)) : [];
                  $h = '<div class="mvv-field">';
                  $h .= '<label class="mvv-label">'.$label.'</label>';
                  $h .= '<div class="mvv-multi-wrap">';
                  $h .= '<div class="mvv-multi-btn" data-multi="'.$id.'" data-placeholder="'.htmlspecialchars($placeholder).'"><span class="mvv-multi-text">'.($saved ?: $placeholder).'</span><span class="caret"></span></div>';
                  $h .= '<div class="mvv-multi-drop" id="'.$id.'_drop">';
                  $h .= '<div class="mvv-multi-search-wrap"><input type="search" class="mvv-multi-search" placeholder="Search '.$label.'..." aria-label="Search '.$label.' options"></div>';
                  foreach($options as $val => $display) {
                    $checked = in_array((string)$val, $savedArr) ? 'checked' : '';
                    $h .= '<label><input type="checkbox" value="'.htmlspecialchars($val).'" '.$checked.' data-multi="'.$id.'" data-label="'.htmlspecialchars($display).'"> '.htmlspecialchars($display).'</label>';
                  }
                  $h .= '<div class="mvv-multi-empty"'.(empty($options) ? ' style="display:block"' : '').'>'.(empty($options) ? 'Select the previous option first' : 'No matching options').'</div>';
                  $h .= '</div>';
                  $h .= '<select id="'.$id.'" name="'.$id.'[]" class="mvv-multi-source" multiple style="display:none;" data-searchable-multi="off">';
                  foreach($savedArr as $sv) {
                    $h .= '<option value="'.htmlspecialchars($sv).'" selected></option>';
                  }
                  $h .= '</select></div></div>';
                  return $h;
                }

                $religionOpts = [];
                mysqli_data_seek($query12,0);
                while($rowr = mysqli_fetch_assoc($query12)) { $religionOpts[$rowr['Religion']] = $rowr['Religion']; }
                $relSaved = (isset($login) && $regvar=='9') ? ($me['PE_Religion']??'') : '';
                echo multiSelect('religion', 'Religion', $religionOpts, $relSaved, 'Select Religion');

                $casteOpts = [];
                mysqli_data_seek($query6,0);
                while($rowc = mysqli_fetch_assoc($query6)) { $casteOpts[$rowc['Caste']] = $rowc['Caste']; }
                $castSaved = (isset($login) && $regvar=='9') ? ($me['PE_Caste']??'') : '';
                echo multiSelect('caste', 'Caste', $casteOpts, $castSaved, 'Select Caste');

                $compOpts = ['Any'=>'Any'];
                mysqli_data_seek($query1,0);
                while($row2 = mysqli_fetch_assoc($query1)) { $compOpts[$row2['complexion']] = $row2['complexion']; }
                $compSaved = (isset($login) && $regvar=='9') ? ($me['PE_Complexion']??'') : '';
                echo multiSelect('complexion', 'Complexion', $compOpts, $compSaved, 'Select complexion');

                $resOpts = ['Any'=>'Any'];
                mysqli_data_seek($query2,0);
                while($row3 = mysqli_fetch_assoc($query2)) { $resOpts[$row3['residency_status']] = $row3['residency_status']; }
                $resSaved = (isset($login) && $regvar=='9') ? ($me['PE_Residentstatus']??'') : '';
                echo multiSelect('rstatus', 'Residency Status', $resOpts, $resSaved, 'Select residencial status');

                $cntOpts = [];
                mysqli_data_seek($query5,0);
                while($rowc1 = mysqli_fetch_assoc($query5)) { $cntOpts[$rowc1['country']] = $rowc1['country']; }
                $cntSaved = (isset($login) && $regvar=='9') ? ($me['PE_Countrylivingin']??'') : '';
                echo multiSelect('country', 'Country', $cntOpts, $cntSaved, 'Select Country');

                $stOpts = [];
                $stSaved = (isset($login) && $regvar=='9') ? ($me['PE_State']??'') : '';
                if ($cntSaved !== '' && $cntSaved !== 'Any') {
                  $savedCountries = array_values(array_filter(array_map('trim', explode(',', $cntSaved))));
                  $quotedCountries = array_map(function($value) use ($con) {
                    return "'".mysqli_real_escape_string($con, $value)."'";
                  }, $savedCountries);
                  if ($quotedCountries) {
                    $stateQuery = mysqli_query($con, "SELECT DISTINCT state FROM e_state WHERE status='enable' AND cid IN (".implode(',', $quotedCountries).") ORDER BY state ASC");
                    while($stateQuery && ($row7 = mysqli_fetch_assoc($stateQuery))) { $stOpts[$row7['state']] = $row7['state']; }
                  }
                }
                echo multiSelect('cbostate', 'State', $stOpts, $stSaved, 'Select State');

                $distOpts = [];
                $distSaved = (isset($login) && $regvar=='9') ? ($me['PE_District']??'') : '';
                if ($stSaved !== '' && $stSaved !== 'Any') {
                  $savedStates = array_values(array_filter(array_map('trim', explode(',', $stSaved))));
                  $quotedStates = array_map(function($value) use ($con) {
                    return "'".mysqli_real_escape_string($con, $value)."'";
                  }, $savedStates);
                  if ($quotedStates) {
                    $districtQuery = mysqli_query($con, "SELECT DISTINCT dist FROM e_dist WHERE status='enable' AND sid2 IN (".implode(',', $quotedStates).") ORDER BY dist ASC");
                    while($districtQuery && ($row8 = mysqli_fetch_assoc($districtQuery))) { $distOpts[$row8['dist']] = $row8['dist']; }
                  }
                }
                echo multiSelect('district', 'District', $distOpts, $distSaved, 'Select District');

                $talukaOpts = [];
                $talukaSaved = (isset($login) && $regvar=='9') ? ($me['PE_Taluka']??'') : '';
                if ($distSaved !== '' && $distSaved !== 'Any') {
                  $savedDistricts = array_values(array_filter(array_map('trim', explode(',', $distSaved))));
                  $quotedDistricts = array_map(function($value) use ($con) {
                    return "'".mysqli_real_escape_string($con, $value)."'";
                  }, $savedDistricts);
                  if ($quotedDistricts) {
                    $talukaQuery = mysqli_query($con, "SELECT DISTINCT taluka FROM e_taluka WHERE status='enable' AND dist_ref IN (".implode(',', $quotedDistricts).") ORDER BY taluka ASC");
                    while($talukaQuery && ($talukaRow = mysqli_fetch_assoc($talukaQuery))) { $talukaOpts[$talukaRow['taluka']] = $talukaRow['taluka']; }
                  }
                }
                echo multiSelect('taluka', 'Taluka', $talukaOpts, $talukaSaved, 'Select Taluka');

                $cityOpts = [];
                $citySaved = (isset($login) && $regvar=='9') ? ($me['PE_City']??'') : '';
                if ($talukaSaved !== '' && $talukaSaved !== 'Any') {
                  $savedTalukas = array_values(array_filter(array_map('trim', explode(',', $talukaSaved))));
                  $quotedTalukas = array_map(function($value) use ($con) {
                    return "'".mysqli_real_escape_string($con, $value)."'";
                  }, $savedTalukas);
                  if ($quotedTalukas) {
                    $cityQuery = mysqli_query($con, "SELECT DISTINCT city FROM e_city WHERE taluka_ref IN (".implode(',', $quotedTalukas).") ORDER BY city ASC");
                    while($cityQuery && ($row9 = mysqli_fetch_assoc($cityQuery))) { $cityOpts[$row9['city']] = $row9['city']; }
                  }
                }
                echo multiSelect('city', 'City', $cityOpts, $citySaved, 'Select City');

                $eduOpts = ['Any'=>'Any'];
                mysqli_data_seek($query3,0);
                while($row5 = mysqli_fetch_assoc($query3)) { $eduOpts[$row5['edu']] = $row5['edu']; }
                $eduSaved = (isset($login) && $regvar=='9') ? ($me['PE_Education']??'') : '';
                echo multiSelect('education', 'Education', $eduOpts, $eduSaved, 'Select education');

                $occOpts = ['Any'=>'Any'];
                mysqli_data_seek($query4,0);
                while($row6 = mysqli_fetch_assoc($query4)) { $occOpts[$row6['occu']] = $row6['occu']; }
                $occSaved = (isset($login) && $regvar=='9') ? ($me['PE_Occupation']??'') : '';
                echo multiSelect('Occupation', 'Occupation', $occOpts, $occSaved, 'Select Occupation');
                ?>

                <div class="mvv-field">
                  <label class="mvv-label">Annual Income From</label>
                  <select name="income_from" required>
                    <option value="">Select Minimum Income</option>
                    <?php echo annual_income_select_options($me['PE_income_from'] ?? '', true); ?>
                  </select>
                </div>
                <div class="mvv-field">
                  <label class="mvv-label">Annual Income To</label>
                  <select name="income_to" required>
                    <option value="">Select Maximum Income</option>
                    <?php echo annual_income_select_options($me['PE_income_to'] ?? '', true); ?>
                  </select>
                </div>

                <!-- Partner Expectations -->
                <div class="mvv-field" style="grid-column:1/-1;">
                  <label class="mvv-label">Partner Expectations</label>
                  <textarea name="expectation" class="mvv-input" placeholder="Enter Your Partner Expectation Here" maxlength="600" style="min-height:100px;"><?php echo (isset($login) && $regvar=='9' && $me['PartnerExpectations']) ? $me['PartnerExpectations'] : ''; ?></textarea>
                  <div style="font-size:0.85rem;color:var(--mvv-muted);margin-top:6px;">
                    Enter few lines about Your Partner Expectation
                    <a href="#" data-bs-toggle="modal" data-bs-target="#myModal5" style="color:var(--mvv-maroon);font-weight:600;">Examples</a>
                  </div>
                </div>

              </div>

              <div style="margin-top:24px;text-align:center;">
                <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" style="min-width:200px;">
                  <?php echo (isset($login) && $regvar=='9') ? 'Update' : 'Submit Now'; ?>
                </button>
              </div>
            </form>
          </div>

          <?php include('contactinfo.php'); ?>

        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

<!-- Partner Expectation Modal -->
<div class="modal fade" id="myModal5" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius:12px;">
      <div class="modal-header" style="background:var(--mvv-maroon);color:#fff;border-radius:12px 12px 0 0;padding:16px 20px;">
        <h5 class="modal-title" style="color:#fff;font-weight:600;">Example Of Partner Expectation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding:20px;font-size:0.95rem;color:#444;line-height:1.7;">
        <?php echo "I am looking for honest, intelligent & open-minded companion to nurture my life & home with security, warmth, freedom and harmony. She should have good communication to manage & maintain relations with all my family members & friends. She should respect elders & family values.";?>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function multiUpdate(id) {
  var sel = document.getElementById(id);
  if(!sel) return;
  var drop = document.getElementById(id+'_drop');
  if(!drop) return;
  var checked = drop.querySelectorAll('input[type=checkbox]:checked');
  var vals=[], texts=[];
  checked.forEach(function(cb) { vals.push(cb.value); texts.push(cb.getAttribute('data-label') || cb.value); });
  sel.innerHTML = '';
  vals.forEach(function(v) {
    var o = document.createElement('option');
    o.value = v; o.selected = true;
    sel.appendChild(o);
  });
  var btn = document.querySelector('[data-multi="'+id+'"]');
  if(btn) {
    var span = btn.querySelector('.mvv-multi-text');
    if(span) span.textContent = texts.length ? texts.join(', ') : (btn.getAttribute('data-placeholder')||'Select...');
  }
}

$(document).ready(function(){
  $(document).on('click', '.mvv-multi-btn', function(e) {
    var id = $(this).data('multi');
    var $drop = $('#'+id+'_drop');
    $('.mvv-multi-drop').not($drop).removeClass('open');
    $drop.toggleClass('open');
    if($drop.hasClass('open')) {
      setTimeout(function(){ $drop.find('.mvv-multi-search').trigger('focus'); }, 0);
    }
    e.stopPropagation();
  });
  $(document).on('click', '.mvv-multi-search', function(e) {
    e.stopPropagation();
  });
  $(document).on('input', '.mvv-multi-search', function() {
    var query = this.value.trim().toLocaleLowerCase();
    var $drop = $(this).closest('.mvv-multi-drop');
    var visible = 0;
    $drop.children('label').each(function() {
      var matches = !query || $(this).text().toLocaleLowerCase().indexOf(query) !== -1;
      $(this).toggle(matches);
      if(matches) visible++;
    });
    $drop.children('.mvv-multi-empty').toggle(visible === 0);
  });
  $(document).on('change', '.mvv-multi-drop input[type=checkbox]', function() {
    var id = $(this).data('multi');
    multiUpdate(id);
  });
  $(document).on('click', function(e) {
    if(!$(e.target).closest('.mvv-multi-wrap').length) {
      $('.mvv-multi-drop').removeClass('open');
    }
  });
  function cascade(fromId, toId, url) {
    $(document).on('change', '#'+fromId+'_drop input[type=checkbox]', function() {
      var vals = [];
      $('#'+fromId+'_drop input[type=checkbox]:checked').each(function(){ vals.push(this.value); });
      multiUpdate(fromId);
      var descendants = {
        country: ['cbostate', 'district', 'city'],
        cbostate: ['district', 'city'],
        district: ['city']
      };
      (descendants[fromId] || []).forEach(function(id) {
        resetMulti(id);
      });
      if(vals.length > 0) {
        $.ajax({
          url:url, method:"POST", data:{selected:vals},
          success:function(data) {
            var drop = document.getElementById(toId+'_drop');
            var sel = document.getElementById(toId);
            // Parse <option> tags from response into checkbox labels
            var label = $('[data-multi="'+toId+'"]').closest('.mvv-field').find('.mvv-label').first().text() || 'options';
            var html = '<div class="mvv-multi-search-wrap"><input type="search" class="mvv-multi-search" placeholder="Search '+label+'..." aria-label="Search '+label+' options"></div>';
            $(data).filter('option').each(function(){
              var v = $(this).val();
              var t = $(this).text();
              html += '<label><input type="checkbox" value="'+v+'" data-multi="'+toId+'" data-label="'+t+'"> '+t+'</label>';
            });
            html += '<div class="mvv-multi-empty">No matching options</div>';
            drop.innerHTML = html;
            sel.innerHTML = '';
            multiUpdate(toId);
          }
        });
      }
    });
  }
  function resetMulti(id) {
    var drop = document.getElementById(id+'_drop');
    var sel = document.getElementById(id);
    var btn = document.querySelector('.mvv-multi-btn[data-multi="'+id+'"]');
    if(drop) {
      var fieldLabel = btn ? btn.closest('.mvv-field').querySelector('.mvv-label').textContent : 'options';
      drop.innerHTML = '<div class="mvv-multi-search-wrap"><input type="search" class="mvv-multi-search" placeholder="Search '+fieldLabel+'..." aria-label="Search '+fieldLabel+' options"></div><div class="mvv-multi-empty" style="display:block">Select the previous location first</div>';
    }
    if(sel) sel.innerHTML = '';
    if(btn) {
      var text = btn.querySelector('.mvv-multi-text');
      if(text) text.textContent = btn.getAttribute('data-placeholder') || 'Select...';
    }
  }
  cascade('religion', 'caste', 'castonchange.php');
  cascade('country', 'cbostate', 'stateonchange.php');
  cascade('cbostate', 'district', 'distonchange.php');
  cascade('district', 'taluka', 'talukaonchange.php');
  cascade('taluka', 'city', 'citybytalukaonchange.php');
});
</script>
