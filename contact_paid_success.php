<?php include('sys_dbconnection.php');
require_once('includes/security.php');

/* contact_paid_success.php — AJAX completion handler for the legacy
 * "buy contact details" Razorpay checkout (razorpay.php).
 *
 * SECURITY changes (C6 payment integrity):
 * - Previously ANY unauthenticated POST with payment_id+oid inserted a "Paid"
 *   record with a client-controlled amount — no verification at all.
 * - The payment is now fetched server-side from the Razorpay API and must be
 *   captured/authorized; the recorded amount is the amount Razorpay reports.
 * - When the plan exists, the paid amount must cover the plan price.
 * - Prepared statements; no SQL/ID echo; session login required.
 * NOTE: the legacy commented-out paiddetails/register-update blocks were
 * already inactive (and referenced undefined variables); they have been
 * removed as obsolete. Behavior of the active flow is preserved.
 */

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('status' => 'error', 'message' => 'Method not allowed'));
    exit;
}

$MatriID = isset($_SESSION['MatriID']) ? $_SESSION['MatriID'] : (isset($_SESSION['matriid']) ? $_SESSION['matriid'] : '');
if ($MatriID === '') {
    http_response_code(401);
    echo json_encode(array('status' => 'error', 'message' => 'Not logged in'));
    exit;
}

$payment_id = isset($_POST['payment_id']) ? trim($_POST['payment_id']) : '';
$order_id   = isset($_POST['oid']) ? trim($_POST['oid']) : '';
$serch_id   = isset($_POST['searchid']) ? trim($_POST['searchid']) : '';

if ($payment_id === '' || $order_id === '') {
    echo json_encode(array('status' => 'error', 'message' => 'Missing payment data'));
    exit;
}

/* ---- 1. Verify the payment with Razorpay (server-to-server) ---- */
$keyId     = svr_config('SVR_RZP_KEY_ID', 'rzp_live_UCmasONfYX891y');
$keySecret = svr_config('SVR_RZP_KEY_SECRET', 'WrbEZmhz7NlXIHiH58Qb9ux1');

$payment = null;
$ch = curl_init('https://api.razorpay.com/v1/payments/' . rawurlencode($payment_id));
curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD        => $keyId . ':' . $keySecret,
    CURLOPT_TIMEOUT        => 30,
));
$response  = curl_exec($ch);
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200 && $response) {
    $payment = json_decode($response, true);
}

if (!is_array($payment) || empty($payment['id']) || $payment['id'] !== $payment_id) {
    error_log('contact_paid_success: payment fetch/verification failed for ' . $payment_id);
    echo json_encode(array('status' => 'error', 'message' => 'Payment verification failed'));
    exit;
}

$payStatus = isset($payment['status']) ? $payment['status'] : '';
if (!in_array($payStatus, array('authorized', 'captured'), true)) {
    error_log('contact_paid_success: payment ' . $payment_id . ' has status ' . $payStatus);
    echo json_encode(array('status' => 'error', 'message' => 'Payment not completed'));
    exit;
}

$amount_rupees = isset($payment['amount']) ? ((float)$payment['amount'] / 100) : 0;

/* ---- 2. When the plan is known, the paid amount must cover its price ---- */
$rowplan = null;
$stmtP = mysqli_prepare($con, "SELECT * FROM membershipplan WHERE planid=? LIMIT 1");
if ($stmtP) {
    mysqli_stmt_bind_param($stmtP, "s", $order_id);
    mysqli_stmt_execute($stmtP);
    $resP = mysqli_stmt_get_result($stmtP);
    $rowplan = $resP ? mysqli_fetch_array($resP) : null;
    mysqli_stmt_close($stmtP);
}
if ($rowplan && isset($rowplan['planamount']) && (float)$rowplan['planamount'] > 0) {
    if ($amount_rupees + 0.01 < (float)$rowplan['planamount']) {
        error_log('contact_paid_success: underpayment for plan ' . $order_id . ' paid=' . $amount_rupees . ' expected=' . $rowplan['planamount']);
        echo json_encode(array('status' => 'error', 'message' => 'Paid amount does not match plan price'));
        exit;
    }
}

/* ---- 3. Record the purchase (same table/columns as the legacy handler) ---- */
$rowrenew = null;
$stmtR = mysqli_prepare($con, "SELECT * FROM register WHERE MatriID=? LIMIT 1");
if ($stmtR) {
    mysqli_stmt_bind_param($stmtR, "s", $MatriID);
    mysqli_stmt_execute($stmtR);
    $resR = mysqli_stmt_get_result($stmtR);
    $rowrenew = $resR ? mysqli_fetch_assoc($resR) : null;
    mysqli_stmt_close($stmtR);
}
if (!$rowrenew) {
    echo json_encode(array('status' => 'error', 'message' => 'Member not found'));
    exit;
}
$name = $rowrenew['Name'];

/* Legacy order-id generator produced "AMAT" followed by up to 21 digits
   (its rand()%33 indexing was out of range and silently produced shorter ids;
   this faithful fix emits a stable 21-digit suffix). */
$suffix = '';
for ($i = 0; $i < 21; $i++) {
    $suffix .= (string) random_int(0, 9);
}
$stroid = 'AMAT' . $suffix;

$mode   = 'Razorpay';
$status = 'Paid';
$amount = $amount_rupees;

$stmt = mysqli_prepare($con, "INSERT INTO contactpaid (pcoid,cmatriid,cname,cpaymode,cdate,camount,cstatus,csearchid) VALUES (?,?,?,?,now(),?,?,?)");
if (!$stmt) {
    error_log('contact_paid_success: insert prepare failed: ' . mysqli_error($con));
    echo json_encode(array('status' => 'error', 'message' => 'Could not record payment'));
    exit;
}
mysqli_stmt_bind_param($stmt, "ssssdss", $stroid, $MatriID, $name, $mode, $amount, $status, $serch_id);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if (!$ok) {
    error_log('contact_paid_success: insert failed for ' . $payment_id);
    echo json_encode(array('status' => 'error', 'message' => 'Could not record payment'));
    exit;
}

echo json_encode(array('status' => 'success', 'message' => 'Payment recorded'));
