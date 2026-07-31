<?php
require_once('includes/bootstrap.php');
include('memprotect.php');
/**
 * payment_failed_handler.php — records a failed Razorpay checkout attempt.
 *
 * Called via fetch() (POST, JSON) from membership_choose.php when Razorpay
 * reports 'payment.failed' or the payer abandons the checkout. The companion
 * page payment_failed.php (the redirect target) already existed; this endpoint
 * is the handler that page flow always expected. Semantics intentionally
 * mirror the failure branch of payment_success.php (same table, same columns,
 * same escaping); it never overwrites an order that already settled.
 */

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!is_array($data)) {
    $data = $_POST;
}

$local_order_id = isset($data['local_order_id']) ? trim($data['local_order_id']) : '';
$rzp_error      = isset($data['error'])          ? trim($data['error'])          : '';

if ($local_order_id !== '' && strlen($local_order_id) <= 64) {
    $lo  = mysqli_real_escape_string($con, $local_order_id);
    $now = date('Y-m-d H:i:s');
    // Only a still-pending order may flip to Failed — never touch a settled one.
    mysqli_query($con, "UPDATE transactions SET status='Failed', updated_at='$now' WHERE order_id='$lo' AND status='Pending'")
        or svr_db_fail($con);
    error_log("Razorpay payment failed for order: $lo" . ($rzp_error !== '' ? " - $rzp_error" : ''));
}

echo json_encode(array('status' => 'recorded'));
exit;
