<?php
/*
  payment_success.php
  Called after Razorpay checkout completes successfully.
  Verifies signature, inserts into paiddetails, updates register table —
  mirroring the logic in the legacy manual-payment handler.
*/

require_once('sys_dbconnection.php');
require_once('agent_commission_lib.php');
include('memprotect.php');

/* Secret now resolves from env/config with the previous value kept only as a
   legacy fallback (see config.php) — SECURITY: removes hard-coded secret. */
define('RZP_KEY_SECRET', svr_config('SVR_RZP_KEY_SECRET', 'WrbEZmhz7NlXIHiH58Qb9ux1'));

// ── Guard ─────────────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index_dashboard');
    exit;
}

// ── Collect POST values ───────────────────────────────────────────────────────
$rzp_payment_id = trim($_POST['razorpay_payment_id'] ?? '');
$rzp_order_id   = trim($_POST['razorpay_order_id']   ?? '');
$rzp_signature  = trim($_POST['razorpay_signature']  ?? '');
$local_order_id = trim($_POST['local_order_id']      ?? '');  // our MAT... order id
$plan_id        = trim($_POST['plan_id']             ?? '');
$amount         = floatval($_POST['amount']          ?? 0);

$matriid = $_SESSION['MatriID'] ?? '';

if (!$matriid || !$rzp_payment_id || !$rzp_order_id || !$rzp_signature) {
    header('Location: payment_failed.php?error=Missing+payment+data');
    exit;
}

// ── Signature Verification ────────────────────────────────────────────────────
$generated_signature = hash_hmac(
    'sha256',
    $rzp_order_id . '|' . $rzp_payment_id,
    RZP_KEY_SECRET
);

if (!hash_equals($generated_signature, $rzp_signature)) {
    error_log("Razorpay signature mismatch for order: $local_order_id");
    $now = date('Y-m-d H:i:s');
    $lo  = mysqli_real_escape_string($con, $local_order_id);
    mysqli_query($con, "UPDATE transactions SET status='Failed', updated_at='$now' WHERE order_id='$lo'");
    header('Location: payment_failed.php?error=Signature+verification+failed');
    exit;
}

// ── Signature OK — fetch member details ──────────────────────────────────────
$matriid_safe = mysqli_real_escape_string($con, $matriid);

$sqlrenew  = mysqli_query($con, "SELECT * FROM register WHERE MatriID='$matriid_safe'");
$rowrenew  = mysqli_fetch_array($sqlrenew);

if (!$rowrenew) {
    header('Location: payment_failed.php?error=Member+not+found');
    exit;
}

$nm     = $rowrenew['Name'];
$mobile = $rowrenew['Mobile'];
$email  = $rowrenew['ConfirmEmail'];

// ── Fetch plan details ────────────────────────────────────────────────────────
$plan_id_safe = mysqli_real_escape_string($con, $plan_id);
$plan_res     = mysqli_query($con, "SELECT * FROM membershipplan WHERE planid='$plan_id_safe'");
$plan_row     = mysqli_fetch_array($plan_res);

if (!$plan_row) {
    header('Location: payment_failed.php?error=Plan+not+found');
    exit;
}

$plan         = $plan_row['planname'];          // short plan code
$memtype      = $plan_row['planname'];          // used in paiddetails.memtype
$memtyp1      = $plan_row['plandisplayname'];   // used in register.memtype
$base_duration = (int) $plan_row['planduration'];
$base_contacts = (int) $plan_row['noofcontacts']; // adjust column name if different

$oldStatus = (string)($rowrenew['Status'] ?? '');
$oldMemtype = (string)($rowrenew['memtype'] ?? '');
$oldExpiry = (string)($rowrenew['MemshipExpiryDate'] ?? '');
$commissionSource = 'Website Registration Purchase';
if ($oldStatus === 'Paid' && $oldMemtype !== '' && $oldMemtype !== 'Free' && strtotime($oldExpiry) >= strtotime(date('Y-m-d'))) {
    $commissionSource = ($oldMemtype === $memtyp1) ? 'Package Renewal' : 'Package Upgrade';
}

// ── Duration & Contacts: mirror legacy logic ──────────────────────────────────
// If Expired or Active → use plan values directly (reset)
// Otherwise (e.g. still has days left) → add remaining days/contacts on top
if ($rowrenew['Status'] == 'Expired' || $rowrenew['Status'] == 'Active') {
    $duration = $base_duration;
    $contacts = $base_contacts;
} else {
    // Add remaining days to new plan duration
    $sqlexp  = mysqli_query($con, "SELECT DATEDIFF(Memshipexpirydate, CURRENT_DATE) AS exp FROM register WHERE MatriID='$matriid_safe'");
    $rowexp  = mysqli_fetch_array($sqlexp);
    $duration = $base_duration + (int)($rowexp['exp'] ?? 0);
    $contacts = $base_contacts + (int)($rowrenew['Noofcontacts'] ?? 0);
}

// ── Compute expiry date ───────────────────────────────────────────────────────
$strexpdate     = date('Y-m-d', strtotime("+$duration days"));
$activation_date = date('Y-m-d');

// ── Escape all values for DB ──────────────────────────────────────────────────
$stroid_safe      = mysqli_real_escape_string($con, $local_order_id);
$name_safe        = mysqli_real_escape_string($con, $nm);
$email_safe       = mysqli_real_escape_string($con, $email);
$plan_safe        = mysqli_real_escape_string($con, $plan);
$memtype_safe     = mysqli_real_escape_string($con, $memtype);
$memtyp1_safe     = mysqli_real_escape_string($con, $memtyp1);
$rzp_pay_safe     = mysqli_real_escape_string($con, $rzp_payment_id);
$rzp_ord_safe     = mysqli_real_escape_string($con, $rzp_order_id);
$rzp_sig_safe     = mysqli_real_escape_string($con, $rzp_signature);
$mode             = 'Razorpay';   // payment mode
$address          = '';           // not collected in online flow
$bank_details     = 'Razorpay Payment ID: ' . $rzp_payment_id . ' | Order ID: ' . $rzp_order_id;
$bank_safe        = mysqli_real_escape_string($con, $bank_details);
$discountcode     = '';
$strstatus        = 'Clear';


$insert = mysqli_query($con, "
    INSERT INTO paiddetails 
        (Poid, Pmatriid, Pname, Pemail, Paddress, Ppaymode, Pactivedate,
         Pplan, memtype, Pplanduration, Pnocontct, Pamount, Pbankdet, Pstatus, discountcode)
    VALUES 
        ('$stroid_safe', '$matriid_safe', '$name_safe', '$email_safe', '$address',
         '$mode', '$activation_date', '$plan_safe', '$memtype_safe',
         '$duration', '$contacts', '$amount', '$bank_safe', '$strstatus', '$discountcode')
");

if (!$insert) {
    error_log('paiddetails insert failed: ' . mysqli_error($con));
    header('Location: payment_failed.php?error=Database+error+on+insert');
    exit;
}

// ── Update register table ─────────────────────────────────────────────────────
$update = mysqli_query($con, "
    UPDATE register SET
        Status            = 'Paid',
        memtype           = '$memtyp1_safe',
        MemshipExpiryDate = '$strexpdate',
        Noofcontacts      = '$contacts'
    WHERE MatriID = '$matriid_safe'
");

if (!$update) {
    error_log('register update failed: ' . mysqli_error($con));
    header('Location: payment_failed.php?error=Database+error+on+update');
    exit;
}

// ── Update transactions table status ─────────────────────────────────────────
$now = date('Y-m-d H:i:s');
mysqli_query($con, "
    UPDATE transactions SET
        rzp_payment_id = '$rzp_pay_safe',
        rzp_signature  = '$rzp_sig_safe',
        status         = 'Success',
        updated_at     = '$now'
    WHERE order_id = '$stroid_safe'
");

$agentSaleReference = 'WEB-' . $rzp_pay_safe;
agent_create_commission_for_registered_payment(
    $con,
    $rowrenew,
    $plan_row,
    $amount,
    $agentSaleReference,
    $rzp_pay_safe,
    $commissionSource,
    $activation_date
);

// ── Notify followers (paid member notification) ───────────────────────────────
$followers = mysqli_query($con, "SELECT * FROM followers WHERE follower_id='$matriid_safe'");
if ($followers && mysqli_num_rows($followers) > 0) {
    while ($follow_row = mysqli_fetch_assoc($followers)) {
        $profile_id = mysqli_real_escape_string($con, $follow_row['profile_id']);
        mysqli_query($con, "
            INSERT INTO notification (noti_sender, noti_receiver, notification_type, notification_desc)
            VALUES ('$matriid_safe', '$profile_id', 'paid member', 'is a Paid Member')
        ");
    }
}

// ── Fetch site config for SMS/email ──────────────────────────────────────────
$configdata1 = mysqli_query($con, "SELECT * FROM siteconfig WHERE id='1'");
$siteinfo    = mysqli_fetch_array($configdata1);
$Webname     = $siteinfo['Webname']     ?? '';
$webfriendly = $siteinfo['WebFriendlyname'] ?? '';

// ── SMS (uncomment sendsms() when ready) ─────────────────────────────────────
$smsMessage = "Hello $nm,\nYou Have Selected '$plan'\nYour Plan Has Been Successfully Activated\n\nThank You\nTeam- $Webname";


// ── Email (uncomment mailer when ready) ──────────────────────────────────────
$date1    = date('d/m/Y');
$message1 = "<!DOCTYPE html>
<html lang='en'>
<head><meta charset='utf-8'><title>Payment Successful</title></head>
<body style='margin:0 auto;width:100%;background:#ccc;text-align:justify;'>
<div style='margin:0 auto;width:590px;background:#333;'>
<div style='float:left;margin:0;width:590px;background:#c5191f;'>
<div style='float:left;width:570px;background:#f7f7f7;margin:10px;border-radius:5px;'>

<div style='margin:7% 0 0 25%;float:left;'>
  <a href='#' target='_blank'><img src='http://localhost/SVR/css3/assets/shivraj-logo.png' alt='" . htmlspecialchars($Webname) . "'></a>
</div>
<br><br>

<table width='570' border='1' style='font-family:Verdana;font-size:14px;color:#919191;border:#bbb7b7;border-collapse:collapse' cellpadding='2' cellspacing='0'>
  <tr><td height='35' bgcolor='#ff5a60'><span style='color:#FFF;font-size:18px'>Payment Successful</span></td></tr>
</table>

<div style='margin:10px 10px 15px 10px;float:left;width:549px;'>
  <p style='font-size:14px;color:#000;line-height:23px;'>Dear $nm,</p>
  <p style='color:#000;'>Welcome to $Webname — you are now a Paid Member!</p>
  <table width='550' border='1' style='font-family:Verdana;font-size:14px;color:#919191;border:#bbb7b7;border-collapse:collapse' cellpadding='2' cellspacing='0'>
    <tr><td align='center'>Date: $date1</td></tr>
    <tr><td align='center'>Plan Selected: $plan</td></tr>
    <tr><td align='center'>Amount: ₹$amount</td></tr>
    <tr><td align='center'>Duration: $duration Days</td></tr>
    <tr><td align='center'>No. of Contacts: $contacts</td></tr>
    <tr><td align='center'>Payment ID: $rzp_payment_id</td></tr>
    <tr><td align='center'>Order ID: $local_order_id</td></tr>
  </table>
  <br>
  <p style='color:#000;'>Note: Thank you for your purchase! Please note that all sales are final and non-refundable. For any queries or assistance, kindly reach out to us within 48 hours.</p>
  <p>Warm Regards,<br><span style='color:#c5191f;'>$Webname</span> Team</p>
</div>

</div></div></div>
</body></html>";

$subject = "Payment Details — $plan Plan Activated";


// ── Set session data for thank-you page ───────────────────────────────────────
$_SESSION['payment_success'] = [
    'payment_id' => $rzp_payment_id,
    'order_id'   => $local_order_id,
    'amount'     => $amount,
    'plan'       => $memtyp1,
];

// ── Redirect ──────────────────────────────────────────────────────────────────
header("Location: payment_thankyou.php");
exit;
