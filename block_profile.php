<?php
require_once('includes/bootstrap.php');
include_once('memprotect.php');
include_once('siteconfig.php');
error_reporting(0);
$limit = 8;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;
$heightMap = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profile I Have Blocked</title>
  <link rel="icon" type="image/png" sizes="32x32" href="branding/favicons/icon-32.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css?v=activities-ui" />
  <style>
    .mvv-page-hero h1 { text-transform:none; }
  </style>
</head>
<body>
<?php include('header.php'); ?>
<link href="css3/activities-ui.css?v=activities-ui-2" rel="stylesheet">

<?php
$sql="select profile_id,when1 from block_member where matriid='$login' and banstatus!='1' LIMIT $start_from, $limit";
$sql1="SELECT COUNT(*) FROM block_member where matriid='$login' and banstatus!='1'";
$rs_result1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_row($rs_result1);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$result1=mysqli_query($con,$sql);
if(mysqli_num_rows($result1)>0) { ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Activities</div>
      <h1>Profile I Have Blocked</h1>
      <p>अवरोधित प्रोफाइल</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Profile I Have Blocked</span>
      </nav>
    </div>
  </section>

<section class="mvv-section">
  <div class="mvv-container">
    <div class="mvv-activity-grid">
      <?php
      while($recs = mysqli_fetch_array($result1)) {
        $s=mysqli_query($con,"select * from register where MatriID='".$recs['profile_id']."'");
        while($rec=mysqli_fetch_array($s)) {
          $encrypt = urlencode( base64_encode( $rec['MatriID'] ) );
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
            <div style="font-size:0.8rem;color:var(--mvv-muted);margin-top:4px;">Date: <?php echo $recs['when1'];?></div>
          </div>
          <div class="mvv-card-actions">
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Profile"><i class="fas fa-user"></i></a>
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Shortlist"><i class="fas fa-heart"></i></a>
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Message"><i class="fas fa-comment-dots"></i></a>
            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank" title="Connect"><i class="fas fa-user-plus"></i></a>
          </div>
        </div>
      </div>
      <?php } } ?>
    </div>
    <?php if($total_pages>1) { ?>
    <div style="text-align:center;margin-top:30px;">
      <ul class="mvv-pagination">
        <li class="mvv-page-info">Page <?php echo $page?> of <?php echo $total_pages?></li>
        <?php if($page>1){ ?><li><a href="block_profile?page=<?php echo ($page-1)?>"><i class="bi bi-chevron-left"></i></a></li><?php } ?>
        <?php for($i=1;$i<=$total_pages;$i++){ ?>
          <li<?php echo ($i==$page)?' class="active"':''?>>
            <?php if($i==$page){ ?><span><?php echo $i?></span><?php }else{ ?><a href="block_profile?page=<?php echo $i?>"><?php echo $i?></a><?php } ?>
          </li>
        <?php } ?>
        <?php if($page<$total_pages){ ?><li><a href="block_profile?page=<?php echo ($page+1)?>"><i class="bi bi-chevron-right"></i></a></li><?php } ?>
      </ul>
    </div>
    <?php } ?>
  </div>
</section>
<?php } else { ?>
<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Activities</div>
      <h1>Profile I Have Blocked</h1>
      <p>अवरोधित प्रोफाइल</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Profile I Have Blocked</span>
      </nav>
    </div>
  </section>
  <section class="mvv-section">
    <div class="mvv-container">
      <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:3rem;font-weight:900;color:var(--mvv-maroon);opacity:0.3;margin-bottom:10px;">OOP'S</div>
        <h3 style="color:#888;">Sorry Result Not Found</h3>
        <p style="color:#999;">Not yet blocked any profiles.</p>
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
