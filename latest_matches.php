<?php
require_once('sys_dbconnection.php');
require_once('includes/partner_match.php');
include_once ('siteconfig.php');
include_once ('memprotect.php');
error_reporting(0);
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

function getHeightValue($h) {
    $map = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
    return $map[(int)$h] ?? '';
}

if (isset($_GET["page"])) $page = (int)$_GET["page"];
else $page = 1;
$setLimit = 8;
$pageLimit = ($page * $setLimit) - $setLimit;

$login = $_SESSION['MatriID'];
$my_profile = mysqli_query($con, "SELECT * from register where matriid='$login'");
$me = mysqli_fetch_array($my_profile);
$hobbies = explode(",", $me['Looking']);
$pe_from_height = $me['PE_from_Height'];
$pe_to_height = $me['PE_to_Height'];
$pe_toage = $me['PE_ToAge'];
$pe_fromage = $me['PE_FromAge'];
$PE_Complexion = $me['PE_Complexion'];
$PE_Education = $me['PE_Education'];
$PE_star = $me['PE_star'];
$Residencystatus = $me['Residencystatus'];
$pe_religion = $me['PE_Religion'];
$Country = $me['Country'];
$pe_caste = $me['PE_Caste'];
$match_sex = ($me['Gender']=='Male') ? 'Female' : 'Male';

$check = mysqli_query($con, "select matriid from block_member where profile_id='" . $_SESSION['matriid'] . "'");
$data1 = array();
while ($check1 = mysqli_fetch_array($check)) { $data1[] = $check1['matriid']; }
$matriid = implode("','", $data1);

$check2 = mysqli_query($con, "select profile_id from block_member where matriid='" . $_SESSION['matriid'] . "'");
$data = array();
while ($check3 = mysqli_fetch_array($check2)) { $data[] = $check3['profile_id']; }
$profile = implode("','", $data);

$match_qry = "select DISTINCT * from register where visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$login' AND Regdate > DATE_SUB( NOW( ),INTERVAL 2 DAY) AND ";
if ($profile != "") $match_qry .= " MatriID NOT IN ('$profile') and ";
if ($matriid != "") $match_qry .= " MatriID NOT IN ('$matriid') and ";
if ($me['Looking'] != "" && $me['Looking'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(" , ", $me['Looking']));
  $match_qry .= "Maritalstatus IN(".implode(',', $t).") AND";
}
$match_qry .= " Gender='$match_sex' AND ";
$match_qry .= " Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
$match_qry .= " Age BETWEEN '$pe_fromage' AND '$pe_toage'";

if ($me['PE_MotherTongue'] != "" && $me['PE_MotherTongue'] != "Any") {
  $terms = array_map(function($v){return "'$v'";}, explode(",", $me['PE_MotherTongue']));
  $match_qry .= " and mother_tounge IN(".implode(',', $terms).")";
}
if ($me['PE_star'] != "" && $me['PE_star'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_star']));
  $match_qry .= " and Star IN(".implode(',', $t).")";
}
if ($me['PE_Complexion'] != "" && $me['PE_Complexion'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_Complexion']));
  $match_qry .= " and Complexion IN(".implode(',', $t).")";
}
if ($me['PE_Religion'] != "" && $me['PE_Religion'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_Religion']));
  $match_qry .= " and Religion IN(".implode(',', $t).")";
}
if ($me['PE_Caste'] != "" && $me['PE_Caste'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_Caste']));
  $match_qry .= " and Caste IN(".implode(',', $t).")";
}
if ($me['PE_Residentstatus'] != "" && $me['PE_Residentstatus'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_Residentstatus']));
  $match_qry .= " and Residencystatus IN(".implode(',', $t).")";
}
if ($me['PE_Countrylivingin'] != "" && $me['PE_Countrylivingin'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_Countrylivingin']));
  $match_qry .= " and Country IN(".implode(',', $t).")";
}
if ($me['PE_State'] != "" && $me['PE_State'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_State']));
  $match_qry .= " and State IN(".implode(',', $t).")";
}
if ($me['PE_Occupation'] != "" && $me['PE_Occupation'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_Occupation']));
  $match_qry .= " and Occupation IN(".implode(',', $t).")";
}
if ($me['PE_Education'] != "" && $me['PE_Education'] != "Any") {
  $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_Education']));
  $match_qry .= " and Education IN(".implode(',', $t).")";
}
$match_qry .= "and Status NOT LIKE 'Banned' ORDER BY Regdate DESC LIMIT " . $pageLimit . " , " . $setLimit;

$heightMap = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];

function displayPaginationBelow($con, $per_page, $page) {
  $login = $_SESSION['MatriID'];
  $page_url = "?";
  $me = mysqli_fetch_array(mysqli_query($con, "SELECT * from register where matriid='$login'"));
  $match_sex = ($me['Gender']=='Male') ? 'Female' : 'Male';
  $check = mysqli_query($con, "select matriid from block_member where profile_id='".$_SESSION['matriid']."'");
  $data1 = array(); while($r=mysqli_fetch_array($check)) $data1[]=$r['matriid'];
  $matriid = implode("','", $data1);
  $check2 = mysqli_query($con, "select profile_id from block_member where matriid='".$_SESSION['matriid']."'");
  $data = array(); while($r=mysqli_fetch_array($check2)) $data[]=$r['profile_id'];
  $profile = implode("','", $data);
  $count = "select COUNT(*) as totalCount from register where visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$login' AND Regdate > DATE_SUB( NOW( ),INTERVAL 2 DAY) AND ";
  if ($profile != "") $count .= " MatriID NOT IN ('$profile') and ";
  if ($matriid != "") $count .= " MatriID NOT IN ('$matriid') and ";
  if ($me['Looking'] != "" && $me['Looking'] != "Any") {
    $t = array_map(function($v){return "'$v'";}, explode(" , ", $me['Looking']));
    $count .= "Maritalstatus IN(".implode(',', $t).") AND";
  }
  $count .= " Gender='$match_sex' AND Height BETWEEN '$me[PE_from_Height]'AND'$me[PE_to_Height]' AND Age BETWEEN '$me[PE_FromAge]' AND '$me[PE_ToAge]'";
  foreach(['Religion','Complexion','Caste','Residentstatus','Country','State','Occupation','Education'] as $f) {
    $vf = 'PE_'.$f; $dbCol = ($f=='Residentstatus')?'Residencystatus':$f;
    if ($me[$vf] != "" && $me[$vf] != "Any") {
      $t = array_map(function($v){return "'$v'";}, explode(",", $me[$vf]));
      $count .= " and $dbCol IN(".implode(',', $t).")";
    }
  }
  if ($me['PE_MotherTongue'] != "" && $me['PE_MotherTongue'] != "Any") {
    $t = array_map(function($v){return "'$v'";}, explode(",", $me['PE_MotherTongue']));
    $count .= " and mother_tounge IN(".implode(',', $t).")";
  }
  
  $rec = mysqli_fetch_array(mysqli_query($con, $count));
  $total = $rec['totalCount'];
  $adjacents = "2";
  $setLastpage = ceil($total / $per_page);
  $lpm1 = $setLastpage - 1;
  $h = '';
  if ($setLastpage > 1) {
    $h .= '<ul class="mvv-pagination">';
    $h .= "<li class='mvv-page-info'>Page $page of $setLastpage</li>";
    if ($page > 1) $h .= "<li><a href='{$page_url}page=".($page-1)."'><i class='bi bi-chevron-left'></i></a></li>";
    $startPage = max(1, $page - $adjacents);
    $endPage = min($setLastpage, $page + $adjacents);
    if ($startPage > 1) { $h .= "<li><a href='{$page_url}page=1'>1</a></li>"; if ($startPage > 2) $h .= "<li class='mvv-dot'>…</li>"; }
    for ($i = $startPage; $i <= $endPage; $i++) {
      if ($i == $page) $h .= "<li class='active'><span>$i</span></li>";
      else $h .= "<li><a href='{$page_url}page=$i'>$i</a></li>";
    }
    if ($endPage < $setLastpage) { if ($endPage < $setLastpage-1) $h .= "<li class='mvv-dot'>…</li>"; $h .= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>"; }
    if ($page < $setLastpage) $h .= "<li><a href='{$page_url}page=".($page+1)."'><i class='bi bi-chevron-right'></i></a></li>";
    $h .= '</ul>';
  }
  return $h;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Latest Matches — Shivraj Maratha</title>
<link href="css3/Style.css" rel="stylesheet" />
<link href="css3/mvv-premium.css" rel="stylesheet" />
<link rel="shortcut icon" href="css3/assets/shivraj-logo.png" type="image/x-icon" />
<link rel="icon" href="css3/assets/shivraj-logo.png" type="image/x-icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<style>
:root{--mvv-maroon:#6B1A1A;--mvv-saffron:#E8612A;--mvv-gold:#C9921A;--mvv-cream:#FFF8F0;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-page{min-height:60vh;padding-top:0;padding-bottom:60px;}
.mvv-container{max-width:1200px;margin:0 auto;padding:0 16px;}
.mvv-section{padding:48px 0 40px;}
.mvv-match-card{background:#fff;border-radius:14px;overflow:hidden;border:1px solid var(--mvv-border);transition:box-shadow .25s;height:100%;}
.mvv-match-card:hover{box-shadow:0 8px 30px rgba(0,0,0,0.1);}
.mvv-match-card .mvv-card-img{width:100%;height:260px;object-fit:cover;background:var(--mvv-cream);}
.mvv-match-card .mvv-card-body{padding:16px;}
.mvv-match-score{display:inline-flex;align-items:center;margin-bottom:9px;padding:5px 9px;border-radius:999px;background:#fff0e0;color:var(--mvv-maroon);font-size:.75rem;font-weight:800}.mvv-match-score.perfect{background:#e8f7ed;color:#24653a}
.mvv-match-card h5{margin:0 0 4px;font-weight:700;font-size:1.05rem;}
.mvv-match-card h5 a{color:var(--mvv-maroon);text-decoration:none;}
.mvv-match-card .mvv-card-meta{font-size:0.85rem;color:#666;margin-bottom:10px;}
.mvv-match-card .mvv-card-actions{display:flex;gap:6px;flex-wrap:wrap;border-top:1px solid var(--mvv-border);padding:10px 16px;background:var(--mvv-cream);}
.mvv-match-card .mvv-card-actions a{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:#fff;border:1px solid var(--mvv-border);color:var(--mvv-maroon);text-decoration:none;transition:.2s;}
.mvv-match-card .mvv-card-actions a:hover{background:var(--mvv-maroon);color:#fff;border-color:var(--mvv-maroon);}
.mvv-pagination{display:flex;align-items:center;gap:6px;flex-wrap:wrap;justify-content:center;padding:0;margin:24px 0 0;list-style:none;}
.mvv-pagination li a,.mvv-pagination li span,.mvv-pagination li.active span{display:inline-flex;align-items:center;justify-content:center;min-width:38px;height:38px;padding:0 8px;border:1px solid var(--mvv-border);border-radius:8px;background:#fff;color:#333;font-size:0.9rem;text-decoration:none;transition:.2s;}
.mvv-pagination li a:hover{background:var(--mvv-cream);border-color:var(--mvv-maroon);color:var(--mvv-maroon);}
.mvv-pagination li.active span{background:var(--mvv-maroon);border-color:var(--mvv-maroon);color:#fff;font-weight:700;}
.mvv-pagination .mvv-page-info{border:none;color:var(--mvv-muted);font-size:0.85rem;padding:0 8px;}
.mvv-pagination .mvv-dot{border:none;font-size:1.1rem;color:#999;padding:0 4px;}
.mvv-btn{display:inline-block;padding:10px 24px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#8B1A1A;}
</style>
</head>
<body>
<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Matches</div>
      <h1>Latest Matches</h1>
      <p>नवीन सदस्य</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Latest Matches</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php
      $sqlmatch = mysqli_query($con, $match_qry) or die(mysqli_error($con));
      if (mysqli_num_rows($sqlmatch) > 0) { ?>
      <div class="row g-4">
        <?php while ($fetch = mysqli_fetch_array($sqlmatch)) {
          $partnerScore=partner_match_score($me,$fetch);
          $encrypt = urlencode(base64_encode($fetch['MatriID']));
          $imgSrc = 'images/nophoto.jpg';
          if($fetch['photo_visibility']=='paidphoto' && $fetch['Photo1Approve']=='Yes' && $me['Status']=='Paid' && $fetch['Photo1']!='nophoto.jpg')
            $imgSrc='gallary/'.$fetch['Photo1'];
          elseif($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' && $fetch['Photo1']!='nophoto.jpg')
            $imgSrc='gallary/'.$fetch['Photo1'];
          else $imgSrc='images/nophoto.jpg';
        ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
          <div class="mvv-match-card">
            <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank">
              <img class="mvv-card-img" src="<?php echo htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile photo" loading="lazy" onerror="this.onerror=null;this.src='images/nophoto.jpg';">
            </a>
            <div class="mvv-card-body">
              <div class="mvv-match-score <?php echo $partnerScore['is_100']?'perfect':''; ?>" title="<?php echo $partnerScore['matched']; ?> of 10 preference points matched"><?php echo partner_match_badge($partnerScore); ?></div>
              <h5><a href="full_profile?id=<?php echo $encrypt ?>" target="_blank"><?php echo $fetch['MatriID'] ?></a></h5>
              <div class="mvv-card-meta">
                <?php echo substr($fetch['Education'],0,20) ?><br>
                <?php echo substr($fetch['Occupation'],0,20) ?><br>
                <?php echo $fetch['Age'] ?> Yrs, <?php echo $heightMap[$fetch['Height']]??''; ?>
              </div>
            </div>
            <div class="mvv-card-actions">
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Profile"><i class="fas fa-user"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Shortlist"><i class="fas fa-heart"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Message"><i class="fas fa-comment-dots"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Connect"><i class="fas fa-user-plus"></i></a>
              <?php
                $waHL = $fetch['Height'] ? getHeightValue($fetch['Height']) : '';
                $waLL = implode(', ', array_filter([$fetch['City'] ?? '', $fetch['Dist'] ?? '']));
                $waLA = [];
                $waLA[] = "\u{1F496} Check out this Matrimony Profile!";
                $waLA[] = '';
                $waLA[] = "\u{1F194} Profile ID: {$fetch['MatriID']}";
                $waLA[] = "\u{1F382} Age: {$fetch['Age']} years";
                if (!empty($fetch['Religion'])) $waLA[] = "\u{1F54A} Religion: {$fetch['Religion']}";
                if (!empty($fetch['Maritalstatus'])) $waLA[] = "\u{1F48D} Marital Status: {$fetch['Maritalstatus']}";
                if (!empty($fetch['Education'])) $waLA[] = "\u{1F393} Education: {$fetch['Education']}";
                if (!empty($fetch['Occupation'])) $waLA[] = "\u{1F4BC} Occupation: {$fetch['Occupation']}";
                if (!empty($waHL)) $waLA[] = "\u{1F4CF} Height: $waHL";
                if (!empty($waLL)) $waLA[] = "\u{1F4CD} Location: $waLL";
                $waLA[] = '';
                $waLA[] = "\u{1F517} View Full Profile:";
                $waLA[] = $baseUrl . 'public_profile?id=' . urlencode(base64_encode($fetch['MatriID']));
                $waLA[] = '';
                $waLA[] = "Find your perfect life partner today \u{2764}\u{FE0F}";
                $waUR = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLA));
              ?><a class="wa-share-btn wa-share-btn-sm" href="<?php echo htmlspecialchars($waUR, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div style="text-align:center;margin-top:30px;">
        <?php echo displayPaginationBelow($con, $setLimit, $page); ?>
      </div>
      <?php } else { ?>
      <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:3rem;font-weight:900;color:var(--mvv-maroon);opacity:0.3;margin-bottom:10px;">OOP'S</div>
        <h3 style="color:var(--mvv-muted);">Sorry Result Not Found</h3>
        <p style="color:#999;">You have not any Latest Matches.</p>
        <a href="smart_search" class="mvv-btn primary" style="margin-top:10px;">Search</a>
      </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
</body>
</html>
