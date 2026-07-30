<?php
require_once('sys_dbconnection.php');
require_once('includes/annual_income.php');

function anonymizePublicName(string $name): string {
    $parts = preg_split('/\s+/u', trim($name), -1, PREG_SPLIT_NO_EMPTY);
    if (!$parts) {
        return 'Not specified';
    }
    $surname = array_pop($parts);
    if (!$parts) {
        return $surname;
    }
    return implode(' ', array_fill(0, count($parts), '*****')).' '.$surname;
}

function publicProfileValue($value, string $fallback = 'Not specified'): string {
    $value = trim((string)$value);
    return htmlspecialchars($value !== '' ? $value : $fallback, ENT_QUOTES, 'UTF-8');
}

function publicInfoRow(string $label, $value, string $fallback = 'Not specified'): void {
    echo '<div class="public-info-row"><span class="public-info-label">'
        .htmlspecialchars($label, ENT_QUOTES, 'UTF-8')
        .'</span><span class="public-info-value">'
        .publicProfileValue($value, $fallback)
        .'</span></div>';
}

$encodedId = (string)($_GET['id'] ?? '');
$profileId = base64_decode(rawurldecode($encodedId), true);
$profile = null;

if (
    $profileId !== false &&
    $profileId !== '' &&
    preg_match('/^[A-Za-z0-9_-]+$/', $profileId)
) {
    $statement = mysqli_prepare(
        $con,
        "SELECT * FROM register
         WHERE MatriID=?
           AND visibility<>'hidden'
           AND Status NOT IN ('Banned','InActive')
         LIMIT 1"
    );
    if ($statement) {
        mysqli_stmt_bind_param($statement, 's', $profileId);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $profile = mysqli_fetch_assoc($result) ?: null;
        mysqli_stmt_close($statement);
    }
}

if (!$profile) {
    http_response_code(404);
}

$heightMap = [
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

$maskedName = $profile ? anonymizePublicName((string)($profile['Name'] ?? '')) : 'Profile Not Found';
$page_title = $profile ? $maskedName.' - Shivraj Maratha' : 'Profile Not Found - Shivraj Maratha';
$backGender = $profile['Gender'] ?? 'Male';
$backStatus = in_array($profile['Maritalstatus'] ?? '', ['Unmarried', 'Divorced'], true)
    ? $profile['Maritalstatus']
    : 'Unmarried';
$backQuery = ['gender' => $backGender];
if (($profile['profile_location_type'] ?? '') === 'NRI') {
    $backQuery['profile_type'] = 'NRI';
} else {
    $backQuery['marital_status'] = $backStatus;
}
$backUrl = 'public_profiles?'.http_build_query($backQuery);

$photoOG = 'images/nophoto.jpg';
if ($profile) {
    $ogPv = $profile['photo_visibility'] ?? '';
    $ogPa = ($profile['Photo1Approve'] ?? '') === 'Yes';
    $ogP1 = !empty($profile['Photo1']) && $profile['Photo1'] !== 'nophoto.jpg';
    if ($ogP1 && $ogPa) {
        if ($ogPv === 'allphoto') {
            $photoOG = 'photoprocess.php?image='.rawurlencode('gallary/'.$profile['Photo1']).'&square=600';
        } elseif ($ogPv === 'paidphoto' && ($_SESSION['Status'] ?? '') === 'Paid') {
            $photoOG = 'photoprocess.php?image='.rawurlencode('gallary/'.$profile['Photo1']).'&square=600';
        }
    }
    $ogBaseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
    $page_og_image = ($photoOG !== 'images/nophoto.jpg') ? $ogBaseUrl . $photoOG : '';
    $page_og_title = $maskedName . ' - Shivraj Maratha';
    $page_og_description = 'View ' . $maskedName . '\'s matrimony profile on Shivraj Maratha.';
}
include('header3.php');
?>

<style>
.public-profile-page{min-height:65vh;padding-bottom:72px;background:linear-gradient(180deg,#fff9f2,#fff 420px)}
.public-profile-hero{padding:54px 0;background:linear-gradient(135deg,#6b1a1a,#8b2520);color:#fff}
.public-profile-hero-inner{display:flex;align-items:center;justify-content:space-between;gap:24px}
.public-profile-hero .eyebrow{display:block;margin-bottom:8px;color:#f0c04a;font-size:.76rem;font-weight:800;letter-spacing:.17em;text-transform:uppercase}
.public-profile-hero h1{margin:0 0 7px;color:#fff;font-family:var(--mvv-display);font-size:clamp(2rem,5vw,3.3rem)}
.public-profile-hero p{margin:0;color:rgba(255,255,255,.75)}
.public-profile-back{display:inline-flex;align-items:center;gap:8px;padding:10px 15px;border:1px solid rgba(255,255,255,.28);border-radius:999px;color:#fff;font-size:.85rem;font-weight:700;text-decoration:none}
.public-profile-back:hover{background:#fff;color:var(--mvv-maroon)}
.public-profile-content{padding:42px 0}
.public-profile-overview{display:grid;grid-template-columns:320px minmax(0,1fr);gap:24px;align-items:start;margin-bottom:24px}
.public-profile-photo-card,.public-profile-summary,.public-detail-card,.public-profile-locked{border:1px solid var(--mvv-line);border-radius:16px;background:#fff;box-shadow:0 9px 30px rgba(79,35,25,.07)}
.public-profile-photo-card{overflow:hidden;text-align:center}
.public-profile-photo{width:100%;height:380px;object-fit:cover;background:var(--mvv-cream)}
.public-profile-photo-copy{padding:18px}
.public-profile-photo-copy h2{margin:0 0 6px;color:var(--mvv-maroon);font-family:var(--mvv-display);font-size:1.35rem}
.public-profile-photo-copy p{margin:0;color:var(--mvv-muted);font-size:.88rem}
.public-profile-summary{padding:24px}
.public-profile-summary h2{margin:0 0 8px;color:var(--mvv-maroon);font-family:var(--mvv-display);font-size:1.55rem}
.public-profile-summary-note{margin:0 0 20px;color:var(--mvv-muted);font-size:.9rem}
.public-summary-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
.public-summary-item{padding:13px;border-radius:10px;background:var(--mvv-cream)}
.public-summary-item span{display:block;margin-bottom:3px;color:var(--mvv-muted);font-size:.72rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase}
.public-summary-item strong{color:var(--mvv-ink);font-size:.94rem}
.public-detail-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:24px}
.public-detail-card{overflow:hidden}
.public-detail-card.full-width{grid-column:1/-1}
.public-detail-title{display:flex;align-items:center;gap:10px;margin:0;padding:15px 20px;background:linear-gradient(135deg,var(--mvv-maroon),#8b2520);color:#fff;font-family:var(--mvv-display);font-size:1.08rem}
.public-detail-title i{color:var(--mvv-gold-light)}
.public-detail-body{padding:7px 20px 14px}
.public-info-row{display:grid;grid-template-columns:minmax(120px,38%) minmax(0,1fr);gap:15px;padding:11px 0;border-bottom:1px solid var(--mvv-line);font-size:.87rem}
.public-info-row:last-child{border-bottom:0}
.public-info-label{color:var(--mvv-muted);font-weight:700}
.public-info-value{color:var(--mvv-ink);overflow-wrap:anywhere}
.public-about{padding:18px 20px;color:var(--mvv-ink);font-size:.92rem;line-height:1.75;white-space:pre-line}
.public-profile-locked{margin-top:24px;padding:25px;text-align:center}
.public-profile-locked i{display:inline-flex;align-items:center;justify-content:center;width:52px;height:52px;margin-bottom:10px;border-radius:50%;background:var(--mvv-cream);color:var(--mvv-maroon);font-size:1.3rem}
.public-profile-locked h2{margin:0 0 7px;color:var(--mvv-maroon);font-family:var(--mvv-display);font-size:1.35rem}
.public-profile-locked p{margin:0 0 16px;color:var(--mvv-muted)}
.public-profile-actions{display:flex;justify-content:center;gap:10px;flex-wrap:wrap}
.public-profile-actions a{padding:10px 20px;border-radius:8px;background:var(--mvv-maroon);color:#fff;font-weight:700;text-decoration:none}
.public-profile-actions a.secondary{border:1px solid var(--mvv-line);background:#fff;color:var(--mvv-maroon)}
.public-not-found{padding:80px 20px;text-align:center}
.public-not-found i{color:var(--mvv-gold);font-size:3rem}
@media(max-width:900px){.public-profile-overview{grid-template-columns:1fr}.public-profile-photo-card{max-width:430px;width:100%;margin:auto}.public-detail-grid{grid-template-columns:1fr}.public-detail-card.full-width{grid-column:auto}}
@media(max-width:600px){.public-profile-hero-inner{align-items:flex-start;flex-direction:column}.public-summary-grid{grid-template-columns:1fr}.public-info-row{grid-template-columns:1fr;gap:3px}.public-profile-photo{height:360px}}
</style>

<main class="public-profile-page">
<?php if (!$profile) { ?>
  <section class="public-not-found">
    <div class="container">
      <i class="fas fa-user-slash"></i>
      <h1>Profile Not Found</h1>
      <p>This profile is unavailable or is no longer publicly visible.</p>
      <a class="public-profile-back" style="background:var(--mvv-maroon)" href="public_profiles">Browse Profiles</a>
    </div>
  </section>
<?php } else {
    $photo = 'images/nophoto.jpg';
    $pv = $profile['photo_visibility'] ?? '';
    $pa = ($profile['Photo1Approve'] ?? '') === 'Yes';
    $p1 = !empty($profile['Photo1']) && $profile['Photo1'] !== 'nophoto.jpg';
    if ($p1 && $pa) {
        if ($pv === 'allphoto') {
            $photo = 'photoprocess.php?image='.rawurlencode('gallary/'.$profile['Photo1']).'&square=600';
        } elseif ($pv === 'paidphoto' && ($_SESSION['Status'] ?? '') === 'Paid') {
            $photo = 'photoprocess.php?image='.rawurlencode('gallary/'.$profile['Photo1']).'&square=600';
        }
    }
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
    $profileUrl = $baseUrl . 'public_profile?id=' . urlencode(base64_encode($profile['MatriID']));
    $profileHeight = $heightMap[(int)$profile['Height']] ?? '';
    $profileLocation = implode(', ', array_filter([$profile['City'] ?? '', $profile['Taluka'] ?? '', $profile['Dist'] ?? '']));
    $waImg = ($photo !== 'images/nophoto.jpg') ? $baseUrl . $photo : '';
    $waLines = [];
    $waLines[] = $profileUrl;
    $waLines[] = '';
    $waLines[] = "\u{1F496} Check out this Matrimony Profile!";
    $waLines[] = "\u{1F194} Profile ID: {$profile['MatriID']}";
    $waLines[] = "\u{1F3C3} Name: $maskedName";
    $waLines[] = "\u{1F382} Age: " . ($profile['Age'] ?? '') . ' years';
    if (!empty($profileHeight)) $waLines[] = "\u{1F4CF} Height: $profileHeight";
    if (!empty($profile['Education'])) $waLines[] = "\u{1F393} Education: {$profile['Education']}";
    if (!empty($profile['Occupation'])) $waLines[] = "\u{1F4BC} Occupation: {$profile['Occupation']}";
    if (!empty($profile['Religion'])) $waLines[] = "\u{1F54A} Religion: {$profile['Religion']}";
    if (!empty($profileLocation)) $waLines[] = "\u{1F4CD} Location: $profileLocation";
    if (!empty($profile['Maritalstatus'])) $waLines[] = "\u{1F48D} Marital Status: {$profile['Maritalstatus']}";
    $waLines[] = '';
    $waLines[] = "Find your perfect life partner today \u{2764}\u{FE0F}";
    $waUrl = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLines));
?>
  <section class="public-profile-hero">
    <div class="container public-profile-hero-inner">
      <div>
        <span class="eyebrow">Public Profile</span>
        <h1><?php echo publicProfileValue($maskedName); ?></h1>
        <p><?php echo publicProfileValue($profile['MatriID']); ?> · <?php echo publicProfileValue($profile['Age']); ?> years · <?php echo publicProfileValue($profile['City']); ?></p>
      </div>
      <a class="public-profile-back" href="<?php echo htmlspecialchars($backUrl); ?>"><i class="fas fa-arrow-left"></i> Back to Profiles</a>
    </div>
  </section>

  <section class="public-profile-content">
    <div class="container">
      <div class="public-profile-overview">
        <article class="public-profile-photo-card">
          <img class="public-profile-photo" src="<?php echo htmlspecialchars($photo); ?>" alt="Profile photo" onerror="this.onerror=null;this.src='images/nophoto.jpg';">
          <div class="public-profile-photo-copy">
            <h2><?php echo publicProfileValue($maskedName); ?></h2>
            <p><?php echo publicProfileValue($profile['MatriID']); ?></p>
            <a class="wa-share-btn" href="<?php echo htmlspecialchars($waUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" style="width:100%;justify-content:center;margin-top:10px"><i class="fab fa-whatsapp"></i> Share on WhatsApp</a>
          </div>
        </article>

        <article class="public-profile-summary">
          <h2>Profile Overview</h2>
          <p class="public-profile-summary-note">Names are partially hidden for member privacy. Contact details are available only after login.</p>
          <div class="public-summary-grid">
            <div class="public-summary-item"><span>Age</span><strong><?php echo publicProfileValue($profile['Age']); ?> years</strong></div>
            <div class="public-summary-item"><span>Height</span><strong><?php echo publicProfileValue($heightMap[(int)$profile['Height']] ?? ''); ?></strong></div>
            <div class="public-summary-item"><span>Education</span><strong><?php echo publicProfileValue($profile['Education']); ?></strong></div>
            <div class="public-summary-item"><span>Occupation</span><strong><?php echo publicProfileValue($profile['Occupation']); ?></strong></div>
            <div class="public-summary-item"><span>Religion</span><strong><?php echo publicProfileValue($profile['Religion']); ?></strong></div>
            <div class="public-summary-item"><span>Location</span><strong><?php echo publicProfileValue(implode(', ', array_filter([$profile['City'] ?? '', $profile['Taluka'] ?? '', $profile['Dist'] ?? '']))); ?></strong></div>
          </div>
        </article>
      </div>

      <div class="public-detail-grid">
        <?php if (($profile['profile_approve'] ?? '') === 'Yes' && trim((string)($profile['aboutus'] ?? '')) !== '') { ?>
        <article class="public-detail-card full-width">
          <h2 class="public-detail-title"><i class="fas fa-user"></i> About Profile</h2>
          <div class="public-about"><?php echo nl2br(publicProfileValue($profile['aboutus'])); ?></div>
        </article>
        <?php } ?>

        <article class="public-detail-card">
          <h2 class="public-detail-title"><i class="fas fa-id-card"></i> Basic &amp; Lifestyle</h2>
          <div class="public-detail-body">
            <?php
            publicInfoRow('Name', $maskedName);
            publicInfoRow('Matrimony ID', $profile['MatriID']);
            publicInfoRow('Gender', $profile['Gender']);
            publicInfoRow('Age', ($profile['Age'] ?? '').' years');
            publicInfoRow('Marital Status', $profile['Maritalstatus']);
            publicInfoRow('Religion', $profile['Religion']);
            publicInfoRow('Caste / Subcaste', trim(($profile['Caste'] ?? '').' / '.($profile['Subcaste'] ?? ''), ' /'));
            publicInfoRow('Mother Tongue', $profile['mother_tounge']);
            publicInfoRow('Height / Weight', trim(($heightMap[(int)$profile['Height']] ?? '').' / '.($profile['Weight'] ?? ''), ' /'));
            publicInfoRow('Body Type', $profile['Bodytype']);
            publicInfoRow('Complexion', $profile['Complexion']);
            publicInfoRow('Diet / Drink', trim(($profile['Diet'] ?? '').' / '.($profile['Drink'] ?? ''), ' /'));
            publicInfoRow('Blood Group', $profile['BloodGroup']);
            publicInfoRow('Spectacles', $profile['Spectacles']);
            publicInfoRow('Special Cases', $profile['spe_cases']);
            ?>
          </div>
        </article>

        <?php if (($profile['profile_location_type'] ?? '') === 'NRI') { ?>
        <article class="public-detail-card">
          <h2 class="public-detail-title"><i class="fas fa-earth-americas"></i> NRI Details</h2>
          <div class="public-detail-body">
            <?php
            publicInfoRow('NRI Type', $profile['nri_type']);
            publicInfoRow('Citizenship', $profile['nri_citizenship']);
            publicInfoRow('Current Country', $profile['nri_current_country']);
            publicInfoRow('Current State / Province', $profile['nri_current_state']);
            publicInfoRow('Current City', $profile['nri_current_city']);
            publicInfoRow('Residency Status', $profile['nri_residency_status']);
            publicInfoRow('Visa Type', $profile['nri_visa_type']);
            publicInfoRow('Years Abroad', $profile['nri_years_abroad']);
            publicInfoRow('Income Currency', $profile['nri_income_currency']);
            publicInfoRow('Willing to Relocate', $profile['nri_willing_to_relocate']);
            publicInfoRow('Settlement Preference', $profile['nri_settlement_preference']);
            publicInfoRow('Preferred Country', $profile['nri_preferred_country']);
            ?>
          </div>
        </article>
        <?php } ?>

        <article class="public-detail-card">
          <h2 class="public-detail-title"><i class="fas fa-graduation-cap"></i> Education &amp; Career</h2>
          <div class="public-detail-body">
            <?php
            publicInfoRow('Education', $profile['Education']);
            publicInfoRow('Education Details', $profile['EducationDetails']);
            publicInfoRow('Occupation', $profile['Occupation']);
            publicInfoRow('Occupation Details', $profile['occu_details']);
            publicInfoRow('Employed In', $profile['Employedin']);
            publicInfoRow('Annual Income', annual_income_format($profile['Annualincome'] ?? ''));
            publicInfoRow('Working Hours', $profile['working_hours']);
            publicInfoRow('Working Location', $profile['workinglocation']);
            publicInfoRow('IIT / IIM / NIT', $profile['iit']);
            publicInfoRow('Institute', $profile['instu']);
            ?>
          </div>
        </article>

        <article class="public-detail-card">
          <h2 class="public-detail-title"><i class="fas fa-users"></i> Family Details</h2>
          <div class="public-detail-body">
            <?php
            publicInfoRow('Family Values', $profile['Familyvalues']);
            publicInfoRow('Family Status', $profile['FamilyStatus']);
            publicInfoRow('Family Type', $profile['FamilyType']);
            publicInfoRow('Brothers', ($profile['noofbrothers'] ?: '0').' (Married: '.($profile['nbm'] ?: '0').')');
            publicInfoRow('Sisters', ($profile['noofsisters'] ?: '0').' (Married: '.($profile['nsm'] ?: '0').')');
            publicInfoRow('Father', anonymizePublicName((string)($profile['Fathername'] ?? '')));
            publicInfoRow("Father's Occupation", $profile['Fathersoccupation']);
            publicInfoRow('Mother', anonymizePublicName((string)($profile['Mothersname'] ?? '')));
            publicInfoRow("Mother's Occupation", $profile['Mothersoccupation']);
            publicInfoRow('Parents Stay', $profile['parents_stay']);
            publicInfoRow('About Family', $profile['FamilyDetails']);
            ?>
          </div>
        </article>

        <article class="public-detail-card">
          <h2 class="public-detail-title"><i class="fas fa-star-and-crescent"></i> Horoscope Details</h2>
          <div class="public-detail-body">
            <?php
            publicInfoRow('Moon Sign', $profile['Moonsign']);
            publicInfoRow('Star', $profile['Star']);
            publicInfoRow('Gotra', $profile['Gothram']);
            publicInfoRow('Charan', $profile['charan']);
            publicInfoRow('Gan', $profile['Gan']);
            publicInfoRow('Nadi', $profile['nadi']);
            publicInfoRow('Devak', $profile['devak']);
            publicInfoRow('Manglik', $profile['Manglik']);
            publicInfoRow('Horoscope Match', $profile['Horosmatch']);
            publicInfoRow('Time of Birth', $profile['TOB']);
            publicInfoRow('Place of Birth', $profile['POB']);
            publicInfoRow('Country of Birth', $profile['POC']);
            ?>
          </div>
        </article>

        <article class="public-detail-card full-width">
          <h2 class="public-detail-title"><i class="fas fa-heart"></i> Partner Preferences</h2>
          <div class="public-detail-body" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));column-gap:28px">
            <?php
            publicInfoRow('Marital Status', $profile['Looking']);
            publicInfoRow('Preferred Age', trim(($profile['PE_FromAge'] ?? '').' - '.($profile['PE_ToAge'] ?? ''), ' -'));
            publicInfoRow('Preferred Height', trim(($heightMap[(int)($profile['PE_from_Height'] ?? 0)] ?? '').' - '.($heightMap[(int)($profile['PE_to_Height'] ?? 0)] ?? ''), ' -'));
            publicInfoRow('Religion', $profile['PE_Religion']);
            publicInfoRow('Caste', $profile['PE_Caste']);
            publicInfoRow('Education', $profile['PE_Education']);
            publicInfoRow('Occupation', $profile['PE_Occupation']);
            publicInfoRow('Country', $profile['PE_Countrylivingin']);
            publicInfoRow('State', $profile['PE_State']);
            publicInfoRow('District', $profile['PE_District']);
            publicInfoRow('Taluka', $profile['PE_Taluka'] ?? '');
            publicInfoRow('City', $profile['PE_City']);
            publicInfoRow('Expectations', $profile['PartnerExpectations']);
            ?>
          </div>
        </article>
      </div>

      <aside class="public-profile-locked">
        <i class="fas fa-lock"></i>
        <h2>Contact details are protected</h2>
        <p>Log in or register to access member contact options and connect securely.</p>
        <div class="public-profile-actions">
          <a href="login">Login</a>
          <a class="secondary" href="signup">Register</a>
        </div>
      </aside>
    </div>
  </section>
<?php } ?>
</main>

<?php include('footer3.php'); ?>
