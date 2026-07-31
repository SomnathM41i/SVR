<?php
require_once('includes/bootstrap.php');

$allowedGenders = ['Male', 'Female'];
$allowedStatuses = ['Unmarried', 'Divorced'];
$gender = in_array($_GET['gender'] ?? '', $allowedGenders, true) ? $_GET['gender'] : 'Male';
$maritalStatus = in_array($_GET['marital_status'] ?? '', $allowedStatuses, true) ? $_GET['marital_status'] : 'Unmarried';
$isNri = ($_GET['profile_type'] ?? '') === 'NRI';
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 12;
$offset = ($page - 1) * $perPage;
$login = (string)($_SESSION['MatriID'] ?? '');
$excludeCurrentProfileSql = $login !== '' ? ' AND MatriID<>?' : '';
$categorySql = $isNri
    ? "Gender=? AND profile_location_type='NRI'"
    : "Gender=? AND Maritalstatus=?";

$countSql = "SELECT COUNT(*) AS total
             FROM register
             WHERE ".$categorySql."
               AND visibility<>'hidden'
               AND Status NOT IN ('Banned','InActive')
               AND MatriID<>''".$excludeCurrentProfileSql;
$countStatement = mysqli_prepare($con, $countSql);
$total = 0;
if ($countStatement) {
    if ($isNri && $login !== '') {
        mysqli_stmt_bind_param($countStatement, 'ss', $gender, $login);
    } elseif ($isNri) {
        mysqli_stmt_bind_param($countStatement, 's', $gender);
    } elseif ($login !== '') {
        mysqli_stmt_bind_param($countStatement, 'sss', $gender, $maritalStatus, $login);
    } else {
        mysqli_stmt_bind_param($countStatement, 'ss', $gender, $maritalStatus);
    }
    mysqli_stmt_execute($countStatement);
    $countResult = mysqli_stmt_get_result($countStatement);
    $total = (int)(mysqli_fetch_assoc($countResult)['total'] ?? 0);
    mysqli_stmt_close($countStatement);
}

$totalPages = max(1, (int)ceil($total / $perPage));
if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $perPage;
}

$profiles = [];
$profileSql = "SELECT MatriID, Age, Height, Education, Occupation, City, Dist,
                      Photo1, Photo1Approve, photo_visibility, profile_location_type
               FROM register
               WHERE ".$categorySql."
                 AND visibility<>'hidden'
                 AND Status NOT IN ('Banned','InActive')
                 AND MatriID<>''".$excludeCurrentProfileSql."
               ORDER BY ID DESC
               LIMIT ? OFFSET ?";
$profileStatement = mysqli_prepare($con, $profileSql);
if ($profileStatement) {
    if ($isNri && $login !== '') {
        mysqli_stmt_bind_param($profileStatement, 'ssii', $gender, $login, $perPage, $offset);
    } elseif ($isNri) {
        mysqli_stmt_bind_param($profileStatement, 'sii', $gender, $perPage, $offset);
    } elseif ($login !== '') {
        mysqli_stmt_bind_param($profileStatement, 'sssii', $gender, $maritalStatus, $login, $perPage, $offset);
    } else {
        mysqli_stmt_bind_param($profileStatement, 'ssii', $gender, $maritalStatus, $perPage, $offset);
    }
    mysqli_stmt_execute($profileStatement);
    $profileResult = mysqli_stmt_get_result($profileStatement);
    while ($profile = mysqli_fetch_assoc($profileResult)) {
        $profiles[] = $profile;
    }
    mysqli_stmt_close($profileStatement);
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

$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

$groupTitle = $isNri ? 'NRI' : ($maritalStatus === 'Divorced' ? 'Divorcee' : 'Unmarried');
$groupTitle .= $gender === 'Male' ? ' Grooms' : ' Brides';
$page_title = $groupTitle.' - Manpasand Jodidar';

function publicProfilesUrl(string $gender, string $status = 'Unmarried', int $page = 1, string $profileType = ''): string {
    $query = ['gender' => $gender];
    if ($profileType === 'NRI') {
        $query['profile_type'] = 'NRI';
    } else {
        $query['marital_status'] = $status;
    }
    if ($page > 1) {
        $query['page'] = $page;
    }
    return 'public_profiles?'.http_build_query($query);
}

include('header3.php');
?>

<style>
.public-profiles-page{min-height:65vh;padding-bottom:70px;background:linear-gradient(180deg,#fffaf5 0,#fff 46%)}
.public-profiles-hero{padding:62px 0 48px;background:linear-gradient(135deg,#5E1426,#8b2520);color:#fff}
.public-profiles-hero .eyebrow{display:block;margin-bottom:10px;color:#DDB15F;font-size:.78rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase}
.public-profiles-hero h1{margin:0 0 10px;color:#fff;font-family:var(--mvv-display);font-size:clamp(2rem,5vw,3.6rem)}
.public-profiles-hero p{max-width:620px;margin:0;color:rgba(255,255,255,.78)}
.public-profiles-section{padding:42px 0}
.profile-filter-tabs{display:flex;gap:9px;flex-wrap:wrap;margin-bottom:28px}
.profile-filter-tabs a{padding:10px 15px;border:1px solid var(--mvv-line);border-radius:999px;background:#fff;color:var(--mvv-maroon);font-size:.86rem;font-weight:700;text-decoration:none}
.profile-filter-tabs a.active,.profile-filter-tabs a:hover{border-color:var(--mvv-maroon);background:var(--mvv-maroon);color:#fff}
.public-results-head{display:flex;align-items:end;justify-content:space-between;gap:20px;margin-bottom:20px}
.public-results-head h2{margin:0;color:var(--mvv-maroon);font-family:var(--mvv-display);font-size:1.7rem}
.public-results-count{color:var(--mvv-muted);font-size:.9rem}
.public-match-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:22px}
.public-match-card{display:flex;flex-direction:column;overflow:hidden;border:1px solid var(--mvv-line);border-radius:16px;background:#fff;box-shadow:0 8px 28px rgba(79,35,25,.07);transition:transform .2s,box-shadow .2s}
.public-match-card:hover{transform:translateY(-4px);box-shadow:0 15px 36px rgba(79,35,25,.13)}
.public-match-photo{width:100%;height:270px;object-fit:cover;background:var(--mvv-cream)}
.public-match-body{display:flex;flex:1;flex-direction:column;padding:17px}
.public-match-badge{align-self:flex-start;margin-bottom:10px;padding:5px 9px;border-radius:999px;background:#fff0e0;color:var(--mvv-maroon);font-size:.72rem;font-weight:800}
.public-match-body h3{margin:0 0 10px;color:var(--mvv-maroon);font-size:1.05rem}
.public-match-meta{margin-bottom:16px;color:var(--mvv-muted);font-size:.86rem;line-height:1.65}
.public-match-meta i{width:18px;color:var(--mvv-saffron)}
.public-match-action{display:flex;align-items:center;justify-content:center;gap:8px;margin-top:auto;padding:10px 13px;border-radius:8px;background:var(--mvv-maroon);color:#fff;font-size:.84rem;font-weight:700;text-decoration:none}
.public-match-action:hover{background:#8b2520;color:#fff}
.public-empty{padding:65px 20px;border:1px solid var(--mvv-line);border-radius:16px;background:#fff;text-align:center}
.public-empty i{margin-bottom:13px;color:var(--mvv-gold);font-size:2.6rem}
.public-empty h2{color:var(--mvv-maroon)}
.public-pagination{display:flex;justify-content:center;gap:7px;flex-wrap:wrap;margin:32px 0 0;padding:0;list-style:none}
.public-pagination a,.public-pagination span{display:inline-flex;align-items:center;justify-content:center;min-width:40px;height:40px;padding:0 10px;border:1px solid var(--mvv-line);border-radius:8px;background:#fff;color:var(--mvv-maroon);font-size:.88rem;font-weight:700;text-decoration:none}
.public-pagination .active{border-color:var(--mvv-maroon);background:var(--mvv-maroon);color:#fff}
@media(max-width:1050px){.public-match-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:760px){.public-match-grid{grid-template-columns:repeat(2,1fr)}.public-results-head{align-items:start;flex-direction:column}.public-match-photo{height:250px}}
@media(max-width:500px){.public-match-grid{grid-template-columns:1fr}.public-match-photo{height:330px}.profile-filter-tabs a{flex:1 1 calc(50% - 9px);text-align:center}}
</style>

<main class="public-profiles-page">
  <section class="public-profiles-hero">
    <div class="container">
      <span class="eyebrow">Discover Profiles</span>
      <h1><?php echo htmlspecialchars($groupTitle); ?></h1>
      <p>Browse matching Manpasand Jodidar profiles. Log in or register to view complete profile details and connect.</p>
    </div>
  </section>

  <section class="public-profiles-section">
    <div class="container">
      <nav class="profile-filter-tabs" aria-label="Profile categories">
        <?php
        $categories = [
            ['Male', 'Unmarried', '', 'Unmarried Grooms'],
            ['Female', 'Unmarried', '', 'Unmarried Brides'],
            ['Male', 'Divorced', '', 'Divorcee Grooms'],
            ['Female', 'Divorced', '', 'Divorcee Brides'],
            ['Male', 'Unmarried', 'NRI', 'NRI Grooms'],
            ['Female', 'Unmarried', 'NRI', 'NRI Brides']
        ];
        foreach ($categories as [$categoryGender, $categoryStatus, $categoryType, $categoryLabel]) {
            $active = $gender === $categoryGender
                && ($categoryType === 'NRI' ? $isNri : (!$isNri && $maritalStatus === $categoryStatus));
        ?>
        <a href="<?php echo htmlspecialchars(publicProfilesUrl($categoryGender, $categoryStatus, 1, $categoryType)); ?>"<?php echo $active ? ' class="active" aria-current="page"' : ''; ?>><?php echo htmlspecialchars($categoryLabel); ?></a>
        <?php } ?>
      </nav>

      <div class="public-results-head">
        <h2><?php echo htmlspecialchars($groupTitle); ?></h2>
        <span class="public-results-count"><?php echo number_format($total); ?> profile<?php echo $total === 1 ? '' : 's'; ?> found</span>
      </div>

      <?php if ($profiles) { ?>
      <div class="public-match-grid">
        <?php foreach ($profiles as $profile) {
            $photo = 'images/nophoto.jpg';
            $pv = $profile['photo_visibility'] ?? '';
            $pa = ($profile['Photo1Approve'] ?? '') === 'Yes';
            $p1 = !empty($profile['Photo1']) && $profile['Photo1'] !== 'nophoto.jpg';
            if ($p1 && $pa) {
                if ($pv === 'allphoto') {
                    $photo = 'photoprocess.php?image='.rawurlencode('gallary/'.$profile['Photo1']).'&square=500';
                } elseif ($pv === 'paidphoto' && ($_SESSION['Status'] ?? '') === 'Paid') {
                    $photo = 'photoprocess.php?image='.rawurlencode('gallary/'.$profile['Photo1']).'&square=500';
                }
            }
            $location = implode(', ', array_filter([
                $profile['City'] ?? '',
                $profile['Taluka'] ?? '',
                $profile['Dist'] ?? ''
            ]));
            $profileLink = 'public_profile?id='.urlencode(base64_encode($profile['MatriID']));
            $waImg = ($photo !== 'images/nophoto.jpg') ? $baseUrl . $photo : '';
            $waLines = [];
            $waLines[] = $baseUrl . $profileLink;
            $waLines[] = '';
            $waLines[] = "\u{1F496} Check out this Matrimony Profile!";
            $waLines[] = "\u{1F194} Profile ID: {$profile['MatriID']}";
            $waLines[] = "\u{1F382} Age: " . (int)$profile['Age'] . ' years';
            if (!empty($profile['Education']) && $profile['Education'] !== 'Education not specified') $waLines[] = "\u{1F393} Education: {$profile['Education']}";
            if (!empty($profile['Occupation']) && $profile['Occupation'] !== 'Occupation not specified') $waLines[] = "\u{1F4BC} Occupation: {$profile['Occupation']}";
            if (!empty($heightMap[(int)$profile['Height']])) $waLines[] = "\u{1F4CF} Height: {$heightMap[(int)$profile['Height']]}";
            if (!empty($location)) $waLines[] = "\u{1F4CD} Location: $location";
            $waLines[] = "\u{1F48D} Marital Status: $maritalStatus";
            $waLines[] = '';
            $waLines[] = "Find your perfect life partner today \u{2764}\u{FE0F}";
            $waUrl = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLines));
        ?>
        <article class="public-match-card">
          <a href="<?php echo htmlspecialchars($profileLink); ?>">
            <img class="public-match-photo" src="<?php echo htmlspecialchars($photo); ?>" alt="Matrimonial profile" loading="lazy" onerror="this.onerror=null;this.src='images/nophoto.jpg';">
          </a>
          <div class="public-match-body">
            <span class="public-match-badge"><?php echo $isNri ? 'NRI' : htmlspecialchars($maritalStatus); ?> Profile</span>
            <h3><?php echo htmlspecialchars($profile['MatriID']); ?></h3>
            <div class="public-match-meta">
              <div><i class="fas fa-user"></i><?php echo (int)$profile['Age']; ?> years<?php echo !empty($heightMap[(int)$profile['Height']]) ? ', '.htmlspecialchars($heightMap[(int)$profile['Height']]) : ''; ?></div>
              <div><i class="fas fa-graduation-cap"></i><?php echo htmlspecialchars($profile['Education'] ?: 'Education not specified'); ?></div>
              <div><i class="fas fa-briefcase"></i><?php echo htmlspecialchars($profile['Occupation'] ?: 'Occupation not specified'); ?></div>
              <div><i class="fas fa-location-dot"></i><?php echo htmlspecialchars($location ?: 'Location not specified'); ?></div>
            </div>
            <div style="display:flex;gap:8px;margin-top:auto">
              <a class="wa-share-btn" href="<?php echo htmlspecialchars($waUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" style="flex:1;justify-content:center"><i class="fab fa-whatsapp"></i> Share</a>
              <a class="public-match-action" href="<?php echo htmlspecialchars($profileLink); ?>" style="flex:1;justify-content:center">
                <i class="fas fa-user"></i>
                View Profile
              </a>
            </div>
          </div>
        </article>
        <?php } ?>
      </div>

      <?php if ($totalPages > 1) {
          $startPage = max(1, $page - 2);
          $endPage = min($totalPages, $page + 2);
      ?>
      <nav aria-label="Profile result pages">
        <ul class="public-pagination">
          <?php if ($page > 1) { ?>
          <li><a href="<?php echo htmlspecialchars(publicProfilesUrl($gender, $maritalStatus, $page - 1, $isNri ? 'NRI' : '')); ?>" aria-label="Previous page"><i class="fas fa-chevron-left"></i></a></li>
          <?php }
          for ($pageNumber = $startPage; $pageNumber <= $endPage; $pageNumber++) {
              if ($pageNumber === $page) { ?>
          <li><span class="active" aria-current="page"><?php echo $pageNumber; ?></span></li>
              <?php } else { ?>
          <li><a href="<?php echo htmlspecialchars(publicProfilesUrl($gender, $maritalStatus, $pageNumber, $isNri ? 'NRI' : '')); ?>"><?php echo $pageNumber; ?></a></li>
              <?php }
          }
          if ($page < $totalPages) { ?>
          <li><a href="<?php echo htmlspecialchars(publicProfilesUrl($gender, $maritalStatus, $page + 1, $isNri ? 'NRI' : '')); ?>" aria-label="Next page"><i class="fas fa-chevron-right"></i></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>

      <?php } else { ?>
      <div class="public-empty">
        <i class="fas fa-users"></i>
        <h2>No profiles found</h2>
        <p>There are currently no visible profiles in this category. Please try another category.</p>
      </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
