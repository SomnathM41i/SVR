<?php //include('dbconnectadmin.php');
require_once('sys_dbconnection.php');
$qry="select * from cms where cms_id='21'";
$result=mysqli_query($con,$qry);
$res=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Logout Successfully</title>
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link rel="shortcut icon" href="css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="icon" href="css3/assets/manpasand-logo.png" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{--mvv-maroon:#6B1A1A;--mvv-saffron:#E8612A;--mvv-gold:#C9921A;--mvv-cream:#FFF8F0;--mvv-muted:#888;}
.mvv-page{min-height:60vh;padding-top:30px;padding-bottom:60px;}
.mvv-container{max-width:1200px;margin:0 auto;padding:0 16px;}
.mvv-page-hero{background:linear-gradient(135deg,var(--mvv-maroon),#8B1A1A);padding:40px 0 30px;margin-bottom:32px;}
.mvv-page-hero h1{color:#fff;font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin:4px 0;text-align:center;}
.mvv-page-hero .mvv-eyebrow{text-align:center;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:2px;font-size:.8rem;font-weight:600;}
.mvv-page-hero p{text-align:center;color:rgba(255,255,255,.7);margin:0 0 8px;}
.mvv-breadcrumb{text-align:center;font-size:.85rem;}
.mvv-breadcrumb a{color:rgba(255,255,255,.7);text-decoration:none;}
.mvv-breadcrumb a:hover{color:#fff;}
.mvv-breadcrumb span{color:var(--mvv-gold);}
.mvv-section{padding:40px 0;}
.mvv-card{background:#fff;border-radius:14px;border:1px solid #e0d5cb;padding:40px;max-width:640px;margin:0 auto;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,0.04);}
.mvv-card .icon-circle{width:72px;height:72px;border-radius:50%;background:var(--mvv-cream);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:2rem;color:var(--mvv-maroon);}
.mvv-card h2{font-size:1.4rem;font-weight:700;color:var(--mvv-maroon);margin:0 0 8px;}
.mvv-card p{color:#666;font-size:.95rem;margin:0 0 20px;line-height:1.6;}
.mvv-btn{display:inline-block;padding:12px 32px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#8B1A1A;transform:translateY(-1px);box-shadow:0 4px 12px rgba(107,26,26,0.3);}
</style>
</head>
<body>

<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Account</div>
      <h1>Logout</h1>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index">Home</a>
        <span>Logout</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="mvv-card">
        <div class="icon-circle"><i class="fas fa-check"></i></div>
        <h2>Logged Out Successfully</h2>
        <p><?php echo $res['content']; ?></p>
        <a href="login" class="mvv-btn primary"><i class="fas fa-sign-in-alt" style="margin-right:8px;"></i>Login Again</a>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
</body>
</html>
