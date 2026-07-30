<?php
require_once('common.php');
ap_require_login();
$agentId = ap_agent_id();
$message = '';
$errors = array();
$availableBalance = ap_available_balance($con, $agentId);
$availability = ap_commission_availability($con, $agentId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = (float)($_POST['requested_amount'] ?? 0);
    $remarks = trim($_POST['admin_remarks'] ?? '');
    $available = $availableBalance;
    if ($amount <= 0) { $errors[] = 'Requested amount must be greater than zero.'; }
    if ($amount > $available) { $errors[] = 'Requested amount cannot exceed your available eligible balance.'; }
    if (!$errors) {
        $today = date('Y-m-d');
        $status = 'Pending';
        $stmt = $con->prepare("INSERT INTO agent_withdrawal_requests (agent_id, requested_amount, available_balance, request_date, status, admin_remarks) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iddsss", $agentId, $amount, $available, $today, $status, $remarks);
        $stmt->execute();
        $stmt->close();
        $message = 'Withdrawal request submitted.';
    }
}

$stmt = $con->prepare("SELECT * FROM agent_withdrawal_requests WHERE agent_id=? ORDER BY withdrawal_id DESC");
$stmt->bind_param("i", $agentId);
$stmt->execute();
$requests = $stmt->get_result();

ap_start('Withdrawal Request');
?>
<?php if ($availability['message'] !== '') { ?>
<div class="alert alert-warning"><?php echo ap_h($availability['message']); ?></div>
<?php } ?>
<div class="ap-grid">
    <div class="ap-card"><div class="ap-stat-label">Available Balance</div><div class="ap-stat-value"><?php echo ap_money($availableBalance); ?></div></div>
</div>
<div class="ap-card mb-3">
<?php if ($message) { ?><div class="alert alert-success"><?php echo ap_h($message); ?></div><?php } ?>
<?php if ($errors) { ?><div class="alert alert-danger"><?php echo ap_h(implode(' ', $errors)); ?></div><?php } ?>
<form method="post" class="row">
    <div class="col-md-4 form-group"><label>Requested Amount</label><input type="number" step="0.01" min="0" max="<?php echo ap_h($availableBalance); ?>" class="form-control" name="requested_amount" <?php echo $availableBalance <= 0 ? 'disabled' : 'required'; ?>></div>
    <div class="col-md-6 form-group"><label>Remarks</label><input class="form-control" name="admin_remarks"></div>
    <div class="col-md-2 form-group d-flex align-items-end"><button class="btn btn-primary w-100" <?php echo $availableBalance <= 0 ? 'disabled' : ''; ?>>Submit</button></div>
</form>
</div>
<div class="ap-card">
    <div class="table-responsive"><table class="table table-bordered table-striped">
        <thead><tr><th>Amount</th><th>Available At Request</th><th>Request Date</th><th>Status</th><th>Remarks</th><th>Payment Date</th></tr></thead>
        <tbody>
        <?php if ($requests->num_rows) { while ($row = $requests->fetch_assoc()) { ?>
            <tr><td><?php echo ap_money($row['requested_amount']); ?></td><td><?php echo ap_money($row['available_balance']); ?></td><td><?php echo ap_h($row['request_date']); ?></td><td><?php echo ap_h($row['status']); ?></td><td><?php echo ap_h($row['admin_remarks']); ?></td><td><?php echo ap_h($row['payment_date']); ?></td></tr>
        <?php }} else { ?><tr><td colspan="6" class="text-center">No withdrawal requests yet.</td></tr><?php } ?>
        </tbody>
    </table></div>
</div>
<?php ap_end(); ?>
