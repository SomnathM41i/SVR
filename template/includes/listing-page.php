<?php
require 'header.php';
$heading=$listingTitle;require 'page-hero.php';
$filtered=array_values(array_filter($profiles,fn($p)=>$p['gender']===$listingGender&&$p['status']===$listingStatus));
?>
<section class="section"><div class="container listing-layout"><aside class="filter-panel"><h2>Filter Profiles</h2><form id="profileFilter"><div class="field"><label for="filterCity">Work City</label><select name="city" id="filterCity"><option value="">All cities</option><option>Pune</option><option>Mumbai</option><option>Satara</option></select></div><div class="field"><label for="filterCaste">Caste</label><select name="caste" id="filterCaste"><option value="">All</option><option>96 KULI</option><option>MARATHA</option></select></div><div class="field"><label for="taluka">Native Taluka</label><select id="taluka"><option>All talukas</option><option>Karad</option><option>Wai</option><option>Javali</option></select></div><button class="btn" type="button">Apply Filters</button></form></aside><div><div class="listing-head"><div><span class="section-kicker">Verified biodata</span><h2 class="section-title"><?= htmlspecialchars($listingTitle) ?></h2></div><p><?= count($filtered) ?> profiles found</p></div><div class="listing-grid"><?php foreach($filtered as $profile) require 'profile-card.php'; ?></div></div></div></section>
<?php require 'footer.php'; ?>
