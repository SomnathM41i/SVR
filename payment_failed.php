<?php
require_once('includes/bootstrap.php');
include('memprotect.php');

$error   = htmlspecialchars($_GET['error'] ?? 'Your payment could not be processed.');
$matriid = htmlspecialchars($_SESSION['MatriID'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Payment Failed | Membership</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
  /* ── Page ── */
  .failed-section {
    padding: 70px 0 80px;
    background: #fafafa;
  }

  /* ── Card ── */
  .failed-card {
    max-width: 580px;
    margin: 0 auto;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.10);
    overflow: hidden;
    animation: slideUp 0.55s cubic-bezier(.22,1,.36,1) both;
  }
  @keyframes slideUp {
    from { opacity:0; transform: translateY(40px); }
    to   { opacity:1; transform: translateY(0); }
  }

  /* ── Red error banner ── */
  .failed-banner {
    background: linear-gradient(135deg, #8b1a1a 0%, #c0392b 100%);
    padding: 44px 30px 36px;
    text-align: center;
    position: relative;
  }
  .failed-banner::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0; right: 0;
    height: 28px;
    background: #fff;
    border-radius: 50% 50% 0 0 / 100% 100% 0 0;
  }

  /* ── Animated X circle ── */
  .x-wrap {
    width: 84px; height: 84px;
    border-radius: 50%;
    background: rgba(255,255,255,0.18);
    border: 3px solid rgba(255,255,255,0.55);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px;
    animation: popIn 0.5s 0.2s cubic-bezier(.34,1.56,.64,1) both;
  }
  @keyframes popIn {
    from { transform: scale(0); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
  }
  .x-wrap svg {
    width: 44px; height: 44px;
    stroke: #fff;
    stroke-width: 3.5;
    fill: none;
    stroke-linecap: round;
    opacity: 0;
    animation: fadeInX 0.3s 0.6s ease forwards;
  }
  @keyframes fadeInX {
    to { opacity: 1; }
  }

  .failed-banner h2 {
    color: #fff;
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 6px;
  }
  .failed-banner p {
    color: rgba(255,255,255,0.88);
    font-size: 0.97rem;
    margin: 0;
  }

  /* ── Body ── */
  .failed-body {
    padding: 36px 36px 32px;
  }

  /* ── Error reason box ── */
  .error-reason {
    background: #fff5f5;
    border: 1px solid #fcc;
    border-left: 4px solid #c0392b;
    border-radius: 8px;
    padding: 14px 18px;
    margin-bottom: 28px;
    display: flex;
    gap: 12px;
    align-items: flex-start;
  }
  .error-reason .err-icon {
    font-size: 1.3rem;
    line-height: 1;
    flex-shrink: 0;
    margin-top: 2px;
  }
  .error-reason .err-text {
    font-size: 0.9rem;
    color: #7b1a1a;
    line-height: 1.5;
  }
  .error-reason .err-text strong {
    display: block;
    font-size: 0.85rem;
    margin-bottom: 3px;
    color: #c0392b;
  }

  /* ── Common reasons ── */
  .reasons-box {
    margin-bottom: 28px;
  }
  .reasons-box h5 {
    font-size: 0.88rem;
    font-weight: 700;
    color: #444;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .reasons-list {
    list-style: none;
    padding: 0; margin: 0;
  }
  .reasons-list li {
    font-size: 0.87rem;
    color: #666;
    padding: 5px 0;
    padding-left: 20px;
    position: relative;
  }
  .reasons-list li::before {
    content: '›';
    position: absolute;
    left: 4px;
    color: #c0392b;
    font-weight: 700;
  }

  /* ── CTA buttons ── */
  .failed-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 20px;
  }
  .failed-actions .btn-retry {
    flex: 1;
    padding: 13px 10px;
    background: linear-gradient(135deg, #c0392b, #a93226);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    transition: transform 0.15s, box-shadow 0.15s;
    display: block;
    cursor: pointer;
  }
  .failed-actions .btn-retry:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(192,57,43,0.35);
    color: #fff;
    text-decoration: none;
  }
  .failed-actions .btn-home {
    flex: 1;
    padding: 13px 10px;
    background: #fff;
    color: #555;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    transition: border-color 0.15s, color 0.15s;
    display: block;
  }
  .failed-actions .btn-home:hover {
    border-color: #c0392b;
    color: #c0392b;
    text-decoration: none;
  }

  /* ── Support note ── */
  .support-note {
    text-align: center;
    font-size: 0.82rem;
    color: #aaa;
    padding-top: 16px;
    border-top: 1px solid #f0f0f0;
  }
  .support-note a { color: #c0392b; }

  /* ── Matri ID tag ── */
  .matri-tag {
    display: inline-block;
    background: #f5f5f5;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 2px 8px;
    font-size: 0.78rem;
    color: #666;
    margin-left: 6px;
    font-family: monospace;
  }
</style>
</head>
<body>
<div class="page-wrapper">
  <span class="header-span"></span>
  <?php include('header.php'); ?>

  <section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
      <h1 class="d-none d-lg-block d-xl-block d-md-block">Payment Failed</h1>
      <ul class="bread-crumb clearfix">
        <li><a href="index_dashboard">Home</a></li>
        <li>Payment Failed</li>
      </ul>
    </div>
  </section>

  <section class="failed-section">
    <div class="auto-container">
      <div class="failed-card">

        <!-- Red banner with X icon -->
        <div class="failed-banner">
          <div class="x-wrap">
            <svg viewBox="0 0 44 44">
              <line x1="13" y1="13" x2="31" y2="31"/>
              <line x1="31" y1="13" x2="13" y2="31"/>
            </svg>
          </div>
          <h2>Payment Failed</h2>
          <p>Don't worry — no amount has been deducted from your account.</p>
        </div>

        <!-- Card body -->
        <div class="failed-body">

          <?php if ($matriid): ?>
            <p style="font-size:0.85rem; color:#888; margin-bottom:18px;">
              Account: <span class="matri-tag"><?php echo $matriid; ?></span>
            </p>
          <?php endif; ?>

          <!-- Error reason -->
          <div class="error-reason">
            <span class="err-icon">⚠️</span>
            <div class="err-text">
              <strong>Error Details</strong>
              <?php echo $error; ?>
            </div>
          </div>

          <!-- Common causes -->
          <div class="reasons-box">
            <h5>Common reasons for failure</h5>
            <ul class="reasons-list">
              <li>Incorrect card number, expiry, or CVV</li>
              <li>Insufficient balance in your account</li>
              <li>Transaction declined by your bank</li>
              <li>Internet connection dropped during payment</li>
              <li>OTP expired or entered incorrectly</li>
              <li>Daily transaction limit exceeded</li>
            </ul>
          </div>

          <!-- Action buttons -->
          <div class="failed-actions">
            <a href="javascript:history.back()" class="btn-retry">🔄 Try Again</a>
            <a href="index_dashboard" class="btn-home">Go to Dashboard</a>
          </div>

          <div class="support-note">
            If money was deducted, it will be refunded within 5–7 business days.<br>
            Still facing issues? <a href="contact.php">Contact our support team</a>
          </div>

        </div><!-- /.failed-body -->
      </div><!-- /.failed-card -->
    </div>
  </section>

  <?php include('footer.php'); ?>
</div>

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>
<script src="js/color-settings.js"></script>
</body>
</html>