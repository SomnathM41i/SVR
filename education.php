<?php
ob_start();
require_once('sys_dbconnection.php');
include('memprotect1.php');
require_once('includes/annual_income.php');

?>
<?php
$login = $_SESSION['MatriID'] ?? '';
if($login) {
  $myq = mysqli_query($con,"SELECT * from register where MatriID='$login'");
  $me = mysqli_fetch_array($myq) ?? [];
}
$regvar = $me['reg_step'] ?? '';
$row = $me;
$page_title = 'Education & Career - Shivraj Maratha';
include('header3.php'); ?>
<style>
.mvv-checkbox-label {
  position: relative;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 500;
  color: var(--text-main);
  padding: 10px 16px;
  border: 2px solid var(--border-warm);
  border-radius: 10px;
  background: var(--cream);
  transition: all 0.2s;
  user-select: none;
}
.mvv-checkbox-label:hover {
  border-color: var(--saffron);
  background: #FFF0E0;
}
.mvv-checkbox-label input[type="checkbox"] {
  position: absolute;
  opacity: 0;
  width: 1px;
  height: 1px;
  pointer-events: none;
  cursor: pointer;
}
.mvv-checkbox-label .check-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  border: 2px solid var(--border-warm);
  border-radius: 5px;
  background: #fff;
  font-size: 0.8rem;
  color: transparent;
  transition: all 0.2s;
  flex-shrink: 0;
}
.mvv-checkbox-label input[type="checkbox"]:focus + .check-icon {
  box-shadow: 0 0 0 4px rgba(232,117,26,0.16);
}
.mvv-checkbox-label input[type="checkbox"]:checked + .check-icon {
  background: var(--saffron);
  color: #fff;
  border-color: var(--saffron);
}
.mvv-checkbox-label input[type="checkbox"]:checked ~ span:last-child {
  color: var(--saffron);
  font-weight: 600;
}
.mvv-field .mvv-field-help {
  display: block;
  margin-top: 6px;
  color: var(--mvv-muted, #6c757d);
  font-size: 0.78rem;
  line-height: 1.4;
}
.mvv-multiselect {
  position: relative;
}
.mvv-multiselect > select {
  position: absolute;
  width: 1px;
  height: 1px;
  opacity: 0;
  pointer-events: none;
}
.mvv-multiselect-toggle {
  width: 100%;
  min-height: 58px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 11px 13px;
  border: 1px solid var(--mvv-border);
  background: #fff;
  color: var(--mvv-text);
  font: inherit;
  text-align: left;
  cursor: pointer;
}
.mvv-multiselect-toggle::after {
  content: '';
  width: 8px;
  height: 8px;
  flex: 0 0 8px;
  border-right: 2px solid currentColor;
  border-bottom: 2px solid currentColor;
  transform: rotate(45deg) translateY(-2px);
  transition: transform .2s ease;
}
.mvv-multiselect.open .mvv-multiselect-toggle {
  border-color: var(--mvv-gold);
  box-shadow: 0 0 0 4px rgba(212,164,55,0.14);
}
.mvv-multiselect.open .mvv-multiselect-toggle::after {
  transform: rotate(225deg) translate(-2px, -2px);
}
.mvv-multiselect-menu {
  display: none;
  position: absolute;
  z-index: 30;
  top: calc(100% + 5px);
  left: 0;
  right: 0;
  max-height: 260px;
  overflow-y: auto;
  padding: 6px;
  border: 1px solid var(--mvv-border);
  border-radius: 5px;
  background: #fff;
  box-shadow: 0 12px 30px rgba(74, 24, 22, .15);
}
.mvv-multiselect-search-wrap {
  position: sticky;
  top: -6px;
  z-index: 2;
  padding: 6px;
  margin: -6px -6px 4px;
  background: #fff;
  border-bottom: 1px solid var(--mvv-border);
}
.mvv-multiselect-search {
  width: 100%;
  min-height: 40px !important;
  padding: 8px 11px !important;
  border: 1px solid var(--mvv-border) !important;
  border-radius: 5px;
  background: #fff;
  color: var(--mvv-text);
  font: inherit;
}
.mvv-multiselect-search:focus {
  outline: none;
  border-color: var(--mvv-gold) !important;
  box-shadow: 0 0 0 3px rgba(212,164,55,0.14);
}
.mvv-multiselect-empty {
  display: none;
  padding: 12px 10px;
  color: var(--mvv-muted, #6c757d);
  font-size: .88rem;
}
.mvv-multiselect.open .mvv-multiselect-menu {
  display: block;
}
.mvv-multiselect-option {
  display: flex !important;
  align-items: center;
  gap: 10px;
  margin: 0 !important;
  padding: 9px 10px;
  border-radius: 4px;
  color: var(--mvv-text) !important;
  font-size: .9rem !important;
  font-weight: 500 !important;
  letter-spacing: 0 !important;
  text-transform: none !important;
  cursor: pointer;
}
.mvv-multiselect-option:hover {
  background: #fff4e8;
}
.mvv-multiselect-option.is-filtered-out {
  display: none !important;
}
.mvv-multiselect-option input {
  width: 18px !important;
  min-height: 18px !important;
  height: 18px;
  margin: 0;
  accent-color: var(--saffron);
}
</style>
<script>
function isNumber(evt) {
  evt = evt || window.event;
  var charCode = evt.which || evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
  return true;
}
function ValidateAlpha(evt) {
  var keyCode = evt.which || evt.keyCode;
  if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) return false;
  return true;
}
function ShowHideIIT(iit) {
  var el = document.getElementById("instu");
  if (el) el.style.display = iit.checked ? "block" : "none";
}
function toggleOtherDist(el) {
  var box = document.getElementById("otherdist");
  if (!box) return;
  if (el.value === "None" || el.value === "") {
    box.style.display = "none";
  } else {
    box.style.display = "block";
  }
}
function initEducationMultiselect(select) {
  var wrapper = document.createElement('div');
  wrapper.className = 'mvv-multiselect';
  var toggle = document.createElement('button');
  toggle.type = 'button';
  toggle.className = 'mvv-multiselect-toggle';
  toggle.setAttribute('aria-haspopup', 'listbox');
  toggle.setAttribute('aria-expanded', 'false');
  var text = document.createElement('span');
  var menu = document.createElement('div');
  menu.className = 'mvv-multiselect-menu';
  menu.setAttribute('role', 'listbox');
  menu.setAttribute('aria-multiselectable', 'true');
  var searchWrap = document.createElement('div');
  searchWrap.className = 'mvv-multiselect-search-wrap';
  var search = document.createElement('input');
  search.type = 'search';
  search.className = 'mvv-multiselect-search';
  search.placeholder = 'Search education...';
  search.setAttribute('aria-label', 'Search education options');
  searchWrap.appendChild(search);
  menu.appendChild(searchWrap);
  var empty = document.createElement('div');
  empty.className = 'mvv-multiselect-empty';
  empty.textContent = 'No matching options';

  function updateText() {
    var selected = Array.prototype.filter.call(select.options, function(option) {
      return option.selected;
    }).map(function(option) { return option.text; });
    text.textContent = selected.length ? selected.join(', ') : 'Select Education';
    text.style.color = selected.length ? '' : '#6c757d';
  }

  Array.prototype.forEach.call(select.options, function(option) {
    if (!option.value) return;
    var label = document.createElement('label');
    label.className = 'mvv-multiselect-option';
    var checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.checked = option.selected;
    checkbox.disabled = option.disabled;
    checkbox.addEventListener('change', function() {
      option.selected = checkbox.checked;
      select.dispatchEvent(new Event('change', { bubbles: true }));
      updateText();
    });
    var optionText = document.createElement('span');
    optionText.textContent = option.text;
    label.appendChild(checkbox);
    label.appendChild(optionText);
    menu.appendChild(label);
  });
  menu.appendChild(empty);

  search.addEventListener('input', function() {
    var query = search.value.trim().toLocaleLowerCase();
    var visible = 0;
    menu.querySelectorAll('.mvv-multiselect-option').forEach(function(label) {
      var matches = !query || label.textContent.toLocaleLowerCase().indexOf(query) !== -1;
      label.classList.toggle('is-filtered-out', !matches);
      if (matches) visible++;
    });
    empty.style.display = visible ? 'none' : 'block';
  });
  search.addEventListener('click', function(event) {
    event.stopPropagation();
  });
  search.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      search.value = '';
      search.dispatchEvent(new Event('input'));
      wrapper.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.focus();
    }
  });

  toggle.appendChild(text);
  wrapper.appendChild(toggle);
  wrapper.appendChild(menu);
  select.parentNode.insertBefore(wrapper, select);
  wrapper.insertBefore(select, toggle);
  toggle.addEventListener('click', function() {
    var open = !wrapper.classList.contains('open');
    document.querySelectorAll('.mvv-multiselect.open').forEach(function(item) {
      item.classList.remove('open');
      item.querySelector('.mvv-multiselect-toggle').setAttribute('aria-expanded', 'false');
    });
    wrapper.classList.toggle('open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (open) {
      window.setTimeout(function() { search.focus(); }, 0);
    } else {
      search.value = '';
      search.dispatchEvent(new Event('input'));
    }
  });
  updateText();
}
document.addEventListener("DOMContentLoaded", function() {
  var iitBox = document.getElementById("iit");
  if (iitBox) ShowHideIIT(iitBox);
  var scases = document.getElementById("scases");
  if (scases) toggleOtherDist(scases);
  document.querySelectorAll('select.education-multiselect').forEach(initEducationMultiselect);
  document.addEventListener('click', function(event) {
    document.querySelectorAll('.mvv-multiselect.open').forEach(function(wrapper) {
      if (!wrapper.contains(event.target)) {
        wrapper.classList.remove('open');
        wrapper.querySelector('.mvv-multiselect-toggle').setAttribute('aria-expanded', 'false');
      }
    });
  });
});
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Education &amp; Career</div>
      <h1>शिक्षण आणि करिअर माहिती</h1>
      <p>तुमचे शिक्षण, उत्पन्न, उंची आणि इतर तपशील भरा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <?php if(isset($login) && $regvar=='9') { ?>
        <a href="index_dashboard">Dashboard</a>
        <?php } else { ?>
        <a href="index">Home</a>
        <?php } ?>
        <span>Education</span>
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
      <?php } else {
        if($me['profile_approve'] == 'Rejected') { ?>
        <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:12px 18px;margin-bottom:20px;text-align:center;">
          Your Profile Description Is Rejected By Admin.
        </div>
        <?php }
        if($me['profile_approve'] == "Yes") { ?>
        <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:12px 18px;margin-bottom:20px;text-align:center;">
          Your Profile Description Is Approved By Admin.
        </div>
        <?php }
      } ?>

<?php
$ID=$_GET['id'];

$hiddenregstep=mysqli_query($con,"select * from register where MatriID='$ID'");
$hiddenfetch=mysqli_fetch_array($hiddenregstep);
if($hiddenfetch['reg_step']=="3") {
    mysqli_query($con,"update register set reg_step='4' where MatriID='$ID'");
}
if(isset($_POST['submit'])) {
    $educationInput = $_POST['education'] ?? [];
    if(!is_array($educationInput)) {
        $educationInput = [$educationInput];
    }
    $educationValues = [];
    foreach($educationInput as $educationValue) {
        $educationValue = $db->setfilter(trim($educationValue));
        if($educationValue !== '' && !in_array($educationValue, $educationValues, true)) {
            $educationValues[] = $educationValue;
        }
    }
    $education = implode(', ', $educationValues);
    $edetails =  $db->setfilter(ucfirst($_POST['edetails']));
    $income = annual_income_normalize_value($_POST['income'] ?? '');
    if (!annual_income_is_valid($income)) {
        $income = 'Income Not Disclosed';
    }
    $occupation = $db->setfilter(ucfirst($_POST['occupation']));
    $odetails = $db->setfilter(ucfirst($_POST['odetails']));
    $employedin = $db->setfilter($_POST['employedin']);
    $workloc = $db->setfilter($_POST['workloc']);
    $workinghrs = $db->setfilter($_POST['workinghrs']);
    $inr = 'Rs';
    $height = $db->setfilter($_POST['height']);
    $weight = $db->setfilter($_POST['weight']);
    $bgroup = $db->setfilter($_POST['bgroup']);
    $complexion = $db->setfilter($_POST['complexion']);
    $scases = $db->setfilter($_POST['scases']);
    $sreason = $db->setfilter($_POST['otherdist']);
    $aboutus = $db->setfilter($_POST['aboutus']);
    $iit=$db->setfilter($_POST['iit']);
    $instu=$db->setfilter($_POST['instu']);
    $edudate = date('d-m-Y');

    if(isset($login) && $regvar=='9') {
        if( ($me['Education'] == $education ) && ($me['EducationDetails'] == $edetails ) && ($me['Annualincome'] == $income ) && ($me['income_in'] == $inr ) && ($me['Occupation'] == $occupation ) && ($me['occu_details'] == $odetails ) && ($me['Employedin'] == $employedin ) && ($me['working_hours'] == $workinghrs ) && ($me['workinglocation'] == $workloc ) && ($me['Height'] == $height ) && ($me['Weight'] == $weight ) && ($me['BloodGroup'] == $bgroup ) && ($me['Complexion'] == $complexion ) && ($me['spe_cases'] == $scases ) && ($me['aboutus'] == $aboutus ) && ($me['iit'] == $iit) && ($me['instu'] == $instu) ) {
            header('Location: index_dashboard'); exit;
        } else {
            if($aboutus != $me['aboutus']) {
                mysqli_query($con,"UPDATE register SET profile_approve='No' where MatriID='$login'");
            }
            if($scases=="None") {
                mysqli_query($con,"update register set Education='$education',EducationDetails='$edetails',Annualincome='$income',income_in='$inr',Occupation='$occupation',occu_details='$odetails',Employedin='$employedin',working_hours='$workinghrs',workinglocation='$workloc',Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',spe_cases='$scases',aboutus='$aboutus',edudate='$edudate',iit='$iit',instu='$instu' where MatriID='$login'");
            } else {
                mysqli_query($con,"update register set Education='$education',EducationDetails='$edetails',Annualincome='$income',income_in='$inr',Occupation='$occupation',occu_details='$odetails',Employedin='$employedin',working_hours='$workinghrs',workinglocation='$workloc',Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',spe_cases='$scases',spe_reason='$sreason',aboutus='$aboutus',edudate='$edudate',iit='$iit',instu='$instu' where MatriID='$login'");
            }
            if($iit!='yes') {
                mysqli_query($con,"update register set instu ='' where MatriID='$login'");
            }
            header('Location: index_dashboard'); exit;
        }
    } else {
        if($scases=="None") {
            mysqli_query($con,"update register set Education='$education',EducationDetails='$edetails',Annualincome='$income',income_in='$inr',Occupation='$occupation',occu_details='$odetails',Employedin='$employedin',working_hours='$workinghrs',workinglocation='$workloc',Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',spe_cases='$scases',edudate='$edudate',reg_step='5',iit='$iit',instu='$instu' where MatriID='$ID'");
        } else {
            mysqli_query($con,"update register set Education='$education',EducationDetails='$edetails',Annualincome='$income',income_in='$inr',Occupation='$occupation',occu_details='$odetails',Employedin='$employedin',working_hours='$workinghrs',workinglocation='$workloc',Height='$height',Weight='$weight',BloodGroup='$bgroup',Complexion='$complexion',spe_cases='$scases',spe_reason='$sreason',edudate='$edudate',reg_step='5',iit='$iit',instu='$instu' where MatriID='$ID'");
        }
        header('location:family?id='.$ID); exit;
    }
}
?>

<?php
$currentEducations = array_values(array_filter(array_map('trim', explode(',', $me['Education'] ?? ''))));
?>

<?php if(isset($login) && $regvar=='9') { ?>
<div class="row g-5 mvv-registration-row">
  <div class="col-lg-9 col-md-12">
    <form method="post" action="#" class="mvv-form">
      <div class="mvv-eyebox">Education &amp; Career</div>
      <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.4vw,2rem);">एडिट एज्युकेशन डिटेल्स</h2>

      <div class="mvv-form-grid">
        <div class="mvv-field" style="grid-column:1/-1;">
          <label class="mvv-checkbox-label">
            <?php if($me['iit']=='yes') { ?>
            <input type="checkbox" name="iit" id="iit" value="yes" onclick="ShowHideIIT(this)" checked>
            <span class="check-icon">&#10003;</span>
            <?php } else { ?>
            <input type="checkbox" name="iit" id="iit" value="yes" onclick="ShowHideIIT(this)">
            <span class="check-icon">&#10003;</span>
            <?php } ?>
            <span>Are you from IIT / IIM / NIT ?</span>
          </label>
        </div>

        <div class="mvv-field" id="instu" <?php if($me['iit']!='yes') { ?>style="display:none"<?php } ?>>
          <label>Institute</label>
          <select name="instu" tabindex="1">
            <?php if($me['instu']=='') { ?>
            <option value="">Select Institute</option>
            <?php } else { ?>
            <option value="<?php echo $me['instu']?>" selected><?php echo $me['instu']?></option>
            <?php } ?>
            <?php $inst1=mysqli_query($con,"select * from iit where status='enable'");
            while($inst=mysqli_fetch_array($inst1)) { ?>
            <option value="<?php echo $inst['Inst_nm'];?>"><?php echo $inst['Inst_nm'] ;?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Education <span class="text-danger">*</span></label>
          <select name="education[]" id="education" class="education-multiselect" tabindex="1" multiple required aria-describedby="education-help">
            <?php $edusql=mysqli_query($con,"select * from education where status='enable'");
            while($edurow=mysqli_fetch_array($edusql)) {
              $eduName = $edurow['edu']; ?>
              <option value="<?php echo htmlspecialchars($eduName, ENT_QUOTES); ?>" <?php echo in_array($eduName, $currentEducations, true) ? 'selected' : ''; ?>><?php echo htmlspecialchars($eduName); ?></option>
            <?php
            } ?>
          </select>
          <small class="mvv-field-help" id="education-help">Click the dropdown and tick all qualifications that apply.</small>
        </div>

        <div class="mvv-field">
          <label>Occupation <span class="text-danger">*</span></label>
          <select name="occupation" id="occupation" tabindex="2" required>
            <?php if($me['Occupation']=="") { ?>
            <option value="" selected>Select Occuption</option>
            <?php } else { ?>
            <option value="<?php echo $me['Occupation']?>" selected><?php echo $me['Occupation']?></option>
            <?php } ?>
            <?php $occsql=mysqli_query($con,"select * from occupation where status='enable'");
            while($occrow=mysqli_fetch_array($occsql)) {
              if($occrow['occu']==$row['Occupation']) { ?>
                <option value="<?php echo $occrow['occu']; ?>" selected><?php echo $occrow['occu']; ?></option>
              <?php } else { ?>
                <option value="<?php echo $occrow['occu']; ?>"><?php echo $occrow['occu']; ?></option>
              <?php }
            } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Education Details</label>
          <textarea rows="4" name="edetails" placeholder="Enter Education Details" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" maxlength="100" tabindex="3"><?php echo $me['EducationDetails']?></textarea>
        </div>

        <div class="mvv-field">
          <label>Occupation Details</label>
          <textarea rows="4" name="odetails" placeholder="Enter Occupation Details" maxlength="100" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" tabindex="4"><?php echo $me['occu_details']?></textarea>
        </div>

        <div class="mvv-field">
          <label>Annual Income</label>
          <select name="income" tabindex="5" required>
            <option value="">Select Annual Income</option>
            <?php echo annual_income_select_options($me['Annualincome'] ?? ''); ?>
          </select>
          <input type="hidden" name="inr" value="Rs">
        </div>

        <div class="mvv-field">
          <label>Employed In</label>
          <select name="employedin" id="employedin" tabindex="7">
            <?php if($me['Employedin']=="") { ?>
            <option value="" selected>Select Employed In</option>
            <?php } else { ?>
            <option value="<?php echo $me['Employedin']?>" selected><?php echo $me['Employedin']?></option>
            <?php } ?>
            <?php $occsql=mysqli_query($con,"select * from employed_in where status='enable'");
            while($occrow=mysqli_fetch_array($occsql)) {
              if($occrow['employed']==$row['Employedin']) { ?>
                <option value="<?php echo $occrow['employed']; ?>" selected><?php echo $occrow['employed']; ?></option>
              <?php } else { ?>
                <option value="<?php echo $occrow['employed']; ?>"><?php echo $occrow['employed']; ?></option>
              <?php }
            } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Working Hours</label>
          <select name="workinghrs" id="workinghrs" tabindex="8">
            <?php if($me['working_hours']=="") { ?>
            <option value="" selected>Select Working Hours</option>
            <?php } else { ?>
            <option value="<?php echo $me['working_hours']?>" selected><?php echo $me['working_hours']?></option>
            <?php } ?>
            <?php $occsql=mysqli_query($con,"select * from working_hours");
            while($occrow=mysqli_fetch_array($occsql)) {
              if($occrow['hours']==$row['working_hours']) { ?>
                <option value="<?php echo $occrow['hours']; ?>" selected><?php echo $occrow['hours']; ?></option>
              <?php } else { ?>
                <option value="<?php echo $occrow['hours']; ?>"><?php echo $occrow['hours']; ?></option>
              <?php }
            } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Height <span class="text-danger">*</span></label>
          <select name="height" tabindex="9" required>
            <?php if($me['Height']=="") { ?>
            <option value="">Select Height</option>
            <?php } else {
              $strheight = $me['Height'];
              $heightLabels = [
                1=>'4Ft', 2=>'4Ft 1 inch', 3=>'4Ft 2 inch', 4=>'4Ft 3 inch', 5=>'4Ft 4 inch',
                6=>'4Ft 5 inch', 7=>'4Ft 6 inch', 8=>'4Ft 7 inch', 9=>'4Ft 8 inch', 10=>'4Ft 9 inch',
                11=>'4Ft 10 inch', 12=>'4Ft 11 inch', 13=>'5Ft', 14=>'5Ft 1 inch', 15=>'5Ft 2 inch',
                16=>'5Ft 3 inch', 17=>'5Ft 4 inch', 18=>'5Ft 5 inch', 19=>'5Ft 6 inch', 20=>'5Ft 7 inch',
                21=>'5Ft 8 inch', 22=>'5Ft 9 inch', 23=>'5Ft 10 inch', 24=>'5Ft 11 inch', 25=>'6Ft',
                26=>'6Ft 1 inch', 27=>'6Ft 2 inch', 28=>'6Ft 3 inch', 29=>'6Ft 4 inch', 30=>'6Ft 5 inch',
                31=>'6Ft 6 inch', 32=>'6Ft 7 inch', 33=>'6Ft 8 inch', 34=>'6Ft 9 inch', 35=>'6Ft 10 inch',
                36=>'6Ft 11 inch', 37=>'7Ft'
              ];
              $height = isset($heightLabels[$strheight]) ? $heightLabels[$strheight] : $strheight;
            ?>
            <option value="<?php echo $strheight; ?>" selected><?php echo $height; ?></option>
            <?php } ?>
            <?php foreach([
              1=>'4Ft', 2=>'4Ft 1 inch', 3=>'4Ft 2 inch', 4=>'4Ft 3 inch', 5=>'4Ft 4 inch',
              6=>'4Ft 5 inch', 7=>'4Ft 6 inch', 8=>'4Ft 7 inch', 9=>'4Ft 8 inch', 10=>'4Ft 9 inch',
              11=>'4Ft 10 inch', 12=>'4Ft 11 inch', 13=>'5Ft', 14=>'5Ft 1 inch', 15=>'5Ft 2 inch',
              16=>'5Ft 3 inch', 17=>'5Ft 4 inch', 18=>'5Ft 5 inch', 19=>'5Ft 6 inch', 20=>'5Ft 7 inch',
              21=>'5Ft 8 inch', 22=>'5Ft 9 inch', 23=>'5Ft 10 inch', 24=>'5Ft 11 inch', 25=>'6Ft',
              26=>'6Ft 1 inch', 27=>'6Ft 2 inch', 28=>'6Ft 3 inch', 29=>'6Ft 4 inch', 30=>'6Ft 5 inch',
              31=>'6Ft 6 inch', 32=>'6Ft 7 inch', 33=>'6Ft 8 inch', 34=>'6Ft 9 inch', 35=>'6Ft 10 inch',
              36=>'6Ft 11 inch', 37=>'7Ft'
            ] as $val => $label) { ?>
            <option value="<?php echo $val; ?>"><?php echo $label; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Weight</label>
          <select name="weight" tabindex="10">
            <?php for($i=40;$i<=150;$i++) {
              $selected = ($me['Weight']==$i) ? 'selected' : '';
            ?>
            <option value="<?php echo $i;?>" <?php echo $selected?>><?php echo $i." kg"; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Blood Group</label>
          <select name="bgroup" tabindex="11">
            <?php if($me['BloodGroup']=="") { ?>
            <?php } else { ?>
            <option value="<?php echo $me['BloodGroup'];?>" selected><?php echo $me['BloodGroup'];?></option>
            <?php } ?>
            <?php $BloodGroup=mysqli_query($con,"select * from blood_group");
            while($edurow=mysqli_fetch_array($BloodGroup)) { ?>
            <option value="<?php echo $edurow['type'] ?>"><?php echo $edurow['type'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Complexion</label>
          <select name="complexion" tabindex="12">
            <?php if($me['Complexion']=="") { ?>
            <?php } else { ?>
            <option value="<?php echo $me['Complexion'];?>" selected><?php echo $me['Complexion'];?></option>
            <?php } ?>
            <?php $Complexionsql=mysqli_query($con,"select * from complexion where complexion!='".$me['Complexion']."'");
            while($Complexionrow=mysqli_fetch_array($Complexionsql)) { ?>
            <option value="<?php echo $Complexionrow['complexion'];?>"><?php echo $Complexionrow['complexion'];?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field" style="grid-column:1/-1;">
          <label>Working Location/City</label>
          <input type="text" name="workloc" maxlength="35" value="<?php echo $me['workinglocation']?>" id="workloc" placeholder="Enter Working Location/City" tabindex="13" onKeyPress="return ValidateAlpha(event);">
        </div>

        <div class="mvv-field" style="grid-column:1/-1;">
          <label>Special Cases</label>
          <select name="scases" id="scases" tabindex="14" onchange="toggleOtherDist(this)">
            <?php if($me['spe_cases']=="") { ?>
            <option value="" selected>Select Special Cases</option>
            <?php } else { ?>
            <option value="<?php echo $me['spe_cases'];?>" selected><?php echo $me['spe_cases'];?></option>
            <?php } ?>
            <?php $special=mysqli_query($con,"select * from special_case where case_type!='".$me['spe_cases']."'");
            while($case=mysqli_fetch_array($special)) { ?>
            <option value="<?php echo $case['case_type'];?>"><?php echo $case['case_type'];?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field" id="otherdist" style="grid-column:1/-1;<?php if(($me['spe_cases']=="None")||($me['spe_cases']=="")) echo 'display:none;'; ?>">
          <label>Please Specify</label>
          <textarea rows="2" name="otherdist" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" placeholder="Please Specify" maxlength="150" tabindex="15"><?php echo $me['spe_reason'];?></textarea>
        </div>

        <div class="mvv-field" style="grid-column:1/-1;">
          <label>About Yourself</label>
          <textarea rows="3" name="aboutus" maxlength="400" tabindex="16" placeholder="About Yourself"><?php echo $me['aboutus'];?></textarea>
        </div>
      </div>

      <div class="mvv-field" style="grid-column:1/-1;margin-top:12px;">
        <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" tabindex="17">Update</button>
      </div>
    </form>
  </div>
  <div class="col-lg-3 col-md-12">
    <?php include('contactinfo.php');?>
  </div>
</div>
<?php } else { ?>
<div class="row g-5 mvv-registration-row">
  <div class="col-lg-9 col-md-12">
    <form method="post" action="#" class="mvv-form">
      <div class="mvv-eyebox">Education &amp; Career</div>
      <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.4vw,2rem);">एज्युकेशन डिटेल्स भरा</h2>

      <div class="mvv-form-grid">
        <div class="mvv-field" style="grid-column:1/-1;">
          <label class="mvv-checkbox-label">
            <input type="checkbox" name="iit" id="iit" value="yes" onclick="ShowHideIIT(this)">
            <span class="check-icon">&#10003;</span>
            <span>Are you from IIT / IIM / NIT ?</span>
          </label>
        </div>

        <div class="mvv-field" id="instu" style="display:none;">
          <label>Institute</label>
          <select name="instu" tabindex="1">
            <option value="">Select Institute</option>
            <?php $inst1=mysqli_query($con,"select * from iit where status='enable'");
            while($inst=mysqli_fetch_array($inst1)) { ?>
            <option value="<?php echo $inst['Inst_nm'];?>"><?php echo $inst['Inst_nm'] ;?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Education <span class="text-danger">*</span></label>
          <select name="education[]" autofocus id="education" class="education-multiselect" tabindex="1" multiple required aria-describedby="education-help">
            <?php $edusql=mysqli_query($con,"select * from education where status='enable'");
            while($edurow=mysqli_fetch_array($edusql)) {
              $eduName = $edurow['edu']; ?>
              <option value="<?php echo htmlspecialchars($eduName, ENT_QUOTES); ?>"><?php echo htmlspecialchars($eduName); ?></option>
            <?php
            } ?>
          </select>
          <small class="mvv-field-help" id="education-help">Click the dropdown and tick all qualifications that apply.</small>
        </div>

        <div class="mvv-field">
          <label>Occupation <span class="text-danger">*</span></label>
          <select name="occupation" id="occupation" tabindex="2" required>
            <option value="" selected>Select Occupation</option>
            <?php $occsql=mysqli_query($con,"select * from occupation where status='enable'");
            while($occrow=mysqli_fetch_array($occsql)) {
              if($occrow['occu']==$row['Occupation']) { ?>
                <option value="<?php echo $occrow['occu']; ?>" selected><?php echo $occrow['occu']; ?></option>
              <?php } else { ?>
                <option value="<?php echo $occrow['occu']; ?>"><?php echo $occrow['occu']; ?></option>
              <?php }
            } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Education Details</label>
          <textarea rows="4" name="edetails" placeholder="Enter Education Details" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" maxlength="100" tabindex="3"></textarea>
        </div>

        <div class="mvv-field">
          <label>Occupation Details</label>
          <textarea rows="4" name="odetails" placeholder="Enter Occupation Details" maxlength="100" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" tabindex="4"></textarea>
        </div>

        <div class="mvv-field">
          <label>Annual Income</label>
          <select name="income" tabindex="5" required>
            <option value="">Select Annual Income</option>
            <?php echo annual_income_select_options(); ?>
          </select>
          <input type="hidden" name="inr" value="Rs">
        </div>

        <div class="mvv-field">
          <label>Employed In</label>
          <select name="employedin" id="employedin" tabindex="7">
            <option value="" selected>Select Employed In</option>
            <?php $occsql=mysqli_query($con,"select * from employed_in where status='enable'");
            while($occrow=mysqli_fetch_array($occsql)) {
              if($occrow['employed']==$row['Employedin']) { ?>
                <option value="<?php echo $occrow['employed']; ?>" selected><?php echo $occrow['employed']; ?></option>
              <?php } else { ?>
                <option value="<?php echo $occrow['employed']; ?>"><?php echo $occrow['employed']; ?></option>
              <?php }
            } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Working Hours</label>
          <select name="workinghrs" id="workinghrs" tabindex="8">
            <option value="" selected>Select Working Hours</option>
            <?php $occsql=mysqli_query($con,"select * from working_hours");
            while($occrow=mysqli_fetch_array($occsql)) {
              if($occrow['hours']==$row['working_hours']) { ?>
                <option value="<?php echo $occrow['hours']; ?>" selected><?php echo $occrow['hours']; ?></option>
              <?php } else { ?>
                <option value="<?php echo $occrow['hours']; ?>"><?php echo $occrow['hours']; ?></option>
              <?php }
            } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Height <span class="text-danger">*</span></label>
          <select name="height" tabindex="9" required>
            <option value="">Select Height</option>
            <?php $heightLabels = [
              1=>'4Ft', 2=>'4Ft 1 inch', 3=>'4Ft 2 inch', 4=>'4Ft 3 inch', 5=>'4Ft 4 inch',
              6=>'4Ft 5 inch', 7=>'4Ft 6 inch', 8=>'4Ft 7 inch', 9=>'4Ft 8 inch', 10=>'4Ft 9 inch',
              11=>'4Ft 10 inch', 12=>'4Ft 11 inch', 13=>'5Ft', 14=>'5Ft 1 inch', 15=>'5Ft 2 inch',
              16=>'5Ft 3 inch', 17=>'5Ft 4 inch', 18=>'5Ft 5 inch', 19=>'5Ft 6 inch', 20=>'5Ft 7 inch',
              21=>'5Ft 8 inch', 22=>'5Ft 9 inch', 23=>'5Ft 10 inch', 24=>'5Ft 11 inch', 25=>'6Ft',
              26=>'6Ft 1 inch', 27=>'6Ft 2 inch', 28=>'6Ft 3 inch', 29=>'6Ft 4 inch', 30=>'6Ft 5 inch',
              31=>'6Ft 6 inch', 32=>'6Ft 7 inch', 33=>'6Ft 8 inch', 34=>'6Ft 9 inch', 35=>'6Ft 10 inch',
              36=>'6Ft 11 inch', 37=>'7Ft'
            ];
            foreach($heightLabels as $val => $label) { ?>
            <option value="<?php echo $val; ?>"><?php echo $label; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Weight</label>
          <select name="weight" tabindex="10">
            <option value="" selected>Select Weight</option>
            <?php for($i=40;$i<=150;$i++) { ?>
            <option value="<?php echo $i;?>"><?php echo $i." kg"; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Blood Group</label>
          <select name="bgroup" tabindex="11">
            <option value="" selected>Select Blood Group</option>
            <?php $BloodGroup=mysqli_query($con,"select * from blood_group");
            while($edurow=mysqli_fetch_array($BloodGroup)) { ?>
            <option value="<?php echo $edurow['type'] ?>"><?php echo $edurow['type'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field">
          <label>Complexion</label>
          <select name="complexion" tabindex="12">
            <option value="" selected>Select Complexion</option>
            <?php $Complexionsql=mysqli_query($con,"select * from complexion where complexion!='".$row['Complexion']."'");
            while($Complexionrow=mysqli_fetch_array($Complexionsql)) { ?>
            <option value="<?php echo $Complexionrow['complexion'];?>"><?php echo $Complexionrow['complexion'];?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field" style="grid-column:1/-1;">
          <label>Working Location/City</label>
          <input type="text" name="workloc" id="workloc" maxlength="35" placeholder="Enter Working Location/City" tabindex="13" onKeyPress="return ValidateAlpha(event);">
        </div>

        <div class="mvv-field" style="grid-column:1/-1;">
          <label>Special Cases</label>
          <select name="scases" id="scases" tabindex="14" onchange="toggleOtherDist(this)">
            <?php if($me['spe_cases']=="") { ?>
            <option value="" selected>Select Special Cases</option>
            <?php } else { ?>
            <option value="<?php echo $me['spe_cases'];?>" selected><?php echo $me['spe_cases'];?></option>
            <?php } ?>
            <?php $special=mysqli_query($con,"select * from special_case where case_type!='".$me['spe_cases']."'");
            while($case=mysqli_fetch_array($special)) { ?>
            <option value="<?php echo $case['case_type'];?>"><?php echo $case['case_type'];?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mvv-field" id="otherdist" style="grid-column:1/-1;display:none;">
          <label>Please Specify</label>
          <textarea rows="2" name="otherdist" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);" placeholder="Please Specify" maxlength="150"><?php echo $me['spe_reason'];?></textarea>
        </div>
      </div>

      <div class="mvv-field" style="grid-column:1/-1;margin-top:12px;">
        <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" tabindex="16">Submit Now</button>
      </div>
    </form>
  </div>
  <div class="col-lg-3 col-md-12">
    <?php include('contactinfo.php');?>
  </div>
</div>
<?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

