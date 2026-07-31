<?php
ob_start();
require_once('includes/bootstrap.php');

if (empty($_SESSION['querystr'])) {
    header('Location: signup');
    exit;
}
if (($_SESSION['registration_profile_type'] ?? '') !== 'NRI') {
    header('Location: step2');
    exit;
}

function nri_h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$fieldNames = [
    'nri_type', 'nri_citizenship', 'nri_current_country', 'nri_current_state',
    'nri_current_city', 'nri_residency_status', 'nri_visa_type', 'nri_visa_expiry',
    'nri_years_abroad', 'nri_overseas_mobile', 'nri_income_currency',
    'nri_willing_to_relocate', 'nri_settlement_preference', 'nri_native_place',
    'nri_preferred_country'
];
$values = array_fill_keys($fieldNames, '');
$values = array_merge($values, $_SESSION['nri_registration_data'] ?? []);
$errors = [];

$nriTypes = ['NRI', 'OCI', 'PIO', 'Foreign Citizen'];
$visaTypes = ['Work Visa', 'Student Visa', 'Dependent Visa', 'Business Visa', 'Other', 'Not Applicable'];
$relocationOptions = ['Yes', 'No', 'Depends'];
$settlementOptions = ['India', 'Abroad', 'Undecided'];
$currencies = ['USD', 'GBP', 'CAD', 'AUD', 'EUR', 'AED', 'NZD', 'SGD', 'INR', 'Other'];

$countries = [];
$countryResult = mysqli_query($con, "SELECT country FROM e_country WHERE status='enable' ORDER BY country ASC");
while ($countryResult && ($country = mysqli_fetch_assoc($countryResult))) {
    $name = trim((string)$country['country']);
    if ($name !== '') $countries[] = $name;
}

$residencyStatuses = [];
$statusResult = mysqli_query($con, "SELECT residency_status FROM residency_status WHERE status='enable' ORDER BY residency_status ASC");
while ($statusResult && ($status = mysqli_fetch_assoc($statusResult))) {
    $name = trim((string)$status['residency_status']);
    if ($name !== '') $residencyStatuses[] = $name;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    foreach ($fieldNames as $field) {
        $values[$field] = trim((string)($_POST[$field] ?? ''));
    }

    $required = [
        'nri_type' => 'NRI type',
        'nri_citizenship' => 'citizenship',
        'nri_current_country' => 'current country',
        'nri_current_state' => 'current state or province',
        'nri_current_city' => 'current city',
        'nri_residency_status' => 'residency status',
        'nri_visa_type' => 'visa type',
        'nri_years_abroad' => 'years living abroad',
        'nri_overseas_mobile' => 'overseas mobile number',
        'nri_income_currency' => 'income currency',
        'nri_willing_to_relocate' => 'relocation preference',
        'nri_settlement_preference' => 'settlement preference',
        'nri_native_place' => 'native place in India',
        'nri_preferred_country' => 'preferred country after marriage'
    ];
    foreach ($required as $field => $label) {
        if ($values[$field] === '') $errors[] = 'Please select or enter '.$label.'.';
    }

    if ($values['nri_type'] !== '' && !in_array($values['nri_type'], $nriTypes, true)) {
        $errors[] = 'Please select a valid NRI type.';
    }
    if ($values['nri_visa_type'] !== '' && !in_array($values['nri_visa_type'], $visaTypes, true)) {
        $errors[] = 'Please select a valid visa type.';
    }
    if ($values['nri_visa_type'] !== '' && $values['nri_visa_type'] !== 'Not Applicable') {
        $expiry = DateTime::createFromFormat('Y-m-d', $values['nri_visa_expiry']);
        if (!$expiry || $expiry->format('Y-m-d') !== $values['nri_visa_expiry']) {
            $errors[] = 'Please enter a valid visa expiry date.';
        }
    } else {
        $values['nri_visa_expiry'] = '';
    }
    if ($values['nri_years_abroad'] !== '' && (!ctype_digit($values['nri_years_abroad']) || (int)$values['nri_years_abroad'] > 80)) {
        $errors[] = 'Years living abroad must be between 0 and 80.';
    }
    if ($values['nri_overseas_mobile'] !== '' && !preg_match('/^\+?[0-9][0-9\s-]{6,23}$/', $values['nri_overseas_mobile'])) {
        $errors[] = 'Please enter a valid overseas mobile number with country code.';
    }
    if ($values['nri_willing_to_relocate'] !== '' && !in_array($values['nri_willing_to_relocate'], $relocationOptions, true)) {
        $errors[] = 'Please select a valid relocation preference.';
    }
    if ($values['nri_settlement_preference'] !== '' && !in_array($values['nri_settlement_preference'], $settlementOptions, true)) {
        $errors[] = 'Please select a valid settlement preference.';
    }

    if (!$errors) {
        $_SESSION['nri_registration_data'] = $values;
        header('Location: step2');
        exit;
    }
}

$page_title = 'NRI Details - Manpasand Jodidar';
include('header3.php');
?>

<style>
.mvv-nri-page{min-height:70vh;padding:54px 0 72px;background:radial-gradient(circle at 90% 5%,rgba(186,147,80,.13),transparent 28%),#FFFDFB;}
.mvv-nri-container{width:min(980px,calc(100% - 32px));margin:0 auto;}
.mvv-nri-card{padding:34px;border:1px solid rgba(94,20,38,.14);border-radius:22px;background:#fff;box-shadow:0 20px 55px rgba(79,35,25,.11);}
.mvv-nri-head{display:flex;align-items:flex-start;gap:16px;margin-bottom:28px;padding-bottom:22px;border-bottom:1px solid #eadfd6;}
.mvv-nri-icon{display:flex;align-items:center;justify-content:center;flex:0 0 48px;width:48px;height:48px;border-radius:14px;background:#fff0e6;color:#C9556A;font-size:1.3rem;}
.mvv-nri-head h1{margin:0 0 5px;color:#5E1426;font-size:clamp(1.5rem,3vw,2rem);font-weight:800;}
.mvv-nri-head p{margin:0;color:#7a6860;font-size:.92rem;}
.mvv-nri-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px;}
.mvv-nri-field{min-width:0;}
.mvv-nri-field.full{grid-column:1/-1;}
.mvv-nri-field label{display:block;margin-bottom:7px;color:#4c3431;font-size:.87rem;font-weight:700;}
.mvv-nri-field label span{color:#b3261e;}
.mvv-nri-field input,.mvv-nri-field select{display:block;width:100%;height:48px;padding:0 13px;border:1px solid #d9cec5;border-radius:10px;background:#fff;color:#382a27;font-size:.92rem;outline:none;}
.mvv-nri-field input:focus,.mvv-nri-field select:focus{border-color:#BA9350;box-shadow:0 0 0 4px rgba(186,147,80,.13);}
.mvv-nri-help{margin-top:5px;color:#8b7a73;font-size:.76rem;}
.mvv-nri-errors{margin-bottom:22px;padding:14px 18px;border:1px solid #f0b8b3;border-radius:10px;background:#fff1f0;color:#9c2119;}
.mvv-nri-errors ul{margin:6px 0 0;padding-left:20px;}
.mvv-nri-actions{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:28px;padding-top:22px;border-top:1px solid #eadfd6;}
.mvv-nri-back{color:#5E1426;font-weight:700;text-decoration:none;}
.mvv-nri-submit{min-height:48px;padding:0 28px;border:0;border-radius:11px;background:linear-gradient(135deg,#BA9350,#C9556A);color:#fff;font-weight:800;box-shadow:0 10px 24px rgba(232,97,42,.23);}
@media(max-width:700px){.mvv-nri-page{padding:28px 0 46px}.mvv-nri-card{padding:22px 18px;border-radius:16px}.mvv-nri-grid{grid-template-columns:1fr}.mvv-nri-field.full{grid-column:auto}.mvv-nri-actions{align-items:stretch;flex-direction:column-reverse}.mvv-nri-submit{width:100%}.mvv-nri-back{text-align:center;padding:10px}}
</style>

<main class="mvv-nri-page">
  <div class="mvv-nri-container">
    <form method="post" class="mvv-nri-card" id="nriRegistrationForm">
      <div class="mvv-nri-head">
        <span class="mvv-nri-icon"><i class="fas fa-earth-americas"></i></span>
        <div>
          <h1>NRI Profile Details</h1>
          <p>Tell us about the candidate's overseas residence. Your regular matrimonial details will be collected next.</p>
        </div>
      </div>

      <?php if ($errors) { ?>
      <div class="mvv-nri-errors" role="alert">
        <strong>Please correct the following:</strong>
        <ul><?php foreach ($errors as $error) { ?><li><?php echo nri_h($error); ?></li><?php } ?></ul>
      </div>
      <?php } ?>

      <div class="mvv-nri-grid">
        <div class="mvv-nri-field">
          <label for="nri_type">NRI Type <span>*</span></label>
          <select name="nri_type" id="nri_type" required><option value="">Select NRI type</option><?php foreach ($nriTypes as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_type'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field">
          <label for="nri_citizenship">Citizenship <span>*</span></label>
          <select name="nri_citizenship" id="nri_citizenship" required><option value="">Select citizenship country</option><?php foreach ($countries as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_citizenship'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field">
          <label for="nri_current_country">Current Country <span>*</span></label>
          <select name="nri_current_country" id="nri_current_country" required><option value="">Select current country</option><?php foreach ($countries as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_current_country'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field">
          <label for="nri_residency_status">Residency Status <span>*</span></label>
          <select name="nri_residency_status" id="nri_residency_status" required><option value="">Select residency status</option><?php foreach ($residencyStatuses as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_residency_status'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field"><label for="nri_current_state">Current State / Province <span>*</span></label><input type="text" name="nri_current_state" id="nri_current_state" maxlength="100" required value="<?php echo nri_h($values['nri_current_state']); ?>"></div>
        <div class="mvv-nri-field"><label for="nri_current_city">Current City <span>*</span></label><input type="text" name="nri_current_city" id="nri_current_city" maxlength="100" required value="<?php echo nri_h($values['nri_current_city']); ?>"></div>
        <div class="mvv-nri-field">
          <label for="nri_visa_type">Visa Type <span>*</span></label>
          <select name="nri_visa_type" id="nri_visa_type" required><option value="">Select visa type</option><?php foreach ($visaTypes as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_visa_type'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field"><label for="nri_visa_expiry">Visa Expiry Date <span id="visaExpiryRequired">*</span></label><input type="date" name="nri_visa_expiry" id="nri_visa_expiry" value="<?php echo nri_h($values['nri_visa_expiry']); ?>"><div class="mvv-nri-help">Choose Not Applicable for citizens without a visa.</div></div>
        <div class="mvv-nri-field"><label for="nri_years_abroad">Years Living Abroad <span>*</span></label><input type="number" name="nri_years_abroad" id="nri_years_abroad" min="0" max="80" required value="<?php echo nri_h($values['nri_years_abroad']); ?>"></div>
        <div class="mvv-nri-field"><label for="nri_overseas_mobile">Overseas Mobile Number <span>*</span></label><input type="tel" name="nri_overseas_mobile" id="nri_overseas_mobile" maxlength="25" placeholder="e.g. +1 555 123 4567" required value="<?php echo nri_h($values['nri_overseas_mobile']); ?>"></div>
        <div class="mvv-nri-field">
          <label for="nri_income_currency">Income Currency <span>*</span></label>
          <select name="nri_income_currency" id="nri_income_currency" required><option value="">Select currency</option><?php foreach ($currencies as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_income_currency'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field">
          <label for="nri_willing_to_relocate">Willing to Relocate <span>*</span></label>
          <select name="nri_willing_to_relocate" id="nri_willing_to_relocate" required><option value="">Select preference</option><?php foreach ($relocationOptions as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_willing_to_relocate'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field">
          <label for="nri_settlement_preference">Settlement Preference <span>*</span></label>
          <select name="nri_settlement_preference" id="nri_settlement_preference" required><option value="">Select preference</option><?php foreach ($settlementOptions as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_settlement_preference'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
        <div class="mvv-nri-field"><label for="nri_native_place">Native Place in India <span>*</span></label><input type="text" name="nri_native_place" id="nri_native_place" maxlength="150" required value="<?php echo nri_h($values['nri_native_place']); ?>"></div>
        <div class="mvv-nri-field full">
          <label for="nri_preferred_country">Preferred Country After Marriage <span>*</span></label>
          <select name="nri_preferred_country" id="nri_preferred_country" required><option value="">Select preferred country</option><?php foreach ($countries as $option) { ?><option value="<?php echo nri_h($option); ?>" <?php echo $values['nri_preferred_country'] === $option ? 'selected' : ''; ?>><?php echo nri_h($option); ?></option><?php } ?></select>
        </div>
      </div>

      <div class="mvv-nri-actions">
        <a class="mvv-nri-back" href="signup"><i class="fas fa-arrow-left"></i> Back to signup</a>
        <button class="mvv-nri-submit" type="submit" name="submit"><span>Continue to Basic Information</span> <i class="fas fa-arrow-right"></i></button>
      </div>
    </form>
  </div>
</main>

<script>
(function(){
  var visaType=document.getElementById('nri_visa_type');
  var expiry=document.getElementById('nri_visa_expiry');
  var marker=document.getElementById('visaExpiryRequired');
  function updateVisaExpiry(){
    var required=visaType.value!==''&&visaType.value!=='Not Applicable';
    expiry.required=required;
    expiry.disabled=visaType.value==='Not Applicable';
    marker.style.display=required?'inline':'none';
    if(expiry.disabled) expiry.value='';
  }
  visaType.addEventListener('change',updateVisaExpiry);
  updateVisaExpiry();
})();
</script>
<?php include('footer3.php'); ?>
