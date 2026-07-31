<?php
require_once('sys_dbconnection.php');
include_once('memprotect.php');
error_reporting(0);
$limit = 8;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;
$heightMap = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Viewed Contact List</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css?v=activities-ui" rel="stylesheet">
<link rel="shortcut icon" href="css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="icon" href="css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
.mvv-page-hero h1 { text-transform:none; }
</style>
</head>
<body>
<?php include('header.php')?>
<link href="css3/activities-ui.css?v=activities-ui-2" rel="stylesheet">

<?php
$exclSql = $excl ? " AND whom1 NOT IN($excl)" : '';
$sqlview=mysqli_query($con,"SELECT * FROM viewedaddress where who1='$login' $exclSql and banstatus!='1' LIMIT $start_from, $limit");
$sql1="SELECT COUNT(*) FROM viewedaddress where who1='$login' $exclSql and banstatus!='1'";
$rs_result1=mysqli_query($con,$sql1);
$row=mysqli_fetch_row($rs_result1);
$total_records=$row[0];
$total_pages=ceil($total_records / $limit);
if(mysqli_num_rows($sqlview)>0) { ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Activities</div>
      <h1>Viewed Contact List</h1>
      <p>तुम्ही पाहिलेले संपर्क</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Viewed Contact List</span>
      </nav>
    </div>
  </section>

<section class="mvv-section">
  <div class="mvv-container">
    <div class="mvv-activity-grid">
      <?php
      while($rowview=mysqli_fetch_array($sqlview)) {
        $whom=$rowview['whom1'];
        $sqldata=mysqli_query($con,"select * from register where matriid='$whom'");
        $rec=mysqli_fetch_array($sqldata);
        $is_block=mysqli_query($con,"select *from block_member where matriid='$login' AND profile_id='".$rowview['whom1']."'");
        if(mysqli_num_rows($is_block)==1) continue;
        $encrypt=urlencode(base64_encode($rec['MatriID']));
        $imgSrc='images/nophoto.jpg';
        if($rec['photo_visibility']=='paidphoto' && $rec['Photo1Approve']=='Yes' && $me['Status']=='Paid' && $rec['Photo1']!='nophoto.jpg')
          $imgSrc='photoprocess.php?image=gallary/'.$rec['Photo1'].'&square=500';
        elseif($rec['photo_visibility']=='allphoto' && $rec['Photo1Approve']=='Yes' && $rec['Photo1']!='nophoto.jpg')
          $imgSrc='photoprocess.php?image=gallary/'.$rec['Photo1'].'&square=500';
      ?>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="mvv-match-card">
          <a href="full_profile?id=<?php echo $encrypt?>" target="_blank">
            <img class="mvv-card-img" src="<?php echo $imgSrc ?>" alt="" loading="lazy">
          </a>
          <div class="mvv-card-body">
            <h5><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><?php echo $rec['MatriID']?></a></h5>
            <div class="mvv-card-meta">
              <?php echo substr($rec['Education'],0,20) ?><br>
              <?php echo substr($rec['Occupation'],0,20) ?><br>
              <?php echo $rec['Age'] ?> Yrs, <?php echo $heightMap[$rec['Height']]??''; ?>
            </div>
          </div>
          <div class="mvv-card-actions">
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Profile"><i class="fas fa-user"></i></a>
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Shortlist"><i class="fas fa-heart"></i></a>
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Message"><i class="fas fa-comment-dots"></i></a>
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Connect"><i class="fas fa-user-plus"></i></a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php if($total_pages>1) { ?>
    <div style="text-align:center;margin-top:30px;">
      <ul class="mvv-pagination">
        <li class="mvv-page-info">Page <?php echo $page?> of <?php echo $total_pages?></li>
        <?php if($page>1){ ?><li><a href="viewed_address?page=<?php echo ($page-1)?>"><i class="bi bi-chevron-left"></i></a></li><?php } ?>
        <?php for($i=1;$i<=$total_pages;$i++){ ?>
          <li<?php echo ($i==$page)?' class="active"':''?>>
            <?php if($i==$page){ ?><span><?php echo $i?></span><?php }else{ ?><a href="viewed_address?page=<?php echo $i?>"><?php echo $i?></a><?php } ?>
          </li>
        <?php } ?>
        <?php if($page<$total_pages){ ?><li><a href="viewed_address?page=<?php echo ($page+1)?>"><i class="bi bi-chevron-right"></i></a></li><?php } ?>
      </ul>
    </div>
    <?php } ?>
  </div>
</section>

<div class="mvv-section" style="padding-top:10px;">
  <div class="mvv-container">
    <?php
    $paid_status = mysqli_fetch_array(mysqli_query($con,"SELECT Status FROM register WHERE matriid='$login'"));
    if($paid_status['Status']=='Free') {
      $my_offer = mysqli_query($con,"SELECT * FROM offer WHERE status='Active'");
      while($offer=mysqli_fetch_array($my_offer)) { ?>
        <div class="pricing-block-three" style="margin-top:20px;">
          <div class="inner-box" style="max-width:600px;margin:0 auto;background:#fff;border-radius:12px;padding:27px 20px;text-align:center;box-shadow:0 0 30px rgba(0,0,0,0.1);">
            <h4><?php echo $offer['title']?></h4>
            <p><?php echo $offer['description']?></p>
            <a href="my_offer" class="mvv-btn primary" style="margin-top:10px;">View Offer</a>
          </div>
        </div>
    <?php } } ?>
  </div>
</div>

<?php } else { ?>
<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Activities</div>
      <h1>Viewed Contact List</h1>
      <p>तुम्ही पाहिलेले संपर्क</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Viewed Contact List</span>
      </nav>
    </div>
  </section>
  <section class="mvv-section">
    <div class="mvv-container">
      <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:3rem;font-weight:900;color:var(--mvv-maroon);opacity:0.3;margin-bottom:10px;">OOP'S</div>
        <h3 style="color:#888;">Sorry Result Not Found</h3>
        <p style="color:#999;">No viewed contacts yet.</p>
        <a href="smart_search" class="mvv-btn primary" style="margin-top:10px;">Search</a>
      </div>
    </div>
  </section>
<?php } ?>
</main>

<?php include('footer3.php')?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
