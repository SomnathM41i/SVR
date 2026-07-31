<?php
require_once('includes/bootstrap.php');

$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

function getHeightValue($h) {
    $map = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
    return $map[(int)$h] ?? '';
}

$login = (string)($_SESSION['MatriID'] ?? '');
$searchTerm = trim((string)($_POST['matriid'] ?? ($_GET['matriid'] ?? '')));
$resultid = false;
$viewer = [];

if ($login !== '') {
    $safeLogin = mysqli_real_escape_string($con, $login);
    $viewerResult = mysqli_query($con, "SELECT * FROM register WHERE MatriID='$safeLogin' LIMIT 1");
    $viewer = $viewerResult ? (mysqli_fetch_assoc($viewerResult) ?: []) : [];
}

if ($searchTerm !== '') {
    $safeTerm = mysqli_real_escape_string($con, $searchTerm);
    $exactResult = mysqli_query($con, "SELECT MatriID FROM register WHERE MatriID='$safeTerm' LIMIT 1");
    $hasExactMatch = $exactResult && mysqli_num_rows($exactResult) > 0;

    $conditions = [
        "Status NOT LIKE 'InActive'",
        "visibility NOT LIKE 'hidden'",
        "Status NOT LIKE 'Banned'"
    ];

    if ($hasExactMatch) {
        $conditions[] = "MatriID='$safeTerm'";
    } else {
        $conditions[] = "Name LIKE '%$safeTerm%'";
    }

    if ($login !== '') {
        $viewerGender = (string)($viewer['Gender'] ?? '');
        if ($viewerGender === 'Male') {
            $conditions[] = "Gender='Female'";
        } elseif ($viewerGender === 'Female') {
            $conditions[] = "Gender='Male'";
        }

        $conditions[] = "MatriID<>'$safeLogin'";
        $blockedIds = [];

        $blockedByResult = mysqli_query($con, "SELECT matriid FROM block_member WHERE profile_id='$safeLogin'");
        if ($blockedByResult) {
            while ($blocked = mysqli_fetch_assoc($blockedByResult)) {
                if (!empty($blocked['matriid'])) $blockedIds[] = (string)$blocked['matriid'];
            }
        }

        $blockedResult = mysqli_query($con, "SELECT profile_id FROM block_member WHERE matriid='$safeLogin'");
        if ($blockedResult) {
            while ($blocked = mysqli_fetch_assoc($blockedResult)) {
                if (!empty($blocked['profile_id'])) $blockedIds[] = (string)$blocked['profile_id'];
            }
        }

        $blockedIds = array_values(array_unique($blockedIds));
        if ($blockedIds) {
            $escapedBlockedIds = array_map(function ($id) use ($con) {
                return "'" . mysqli_real_escape_string($con, $id) . "'";
            }, $blockedIds);
            $conditions[] = 'MatriID NOT IN (' . implode(',', $escapedBlockedIds) . ')';
        }
    }

    $resultid = mysqli_query($con, 'SELECT * FROM register WHERE ' . implode(' AND ', $conditions));
}

$resultCount = $resultid instanceof mysqli_result ? mysqli_num_rows($resultid) : 0;
$isLoggedIn = $login !== '';
$viewerIsPaid = ($viewer['Status'] ?? '') === 'Paid';
$heightMap = [
    1=>'4Ft', 2=>'4Ft 1 inch', 3=>'4Ft 2 inch', 4=>'4Ft 3 inch', 5=>'4Ft 4 inch',
    6=>'4Ft 5 inch', 7=>'4Ft 6 inch', 8=>'4Ft 7 inch', 9=>'4Ft 8 inch', 10=>'4Ft 9 inch',
    11=>'4Ft 10 inch', 12=>'4Ft 11 inch', 13=>'5Ft', 14=>'5Ft 1 inch', 15=>'5Ft 2 inch',
    16=>'5Ft 3 inch', 17=>'5Ft 4 inch', 18=>'5Ft 5 inch', 19=>'5Ft 6 inch', 20=>'5Ft 7 inch',
    21=>'5Ft 8 inch', 22=>'5Ft 9 inch', 23=>'5Ft 10 inch', 24=>'5Ft 11 inch', 25=>'6Ft',
    26=>'6Ft 1 inch', 27=>'6Ft 2 inch', 28=>'6Ft 3 inch', 29=>'6Ft 4 inch', 30=>'6Ft 5 inch',
    31=>'6Ft 6 inch', 32=>'6Ft 7 inch', 33=>'6Ft 8 inch', 34=>'6Ft 9 inch', 35=>'6Ft 10 inch',
    36=>'6Ft 11 inch', 37=>'7Ft'
];

function id_search_h($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Search Result - Manpasand Jodidar</title>
  <link rel="icon" href="branding/favicons/icon-32.png" type="image/png">
  <link rel="stylesheet" href="css3/Style.css">
  <link rel="stylesheet" href="css3/mvv-premium.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    .mvv-id-results {
      min-height: 62vh;
      padding-bottom: 72px;
      background:
        radial-gradient(circle at 8% 15%, rgba(232,97,42,.07), transparent 26%),
        linear-gradient(180deg, #fffaf5 0%, #fff 42%);
    }
    .mvv-id-results .mvv-page-hero { margin-bottom: 40px; }
    .mvv-results-summary {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      margin-bottom: 22px;
      padding: 18px 22px;
      border: 1px solid var(--mvv-border);
      border-radius: 14px;
      background: rgba(255,255,255,.9);
      box-shadow: 0 10px 30px rgba(60,31,25,.06);
    }
    .mvv-results-summary h2 { margin: 0; color: var(--mvv-maroon); font-size: 1.15rem; font-weight: 800; }
    .mvv-results-summary p { margin: 3px 0 0; color: var(--mvv-muted); font-size: .9rem; }
    .mvv-result-count {
      flex: 0 0 auto;
      padding: 7px 13px;
      border-radius: 999px;
      background: var(--mvv-cream);
      color: var(--mvv-maroon);
      font-size: .82rem;
      font-weight: 800;
    }
    .mvv-profile-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 24px;
    }
    .mvv-match-card {
      display: flex;
      flex-direction: column;
      min-width: 0;
      overflow: hidden;
      border: 1px solid var(--mvv-border);
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 8px 24px rgba(56,32,25,.06);
      transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .mvv-match-card:hover {
      transform: translateY(-5px);
      border-color: rgba(201,146,26,.45);
      box-shadow: 0 18px 42px rgba(56,32,25,.13);
    }
    .mvv-card-photo { position: relative; display: block; overflow: hidden; background: var(--mvv-cream); }
    .mvv-card-photo img {
      display: block;
      width: 100%;
      height: 295px;
      object-fit: cover;
      transition: transform .4s ease;
    }
    .mvv-match-card:hover .mvv-card-photo img { transform: scale(1.035); }
    .mvv-card-id {
      position: absolute;
      left: 12px;
      bottom: 12px;
      padding: 6px 11px;
      border-radius: 999px;
      background: rgba(74,14,14,.9);
      color: #fff;
      font-size: .78rem;
      font-weight: 800;
      letter-spacing: .04em;
      backdrop-filter: blur(5px);
    }
    .mvv-card-body { flex: 1; padding: 18px; }
    .mvv-card-body h3 { margin: 0 0 12px; font-size: 1.05rem; font-weight: 800; }
    .mvv-card-body h3 a { color: var(--mvv-maroon); text-decoration: none; }
    .mvv-profile-detail {
      display: flex;
      align-items: flex-start;
      gap: 9px;
      margin-top: 8px;
      color: #66595a;
      font-size: .87rem;
      line-height: 1.4;
    }
    .mvv-profile-detail i { width: 15px; margin-top: 3px; color: var(--mvv-saffron); text-align: center; }
    .mvv-card-actions {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1px;
      padding: 0;
      border-top: 1px solid var(--mvv-border);
      background: var(--mvv-border);
    }
    .mvv-card-actions a {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 48px;
      background: #fffaf5;
      color: var(--mvv-maroon);
      text-decoration: none;
      transition: background .2s ease, color .2s ease;
    }
    .mvv-card-actions a:hover { background: var(--mvv-maroon); color: #fff; }
    .mvv-empty-state {
      max-width: 650px;
      margin: 0 auto;
      padding: 64px 24px;
      border: 1px solid var(--mvv-border);
      border-radius: 20px;
      background: #fff;
      text-align: center;
      box-shadow: 0 14px 40px rgba(56,32,25,.08);
    }
    .mvv-empty-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 72px;
      height: 72px;
      margin-bottom: 18px;
      border-radius: 50%;
      background: var(--mvv-cream);
      color: var(--mvv-saffron);
      font-size: 1.8rem;
    }
    .mvv-empty-state h2 { margin: 0 0 8px; color: var(--mvv-maroon); font-size: 1.5rem; }
    .mvv-empty-state p { margin: 0 auto 22px; color: var(--mvv-muted); }
    .mvv-search-again {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 11px 22px;
      border-radius: 9px;
      background: var(--mvv-maroon);
      color: #fff;
      font-weight: 700;
      text-decoration: none;
    }
    .mvv-search-again:hover { background: var(--mvv-maroon-dark); color: #fff; }
    @media (max-width: 1100px) { .mvv-profile-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
    @media (max-width: 820px) { .mvv-profile-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 560px) {
      .mvv-profile-grid { grid-template-columns: 1fr; }
      .mvv-results-summary { align-items: flex-start; flex-direction: column; }
      .mvv-card-photo img { height: 360px; }
    }
  </style>
</head>
<body>
<?php include('header.php'); ?>

<main class="mvv-page mvv-id-results">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Profile Search</div>
      <h1>Search Result</h1>
      <p>Find a member by Matrimony ID or name</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="<?php echo $isLoggedIn ? 'index_dashboard' : 'index'; ?>">Home</a>
        <span>Search Result</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if ($resultCount > 0) { ?>
        <div class="mvv-results-summary">
          <div>
            <h2>Matching Profile</h2>
            <p>Result for “<?php echo id_search_h($searchTerm); ?>”</p>
          </div>
          <span class="mvv-result-count"><?php echo $resultCount; ?> <?php echo $resultCount === 1 ? 'profile' : 'profiles'; ?></span>
        </div>

        <div class="mvv-profile-grid">
          <?php while ($profile = mysqli_fetch_assoc($resultid)) {
              $encryptedId = urlencode(base64_encode($profile['MatriID']));
              $profileUrl = $isLoggedIn ? 'full_profile?id=' . $encryptedId : 'login';
              $photo = (string)($profile['Photo1'] ?? 'nophoto.jpg');
              $approvedPhoto = ($profile['Photo1Approve'] ?? '') === 'Yes' && $photo !== '' && $photo !== 'nophoto.jpg';
              $photoSrc = 'images/nophoto.jpg';

              if ($approvedPhoto && ($profile['photo_visibility'] ?? '') === 'allphoto') {
                  $photoSrc = 'photoprocess.php?image=' . rawurlencode('gallary/' . $photo) . '&square=500';
              } elseif ($approvedPhoto && ($profile['photo_visibility'] ?? '') === 'paidphoto') {
                  if ($viewerIsPaid) {
                      $photoSrc = 'photoprocess.php?image=' . rawurlencode('gallary/' . $photo) . '&square=500';
                  } else {
                      $photoSrc = 'blur.php?image=' . rawurlencode('gallary/' . $photo);
                  }
              }

              $education = trim((string)($profile['Education'] ?? '')) ?: 'Education not specified';
              $occupation = trim((string)($profile['Occupation'] ?? '')) ?: 'Occupation not specified';
              $age = trim((string)($profile['Age'] ?? '')) ?: 'NA';
              $height = $heightMap[(int)($profile['Height'] ?? 0)] ?? 'Height not specified';
          ?>
            <article class="mvv-match-card">
              <a class="mvv-card-photo" href="<?php echo id_search_h($profileUrl); ?>" target="_blank">
                <img src="<?php echo id_search_h($photoSrc); ?>" alt="Profile <?php echo id_search_h($profile['MatriID']); ?>" loading="lazy">
                <span class="mvv-card-id"><?php echo id_search_h($profile['MatriID']); ?></span>
              </a>
              <div class="mvv-card-body">
                <h3><a href="<?php echo id_search_h($profileUrl); ?>" target="_blank"><?php echo id_search_h($profile['MatriID']); ?></a></h3>
                <div class="mvv-profile-detail"><i class="fas fa-graduation-cap"></i><span><?php echo id_search_h($education); ?></span></div>
                <div class="mvv-profile-detail"><i class="fas fa-briefcase"></i><span><?php echo id_search_h($occupation); ?></span></div>
                <div class="mvv-profile-detail"><i class="fas fa-ruler-vertical"></i><span><?php echo id_search_h($age); ?> Yrs, <?php echo id_search_h($height); ?></span></div>
              </div>
              <div class="mvv-card-actions">
                <a href="<?php echo id_search_h($profileUrl); ?>" target="_blank" title="View profile" aria-label="View profile"><i class="fas fa-user"></i></a>
                <a href="<?php echo id_search_h($profileUrl); ?>" target="_blank" title="Shortlist" aria-label="Shortlist"><i class="fas fa-heart"></i></a>
                <a href="<?php echo id_search_h($profileUrl); ?>" target="_blank" title="Message" aria-label="Message"><i class="fas fa-comment-dots"></i></a>
                <a href="<?php echo id_search_h($profileUrl); ?>" target="_blank" title="Connect" aria-label="Connect"><i class="fas fa-user-plus"></i></a>
              <?php
                $waHL = $profile['Height'] ? getHeightValue($profile['Height']) : '';
                $waLL = implode(', ', array_filter([$profile['City'] ?? '', $profile['Dist'] ?? '']));
                $waLA = [];
                $waLA[] = "\u{1F496} Check out this Matrimony Profile!";
                $waLA[] = '';
                $waLA[] = "\u{1F194} Profile ID: {$profile['MatriID']}";
                $waLA[] = "\u{1F382} Age: {$profile['Age']} years";
                if (!empty($profile['Religion'])) $waLA[] = "\u{1F54A} Religion: {$profile['Religion']}";
                if (!empty($profile['Maritalstatus'])) $waLA[] = "\u{1F48D} Marital Status: {$profile['Maritalstatus']}";
                if (!empty($profile['Education'])) $waLA[] = "\u{1F393} Education: {$profile['Education']}";
                if (!empty($profile['Occupation'])) $waLA[] = "\u{1F4BC} Occupation: {$profile['Occupation']}";
                if (!empty($waHL)) $waLA[] = "\u{1F4CF} Height: $waHL";
                if (!empty($waLL)) $waLA[] = "\u{1F4CD} Location: $waLL";
                $waLA[] = '';
                $waLA[] = "\u{1F517} View Full Profile:";
                $waLA[] = $baseUrl . 'public_profile?id=' . urlencode(base64_encode($profile['MatriID']));
                $waLA[] = '';
                $waLA[] = "Find your perfect life partner today \u{2764}\u{FE0F}";
                $waUR = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLA));
              ?><div style="padding:4px 16px 12px;background:var(--mvv-cream,#FFF8F0)"><a class="wa-share-btn wa-share-btn-sm" href="<?php echo htmlspecialchars($waUR, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Share</a></div>
              </div>
            </article>
          <?php } ?>
        </div>
      <?php } else { ?>
        <div class="mvv-empty-state">
          <span class="mvv-empty-icon"><i class="fas fa-magnifying-glass"></i></span>
          <h2>No Profile Found</h2>
          <p>
            <?php if ($searchTerm !== '') { ?>
              We could not find an available profile matching “<?php echo id_search_h($searchTerm); ?>”.
            <?php } else { ?>
              Enter a Matrimony ID or member name to search for a profile.
            <?php } ?>
          </p>
          <a class="mvv-search-again" href="<?php echo $isLoggedIn ? 'index_dashboard' : 'index'; ?>"><i class="fas fa-arrow-left"></i> Go Back</a>
        </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
