<?php
require_once('sys_dbconnection.php');
include('memprotect.php');
require_once('includes/partner_match.php');
require_once('includes/annual_income.php');
$login = $_SESSION['MatriID'] ?? '';
if($login) {
  $r=mysqli_query($con,"SELECT * FROM register WHERE MatriID='$login'");
  $me=mysqli_fetch_array($r);
}
function dashboardValue($value) {
  $value = trim((string)$value);
  return $value !== '' ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : 'Not specified';
}
function dashboardTags($value) {
  $items = array_values(array_filter(array_map('trim', explode(',', (string)$value)), function($item) {
    return $item !== '';
  }));
  if (!$items) return '<span class="mvv-empty-value">Not specified</span>';
  return '<span class="mvv-value-tags">'.implode('', array_map(function($item) {
    return '<span>'.htmlspecialchars($item, ENT_QUOTES, 'UTF-8').'</span>';
  }, $items)).'</span>';
}
$monthlyRentalIncomeDisplay = trim((string)($me['monthly_rental_income'] ?? ''));
if($monthlyRentalIncomeDisplay !== '' && ctype_digit($monthlyRentalIncomeDisplay)) {
  $monthlyRentalIncomeDisplay = '₹'.number_format((int)$monthlyRentalIncomeDisplay).' per month';
}
$profileLocationType = trim((string)($me['profile_location_type'] ?? ''));
if ($profileLocationType === '') $profileLocationType = 'Indian Resident';
$isNriProfile = $profileLocationType === 'NRI';
$nriVisaExpiryDisplay = trim((string)($me['nri_visa_expiry'] ?? ''));
if ($nriVisaExpiryDisplay !== '' && $nriVisaExpiryDisplay !== '0000-00-00') {
  $nriVisaExpiryTimestamp = strtotime($nriVisaExpiryDisplay);
  if ($nriVisaExpiryTimestamp !== false) $nriVisaExpiryDisplay = date('d M Y', $nriVisaExpiryTimestamp);
}
$childrenDetails = json_decode((string)($me['children_details'] ?? ''), true);
if (!is_array($childrenDetails)) $childrenDetails = [];
$childrenSummary = [];
foreach ($childrenDetails as $index => $child) {
  $gender = isset($child['gender']) ? trim((string)$child['gender']) : '';
  $age = isset($child['age']) ? (int)$child['age'] : 0;
  if ($gender !== '' && $age >= 1 && $age <= 50) {
    $childrenSummary[] = 'Child '.($index + 1).': '.$gender.', '.$age.' years';
  }
}
$heightMap=[1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
$bq1=explode("','",implode("','",array_column(mysqli_fetch_all(mysqli_query($con,"select matriid from block_member where profile_id='$login'")),0)));
$bq2=explode("','",implode("','",array_column(mysqli_fetch_all(mysqli_query($con,"select profile_id from block_member where matriid='$login'")),0)));
$mc="SELECT COUNT(*) as c FROM register WHERE visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$login'";
if($bq1[0]) $mc.=" AND MatriID NOT IN('".implode("','",$bq1)."')";
if($bq2[0]) $mc.=" AND MatriID NOT IN('".implode("','",$bq2)."')";
if($me['Looking']&&$me['Looking']!='Any') $mc.=" AND Maritalstatus IN(".implode(',',array_map(function($v){return"'$v'";},explode(' , ',$me['Looking']))).")";
$mc.=" AND Gender='".($me['Gender']=='Male'?'Female':'Male')."' AND Height BETWEEN '".$me['PE_from_Height']."' AND '".$me['PE_to_Height']."' AND Age BETWEEN '".$me['PE_FromAge']."' AND '".$me['PE_ToAge']."'";
foreach(['Complexion','Religion','Caste','Residentstatus','Country','State','Occupation','Education'] as $f){
  $vf='PE_'.$f; $dbCol=($f=='Residentstatus')?'Residencystatus':$f;
  if($me[$vf]!=''&&$me[$vf]!='Any') $mc.=" and $dbCol IN(".implode(',',array_map(function($v){return"'$v'";},explode(",",$me[$vf]))).")";
}
$match_total=mysqli_fetch_array(mysqli_query($con,$mc));
$shortlist_total=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM shortlist_profile WHERE profile_id='$login'".($bq1[0]?" AND mat_id NOT IN('".implode("','",$bq1)."')":"").($bq2[0]?" AND mat_id NOT IN('".implode("','",$bq2)."')":"")." AND banstatus!='1'"));
$interest_total=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM expressinterest WHERE eireceiver='$login' AND status='Pending'".($bq1[0]?" AND eisender NOT IN('".implode("','",$bq1)."')":"").($bq2[0]?" AND eisender NOT IN('".implode("','",$bq2)."')":"")." AND banstatus!='1'"));
$viewed_total=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM profile_views WHERE whom='$login'".($bq1[0]?" AND who NOT IN('".implode("','",$bq1)."')":"").($bq2[0]?" AND who NOT IN('".implode("','",$bq2)."')":"")." AND banstatus!='1'"));
$msg_total=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(DISTINCT FromID) as c FROM receivemessage WHERE ToID='$login' AND banstatus!='1'"));
$partner100Total=partner_match_count_100($con,$me);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
</head>
<body>
<?php include('header.php'); ?>
<style>
:root{--mvv-maroon:#6B1A1A;--mvv-saffron:#E8612A;--mvv-gold:#C9921A;--mvv-cream:#FFF8F0;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-page{min-height:60vh;padding-top:30px;padding-bottom:60px;background:linear-gradient(180deg,#fffaf5 0,#fff 360px);}
.mvv-container{max-width:1200px;margin:0 auto;padding:0 16px;}
.mvv-page-hero{background:linear-gradient(135deg,var(--mvv-maroon),#8B1A1A);padding:40px 0 30px;margin-bottom:32px;}
.mvv-page-hero h1{color:#fff;font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin:4px 0;text-align:center;}
.mvv-page-hero .mvv-eyebrow{text-align:center;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:2px;font-size:.8rem;font-weight:600;}
.mvv-page-hero p{text-align:center;color:rgba(255,255,255,.7);margin:0 0 8px;}
.mvv-profile-type-badge{display:flex;justify-content:center;margin:12px 0 5px;}
.mvv-profile-type-badge span{display:inline-flex;align-items:center;gap:7px;padding:6px 12px;border:1px solid rgba(255,255,255,.25);border-radius:999px;background:rgba(255,255,255,.12);color:#fff;font-size:.78rem;font-weight:700;letter-spacing:.02em;}
.mvv-breadcrumb{text-align:center;font-size:.85rem;}
.mvv-breadcrumb a{color:rgba(255,255,255,.7);text-decoration:none;}
.mvv-breadcrumb a:hover{color:#fff;}
.mvv-breadcrumb span{color:var(--mvv-gold);}
.mvv-section{padding:0 0 40px;}
.mvv-stat-row{display:flex;gap:12px;flex-wrap:wrap;justify-content:center;margin-bottom:32px;}
.mvv-stat-card{position:relative;overflow:hidden;flex:1;min-width:150px;max-width:200px;background:#fff;border:1px solid var(--mvv-border);border-radius:14px;padding:18px 12px;text-align:center;transition:.25s;text-decoration:none!important;display:block;color:inherit;}
.mvv-stat-card::before{content:"";position:absolute;inset:0 auto 0 0;width:3px;background:var(--mvv-saffron);}
.mvv-stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(107,26,26,.10);border-color:#d8b9ad;}
.mvv-stat-card .stat-icon{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;margin-bottom:6px;border-radius:9px;background:#fff2e8;color:var(--mvv-saffron);font-size:.82rem;}
.mvv-stat-card .num{font-size:1.8rem;font-weight:800;color:var(--mvv-maroon);line-height:1.2;}
.mvv-stat-card .lbl{font-size:.8rem;color:#666;font-weight:500;}
.mvv-dash-card{background:#fff;border:1px solid #eaded5;border-radius:16px;padding:20px;height:100%;box-shadow:0 5px 18px rgba(78,38,25,.045);transition:.25s;}
.mvv-dash-card:hover{box-shadow:0 8px 24px rgba(78,38,25,.08);}
.mvv-dash-card .card-head{display:flex;align-items:center;gap:10px;margin-bottom:14px;padding-bottom:10px;border-bottom:1px solid var(--mvv-border);}
.mvv-dash-card .card-head img{width:32px;height:32px;object-fit:contain;}
.mvv-dash-card .card-head h5{margin:0;font-weight:700;font-size:1rem;flex:1;}
.mvv-dash-card .card-head h5 a{color:var(--mvv-maroon);text-decoration:none;}
.mvv-dash-card .card-head h5 a i{font-size:.85rem;margin-left:4px;}
.mvv-dash-card .card-body{font-size:.88rem;color:#444;padding:0;}
.mvv-dash-card .card-body .row-line{display:grid;grid-template-columns:minmax(170px,210px) minmax(0,1fr);align-items:start;column-gap:24px;padding:10px 4px;border-bottom:1px dashed #eadfd6;}
.mvv-dash-card .card-body .row-line:last-child{border-bottom:0;}
.mvv-dash-card .card-body .row-line .lab{min-width:0;font-weight:700;color:#352326;line-height:1.5;}
.mvv-dash-card .card-body .row-line .val{min-width:0;color:#65575a;line-height:1.55;overflow-wrap:anywhere;}
.mvv-property-card{padding:24px;}
.mvv-property-card .card-head{margin-bottom:4px;}
.mvv-card-icon{display:inline-flex;align-items:center;justify-content:center;flex:0 0 38px;width:38px;height:38px;border-radius:10px;background:#fff1e8;color:var(--mvv-saffron);font-size:1.05rem;}
.mvv-nri-card .mvv-card-icon{background:#eaf5ff;color:#246b9b;}
.mvv-nri-card .card-head h5{color:var(--mvv-maroon);}
.mvv-value-tags{display:flex;flex-wrap:wrap;gap:7px;}
.mvv-value-tags>span{display:inline-flex;align-items:center;min-height:28px;padding:4px 10px;border:1px solid #ead8ca;border-radius:999px;background:#fff8f2;color:#6b3131;font-size:.8rem;font-weight:600;line-height:1.2;}
.mvv-empty-value{color:#998b8d;font-style:italic;}
.mvv-photo-wrap{text-align:center;}
.mvv-photo-wrap img{width:100%;max-width:260px;border-radius:14px;border:3px solid var(--mvv-cream);margin-bottom:12px;}
.mvv-btn{display:inline-block;padding:10px 24px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#8B1A1A;}
.mvv-btn-sm{padding:6px 16px;font-size:.8rem;}
.mvv-dashboard-tabs{display:flex;gap:8px;overflow-x:auto;padding:2px 0 8px;margin-bottom:20px;border-bottom:1px solid var(--mvv-border);scrollbar-width:thin;}
.mvv-dashboard-tab{flex:0 0 auto;border:1px solid var(--mvv-border);border-radius:8px;background:#fff;color:var(--mvv-maroon);padding:9px 14px;font-size:.88rem;font-weight:600;cursor:pointer;white-space:nowrap;transition:.2s;}
.mvv-dashboard-tab:hover,.mvv-dashboard-tab.is-active{background:var(--mvv-maroon);border-color:var(--mvv-maroon);color:#fff;}
.mvv-dashboard-panel{display:none;flex:0 0 100%;max-width:100%;}
.mvv-dashboard-panel.is-active{display:block;}
.mvv-personal-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:24px;align-items:start;}
.mvv-profile-photo-card{height:auto;position:sticky;top:20px;padding:24px;}
.mvv-profile-photo-card .mvv-photo-wrap{display:flex;flex-direction:column;align-items:center;width:100%;}
.mvv-profile-photo-card .mvv-photo-wrap img{display:block;width:min(100%,280px);max-width:280px;aspect-ratio:1;object-fit:cover;margin:0 auto 16px;}
.mvv-profile-photo-card .mvv-photo-wrap .mvv-btn{display:inline-flex;align-items:center;justify-content:center;}

@media (max-width: 767.98px){
  .mvv-page{padding-top:0;padding-bottom:36px;}
  .mvv-container{padding-left:12px;padding-right:12px;}
  .mvv-page-hero{min-height:auto;padding:22px 0 18px!important;margin-bottom:12px;background:linear-gradient(145deg,#fff5e9,#fffaf5)!important;border-bottom:1px solid #ecdcd0;box-shadow:0 6px 18px rgba(91,45,32,.06);}
  .mvv-page-hero .mvv-container{text-align:left!important;}
  .mvv-page-hero .mvv-eyebrow,.mvv-page-hero h1,.mvv-page-hero p,.mvv-page-hero .mvv-breadcrumb{text-align:left!important;}
  .mvv-page-hero .mvv-eyebrow{color:var(--mvv-saffron)!important;font-size:.68rem;letter-spacing:1.5px;}
  .mvv-page-hero h1{color:var(--mvv-maroon)!important;font-size:clamp(1.4rem,6vw,1.85rem)!important;line-height:1.18;margin-top:5px!important;overflow-wrap:anywhere;}
  .mvv-page-hero p{color:#755f5f!important;font-size:.82rem;padding:0;margin-top:6px!important;}
  .mvv-profile-type-badge{justify-content:flex-start;margin-top:10px;}
  .mvv-profile-type-badge span{border-color:#ead0c1;background:#fff;color:var(--mvv-maroon);box-shadow:0 3px 10px rgba(107,26,26,.05);}
  .mvv-page-hero .mvv-breadcrumb{margin-top:10px!important;font-size:.76rem;}
  .mvv-page-hero .mvv-breadcrumb a{color:var(--mvv-saffron);}
  .mvv-page-hero .mvv-breadcrumb span{color:#766568;}
  .mvv-stat-row{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:5px;margin-bottom:12px;}
  .mvv-stat-card{min-width:0;max-width:none;padding:5px 3px 6px;border-radius:9px;box-shadow:0 3px 10px rgba(78,38,25,.045);}
  .mvv-stat-card::before{inset:0 0 auto;width:auto;height:2px;}
  .mvv-stat-card:last-child{grid-column:auto;}
  .mvv-stat-card .stat-icon{width:20px;height:20px;margin-bottom:1px;border-radius:6px;font-size:.58rem;}
  .mvv-stat-card .num{font-size:1rem;line-height:1.05;}
  .mvv-stat-card .lbl{font-size:.61rem;line-height:1.12;}
  .mvv-dash-card{height:auto;padding:14px;border-radius:13px;box-shadow:0 4px 14px rgba(78,38,25,.055);}
  .mvv-personal-grid{grid-template-columns:1fr;gap:16px;}
  .mvv-profile-photo-card{position:static;padding:10px;}
  .mvv-profile-photo-card .mvv-photo-wrap{flex-direction:column;align-items:stretch;gap:10px;}
  .mvv-profile-photo-card .mvv-photo-wrap img{width:100%;max-width:none;margin:0;aspect-ratio:4/3;object-fit:cover;object-position:center;border-radius:11px;box-shadow:0 5px 15px rgba(76,35,23,.12);}
  .mvv-profile-photo-card .mvv-photo-wrap .mvv-btn{width:100%;padding:8px 14px;}
  .mvv-dash-card .card-head{gap:9px;margin-bottom:8px;padding-bottom:9px;}
  .mvv-dash-card .card-head img{width:28px;height:28px;}
  .mvv-dash-card .card-head h5{font-size:.92rem;}
  .mvv-card-icon{width:34px;height:34px;flex-basis:34px;}
  .mvv-dash-card .card-body{font-size:.82rem;}
  .mvv-dash-card .card-body .row-line{grid-template-columns:minmax(105px,38%) minmax(0,1fr);column-gap:10px;padding:8px 2px;}
  .mvv-dash-card .card-body .row-line .lab{min-width:0;}
  .mvv-dash-card .card-body .row-line .val{min-width:0;overflow-wrap:anywhere;}
  .mvv-property-card{padding:16px;}
  .mvv-profile-photo-card .mvv-photo-wrap img{max-width:none;}
  .mvv-dashboard-tabs{
    position:sticky;
    top:74px;
    z-index:900;
    width:auto;
    margin:0 -12px 16px;
    padding:10px 12px;
    gap:8px;
    overflow-x:auto;
    overflow-y:hidden;
    overscroll-behavior-inline:contain;
    scroll-snap-type:x proximity;
    scrollbar-width:none;
    -webkit-overflow-scrolling:touch;
    scroll-padding-inline:12px;
    background:rgba(255,249,240,.96);
    border-top:1px solid rgba(107,26,26,.08);
    border-bottom:1px solid var(--mvv-border);
    box-shadow:0 8px 22px rgba(79,35,25,.10);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
  }
  .mvv-dashboard-tabs::-webkit-scrollbar{display:none;}
  .mvv-dashboard-tab{
    min-height:38px;
    padding:8px 12px;
    font-size:.76rem;
    scroll-snap-align:start;
    touch-action:manipulation;
    line-height:1.2;
    box-shadow:0 2px 8px rgba(79,35,25,.05);
  }
  .mvv-dashboard-tab.is-active{
    background:linear-gradient(135deg,var(--mvv-maroon),#8B2230);
    box-shadow:0 6px 16px rgba(107,26,26,.22);
  }
  .mvv-dashboard-panel{display:none!important;width:100%!important;max-width:100%!important;flex:0 0 100%!important;padding-left:0!important;padding-right:0!important;}
  .mvv-dashboard-panel.is-active{display:block!important;}
  .mvv-section>.mvv-container>.row{display:block;margin-left:0;margin-right:0;}
  .mvv-dashboard-panel .mvv-dash-card{width:100%;max-width:100%;overflow:hidden;}
  #myModalss .modal-dialog{width:calc(100% - 24px);margin:90px auto 20px;}
  #myModalss .modal-body{max-height:55vh;overflow-y:auto;}
}

@media (max-width: 380px){
  .mvv-stat-row{grid-template-columns:repeat(2,minmax(0,1fr));}
  .mvv-dash-card .card-body .row-line{grid-template-columns:1fr;row-gap:3px;}
}
</style>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Dashboard</div>
      <h1>Welcome, <?php echo $me['Name']?:'User'; ?></h1>
      <p>Manage your profile and view your activity</p>
      <div class="mvv-profile-type-badge"><span><i class="fas <?php echo $isNriProfile ? 'fa-earth-americas' : 'fa-location-dot'; ?>"></i> <?php echo dashboardValue($profileLocationType); ?> Profile</span></div>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>Dashboard</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="mvv-dashboard-tabs" role="tablist" aria-label="Dashboard sections">
        <button class="mvv-dashboard-tab is-active" type="button" role="tab" aria-selected="true" aria-controls="dashboard-personal" data-dashboard-tab="dashboard-personal">Personal Details</button>
        <?php if ($isNriProfile) { ?><button class="mvv-dashboard-tab" type="button" role="tab" aria-selected="false" aria-controls="dashboard-nri" data-dashboard-tab="dashboard-nri"><i class="fas fa-earth-americas"></i> NRI Details</button><?php } ?>
        <button class="mvv-dashboard-tab" type="button" role="tab" aria-selected="false" aria-controls="dashboard-education" data-dashboard-tab="dashboard-education">Education &amp; Work</button>
        <button class="mvv-dashboard-tab" type="button" role="tab" aria-selected="false" aria-controls="dashboard-family" data-dashboard-tab="dashboard-family">Family</button>
        <button class="mvv-dashboard-tab" type="button" role="tab" aria-selected="false" aria-controls="dashboard-property" data-dashboard-tab="dashboard-property">Property &amp; Investments</button>
        <button class="mvv-dashboard-tab" type="button" role="tab" aria-selected="false" aria-controls="dashboard-horoscope" data-dashboard-tab="dashboard-horoscope">Horoscope</button>
        <button class="mvv-dashboard-tab" type="button" role="tab" aria-selected="false" aria-controls="dashboard-preference" data-dashboard-tab="dashboard-preference">Partner Preference</button>
      </div>

      <div class="mvv-stat-row">
        <a class="mvv-stat-card" href="partner_matches_100">
          <span class="stat-icon" aria-hidden="true"><i class="fas fa-bullseye"></i></span>
          <div class="num"><?php echo $partner100Total; ?></div>
          <div class="lbl">100% Matches</div>
        </a>
        <a class="mvv-stat-card" href="mutual_matches">
          <span class="stat-icon" aria-hidden="true"><i class="fas fa-handshake"></i></span>
          <div class="num"><?php echo (int)$match_total['c'] ?></div>
          <div class="lbl">Mutual Matches</div>
        </a>
        <a class="mvv-stat-card" href="who_shortlisted_me">
          <span class="stat-icon" aria-hidden="true"><i class="fas fa-bookmark"></i></span>
          <div class="num"><?php echo (int)$shortlist_total['c'] ?></div>
          <div class="lbl">New Shortlists</div>
        </a>
        <a class="mvv-stat-card" href="interest_received">
          <span class="stat-icon" aria-hidden="true"><i class="fas fa-heart"></i></span>
          <div class="num"><?php echo (int)$interest_total['c'] ?></div>
          <div class="lbl">New Interest</div>
        </a>
        <a class="mvv-stat-card" href="who_viewed_my_profile">
          <span class="stat-icon" aria-hidden="true"><i class="fas fa-eye"></i></span>
          <div class="num"><?php echo (int)$viewed_total['c'] ?></div>
          <div class="lbl">Profile Views</div>
        </a>
        <a class="mvv-stat-card" href="message_received">
          <span class="stat-icon" aria-hidden="true"><i class="fas fa-envelope"></i></span>
          <div class="num"><?php echo (int)$msg_total['c'] ?></div>
          <div class="lbl">Messages</div>
        </a>
      </div>

      <div class="row g-4">
        <div class="col-lg-4 col-md-6 mvv-dashboard-panel is-active" id="dashboard-personal" role="tabpanel">
          <div class="mvv-personal-grid">
          <div class="mvv-dash-card mvv-profile-photo-card">
            <div class="mvv-photo-wrap">
              <?php if($me['Photo1']==''||$me['Photo1']=='nophoto.jpg'){ ?>
                <img src="images/nophoto.jpg" alt="Default profile photo">
              <?php } else { ?>
                <img src="gallary/<?php echo htmlspecialchars($me['Photo1'], ENT_QUOTES, 'UTF-8'); ?>" alt="Profile photo" onerror="this.onerror=null;this.src='images/nophoto.jpg';">
              <?php } ?>
              <a href="upload_photo_gallary" class="mvv-btn primary mvv-btn-sm">Upload Photo</a>
            </div>
          </div>
          <div class="mvv-dash-card">
            <div class="card-head">
              <img src="icon/basic.png" alt="">
              <h5><a href="basic">Your Details <i class="fas fa-pencil-alt"></i></a></h5>
            </div>
            <div class="card-body">
              <div class="row-line"><span class="lab">Profile ID</span><span class="val"><?php echo $me['MatriID'] ?></span></div>
              <div class="row-line"><span class="lab">Profile Location</span><span class="val"><?php echo dashboardValue($profileLocationType) ?></span></div>
              <div class="row-line"><span class="lab">Name</span><span class="val"><?php echo $me['Name'] ?></span></div>
              <div class="row-line"><span class="lab">Gender</span><span class="val"><?php echo $me['Gender'] ?></span></div>
              <div class="row-line"><span class="lab">DOB</span><span class="val"><?php echo date("d-m-Y",strtotime($me['DOB'])) ?></span></div>
              <?php if($me['regno']) { ?><div class="row-line"><span class="lab">SMT No</span><span class="val"><?php echo $me['regno'] ?></span></div><?php } ?>
              <?php if($me['signdate']) { ?><div class="row-line"><span class="lab">Reg Date</span><span class="val"><?php echo $me['signdate'] ?></span></div><?php } ?>
              <div class="row-line"><span class="lab">Created By</span><span class="val"><?php echo $me['Profilecreatedby'] ?></span></div>
              <div class="row-line"><span class="lab">Marital Status</span><span class="val"><?php echo dashboardValue($me['Maritalstatus'] ?? '') ?></span></div>
              <?php if (($me['Maritalstatus'] ?? '') === 'Divorced') { ?>
              <div class="row-line"><span class="lab">No. of Children</span><span class="val"><?php echo dashboardValue($me['PE_HaveChildren'] ?? '') ?></span></div>
              <?php if (($me['PE_HaveChildren'] ?? '') !== 'None' && ($me['PE_HaveChildren'] ?? '') !== '') { ?>
              <div class="row-line"><span class="lab">Children Living</span><span class="val"><?php echo dashboardValue($me['childrenlivingstatus'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Child Acceptance</span><span class="val"><?php echo dashboardValue($me['child_acceptance'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Children Details</span><span class="val"><?php echo $childrenSummary ? htmlspecialchars(implode(' | ', $childrenSummary), ENT_QUOTES, 'UTF-8') : 'Not specified'; ?></span></div>
              <?php } ?>
              <?php } ?>
              <div class="row-line"><span class="lab">Religion</span><span class="val"><?php echo $me['Religion'] ?></span></div>
              <div class="row-line"><span class="lab">Caste</span><span class="val"><?php echo $me['Caste'] ?></span></div>
              <div class="row-line"><span class="lab">Mobile</span><span class="val"><?php echo $me['Mobile'] ?></span></div>
              <div class="row-line"><span class="lab">Alternate No</span><span class="val"><?php echo $me['Mobile2'] ?></span></div>
              <div class="row-line"><span class="lab">Residency</span><span class="val"><?php echo $me['Residencystatus'] ?></span></div>
              <div class="row-line"><span class="lab">Time To Call</span><span class="val"><?php echo $me['calling_time'] ?></span></div>
              <div class="row-line"><span class="lab">ID Proof</span><span class="val"><?php echo $me['idproof_approve']?:'No' ?></span></div>
              <div class="row-line"><span class="lab">Doc Proof</span><span class="val"><?php echo $me['docapprove']?:'No' ?></span></div>
              <div class="row-line"><span class="lab">Compatibility</span><span class="val"><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM compatibility WHERE MatriID='$login'"))?'Yes':'No' ?></span></div>
              <div class="row-line"><span class="lab">Email</span><span class="val"><?php echo $me['ConfirmEmail'] ?></span></div>
            </div>
          </div>
          </div>
        </div>

        <?php if ($isNriProfile) { ?>
        <div class="col-lg-4 col-md-6 mvv-dashboard-panel" id="dashboard-nri" role="tabpanel" hidden>
          <div class="mvv-dash-card mvv-property-card mvv-nri-card">
            <div class="card-head">
              <span class="mvv-card-icon" aria-hidden="true"><i class="fas fa-earth-americas"></i></span>
              <h5>NRI Profile Details</h5>
            </div>
            <div class="card-body">
              <div class="row-line"><span class="lab">NRI Type</span><span class="val"><?php echo dashboardValue($me['nri_type'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Citizenship</span><span class="val"><?php echo dashboardValue($me['nri_citizenship'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Current Country</span><span class="val"><?php echo dashboardValue($me['nri_current_country'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Current State / Province</span><span class="val"><?php echo dashboardValue($me['nri_current_state'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Current City</span><span class="val"><?php echo dashboardValue($me['nri_current_city'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Residency Status</span><span class="val"><?php echo dashboardValue($me['nri_residency_status'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Visa Type</span><span class="val"><?php echo dashboardValue($me['nri_visa_type'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Visa Expiry Date</span><span class="val"><?php echo dashboardValue($nriVisaExpiryDisplay) ?></span></div>
              <div class="row-line"><span class="lab">Years Living Abroad</span><span class="val"><?php echo dashboardValue($me['nri_years_abroad'] ?? '') ?><?php echo trim((string)($me['nri_years_abroad'] ?? '')) !== '' ? ' years' : ''; ?></span></div>
              <div class="row-line"><span class="lab">Overseas Mobile</span><span class="val"><?php echo dashboardValue($me['nri_overseas_mobile'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Income Currency</span><span class="val"><?php echo dashboardValue($me['nri_income_currency'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Willing to Relocate</span><span class="val"><?php echo dashboardValue($me['nri_willing_to_relocate'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Settlement Preference</span><span class="val"><?php echo dashboardValue($me['nri_settlement_preference'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Native Place in India</span><span class="val"><?php echo dashboardValue($me['nri_native_place'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Preferred Country After Marriage</span><span class="val"><?php echo dashboardValue($me['nri_preferred_country'] ?? '') ?></span></div>
            </div>
          </div>
        </div>
        <?php } ?>

        <div class="col-lg-4 col-md-6 mvv-dashboard-panel" id="dashboard-education" role="tabpanel" hidden>
          <div class="mvv-dash-card">
            <div class="card-head">
              <img src="icon/education.png" alt="">
              <h5><a href="education">Education Details <i class="fas fa-pencil-alt"></i></a></h5>
            </div>
            <div class="card-body">
              <div class="row-line"><span class="lab">Education</span><span class="val"><?php echo $me['Education'] ?></span></div>
              <div class="row-line"><span class="lab">IIT/IIM/NIT</span><span class="val"><?php echo $me['iit'] ?></span></div>
              <div class="row-line"><span class="lab">Institute</span><span class="val"><?php echo $me['instu'] ?></span></div>
              <div class="row-line"><span class="lab">Occupation</span><span class="val"><?php echo $me['Occupation'] ?></span></div>
              <div class="row-line"><span class="lab">Edu Details</span><span class="val"><?php echo $me['EducationDetails'] ?></span></div>
              <div class="row-line"><span class="lab">Occu Details</span><span class="val"><?php echo $me['occu_details'] ?></span></div>
              <div class="row-line"><span class="lab">Employed In</span><span class="val"><?php echo $me['Employedin'] ?></span></div>
              <div class="row-line"><span class="lab">Annual Income</span><span class="val"><?php echo htmlspecialchars(annual_income_format($me['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span></div>
              <div class="row-line"><span class="lab">Working Hours</span><span class="val"><?php echo $me['working_hours'] ?></span></div>
              <div class="row-line"><span class="lab">Work Location</span><span class="val"><?php echo $me['workinglocation'] ?></span></div>
              <div class="row-line"><span class="lab">Height</span><span class="val"><?php echo $heightMap[$me['Height']]??$me['Height'] ?></span></div>
              <div class="row-line"><span class="lab">Weight</span><span class="val"><?php echo $me['Weight'] ?> Kg</span></div>
              <div class="row-line"><span class="lab">Blood Group</span><span class="val"><?php echo $me['BloodGroup'] ?></span></div>
              <div class="row-line"><span class="lab">Special Cases</span><span class="val"><?php echo $me['spe_cases'] ?></span></div>
              <?php if($me['spe_cases']!='None'&&$me['spe_cases']!=''){ ?><div class="row-line"><span class="lab">Reason</span><span class="val"><?php echo $me['spe_reason'] ?></span></div><?php } ?>
              <div class="row-line"><span class="lab">Complexion</span><span class="val"><?php echo $me['Complexion'] ?></span></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mvv-dashboard-panel" id="dashboard-family" role="tabpanel" hidden>
          <div class="mvv-dash-card">
            <div class="card-head">
              <img src="icon/family.png" alt="">
              <h5><a href="family?flag=1">Family Details <i class="fas fa-pencil-alt"></i></a></h5>
            </div>
            <div class="card-body">
              <div class="row-line"><span class="lab">Family Values</span><span class="val"><?php echo $me['Familyvalues'] ?></span></div>
              <div class="row-line"><span class="lab">Family Status</span><span class="val"><?php echo $me['FamilyStatus'] ?></span></div>
              <div class="row-line"><span class="lab">Brothers</span><span class="val"><?php echo $me['noofbrothers'] ?> (<?php echo $me['nbm'] ?> Married)</span></div>
              <div class="row-line"><span class="lab">Sisters</span><span class="val"><?php echo $me['noofsisters'] ?> (<?php echo $me['nsm'] ?> Married)</span></div>
              <div class="row-line"><span class="lab">Mother Tongue</span><span class="val"><?php echo $me['mother_tounge'] ?></span></div>
              <div class="row-line"><span class="lab">Family Type</span><span class="val"><?php echo $me['FamilyType'] ?></span></div>
              <div class="row-line"><span class="lab">Father Name</span><span class="val"><?php echo $me['Fathername'] ?></span></div>
              <div class="row-line"><span class="lab">Father Occu</span><span class="val"><?php echo $me['Fathersoccupation'] ?></span></div>
              <div class="row-line"><span class="lab">Mother Name</span><span class="val"><?php echo $me['Mothersname'] ?></span></div>
              <div class="row-line"><span class="lab">Mother Occu</span><span class="val"><?php echo $me['Mothersoccupation'] ?></span></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mvv-dashboard-panel" id="dashboard-property" role="tabpanel" hidden>
          <div class="mvv-dash-card mvv-property-card">
            <div class="card-head">
              <span class="mvv-card-icon" aria-hidden="true"><i class="fas fa-house-chimney"></i></span>
              <h5><a href="family?flag=1">Property Details <i class="fas fa-pencil-alt"></i></a></h5>
            </div>
            <div class="card-body">
              <div class="row-line"><span class="lab">Properties Owned</span><span class="val"><?php echo dashboardTags($me['property_types'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Property Details</span><span class="val"><?php echo dashboardValue($me['property_details'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Investments</span><span class="val"><?php echo dashboardTags($me['investment_types'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Investment Details</span><span class="val"><?php echo dashboardValue($me['investment_details'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Monthly Rental Income</span><span class="val"><?php echo dashboardValue($monthlyRentalIncomeDisplay) ?></span></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mvv-dashboard-panel" id="dashboard-horoscope" role="tabpanel" hidden>
          <div class="mvv-dash-card">
            <div class="card-head">
              <img src="icon/horocope.png" alt="">
              <h5><a href="horoscope">Horoscope Details <i class="fas fa-pencil-alt"></i></a></h5>
            </div>
            <div class="card-body">
              <div class="row-line"><span class="lab">Moonsign</span><span class="val"><?php echo $me['Moonsign'] ?></span></div>
              <div class="row-line"><span class="lab">Star</span><span class="val"><?php echo $me['Star'] ?></span></div>
              <div class="row-line"><span class="lab">Gan</span><span class="val"><?php echo $me['Gan'] ?></span></div>
              <div class="row-line"><span class="lab">Nadi</span><span class="val"><?php echo $me['nadi'] ?></span></div>
              <div class="row-line"><span class="lab">Devak</span><span class="val"><?php echo $me['devak'] ?></span></div>
              <div class="row-line"><span class="lab">Horo Match</span><span class="val"><?php echo $me['Horosmatch'] ?></span></div>
              <div class="row-line"><span class="lab">Manglik</span><span class="val"><?php echo $me['Manglik'] ?></span></div>
              <div class="row-line"><span class="lab">Gotra</span><span class="val"><?php echo $me['Gothram'] ?></span></div>
              <div class="row-line"><span class="lab">Place of Birth</span><span class="val"><?php echo $me['POB'] ?></span></div>
              <div class="row-line"><span class="lab">Birth Country</span><span class="val"><?php echo $me['POC'] ?></span></div>
              <div class="row-line"><span class="lab">Time of Birth</span><span class="val"><?php echo $me['TOB'] ?></span></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mvv-dashboard-panel" id="dashboard-preference" role="tabpanel" hidden>
          <div class="mvv-dash-card">
            <div class="card-head">
              <img src="icon/matches.png" alt="">
              <h5><a href="partner_prefrence">Partner Preference <i class="fas fa-pencil-alt"></i></a></h5>
            </div>
            <div class="card-body">
              <div class="row-line"><span class="lab">Looking For</span><span class="val"><?php echo $me['Looking'] ?></span></div>
              <div class="row-line"><span class="lab">Religion</span><span class="val"><?php echo $me['PE_Religion'] ?></span></div>
              <div class="row-line"><span class="lab">Occupation</span><span class="val"><?php echo $me['PE_Occupation'] ?></span></div>
              <div class="row-line"><span class="lab">Country</span><span class="val"><?php echo $me['PE_Countrylivingin'] ?></span></div>
              <div class="row-line"><span class="lab">Age</span><span class="val"><?php echo $me['PE_FromAge'] ?> - <?php echo $me['PE_ToAge'] ?> Yrs</span></div>
              <div class="row-line"><span class="lab">Caste</span><span class="val"><?php echo $me['PE_Caste'] ?></span></div>
              <div class="row-line"><span class="lab">Education</span><span class="val"><?php echo $me['PE_Education'] ?></span></div>
              <div class="row-line"><span class="lab">State</span><span class="val"><?php echo $me['PE_State'] ?></span></div>
              <div class="row-line"><span class="lab">District</span><span class="val"><?php echo dashboardValue($me['PE_District'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Taluka</span><span class="val"><?php echo dashboardValue($me['PE_Taluka'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">City</span><span class="val"><?php echo dashboardValue($me['PE_City'] ?? '') ?></span></div>
              <div class="row-line"><span class="lab">Annual Income</span><span class="val"><?php echo htmlspecialchars(annual_income_format($me['PE_income_from'] ?? '', 'Not specified'), ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlspecialchars(annual_income_format($me['PE_income_to'] ?? '', 'Not specified'), ENT_QUOTES, 'UTF-8'); ?></span></div>
              <div class="row-line"><span class="lab">Height</span><span class="val"><?php echo ($heightMap[$me['PE_from_Height']]??$me['PE_from_Height']).' - '.($heightMap[$me['PE_to_Height']]??$me['PE_to_Height']) ?></span></div>
              <div class="row-line"><span class="lab">Complexion</span><span class="val"><?php echo $me['PE_Complexion'] ?></span></div>
              <div class="row-line"><span class="lab">Resident Status</span><span class="val"><?php echo $me['PE_Residentstatus'] ?></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer.php'); ?>

<div class="modal fade" id="myModalss" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius:12px;">
      <div class="modal-header" style="background:var(--mvv-maroon);color:#fff;border-radius:12px 12px 0 0;">
        <button type="button" class="close dashboard-reminder-close" data-bs-dismiss="modal" aria-label="Close" style="color:#fff;opacity:.8;">&times;</button>
        <h4 class="modal-title" style="color:#fff;font-weight:600;">Reminder</h4>
      </div>
      <div class="modal-body" style="padding:20px;">
        <?php
        $q1f=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM emailverify WHERE MatriID='$login'"));
        if(($q1f['verification']??'')=='No'||($q1f['verification']??'')==''){ ?>
          <a href="verifycode" style="color:var(--mvv-maroon);text-decoration:none;display:block;margin-bottom:8px;"><i class="fa fa-envelope" style="margin-right:8px;"></i> Please Verify Your Email Account</a>
        <?php }
        if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM compatibility WHERE MatriID='$login'"))=='0'){ ?>
          <a href="compability" style="color:var(--mvv-maroon);text-decoration:none;display:block;margin-bottom:8px;"><i class="fa fa-check-square" style="margin-right:8px;"></i> Please Update Your Compatibility</a>
        <?php }
        if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM register WHERE MatriID='$login' AND Photo1!='nophoto.jpg' AND Photo1!=''"))=='0'){ ?>
          <a href="upload_photo_gallary" style="color:var(--mvv-maroon);text-decoration:none;display:block;margin-bottom:8px;"><i class="fa fa-file-image" style="margin-right:8px;"></i> Please Update Your Profile Photo</a>
        <?php }
        $q4f=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM register WHERE MatriID='$login'"));
        if(!($q4f['memtype']!='Free'&&$q4f['Noofcontacts']>0&&strtotime($q4f['MemshipExpiryDate']??'')>strtotime(date('Y-m-d')))){ ?>
          <a href="my_offer" style="color:var(--mvv-maroon);text-decoration:none;display:block;margin-bottom:8px;"><i class="fa fa-credit-card" style="margin-right:8px;"></i> Your Membership Plan status is <b><?php echo $q4f['memtype'] ?? 'Free' ?></b>. Upgrade it Now.</a>
        <?php } ?>
      </div>
      <div class="modal-footer" style="padding:12px 20px;">
        <button type="button" class="mvv-btn primary dashboard-reminder-close" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
document.querySelectorAll('[data-dashboard-tab]').forEach(function(tab) {
  tab.addEventListener('click', function() {
    var targetId = tab.getAttribute('data-dashboard-tab');
    document.querySelectorAll('[data-dashboard-tab]').forEach(function(item) {
      var isActive = item === tab;
      item.classList.toggle('is-active', isActive);
      item.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });
    document.querySelectorAll('.mvv-dashboard-panel').forEach(function(panel) {
      var isActive = panel.id === targetId;
      panel.classList.toggle('is-active', isActive);
      panel.hidden = !isActive;
    });
    if (window.innerWidth <= 767.98) {
      var tabs = tab.parentElement;
      var left = tab.offsetLeft - (tabs.clientWidth - tab.offsetWidth) / 2;
      tabs.scrollTo({ left: Math.max(0, left), behavior: 'smooth' });
    }
  });
});

document.querySelector('.mvv-dashboard-tabs')?.addEventListener('keydown', function(event) {
  if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
  var tabs = Array.from(this.querySelectorAll('[data-dashboard-tab]'));
  var current = tabs.indexOf(document.activeElement);
  if (current < 0) current = tabs.findIndex(function(tab) { return tab.classList.contains('is-active'); });
  var next = event.key === 'ArrowRight' ? Math.min(tabs.length - 1, current + 1) : Math.max(0, current - 1);
  event.preventDefault();
  tabs[next].focus();
  tabs[next].click();
});

function closeDashboardReminder()
{
  var modal = document.getElementById('myModalss');
  if (!modal) {
    return;
  }

  if (window.bootstrap && bootstrap.Modal) {
    var modalInstance = bootstrap.Modal.getInstance(modal);
    if (modalInstance) {
      modalInstance.hide();
      return;
    }
  }

  modal.classList.remove('show');
  modal.style.display = 'none';
  modal.setAttribute('aria-hidden', 'true');
  modal.removeAttribute('aria-modal');
  document.body.classList.remove('modal-open');
  document.body.style.removeProperty('overflow');
  document.body.style.removeProperty('padding-right');
  document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
    backdrop.remove();
  });
}

window.addEventListener('load', function() {
  var modal = document.getElementById('myModalss');
  if (!modal) {
    return;
  }

  if (window.bootstrap && bootstrap.Modal) {
    bootstrap.Modal.getOrCreateInstance(modal).show();
  } else if (window.jQuery && jQuery.fn.modal) {
    jQuery(modal).modal('show');
  } else {
    modal.style.display = 'block';
    modal.classList.add('show');
    modal.removeAttribute('aria-hidden');
    document.body.classList.add('modal-open');
  }
});

document.addEventListener('click', function(e) {
  if (e.target.closest('.dashboard-reminder-close')) {
    closeDashboardReminder();
  }
});
</script>
</body>
</html>
