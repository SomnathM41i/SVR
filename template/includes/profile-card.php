<?php
$waAge = '';
if (!empty($profile['dob'])) {
    $dobObj = date_create($profile['dob']);
    if ($dobObj) {
        $now = date_create('now');
        $diff = $now->diff($dobObj);
        $waAge = $diff->y . ' years';
    }
}
$waLoc = implode(', ', array_filter([$profile['city'] ?? '', $profile['taluka'] ?? '', $profile['district'] ?? '']));
$waLines = [];
$waLines[] = "\u{1F496} Check out this Matrimony Profile!";
$waLines[] = '';
$waLines[] = "\u{1F194} Profile ID: {$profile['id']}";
if (!empty($profile['name'])) $waLines[] = "\u{1F3C3} Name: {$profile['name']}";
if ($waAge) $waLines[] = "\u{1F382} Age: $waAge";
if (!empty($profile['height'])) $waLines[] = "\u{1F4CF} Height: {$profile['height']}";
if (!empty($profile['education'])) $waLines[] = "\u{1F393} Education: {$profile['education']}";
if (!empty($profile['occupation'])) $waLines[] = "\u{1F4BC} Occupation: {$profile['occupation']}";
if (!empty($waLoc)) $waLines[] = "\u{1F4CD} Location: $waLoc";
if (!empty($profile['caste'])) $waLines[] = "\u{1F3AD} Caste: {$profile['caste']}";
if (!empty($profile['status'])) $waLines[] = "\u{1F48D} Marital Status: " . ucfirst($profile['status']);
$waLines[] = '';
$waLines[] = "\u{1F517} View Full Profile:";
$waLines[] = 'public_profile?id=' . urlencode(base64_encode($profile['id'] ?? ''));
$waLines[] = '';
$waLines[] = "Find your perfect life partner today \u{2764}\u{FE0F}";
$waUrl = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLines));
?>
<article class="profile-card" data-city="<?= strtolower($profile['city']) ?>" data-caste="<?= strtolower($profile['caste']) ?>">
  <div class="profile-visual <?= $profile['gender'] ?>"><span class="profile-avatar" aria-hidden="true"><?= $profile['gender']==='groom'?'👨':'👩' ?></span><span class="verified">✓ Verified</span></div>
  <div class="profile-body"><div class="profile-head"><div><span class="eyebrow">Profile ID</span><h3><?= htmlspecialchars($profile['id']) ?> · <?= htmlspecialchars($profile['name']) ?></h3></div><button class="save" aria-label="Save profile">♡</button></div>
  <dl class="profile-details"><div><dt>Age / Height</dt><dd><?= htmlspecialchars($profile['dob']) ?> · <?= htmlspecialchars($profile['height']) ?></dd></div><div><dt>Education</dt><dd><?= htmlspecialchars($profile['education']) ?></dd></div><div><dt>Occupation</dt><dd><?= htmlspecialchars($profile['occupation']) ?></dd></div><div><dt>Work City</dt><dd><?= htmlspecialchars($profile['city']) ?></dd></div></dl>
  <div class="profile-foot"><span><?= htmlspecialchars($profile['caste']) ?></span><a class="wa-share-btn wa-share-btn-sm" href="<?= htmlspecialchars($waUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> Share</a><a href="#login">View Profile →</a></div></div>
</article>
