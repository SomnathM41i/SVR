<article class="profile-card" data-city="<?= strtolower($profile['city']) ?>" data-caste="<?= strtolower($profile['caste']) ?>">
  <div class="profile-visual <?= $profile['gender'] ?>"><span class="profile-avatar" aria-hidden="true"><?= $profile['gender']==='groom'?'👨':'👩' ?></span><span class="verified">✓ Verified</span></div>
  <div class="profile-body"><div class="profile-head"><div><span class="eyebrow">Profile ID</span><h3><?= htmlspecialchars($profile['id']) ?> · <?= htmlspecialchars($profile['name']) ?></h3></div><button class="save" aria-label="Save profile">♡</button></div>
  <dl class="profile-details"><div><dt>Age / Height</dt><dd><?= htmlspecialchars($profile['dob']) ?> · <?= htmlspecialchars($profile['height']) ?></dd></div><div><dt>Education</dt><dd><?= htmlspecialchars($profile['education']) ?></dd></div><div><dt>Occupation</dt><dd><?= htmlspecialchars($profile['occupation']) ?></dd></div><div><dt>Work City</dt><dd><?= htmlspecialchars($profile['city']) ?></dd></div></dl>
  <div class="profile-foot"><span><?= htmlspecialchars($profile['caste']) ?></span><a href="#login">View Profile →</a></div></div>
</article>
