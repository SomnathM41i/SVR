<?php
ob_start();
require_once('includes/bootstrap.php');
include_once('memprotect.php');
include_once('siteconfig.php');

$matriid = $_SESSION['MatriID'] ?? '';
$questions = [
  'out' => ['column' => 'que1', 'title' => 'How often do you go out?', 'type' => 'radio', 'options' => [
    '1' => 'Twice a week or more', '2' => 'Once a week', '3' => 'Twice a month', '4' => 'Once a month or less']],
  'clothes' => ['column' => 'que2', 'title' => 'How would you describe your clothing preferences?', 'type' => 'radio', 'options' => [
    '5' => 'Only foreign or premium brands', '6' => 'Mostly foreign brands', '7' => 'Mostly local brands', '8' => 'Only local brands']],
  'free' => ['column' => 'que3', 'title' => 'How do you spend your free time?', 'type' => 'checkbox', 'options' => [
    '9' => 'Meditation or spiritual activities', '10' => 'Time with family', '11' => 'Hobbies or recreational activities', '12' => 'Time with friends']],
  'parlour' => ['column' => 'que4', 'title' => 'How often do you visit a salon or beauty parlour?', 'type' => 'radio', 'options' => [
    '13' => 'Once a week', '14' => 'Twice a month', '15' => 'Once a month', '16' => 'Occasionally']],
  'pub' => ['column' => 'que5', 'title' => 'How often do you go drinking or visit a pub?', 'type' => 'radio', 'options' => [
    '17' => 'Once a week or more', '18' => 'Once or twice a month', '19' => 'Rarely', '20' => 'Never']],
  'date_choice' => ['column' => 'que6', 'title' => 'What would you choose for a romantic date?', 'type' => 'radio', 'options' => [
    '21' => 'Candlelight dinner at home', '22' => 'Lunch or dinner at a deluxe hotel', '23' => 'A long drive', '24' => 'Tea and snacks at a street vendor']],
  'social' => ['column' => 'que7', 'title' => 'Which social platforms do you use most?', 'type' => 'checkbox', 'options' => [
    '25' => 'Facebook', '26' => 'WhatsApp', '27' => 'Instagram', '28' => 'X (Twitter)']],
  'shopping' => ['column' => 'que8', 'title' => 'Do you like shopping?', 'type' => 'radio', 'options' => [
    '29' => 'Yes', '30' => 'Sometimes', '31' => 'Only when needed', '32' => 'No']],
  'traveling' => ['column' => 'que9', 'title' => 'What do you prefer while travelling?', 'type' => 'radio', 'options' => [
    '33' => 'Flexible about place and time', '34' => 'Trekking and adventure', '35' => 'Peaceful places close to nature', '36' => 'I do not like travelling']],
  'personality' => ['column' => 'que10', 'title' => 'Which spending style describes you?', 'type' => 'radio', 'options' => [
    '37' => 'I enjoy spending on luxury products', '38' => 'I sometimes enjoy luxury products', '39' => 'I spend for comfort and convenience', '40' => 'I prefer economical choices']]
];

$existing = [];
$existingQuery = mysqli_prepare($con, 'SELECT * FROM compatibility WHERE MatriID = ? LIMIT 1');
mysqli_stmt_bind_param($existingQuery, 's', $matriid);
mysqli_stmt_execute($existingQuery);
$existingResult = mysqli_stmt_get_result($existingQuery);
$existing = mysqli_fetch_assoc($existingResult) ?: [];
mysqli_stmt_close($existingQuery);

$errors = [];
$submitted = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  if (!isset($_POST['csrf_token'], $_SESSION['compatibility_csrf']) || !hash_equals($_SESSION['compatibility_csrf'], (string)$_POST['csrf_token'])) {
    $errors[] = 'Your session expired. Please refresh the page and try again.';
  }

  foreach ($questions as $name => $question) {
    $allowed = array_keys($question['options']);
    if ($question['type'] === 'checkbox') {
      $values = isset($_POST[$name]) && is_array($_POST[$name]) ? $_POST[$name] : [];
      $values = array_values(array_unique(array_intersect($allowed, array_map('strval', $values))));
      $submitted[$question['column']] = implode(',', $values);
      if (!$values) $errors[] = 'Please answer: '.$question['title'];
    } else {
      $value = isset($_POST[$name]) ? (string)$_POST[$name] : '';
      $submitted[$question['column']] = in_array($value, $allowed, true) ? $value : '';
      if ($submitted[$question['column']] === '') $errors[] = 'Please answer: '.$question['title'];
    }
  }

  if (!$errors) {
    $changed = !$existing;
    foreach ($questions as $question) {
      $column = $question['column'];
      if (($existing[$column] ?? '') !== $submitted[$column]) $changed = true;
    }
    if (!$changed) {
      header('Location: compability?msg=unchanged');
      exit;
    }

    $dateUpdated = date('d-m-Y');
    $que1=$submitted['que1']; $que2=$submitted['que2']; $que3=$submitted['que3']; $que4=$submitted['que4']; $que5=$submitted['que5'];
    $que6=$submitted['que6']; $que7=$submitted['que7']; $que8=$submitted['que8']; $que9=$submitted['que9']; $que10=$submitted['que10'];
    if ($existing) {
      $statement = mysqli_prepare($con, 'UPDATE compatibility SET que1=?,que2=?,que3=?,que4=?,que5=?,que6=?,que7=?,que8=?,que9=?,que10=?,date=? WHERE MatriID=?');
      mysqli_stmt_bind_param($statement, 'ssssssssssss', $que1, $que2, $que3, $que4, $que5, $que6, $que7, $que8, $que9, $que10, $dateUpdated, $matriid);
    } else {
      $statement = mysqli_prepare($con, 'INSERT INTO compatibility (que1,que2,que3,que4,que5,que6,que7,que8,que9,que10,date,MatriID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
      mysqli_stmt_bind_param($statement, 'ssssssssssss', $que1, $que2, $que3, $que4, $que5, $que6, $que7, $que8, $que9, $que10, $dateUpdated, $matriid);
    }
    if (mysqli_stmt_execute($statement)) {
      mysqli_stmt_close($statement);
      header('Location: compability?msg=success');
      exit;
    }
    $errors[] = 'We could not save your answers. Please try again.';
    mysqli_stmt_close($statement);
  }
}

if (empty($_SESSION['compatibility_csrf'])) $_SESSION['compatibility_csrf'] = bin2hex(random_bytes(32));
$formValues = $submitted ?: $existing;
$answeredCount = 0;
foreach ($questions as $question) if (!empty($formValues[$question['column']])) $answeredCount++;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Compatibility - Manpasand Jodidar</title>
  <link rel="icon" type="image/png" sizes="32x32" href="branding/favicons/icon-32.png">
  <link rel="stylesheet" href="css3/Style.css">
  <link rel="stylesheet" href="css3/mvv-premium.css">
  <style>
    .compat-shell{max-width:980px;margin:0 auto}.compat-intro{display:flex;align-items:center;justify-content:space-between;gap:24px;padding:22px 24px;margin-bottom:22px;border:1px solid var(--mvv-border);background:#fff;box-shadow:0 10px 28px rgba(58,42,34,.07)}
    .compat-intro h2{margin:0 0 5px;color:var(--mvv-maroon);font-size:1.25rem}.compat-intro p{margin:0;color:var(--mvv-muted);font-size:.9rem}.compat-progress{min-width:150px;text-align:right}.compat-progress strong{display:block;color:var(--mvv-saffron);font-size:1.25rem}.compat-progress-bar{height:7px;margin-top:7px;overflow:hidden;border-radius:20px;background:#eee}.compat-progress-bar span{display:block;height:100%;background:linear-gradient(90deg,var(--mvv-saffron),var(--mvv-gold));transition:width .2s}
    .compat-alert{padding:13px 16px;margin-bottom:18px;border-radius:8px;font-size:.9rem}.compat-alert.success{color:#285d35;border:1px solid #a9d7b5;background:#edf9f0}.compat-alert.info{color:var(--mvv-maroon);border:1px solid rgba(106,27,27,.2);background:rgba(106,27,27,.06)}.compat-alert.error{color:#8b1e1e;border:1px solid #e5aaaa;background:#fff0f0}.compat-alert ul{margin:7px 0 0;padding-left:20px}
    .compat-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.compat-question{min-width:0;padding:22px;border:1px solid var(--mvv-border);border-radius:10px;background:#fff;box-shadow:0 7px 20px rgba(58,42,34,.05)}.compat-question h3{display:flex;align-items:flex-start;gap:10px;margin:0 0 16px;color:var(--mvv-maroon);font-size:1rem;line-height:1.45}.compat-number{display:inline-flex;align-items:center;justify-content:center;flex:0 0 27px;height:27px;border-radius:50%;background:#fff0e0;color:var(--mvv-saffron);font-size:.78rem}.compat-required{color:#c6382d}
    .compat-options{display:grid;gap:9px}.compat-option{position:relative;display:flex!important;align-items:center;gap:10px;margin:0!important;padding:11px 12px;border:1px solid #eadfd6;border-radius:8px;background:#fffaf6;color:var(--mvv-text)!important;font-size:.88rem!important;font-weight:500!important;letter-spacing:0!important;line-height:1.35;text-transform:none!important;cursor:pointer;transition:.15s}.compat-option:hover{border-color:var(--mvv-gold);background:#fff5e9}.compat-option:has(input:checked){border-color:var(--mvv-saffron);background:#fff0e0;color:var(--mvv-maroon)!important}.compat-option input{width:18px!important;min-height:18px!important;height:18px;margin:0;padding:0;accent-color:var(--mvv-saffron)}
    .compat-actions{position:sticky;bottom:0;z-index:5;display:flex;align-items:center;justify-content:space-between;gap:15px;margin-top:22px;padding:16px 20px;border:1px solid var(--mvv-border);background:rgba(255,255,255,.96);box-shadow:0 -8px 28px rgba(58,42,34,.08);backdrop-filter:blur(12px)}.compat-actions span{color:var(--mvv-muted);font-size:.86rem}
    @media(max-width:760px){.compat-grid{grid-template-columns:1fr}.compat-intro{align-items:flex-start;flex-direction:column}.compat-progress{width:100%;text-align:left}.compat-actions{align-items:stretch;flex-direction:column}.compat-actions .mvv-btn{width:100%}}
  </style>
</head>
<body>
<?php include('header.php'); ?>
<main class="mvv-page">
  <section class="mvv-page-hero"><div class="mvv-container"><div class="mvv-eyebrow">Profile</div><h1>My Compatibility</h1><p>Tell us about your lifestyle and preferences to improve your matches.</p><nav class="mvv-breadcrumb" aria-label="breadcrumb"><a href="index_dashboard">Dashboard</a><span>Compatibility</span></nav><div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div></div></section>
  <section class="mvv-section"><div class="mvv-container"><div class="compat-shell">
    <?php if (($_GET['msg'] ?? '') === 'success') { ?><div class="compat-alert success" role="status">Your compatibility preferences were saved successfully.</div><?php } ?>
    <?php if (($_GET['msg'] ?? '') === 'unchanged') { ?><div class="compat-alert info" role="status">No changes were detected. Your existing preferences are already saved.</div><?php } ?>
    <?php if ($errors) { ?><div class="compat-alert error" role="alert"><strong>Please complete the form.</strong><ul><?php foreach ($errors as $error) { ?><li><?php echo htmlspecialchars($error); ?></li><?php } ?></ul></div><?php } ?>
    <div class="compat-intro"><div><h2>Lifestyle Compatibility</h2><p>Answer all 10 questions. For checkbox questions, you may select more than one answer.</p></div><div class="compat-progress"><strong><span id="answeredCount"><?php echo $answeredCount; ?></span>/10 answered</strong><div class="compat-progress-bar"><span id="progressBar" style="width:<?php echo $answeredCount * 10; ?>%"></span></div></div></div>
    <form method="post" action="compability" id="compatibilityForm">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['compatibility_csrf']); ?>">
      <div class="compat-grid">
      <?php $number=0; foreach ($questions as $name => $question) { $number++; $savedValues = array_filter(explode(',', (string)($formValues[$question['column']] ?? ''))); ?>
        <fieldset class="compat-question" data-question>
          <h3><span class="compat-number"><?php echo $number; ?></span><span><?php echo htmlspecialchars($question['title']); ?> <span class="compat-required">*</span></span></h3>
          <div class="compat-options">
          <?php foreach ($question['options'] as $value => $label) { $checked = in_array((string)$value, $savedValues, true); ?>
            <label class="compat-option"><input type="<?php echo $question['type']; ?>" name="<?php echo $name.($question['type']==='checkbox'?'[]':''); ?>" value="<?php echo $value; ?>" <?php echo $checked?'checked':''; ?> <?php echo $question['type']==='radio'?'required':''; ?>><span><?php echo htmlspecialchars($label); ?></span></label>
          <?php } ?>
          </div>
        </fieldset>
      <?php } ?>
      </div>
      <div class="compat-actions"><span>All questions are required for an accurate compatibility score.</span><button class="mvv-btn mvv-btn-primary" type="submit" name="submit" value="1">Save Compatibility</button></div>
    </form>
  </div></div></section>
</main>
<?php include('footer3.php'); ?>
<script>
(function(){
  var form=document.getElementById('compatibilityForm'), count=document.getElementById('answeredCount'), bar=document.getElementById('progressBar');
  function updateProgress(){var answered=0;form.querySelectorAll('[data-question]').forEach(function(q){if(q.querySelector('input:checked'))answered++;});count.textContent=answered;bar.style.width=(answered*10)+'%';}
  form.addEventListener('change',updateProgress);
  form.addEventListener('submit',function(e){var missing=[];form.querySelectorAll('[data-question]').forEach(function(q){if(!q.querySelector('input:checked'))missing.push(q);});if(missing.length){e.preventDefault();missing[0].scrollIntoView({behavior:'smooth',block:'center'});missing.forEach(function(q){q.style.borderColor='#c6382d';});}else{var button=form.querySelector('button[type="submit"]');button.disabled=true;button.textContent='Saving...';}});
  updateProgress();
})();
</script>
</body>
</html>
