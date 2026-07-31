<?php
require_once('includes/bootstrap.php');
include('memprotect.php');

// Grab success data set in payment_success.php
$success = $_SESSION['payment_success'] ?? null;

// If someone lands here directly without a payment, redirect
if (!$success) {
    header('Location: index_dashboard');
    exit;
}

// Clear it so refreshing doesn't re-show stale data
unset($_SESSION['payment_success']);

$payment_id = htmlspecialchars($success['payment_id'] ?? '');
$order_id   = htmlspecialchars($success['order_id']   ?? '');
$amount     = number_format(floatval($success['amount'] ?? 0), 2);
$plan       = htmlspecialchars($success['plan']        ?? '');
$matriid    = htmlspecialchars($_SESSION['MatriID']    ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Payment Successful | Membership</title>
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
  /* ── Page wrapper ── */
  .thankyou-section {
    padding: 70px 0 80px;
    background: #fafafa;
  }

  /* ── Card ── */
  .thankyou-card {
    max-width: 620px;
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

  /* ── Green success banner ── */
  .thankyou-banner {
    background: linear-gradient(135deg, #1a7a4a 0%, #27ae60 100%);
    padding: 44px 30px 36px;
    text-align: center;
    position: relative;
  }
  .thankyou-banner::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0; right: 0;
    height: 28px;
    background: #fff;
    border-radius: 50% 50% 0 0 / 100% 100% 0 0;
  }

  /* ── Animated tick circle ── */
  .tick-wrap {
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
  .tick-wrap svg {
    width: 44px; height: 44px;
    stroke: #fff;
    stroke-width: 3.5;
    fill: none;
    stroke-dasharray: 60;
    stroke-dashoffset: 60;
    stroke-linecap: round;
    stroke-linejoin: round;
    animation: drawTick 0.5s 0.55s ease forwards;
  }
  @keyframes drawTick {
    to { stroke-dashoffset: 0; }
  }

  .thankyou-banner h2 {
    color: #fff;
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 6px;
  }
  .thankyou-banner p {
    color: rgba(255,255,255,0.88);
    font-size: 0.97rem;
    margin: 0;
  }

  /* ── Body ── */
  .thankyou-body {
    padding: 36px 36px 32px;
  }

  /* ── Amount highlight ── */
  .amount-highlight {
    text-align: center;
    margin-bottom: 28px;
  }
  .amount-highlight .label {
    font-size: 0.82rem;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  .amount-highlight .value {
    font-size: 2.6rem;
    font-weight: 800;
    color: #1a7a4a;
    line-height: 1.1;
  }
  .amount-highlight .plan-pill {
    display: inline-block;
    background: #fff0f0;
    color: #c0392b;
    border: 1px solid rgba(192,57,43,0.2);
    border-radius: 20px;
    padding: 3px 14px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-top: 6px;
  }

  /* ── Detail rows ── */
  .detail-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 28px;
    font-size: 0.9rem;
  }
  .detail-table tr {
    border-bottom: 1px solid #f0f0f0;
  }
  .detail-table tr:last-child { border: none; }
  .detail-table td {
    padding: 10px 4px;
    color: #555;
  }
  .detail-table td:last-child {
    text-align: right;
    font-weight: 600;
    color: #222;
    word-break: break-all;
    font-size: 0.85rem;
  }
  .detail-table .icon-cell {
    width: 28px;
    color: #c0392b;
    font-size: 1rem;
  }

  /* ── CTA buttons ── */
  .thankyou-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }
  .thankyou-actions .btn-primary-cta {
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
    cursor: pointer;
    display: block;
  }
  .thankyou-actions .btn-primary-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(192,57,43,0.35);
    color: #fff;
    text-decoration: none;
  }
  .thankyou-actions .btn-outline-cta {
    flex: 1;
    padding: 13px 10px;
    background: #fff;
    color: #c0392b;
    border: 2px solid #c0392b;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
    display: block;
  }
  .thankyou-actions .btn-outline-cta:hover {
    background: #c0392b;
    color: #fff;
    text-decoration: none;
  }

  /* ── Footer note ── */
  .thankyou-footnote {
    text-align: center;
    margin-top: 22px;
    font-size: 0.78rem;
    color: #bbb;
  }
  .thankyou-footnote a { color: #c0392b; }
</style>
</head>
<body>
<div class="page-wrapper">
  <span class="header-span"></span>
  <?php include('header.php'); ?>

  <section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
      <h1 class="d-none d-lg-block d-xl-block d-md-block">Payment Successful</h1>
      <ul class="bread-crumb clearfix">
        <li><a href="index_dashboard">Home</a></li>
        <li>Payment Successful</li>
      </ul>
    </div>
  </section>

  <section class="thankyou-section">
    <div class="auto-container">
      <div class="thankyou-card">

        <!-- Green banner with animated tick -->
        <div class="thankyou-banner">
          <div class="tick-wrap">
            <svg viewBox="0 0 52 52">
              <polyline points="14,27 22,35 38,19"/>
            </svg>
          </div>
          <h2>Payment Successful!</h2>
          <p>Your membership has been activated. Welcome aboard!</p>
        </div>

        <!-- Card body -->
        <div class="thankyou-body">

          <div class="amount-highlight">
            <div class="label">Amount Paid</div>
            <div class="value">₹<?php echo $amount; ?></div>
            <span class="plan-pill">🎯 <?php echo $plan; ?></span>
          </div>

          <table class="detail-table">
            <tr>
              <td class="icon-cell">🪪</td>
              <td>Matrimony ID</td>
              <td><?php echo $matriid; ?></td>
            </tr>
            <tr>
              <td class="icon-cell">📦</td>
              <td>Plan</td>
              <td><?php echo $plan; ?></td>
            </tr>
            <tr>
              <td class="icon-cell">🧾</td>
              <td>Order ID</td>
              <td><?php echo $order_id; ?></td>
            </tr>
            <tr>
              <td class="icon-cell">💳</td>
              <td>Payment ID</td>
              <td><?php echo $payment_id; ?></td>
            </tr>
            <tr>
              <td class="icon-cell">📅</td>
              <td>Date</td>
              <td><?php echo date('d M Y, h:i A'); ?></td>
            </tr>
            <tr>
              <td class="icon-cell">✅</td>
              <td>Status</td>
              <td style="color:#1a7a4a; font-weight:700;">Success</td>
            </tr>
          </table>

          <div class="thankyou-actions">
            <a href="index_dashboard" class="btn-primary-cta">Go to Dashboard</a>
            <a href="profile.php" class="btn-outline-cta">View Profile</a>
          </div>

          <div class="thankyou-footnote">
            A confirmation email has been sent to your registered email address.<br>
            Need help? <a href="contact.php">Contact Support</a>
          </div>

        </div><!-- /.thankyou-body -->
      </div><!-- /.thankyou-card -->
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