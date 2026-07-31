<?php 
require_once('includes/bootstrap.php');
require_once('agent_commission_lib.php');

$login=$_SESSION['MatriID'] ?? null;

function save_registration_location_details($con, $matriID)
{
    $profileType = $_SESSION['registration_profile_type'] ?? 'Indian Resident';
    $nri = $_SESSION['nri_registration_data'] ?? [];
    $fields = [
        'nri_type', 'nri_citizenship', 'nri_current_country', 'nri_current_state',
        'nri_current_city', 'nri_residency_status', 'nri_visa_type', 'nri_visa_expiry',
        'nri_years_abroad', 'nri_overseas_mobile', 'nri_income_currency',
        'nri_willing_to_relocate', 'nri_settlement_preference', 'nri_native_place',
        'nri_preferred_country'
    ];
    $values = [];
    foreach ($fields as $field) {
        $values[$field] = $profileType === 'NRI' ? trim((string)($nri[$field] ?? '')) : '';
    }
    $visaExpiry = $values['nri_visa_expiry'] !== '' ? $values['nri_visa_expiry'] : null;
    $yearsAbroad = $values['nri_years_abroad'] !== '' ? (string)(int)$values['nri_years_abroad'] : null;

    $query = $con->prepare("UPDATE register SET
        profile_location_type=?, nri_type=?, nri_citizenship=?, nri_current_country=?,
        nri_current_state=?, nri_current_city=?, nri_residency_status=?, nri_visa_type=?,
        nri_visa_expiry=?, nri_years_abroad=?,
        nri_overseas_mobile=?, nri_income_currency=?, nri_willing_to_relocate=?,
        nri_settlement_preference=?, nri_native_place=?, nri_preferred_country=?
        WHERE MatriID=?");
    if (!$query) return false;
    $query->bind_param(
        'sssssssssssssssss',
        $profileType, $values['nri_type'], $values['nri_citizenship'],
        $values['nri_current_country'], $values['nri_current_state'],
        $values['nri_current_city'], $values['nri_residency_status'],
        $values['nri_visa_type'], $visaExpiry,
        $yearsAbroad, $values['nri_overseas_mobile'],
        $values['nri_income_currency'], $values['nri_willing_to_relocate'],
        $values['nri_settlement_preference'], $values['nri_native_place'],
        $values['nri_preferred_country'], $matriID
    );
    try {
        return $query->execute();
    } catch (mysqli_sql_exception $exception) {
        error_log('Unable to save registration location details: '.$exception->getMessage());
        return false;
    }
}

function find_interrupted_registration($con, $email, $password, $initialMatriID)
{
    if ($email === '' || $password === '' || $initialMatriID === '') return null;
    $query = $con->prepare("SELECT ID, MatriID, Mobile, ConfirmEmail FROM register
        WHERE ConfirmEmail=? AND ConfirmPassword=? AND reg_step='1' AND MatriID<>?
        ORDER BY ID DESC LIMIT 1");
    if (!$query) return null;
    $query->bind_param('sss', $email, $password, $initialMatriID);
    $query->execute();
    $result = $query->get_result();
    return $result ? $result->fetch_assoc() : null;
}

function finish_new_registration($con, $member, $mobile, $email)
{
    $memberID = (int)$member['ID'];
    $matriID = (string)$member['MatriID'];
    if (!save_registration_location_details($con, $matriID)) return false;

    agent_link_registered_customer($con, $memberID, $matriID, $mobile, $email);
    $_SESSION['tempid'] = $matriID;
    $_SESSION['matriid'] = $matriID;
    $_SESSION['MatriID'] = $matriID;
    unset(
        $_SESSION['nri_registration_data'],
        $_SESSION['registration_profile_type'],
        $_SESSION['querystr'],
        $_SESSION['querystr2']
    );
    return true;
}

function complete_step2_registration($con, $initialMatriID)
{
    if (!empty($_SESSION['querystr'])) {
        $email = isset($_SESSION['emailtemp']) ? $_SESSION['emailtemp'] : '';
        $mobile = isset($_SESSION['mobile']) ? $_SESSION['mobile'] : '';
        $password = isset($_SESSION['pwd']) ? $_SESSION['pwd'] : '';

        $interruptedMember = find_interrupted_registration($con, $email, $password, (string)$initialMatriID);
        if ($interruptedMember) {
            if (!finish_new_registration($con, $interruptedMember, $mobile, $email)) {
                header('location:step2?msg=Unable to save profile location details');
                exit;
            }
            header('Location: admin_mail?id='.$interruptedMember['MatriID']);
            exit;
        }

        if ($email !== '') {
            $emailCheck = mysqli_query($con, "SELECT ConfirmEmail FROM register WHERE ConfirmEmail='$email'");
            if (mysqli_num_rows($emailCheck) > 0) {
                header('Location: signup?error=The email address is already registered');
                exit;
            }
        }

        if ($mobile !== '') {
            $mobileCheck = mysqli_query($con, "SELECT Mobile FROM register WHERE Mobile='$mobile'");
            if (mysqli_num_rows($mobileCheck) > 0) {
                header('Location: signup?mobile=The Mobile Number is already Exists');
                exit;
            }
        }

        if (mysqli_query($con, $_SESSION['querystr']) == 0) {
            header('location:step2?msg=Unable to complete registration');
            exit;
        }

        $lastid = mysqli_insert_id($con);
        mysqli_query($con, $_SESSION['querystr2']);

        $respre = mysqli_query($con, 'SELECT * FROM siteconfig');
        $rowpre = mysqli_fetch_array($respre);
        $prefix = $rowpre['prefix'];

        do {
            $mid = $prefix . rand(11111, 99999);
            $check = mysqli_query($con, "SELECT MatriID FROM register WHERE MatriID='$mid'");
        } while (mysqli_num_rows($check) > 0);

        mysqli_query($con, "UPDATE register SET MatriID='$mid', Age=DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,DOB)),'%y') WHERE ID='$lastid'");
        $newMember = ['ID' => $lastid, 'MatriID' => $mid];
        if (!finish_new_registration($con, $newMember, $mobile, $email)) {
            header('location:step2?msg=Unable to save profile location details');
            exit;
        }

        header('Location: admin_mail?id='.$mid);
        exit;
    }

    mysqli_query($con, $_SESSION['querystr2']);
    mysqli_query($con, "UPDATE register SET reg_step='2' WHERE MatriID='$initialMatriID'");
    $memberResult = mysqli_query($con, "SELECT ID, MatriID, Mobile, ConfirmEmail FROM register WHERE MatriID='$initialMatriID' LIMIT 1");
    if ($memberResult && ($member = mysqli_fetch_assoc($memberResult))) {
        agent_link_registered_customer($con, (int)$member['ID'], $member['MatriID'], $member['Mobile'], $member['ConfirmEmail']);
    }
    header('Location: horoscope?id='.$initialMatriID);
    exit;
}

// Resume an NRI registration that was interrupted after the member row was
// created but before its location details were saved.
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_SESSION['querystr']) && !empty($_SESSION['nri_registration_data'])) {
    $resumeEmail = (string)($_SESSION['emailtemp'] ?? '');
    $resumePassword = (string)($_SESSION['pwd'] ?? '');
    $resumeInitialID = (string)($_SESSION['MatriID'] ?? '');
    $interruptedMember = find_interrupted_registration($con, $resumeEmail, $resumePassword, $resumeInitialID);
    if ($interruptedMember && finish_new_registration($con, $interruptedMember, (string)($_SESSION['mobile'] ?? ''), $resumeEmail)) {
        header('Location: admin_mail?id='.$interruptedMember['MatriID']);
        exit;
    }
}

if(isset($_POST['submit']))
{
    $created_by="";         $created_by_error="";
    $maritial_status="";    $maritial_status_error="";
    $mobile="";             $mobile_error="";
    $religion="";           $religion_error="";
    $caste="";              $caste_error="";
    $subcaste="";           $subcaste_error="";

    $ID=$_SESSION['MatriID'] ?? null;
    $created_by=$db->setfilter($_POST['created_by']);   
    $maritial_status=$db->setfilter($_POST['maritalstatus']);
    $noofchildren='None';
    $childrenstatus='';
    $children_details='';
    $child_acceptance='';
    if ($maritial_status === 'Divorced') {
        $childrenCountInput = $_POST['noofchildren'] ?? '';
        if ($childrenCountInput === '' || !ctype_digit((string)$childrenCountInput) || (int)$childrenCountInput < 0 || (int)$childrenCountInput > 10) {
            header('location:step2?msg='.urlencode('Please select a valid children count')); exit;
        }
        $childrenCount = (int)$childrenCountInput;
        $noofchildren = $childrenCount === 0 ? 'None' : (string)$childrenCount;
        $childRecords = [];
        if ($childrenCount > 0) {
            $childrenstatus=$db->setfilter($_POST['childrenstatus'] ?? '');
            $child_acceptance=$db->setfilter($_POST['child_acceptance'] ?? '');
            if ($childrenstatus === '') {
                header('location:step2?msg='.urlencode('Please select children living status')); exit;
            }
            if (!in_array($child_acceptance, ['Do Not Accept Children', 'Boy Child', 'Girl Child', 'Both Boy and Girl Child'], true)) {
                header('location:step2?msg='.urlencode('Please select child acceptance')); exit;
            }
            $childGenders = isset($_POST['child_gender']) && is_array($_POST['child_gender']) ? $_POST['child_gender'] : [];
            $childAges = isset($_POST['child_age']) && is_array($_POST['child_age']) ? $_POST['child_age'] : [];
            for ($childIndex = 0; $childIndex < $childrenCount; $childIndex++) {
                $childGender = $childGenders[$childIndex] ?? '';
                $childAge = $childAges[$childIndex] ?? '';
                if (!in_array($childGender, ['Male', 'Female'], true) || !ctype_digit((string)$childAge) || (int)$childAge < 1 || (int)$childAge > 50) {
                    header('location:step2?msg='.urlencode('Please enter gender and age (1-50 years) for every child')); exit;
                }
                $childRecords[] = ['gender' => $childGender, 'age' => (int)$childAge];
            }
        }
        $children_details = $db->setfilter(json_encode($childRecords, JSON_UNESCAPED_UNICODE));
    }
    $religion=$db->setfilter($_POST['religion']);
    $caste=$db->setfilter($_POST['caste']);
    $mobile=$db->setfilter($_POST['mobile']);
    $subcaste=$db->setfilter($_POST['subcaste']);
    $countrycode=$db->setfilter($_POST['countrycode']);
    $aboutus=$db->setfilter($_POST['aboutus']);
    $aboutLength = function_exists('mb_strlen') ? mb_strlen(trim($aboutus)) : strlen(trim($aboutus));
    if ($aboutLength < 30 || $aboutLength > 400) {
        header('location:step2?msg='.urlencode('About Yourself must contain between 30 and 400 characters'));
        exit;
    }
    $error=0;

    $mob=strlen($mobile);
    if($mob!=10){
        $mobile_error="Incorrect Mobile Number";    
        header('location:step2?msg='.$mobile_error); exit;
    } elseif (!ctype_digit($mobile)) {
        $mobile_error="Please Enter only number";   
        header('location:step2?msg='.$mobile_error); exit;
    }

    if($mobile==""){
        $mobile_error="Please Enter Mobile";
        header('location:step2?msg='.$mobile_error); exit;
    } else {
        $sql = mysqli_query($con,"SELECT Mobile FROM register where Mobile='".$_POST['mobile']."'");
        while($row=mysqli_fetch_array($sql)){
            if(in_array($mobile,$row)!==false){
                $mobile_error="The mobile number is already registered";    
                header('location:step2?msg='.$mobile_error); exit;
            }
        }
    }
    if($religion=="")  { $religion_error="Please select Religion";         $error=1; }
    if($caste=="")     { $caste_error="Please select Caste";               $error=1; }
    if($maritial_status=="") { $maritial_status_error="Please select Maritial Status"; $error=1; }
    if($created_by=="") { $created_by_error="Please select Profile Created For"; $error=1; }

    $query2="update register set Profilecreatedby='$created_by',Maritalstatus='$maritial_status',PE_HaveChildren='$noofchildren',childrenlivingstatus='$childrenstatus',children_details='$children_details',child_acceptance='$child_acceptance',Religion='$religion',Caste='$caste',Subcaste='$subcaste',countrycode='$countrycode',Mobile=$mobile,aboutus='$aboutus' where MatriID='$ID'";

    $_SESSION['querystr2']=$query2;
    $_SESSION['mobile']=$mobile;  
    $_SESSION['tempid']=$ID;
    $_SESSION['matriid']=$ID;
    $_SESSION['countrycode']=$countrycode;
    $_SESSION['caste']=$caste;
    $_SESSION['maritial_status']=$maritial_status;
    complete_step2_registration($con, $ID);
}
?>
<?php
$page_title = 'Basic Information - Manpasand Jodidar';
$defaultAboutText = 'I am a caring, responsible and family-oriented person who values honesty, respect and understanding. I believe in balancing family traditions with a positive and modern outlook. I am looking for a compatible life partner with similar values.';
$aboutText = trim((string)($aboutus ?? '')) !== '' ? $aboutus : $defaultAboutText;
$aboutExamples = [
    'Family Oriented' => 'I am a caring, responsible and family-oriented person who values honesty, respect and understanding. I believe in balancing family traditions with a positive and modern outlook. I am looking for a compatible life partner with similar values.',
    'Career Focused' => 'I am a confident and hardworking professional with a positive approach to life. I value family relationships, personal growth and mutual respect. In my free time, I enjoy travelling, music and spending time with family.',
    'Simple and Traditional' => 'I am a simple, kind-hearted and down-to-earth person from a close-knit family. I respect our culture and traditions while keeping an open-minded outlook. I am looking for an understanding and supportive life partner.'
];
include('header3.php');
?>
<style>
/* Match the light breadcrumb header used on the Membership page. */
main.mvv-page > .mvv-page-hero.mvv-form-hero {
  min-height: auto !important;
  padding: clamp(50px, 6vw, 72px) 0 !important;
  color: #3a2a22 !important;
  background: radial-gradient(circle at 80% 30%, rgba(213,107,36,.14), transparent 30%), #fff9f0 !important;
  border-bottom: 1px solid rgba(109,23,38,.12) !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero::before,
main.mvv-page > .mvv-page-hero.mvv-form-hero::after {
  display: none !important;
  content: none !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero .mvv-container {
  padding-right: 24px !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero h1 {
  color: #7a0e1a !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero p {
  color: #7b6256 !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero .mvv-breadcrumb {
  padding: 0 !important;
  background: transparent !important;
  border: 0 !important;
  color: #7b6256 !important;
  backdrop-filter: none !important;
  font-weight: 500 !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero .mvv-breadcrumb a {
  color: #d56b24 !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero .mvv-breadcrumb span {
  color: #7b6256 !important;
}
main.mvv-page > .mvv-page-hero.mvv-form-hero .mvv-breadcrumb span::before {
  content: "›" !important;
  color: #7b6256 !important;
}
.divorce-children-section {
  grid-column: 1/-1;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 18px;
  padding: 20px;
  border: 1px solid var(--mvv-border);
  border-radius: 10px;
  background: #fff9f2;
}
.divorce-children-section > h3,
.divorce-children-section > p,
.children-details-grid { grid-column: 1/-1; }
.divorce-children-section > h3 { margin: 0; color: var(--mvv-maroon); font-size: 1.15rem; }
.divorce-children-section > p { margin: -10px 0 0; color: var(--mvv-muted); font-size: .86rem; }
.children-details-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
.child-detail-card { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; padding: 15px; border: 1px solid var(--mvv-border); border-radius: 8px; background: #fff; }
.child-detail-card h4 { grid-column: 1/-1; margin: 0; color: var(--mvv-saffron); font-size: .95rem; }
.about-label-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.about-examples-button {
  border: 1px solid rgba(122, 14, 26, .24);
  border-radius: 999px;
  padding: 7px 13px;
  color: var(--mvv-maroon);
  background: #fff7ef;
  font-size: .78rem;
  font-weight: 700;
  cursor: pointer;
}
.about-examples-button:hover {
  color: #fff;
  background: var(--mvv-maroon);
}
.about-help-row {
  display: flex;
  justify-content: space-between;
  gap: 12px;
  margin-top: 6px;
  color: var(--mvv-muted);
  font-size: .8rem;
}
.about-modal {
  position: fixed;
  inset: 0;
  z-index: 99999;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: rgba(38, 18, 14, .62);
  backdrop-filter: blur(4px);
}
.about-modal.is-open { display: flex; }
.about-modal-panel {
  width: min(760px, 100%);
  max-height: min(84vh, 760px);
  overflow-y: auto;
  border-radius: 18px;
  padding: 24px;
  background: #fffaf4;
  box-shadow: 0 24px 70px rgba(50, 16, 12, .3);
}
.about-modal-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 18px;
  margin-bottom: 18px;
}
.about-modal-header h3 {
  margin: 0 0 5px;
  color: var(--mvv-maroon);
}
.about-modal-header p {
  margin: 0;
  color: var(--mvv-muted);
}
.about-modal-close {
  flex: 0 0 40px;
  width: 40px;
  height: 40px;
  border: 0;
  border-radius: 50%;
  color: var(--mvv-maroon);
  background: #f5e7dd;
  font-size: 1.45rem;
  cursor: pointer;
}
.about-example-card {
  margin-top: 12px;
  border: 1px solid var(--mvv-border);
  border-radius: 12px;
  padding: 17px;
  background: #fff;
}
.about-example-card h4 {
  margin: 0 0 7px;
  color: var(--mvv-maroon);
}
.about-example-card p {
  margin: 0 0 13px;
  color: #614b40;
  line-height: 1.65;
}
.use-about-example {
  border: 0;
  border-radius: 8px;
  padding: 9px 15px;
  color: #fff;
  background: var(--mvv-maroon);
  font-weight: 700;
  cursor: pointer;
}
@media (max-width: 700px) {
  .divorce-children-section, .children-details-grid, .child-detail-card { grid-template-columns: 1fr; }
  .child-detail-card h4 { grid-column: auto; }
  .about-modal-panel { padding: 18px; }
}
</style>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
function checkdiv(str) {
  var isDivorced = str === 'Divorced';
  $('#divorceChildrenSection').toggle(isDivorced);
  var count = document.getElementById('noofchildren');
  if (count) count.required = isDivorced;
  if (!isDivorced) {
    if (count) count.value = '';
    renderChildDetails(0);
  } else if (count) {
    updateChildFields(count.value);
  }
}
function updateChildFields(value) {
  var count = parseInt(value, 10) || 0;
  $('#childstatus').toggle(count > 0);
  $('#childAcceptanceField').toggle(count > 0);
  var livingStatus = document.getElementById('childrenstatus');
  var childAcceptance = document.getElementById('child_acceptance');
  if (livingStatus) livingStatus.required = count > 0;
  if (childAcceptance) childAcceptance.required = count > 0;
  renderChildDetails(count);
}
function renderChildDetails(count) {
  var container = document.getElementById('childrenDetails');
  if (!container) return;
  var previous = Array.from(container.querySelectorAll('.child-detail-card')).map(function(card) {
    return {
      gender: card.querySelector('[name="child_gender[]"]')?.value || '',
      age: card.querySelector('[name="child_age[]"]')?.value || ''
    };
  });
  container.innerHTML = '';
  for (var i = 0; i < count; i++) {
    var card = document.createElement('div');
    card.className = 'child-detail-card';
    card.innerHTML = '<h4>Child '+(i+1)+'</h4>'+
      '<div class="mvv-field"><label>Gender</label><select name="child_gender[]" required><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></div>'+
      '<div class="mvv-field"><label>Age</label><select name="child_age[]" required><option value="">Select Age</option>'+childAgeOptions()+'</select></div>';
    container.appendChild(card);
    if (previous[i]) {
      card.querySelector('[name="child_gender[]"]').value = previous[i].gender;
      card.querySelector('[name="child_age[]"]').value = previous[i].age;
    }
  }
}
function childAgeOptions() {
  var options = '';
  for (var age = 1; age <= 50; age++) options += '<option value="'+age+'">'+age+' years</option>';
  return options;
}
function checkdiv2(str) { if((str=='Buddhist')||(str=='Inter-Religion')){$('#caste1').hide();}else{$('#caste1').show();} }
function fillcaste(str) { if(str==""){document.getElementById("caste").innerHTML="";return;}
  var x=new XMLHttpRequest();x.onreadystatechange=function(){if(x.readyState==4&&x.status==200)document.getElementById("caste").innerHTML=x.responseText;};
  x.open("GET","fillcaste.php?q="+str,true);x.send();
}
function isNumber(evt){evt=evt||window.event;var c=evt.which||evt.keyCode;return!(c>31&&(c<48||c>57));}
function maxLengthCheck(obj){if(obj.value.length>obj.maxLength)obj.value=obj.value.slice(0,obj.maxLength);}
function check_exist1(str){var x=new XMLHttpRequest();x.onreadystatechange=function(){if(x.readyState==4&&x.status==200)document.getElementById("mobileErrorDiv").innerHTML=x.responseText;};x.open("GET","check_mobile_exist.php?q="+str,true);x.send();}
function preventBack(){window.history.forward();}
setTimeout("preventBack()",0);
window.onunload=function(){null};
if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}
document.addEventListener('DOMContentLoaded', function() {
  var maritalStatus = document.getElementById('maritalstatus');
  if (maritalStatus) checkdiv(maritalStatus.value);

  var aboutField = document.getElementById('aboutus');
  var aboutCounter = document.getElementById('aboutCharacterCount');
  var aboutModal = document.getElementById('aboutExamplesModal');
  var openExamples = document.getElementById('openAboutExamples');
  var closeExamples = document.getElementById('closeAboutExamples');

  function updateAboutCounter() {
    if (aboutField && aboutCounter) aboutCounter.textContent = aboutField.value.length + '/400';
  }

  function closeAboutModal() {
    if (!aboutModal) return;
    aboutModal.classList.remove('is-open');
    document.body.style.overflow = '';
    if (openExamples) openExamples.focus();
  }

  if (openExamples && aboutModal) {
    openExamples.addEventListener('click', function() {
      aboutModal.classList.add('is-open');
      document.body.style.overflow = 'hidden';
      if (closeExamples) closeExamples.focus();
    });
  }
  if (closeExamples) closeExamples.addEventListener('click', closeAboutModal);
  if (aboutModal) {
    aboutModal.addEventListener('click', function(event) {
      if (event.target === aboutModal) closeAboutModal();
    });
  }
  document.querySelectorAll('.use-about-example').forEach(function(button) {
    button.addEventListener('click', function() {
      if (!aboutField) return;
      aboutField.value = button.getAttribute('data-about-example') || '';
      updateAboutCounter();
      closeAboutModal();
      aboutField.focus();
    });
  });
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && aboutModal && aboutModal.classList.contains('is-open')) {
      closeAboutModal();
    }
  });
  if (aboutField) aboutField.addEventListener('input', updateAboutCounter);
  updateAboutCounter();
});
</script>

<main class="mvv-page">
  <section class="mvv-page-hero mvv-form-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Basic Information</div>
      <h1>तुमची बेसिक माहिती पूर्ण करा</h1>
      <p>तुमच्या प्रोफाइलसाठी आवश्यक माहिती भरा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>Basic Information</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(isset($_GET['msg'])){ ?>
      <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:10px 16px;margin-bottom:16px;"><?php echo htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8'); ?></div>
      <?php } ?>

      <form method="POST" action="#" class="mvv-form">
        <div class="mvv-eyebrow">Profile Details</div>
        <h2 class="mvv-title" style="font-size:clamp(1.6rem,2.8vw,2.4rem);">तुमची वैयक्तिक माहिती</h2>

        <div class="mvv-form-grid">
          <div class="mvv-field">
            <label>Profile Created by</label>
            <select name="created_by" required tabindex="1">
              <?php if(isset($_POST['created_by'])){ ?>
                <option value="<?php echo $_POST['created_by'];?>" selected><?php echo $_POST['created_by'];?></option>
              <?php } else { ?>
                <option value="">Profile Created by</option>
              <?php } ?>
              <option value="Self">Self</option>
              <option value="Father">Father</option>
              <option value="Mother">Mother</option>
              <option value="Brother">Brother</option>
              <option value="Sister">Sister</option>
              <option value="Friend">Friend</option>
              <option value="Son">Son</option>
              <option value="Daughter">Daughter</option>
              <option value="Others">Others</option>
            </select>
          </div>

          <div class="mvv-field">
            <label>Marital Status</label>
            <select name="maritalstatus" id="maritalstatus" onChange="checkdiv(this.value)" required tabindex="2">
              <?php if(isset($_POST['maritial_status'])){ ?>
                <option value="<?php echo $maritial_status;?>" selected><?php echo $maritial_status;?></option>
              <?php } else { ?>
                <option value="">Marital Status</option>
              <?php } ?>
              <?php $rrs=mysqli_query($con,"SELECT * FROM maritial_status");
              while($rrow=mysqli_fetch_array($rrs)){ ?>
                <option value="<?php echo $rrow['status'];?>"><?php echo $rrow['status'];?></option>
              <?php } ?>
            </select>
          </div>

          <div class="divorce-children-section" id="divorceChildrenSection" style="display:none">
            <h3>Children Details</h3>
            <p>This information is required for divorced profiles. Add gender and age for each child.</p>
            <div class="mvv-field" id="noofchild">
              <label>No. of Children</label>
              <select name="noofchildren" id="noofchildren" onchange="updateChildFields(this.value)" tabindex="3">
                <option value="">Select Children Count</option>
                <option value="0">No Children</option>
                <?php for($childCount=1; $childCount<=10; $childCount++){ ?>
                  <option value="<?php echo $childCount; ?>"><?php echo $childCount; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mvv-field" id="childstatus" style="display:none">
              <label>Children Living Status</label>
              <select name="childrenstatus" id="childrenstatus" tabindex="4">
                <option value="">Select Living Status</option>
                <option value="Living with me">Living with me</option>
                <option value="Not living with me">Not living with me</option>
                <option value="Some living with me">Some living with me</option>
              </select>
            </div>
            <div class="mvv-field" id="childAcceptanceField" style="display:none">
              <label>Child Acceptance</label>
              <select name="child_acceptance" id="child_acceptance" tabindex="5">
                <option value="">Select Child Acceptance</option>
                <option value="Do Not Accept Children">Do Not Accept Children</option>
                <option value="Boy Child">Boy Child</option>
                <option value="Girl Child">Girl Child</option>
                <option value="Both Boy and Girl Child">Both Boy &amp; Girl Child</option>
              </select>
            </div>
            <div class="children-details-grid" id="childrenDetails"></div>
          </div>

          <div class="mvv-field">
            <label>Religion</label>
            <select name="religion" id="religion" onChange="fillcaste(this.value);checkdiv2(this.value)" required tabindex="5">
              <?php if(isset($_POST['religion'])){ ?>
                <option value="<?php echo $religion;?>" selected><?php echo $religion;?></option>
              <?php } else { ?>
                <option value="">Your Religion</option>
              <?php } ?>
              <?php $rrs=mysqli_query($con,"SELECT * FROM religion WHERE status='enable' ORDER BY Religion ASC");
              while($rrow=mysqli_fetch_array($rrs)){ ?>
                <option value="<?php echo $rrow['Religion'];?>"><?php echo $rrow['Religion'];?></option>
              <?php } ?>
            </select>
          </div>

          <div class="mvv-field" id="caste1">
            <label>Caste</label>
            <select name="caste" id="caste" required tabindex="6">
              <?php if(isset($_POST['caste'])){ ?>
                <option value="<?php echo $caste;?>" selected><?php echo $caste;?></option>
              <?php } else { ?>
                <option value="">Your Caste</option>
              <?php } ?>
            </select>
          </div>

          <div class="mvv-field">
            <label>Subcaste</label>
            <input type="text" placeholder="Your Subcaste" name="subcaste" tabindex="7" maxlength="20">
          </div>

          <div class="mvv-field">
            <label>Country Code</label>
            <select name="countrycode" required tabindex="8">
              <?php $SQL_CountryCode=mysqli_query($con,"SELECT id,phonecode,nicename FROM tbl_country"); ?>
              <option value="99" selected>(+91) India</option>
              <?php while($RS_CountryCode=mysqli_fetch_array($SQL_CountryCode)){ ?>
                <option value="<?php echo $RS_CountryCode['id'] ?>">(+<?php echo $RS_CountryCode['phonecode']; ?>) <?php echo $RS_CountryCode['nicename']; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="mvv-field">
            <label>Mobile Number</label>
            <input type="text"
                oninput="maxLengthCheck(this)"
                maxlength="10"
                placeholder="Enter 10-digit Mobile Number"
                onblur="check_exist1(this.value);"
                name="mobile"
                id="mobileInput"
                tabindex="9"
                onkeypress="return isNumber(event)"
                pattern="[6-9]{1}[0-9]{9}"
                required>
            <div id="mobileErrorDiv" style="color:var(--mvv-maroon);font-size:0.85rem;margin-top:4px;">
              <?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8') : ''; ?>
            </div>
          </div>

          <div class="mvv-field full">
            <div class="about-label-row">
              <label for="aboutus">About Yourself</label>
              <button type="button" class="about-examples-button" id="openAboutExamples">
                <i class="bi bi-lightbulb"></i> View Examples
              </button>
            </div>
            <textarea name="aboutus" id="aboutus" placeholder="Enter few lines about yourself" class="txare" minlength="30" maxlength="400" tabindex="10" required><?php echo htmlspecialchars($aboutText, ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div class="about-help-row">
              <span>Minimum 30 characters. Please personalize the text.</span>
              <span id="aboutCharacterCount">0/400</span>
            </div>
          </div>

          <div class="full">
            <button class="mvv-btn maroon w-100" type="submit" name="submit" value="1" id="submitBtn"><i class="bi bi-check-circle-fill"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>

<div class="about-modal" id="aboutExamplesModal" role="dialog" aria-modal="true" aria-labelledby="aboutExamplesTitle">
  <div class="about-modal-panel">
    <div class="about-modal-header">
      <div>
        <h3 id="aboutExamplesTitle">About Yourself Examples</h3>
        <p>Select an example, then edit it to match your personality and lifestyle.</p>
      </div>
      <button type="button" class="about-modal-close" id="closeAboutExamples" aria-label="Close examples">&times;</button>
    </div>
    <?php foreach ($aboutExamples as $exampleTitle => $exampleText) { ?>
    <article class="about-example-card">
      <h4><?php echo htmlspecialchars($exampleTitle, ENT_QUOTES, 'UTF-8'); ?></h4>
      <p><?php echo htmlspecialchars($exampleText, ENT_QUOTES, 'UTF-8'); ?></p>
      <button type="button" class="use-about-example" data-about-example="<?php echo htmlspecialchars($exampleText, ENT_QUOTES, 'UTF-8'); ?>">
        Use This Example
      </button>
    </article>
    <?php } ?>
  </div>
</div>

<?php include('footer3.php'); ?>
