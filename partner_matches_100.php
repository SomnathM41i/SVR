<?php
require_once('sys_dbconnection.php');
include_once('memprotect.php');
require_once('includes/partner_match.php');

$login = $_SESSION['MatriID'] ?? $_SESSION['matriid'] ?? '';
$viewerQuery = mysqli_prepare($con, 'SELECT * FROM register WHERE MatriID=? LIMIT 1');
mysqli_stmt_bind_param($viewerQuery, 's', $login);
mysqli_stmt_execute($viewerQuery);
$viewer = mysqli_fetch_assoc(mysqli_stmt_get_result($viewerQuery)) ?: [];
mysqli_stmt_close($viewerQuery);

$oppositeGender = ($viewer['Gender'] ?? '') === 'Male' ? 'Female' : 'Male';
$profilesQuery = mysqli_prepare($con, "SELECT r.* FROM register r WHERE r.MatriID<>? AND r.Gender=? AND r.visibility<>'hidden' AND r.Status NOT IN('Banned','InActive') AND NOT EXISTS (SELECT 1 FROM block_member b WHERE (b.matriid=? AND b.profile_id=r.MatriID) OR (b.profile_id=? AND b.matriid=r.MatriID)) ORDER BY r.Regdate DESC");
mysqli_stmt_bind_param($profilesQuery, 'ssss', $login, $oppositeGender, $login, $login);
mysqli_stmt_execute($profilesQuery);
$profilesResult = mysqli_stmt_get_result($profilesQuery);
$matches = [];
while ($profile = mysqli_fetch_assoc($profilesResult)) {
    $score = partner_match_score($viewer, $profile);
    if ($score['is_100'] && partner_match_is_child_accepted($viewer, $profile)) $matches[] = $profile;
}
mysqli_stmt_close($profilesQuery);

$perPage = 12;
$page = max(1, (int)($_GET['page'] ?? 1));
$totalPages = max(1, (int)ceil(count($matches) / $perPage));
$page = min($page, $totalPages);
$pageMatches = array_slice($matches, ($page - 1) * $perPage, $perPage);
$heightMap=[1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>100% Partner Matches - Shivraj Maratha</title><link rel="icon" href="css3/assets/shivraj-logo.png"><link rel="stylesheet" href="css3/Style.css"><link rel="stylesheet" href="css3/mvv-premium.css"><style>
.match-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:22px}.match-card{overflow:hidden;border:1px solid var(--mvv-border);border-radius:14px;background:#fff;box-shadow:0 8px 24px rgba(58,42,34,.06)}.match-photo{width:100%;height:260px;object-fit:cover;background:#fff8f0}.match-body{padding:16px}.perfect-badge{display:inline-flex;margin-bottom:9px;padding:6px 10px;border-radius:999px;background:#e8f7ed;color:#24653a;font-size:.75rem;font-weight:800}.match-body h3{margin:0 0 7px;font-size:1.05rem}.match-body h3 a{color:var(--mvv-maroon);text-decoration:none}.match-meta{color:var(--mvv-muted);font-size:.85rem;line-height:1.55}.empty-state{padding:45px;text-align:center;border:1px solid var(--mvv-border);background:#fff}.empty-state h2{color:var(--mvv-maroon)}.pager{display:flex;justify-content:center;gap:8px;margin-top:28px}.pager a{padding:8px 12px;border:1px solid var(--mvv-border);border-radius:7px;color:var(--mvv-maroon);text-decoration:none}.pager a.active{background:var(--mvv-maroon);color:#fff}@media(max-width:1000px){.match-grid{grid-template-columns:repeat(3,1fr)}}@media(max-width:760px){.match-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:480px){.match-grid{grid-template-columns:1fr}.match-photo{height:300px}}
</style></head><body><?php include('header.php'); ?><main class="mvv-page"><section class="mvv-page-hero"><div class="mvv-container"><div class="mvv-eyebrow">Matches</div><h1>100% Partner Matches</h1><p>Profiles matching all 10 of your partner preferences.</p><nav class="mvv-breadcrumb"><a href="index_dashboard">Dashboard</a><span>100% Matches</span></nav></div></section><section class="mvv-section"><div class="mvv-container">
<?php if (!$pageMatches) { ?><div class="empty-state"><h2>No 100% matches yet</h2><p>Complete all partner preferences—including district, city and annual income—to qualify profiles for a 10/10 match.</p><a class="mvv-btn mvv-btn-primary" href="partner_prefrence">Update Partner Preferences</a></div><?php } else { ?><div class="match-grid">
<?php foreach($pageMatches as $profile){ $encoded=urlencode(base64_encode($profile['MatriID'])); $photo='images/nophoto.jpg'; $pv=$profile['photo_visibility']??''; $pa=($profile['Photo1Approve']??'')==='Yes'; $p1=!empty($profile['Photo1']) && $profile['Photo1']!=='nophoto.jpg'; if($p1 && $pa){if($pv==='allphoto') $photo='photoprocess.php?image=gallary/'.$profile['Photo1'].'&square=500'; elseif($pv==='paidphoto' && ($viewer['Status']??'')==='Paid') $photo='photoprocess.php?image=gallary/'.$profile['Photo1'].'&square=500';} $waMLoc=implode(', ', array_filter([$profile['City']??'', $profile['Taluka']??'', $profile['Dist']??''])); $waMUrl=$baseUrl.'public_profile?id='.$encoded; $waML=[]; $waML[]=$waMUrl; $waML[]=''; $waML[]="\u{1F496} Check out this Matrimony Profile!"; $waML[]="\u{1F194} Profile ID: {$profile['MatriID']}"; $waML[]="\u{1F382} Age: ".(int)$profile['Age'].' years'; if(!empty($profile['Education'])) $waML[]="\u{1F393} Education: {$profile['Education']}"; if(!empty($profile['Occupation'])) $waML[]="\u{1F4BC} Occupation: {$profile['Occupation']}"; if(!empty($heightMap[(int)$profile['Height']])) $waML[]="\u{1F4CF} Height: {$heightMap[(int)$profile['Height']]}"; if(!empty($waMLoc)) $waML[]="\u{1F4CD} Location: $waMLoc"; if(!empty($profile['Maritalstatus'])) $waML[]="\u{1F48D} Marital Status: {$profile['Maritalstatus']}"; $waML[]=''; $waML[]="Find your perfect life partner today \u{2764}\u{FE0F}"; $waUrl='https://api.whatsapp.com/send?text='.rawurlencode(implode("\n", $waML)); ?>
<article class="match-card"><a href="full_profile?id=<?php echo $encoded; ?>"><img class="match-photo" src="<?php echo htmlspecialchars($photo); ?>" alt="Profile photo" onerror="this.src='images/nophoto.jpg'"></a><div class="match-body"><span class="perfect-badge">100% Preferences Match</span><h3><a href="full_profile?id=<?php echo $encoded; ?>"><?php echo htmlspecialchars($profile['MatriID']); ?></a></h3><div class="match-meta"><?php echo htmlspecialchars($profile['Education'] ?: 'Education not specified'); ?><br><?php echo htmlspecialchars($profile['Occupation'] ?: 'Occupation not specified'); ?><br><?php echo (int)$profile['Age']; ?> years, <?php echo htmlspecialchars($heightMap[$profile['Height']] ?? ''); ?><br><?php echo htmlspecialchars(implode(', ', array_filter([$profile['City'] ?? '', $profile['Taluka'] ?? '', $profile['Dist'] ?? '']))); ?></div><a class="wa-share-btn" href="<?php echo htmlspecialchars($waUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" style="width:100%;justify-content:center;margin-top:10px"><i class="fab fa-whatsapp"></i> Share</a></div></article>
<?php } ?></div><?php if($totalPages>1){ ?><nav class="pager"><?php for($i=1;$i<=$totalPages;$i++){ ?><a class="<?php echo $i===$page?'active':''; ?>" href="partner_matches_100?page=<?php echo $i; ?>"><?php echo $i; ?></a><?php } ?></nav><?php } ?><?php } ?>
</div></section></main><?php include('footer3.php'); ?></body></html>
