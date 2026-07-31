<?php
require_once('includes/bootstrap.php');
include('memprotect.php');
$id = $_SESSION['matriid'];
$res12 = mysqli_query($con, "SELECT * FROM usernote where MatriID='$id' order by id DESC");
$total = mysqli_num_rows($res12);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User Notification</title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{--mvv-maroon:#5E1426;--mvv-saffron:#C9556A;--mvv-gold:#BA9350;--mvv-cream:#FFFDFB;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-page{min-height:60vh;padding-top:0;padding-bottom:60px;}
.mvv-container{max-width:1200px;margin:0 auto;padding:0 16px;}
.mvv-page-hero{background:linear-gradient(135deg,var(--mvv-maroon),#7A1F39);padding:40px 0 30px;margin-bottom:32px;}
.mvv-page-hero h1{color:#fff;font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin:4px 0;text-align:center;}
.mvv-page-hero .mvv-eyebrow{text-align:center;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:2px;font-size:.8rem;font-weight:600;}
.mvv-page-hero p{text-align:center;color:rgba(255,255,255,.7);margin:0 0 8px;}
.mvv-breadcrumb{text-align:center;font-size:.85rem;}
.mvv-breadcrumb a{color:rgba(255,255,255,.7);text-decoration:none;}
.mvv-breadcrumb a:hover{color:#fff;}
.mvv-breadcrumb span{color:var(--mvv-gold);}
.mvv-section{padding:0 0 40px;}
.mvv-notif-card{background:#fff;border-radius:12px;border:1px solid var(--mvv-border);padding:16px 20px;margin-bottom:12px;display:flex;align-items:center;gap:14px;transition:box-shadow .2s;}
.mvv-notif-card:hover{box-shadow:0 4px 16px rgba(0,0,0,0.06);}
.mvv-notif-icon{flex-shrink:0;width:40px;height:40px;border-radius:50%;background:var(--mvv-cream);display:flex;align-items:center;justify-content:center;color:var(--mvv-saffron);font-size:1.1rem;}
.mvv-notif-text{flex:1;font-size:0.95rem;color:#444;line-height:1.5;}
.mvv-btn{display:inline-block;padding:10px 24px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#7A1F39;}
</style>
</head>
<body>

<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Notifications</div>
      <h1>User Notification</h1>
      <p>Messages and updates from the admin</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Notification</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if($total > 0) {
        while($fetch_note=mysqli_fetch_assoc($res12)) { ?>
        <div class="mvv-notif-card">
          <div class="mvv-notif-icon"><i class="fas fa-bell"></i></div>
          <div class="mvv-notif-text"><?php echo $fetch_note['Unote']; ?></div>
        </div>
        <?php }
      } else { ?>
      <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:3rem;font-weight:900;color:var(--mvv-maroon);opacity:0.3;margin-bottom:10px;">OOP'S</div>
        <h3 style="color:var(--mvv-muted);">No Notifications</h3>
        <p style="color:#999;">No notifications from admin yet.</p>
      </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
</body>
</html>
