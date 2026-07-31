<?php
require_once('includes/bootstrap.php');
include_once('memprotect.php');
 //include_once('siteconfig.php');
 //include_once('dbconnectadmin.php');
$from = 0;
$max_results = 10; 
$sender=$_SESSION['matriid'];

$receiver=$_GET['id'];

$sender_sql=mysqli_query($con,"select * from  register where MatriID='$receiver'");
$sender_info=mysqli_fetch_array($sender_sql);

$mem_sql=mysqli_query($con,"select * from  register where MatriID='$sender'");
$mem_info=mysqli_fetch_array($mem_sql);

$strid = $_SESSION['matriid'];
$chat = mysqli_query($con,"SELECT * FROM receivemessage WHERE ToID IN('$strid','$sender') order by rid DESC LIMIT $from, $max_results ");
$sqlcnt=mysqli_query($con,"select * from receivemessage where FromID='$receiver' and ToID='$sender'") or svr_db_fail($con);	
date_default_timezone_set("Asia/Kolkata");
$dt=date('Y-m-d');
$hr=date('h');
$min=date('i');
$sec=date('s');
$am=date('a');


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Recieved Messages</title>
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link rel="shortcut icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<link rel="icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<!-- MPJ: brand icons -->
<link rel="apple-touch-icon" href="branding/favicons/apple-touch-icon.png">
<link rel="manifest" href="branding/site.webmanifest">
<meta name="theme-color" content="#5E1426">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<style>
:root{--mvv-maroon:#6B1A1A;--mvv-saffron:#E8612A;--mvv-gold:#C9921A;--mvv-cream:#FFF8F0;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-btn{display:inline-block;padding:10px 24px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#8B1A1A;}
.comments-area .comment-box{padding:12px 0;border-bottom:1px solid var(--mvv-border);}
.comments-area .comment-box:last-child{border-bottom:none;}
.comment{display:flex;flex-wrap:wrap;gap:12px;}
.author-thumb{width:60px;height:60px;border-radius:50%;overflow:hidden;flex-shrink:0;}
.author-thumb img{width:100%;height:100%;object-fit:cover;}
.comment-info{flex:1;min-width:0;}
.comment-info .name{font-weight:700;color:var(--mvv-maroon);display:inline;}
.comment-info .name a{color:var(--mvv-maroon);text-decoration:none;}
.comment-info .date{display:inline;color:var(--mvv-muted);font-size:.85rem;}
.text{width:100%;margin-top:6px;color:#555;}
.message{margin-right:5px;color:#1d95d2;font-size:18px;}
@media screen and (max-width:768px){.error-section{padding:80px 0px;}.errtitle{display:none;}}
@media screen and (max-width:568px){.error-section{padding:80px 0px;}.errtitle{display:none;}}
</style>
</head>
<body>

<?php include('header.php')?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Messages</div>
      <h1>Received Messages</h1>
      <p>प्राप्त संदेश</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Received Messages</span>
      </nav>
    </div>
  </section>

  <?php 
  $strid=$_SESSION['matriid'];
  $sql = mysqli_query($con,"SELECT  * from receivemessage where ToID='$strid' and banstatus!='1' order by rid  desc  LIMIT 0, 10");
  if(mysqli_num_rows($sql)>0)
  {?>
  <section class="mvv-section">
    <div class="mvv-container">
      <?php 
      $i=0;
      while($row=mysqli_fetch_array($sql))
      {
        if($row['FromID']==$_SESSION['matriid'])
          $iduser[$i]=$row['ToID'];
        else
          $iduser[$i]=$row['FromID'];
        $i++;	
      }
      $idu=array_unique($iduser);
      ?>
      <?php
      foreach($idu as $idd)
      {			
        $sender=mysqli_query($con,"select * from register where MatriID='$idd'  ")or svr_db_fail($con);
        $sender_rec=mysqli_fetch_array($sender);
        $count=mysqli_query($con,"select * from receivemessage where (ToID='".$_SESSION['matri_login']."' and FromID='$idd')");
        $lastmessage=mysqli_query($con,"select LEFT(Msg,100) as text from receivemessage where ToID='$idd' or FromID='$idd' ORDER BY rid DESC")or svr_db_fail($con);
        $recivems=mysqli_query($con,"select * from receivemessage where  FromID='$idd' and ToID='$strid' ORDER BY rid DESC");
        $receie=mysqli_fetch_array($recivems);
        ?>
        <div class="comments-area">
          <div class="comment-box">
            <div class="comment">
              <?php 
              $encrypt = urlencode( base64_encode( $sender_rec['MatriID'] ) );
              ?>
              <div class="author-thumb"><a href="full_profile?id=<?php echo $encrypt ?>" target=_blank><img src="photoprocess.php?image=gallary/<?php echo $sender_rec['Photo1'];?>&square=200" alt=""></a></div>
              <div class="comment-info">
                <div class="name"><a href="full_profile?id=<?php echo $encrypt?>" target=_blank>
                <?php $namepp1=explode(" ",$sender_rec['Name']);if($namep1p!=""){ $namepp1[0];}  echo $namepp1[0];?>
                </a></div>
                -<div class="date"><?php echo $receie['SendDate'];?></div>
              </div>
              <div class="text" style="margin-top:8px;"><?php echo $receie['Msg'];?></div>
              <a href="send_message?id=<?php echo $idd?>" class="mvv-btn primary" style="margin-top:10px;">Reply</a>
              <?php  ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
  <?php } else { ?>
  <section class="mvv-section">
    <div class="mvv-container">
      <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:3rem;font-weight:900;color:var(--mvv-maroon);opacity:0.3;margin-bottom:10px;">OOP'S</div>
        <h4 style="color:var(--mvv-muted);">Sorry Result Not Found</h4>
        <p style="color:#999;">No Message Received</p>
        <a href="smart_search" class="mvv-btn primary" style="margin-top:10px;">Search</a>
      </div>
    </div>
  </section>
  <?php } ?>
</main>

<?php include('footer3.php')?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</body>
</html>
