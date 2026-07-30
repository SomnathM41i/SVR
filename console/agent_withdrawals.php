<?php
require_once('agent_common.php');
$message = '';
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_request'])) {
    $agentId = (int)($_POST['agent_id'] ?? 0);
    $amount = (float)($_POST['requested_amount'] ?? 0);
    $remarks = trim($_POST['admin_remarks'] ?? '');
    $available = agent_available_balance($con, $agentId);
    if ($agentId <= 0) { $errors[] = 'Select an agent.'; }
    if ($amount <= 0) { $errors[] = 'Requested amount must be greater than zero.'; }
    if ($amount > $available) { $errors[] = 'Requested amount cannot exceed eligible available balance.'; }
    if (!$errors) {
        $status = 'Pending';
        $today = date('Y-m-d');
        $stmt = $con->prepare("INSERT INTO agent_withdrawal_requests (agent_id, requested_amount, available_balance, request_date, status, admin_remarks) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iddsss", $agentId, $amount, $available, $today, $status, $remarks);
        $stmt->execute();
        $stmt->close();
        $message = 'Withdrawal request created.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_request'])) {
    $withdrawalId = (int)($_POST['withdrawal_id'] ?? 0);
    $status = $_POST['status'] ?? 'Pending';
    $remarks = trim($_POST['admin_remarks'] ?? '');
    $paymentDate = trim($_POST['payment_date'] ?? '');
    if (!in_array($status, array('Pending','Approved','Rejected','Paid'), true)) {
        $status = 'Pending';
    }
    if ($status === 'Paid' && $paymentDate === '') {
        $paymentDate = date('Y-m-d');
    }
    $stmt = $con->prepare("UPDATE agent_withdrawal_requests SET status=?, admin_remarks=?, payment_date=?, updated_at=NOW() WHERE withdrawal_id=?");
    $stmt->bind_param("sssi", $status, $remarks, $paymentDate, $withdrawalId);
    $stmt->execute();
    $stmt->close();
    $message = 'Withdrawal request updated.';
}

$agents = agent_active_options($con);
$requests = $con->query("SELECT w.*, a.full_name, a.bank_name, a.account_holder_name, a.account_number, a.ifsc_code, a.branch_name, a.upi_id
    FROM agent_withdrawal_requests w
    LEFT JOIN agents a ON a.agent_id=w.agent_id
    ORDER BY w.withdrawal_id DESC");

agent_admin_start('Withdrawal Requests');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card"><div class="card-header"><h5>Create Withdrawal Request</h5></div><div class="card-body">
            <?php if ($message) { ?><div class="alert alert-success"><?php echo agent_h($message); ?></div><?php } ?>
            <?php if ($errors) { ?><div class="alert alert-danger"><?php echo agent_h(implode(' ', $errors)); ?></div><?php } ?>
            <form method="post" class="row g-2">
                <input type="hidden" name="create_request" value="1">
                <div class="col-md-4"><select name="agent_id" class="form-control" required><option value="">Select Agent</option><?php foreach ($agents as $agent) { ?><option value="<?php echo (int)$agent['agent_id']; ?>"><?php echo agent_h($agent['full_name']); ?> (Available: <?php echo agent_money(agent_available_balance($con, $agent['agent_id'])); ?>)</option><?php } ?></select></div>
                <div class="col-md-3"><input type="number" name="requested_amount" step="0.01" min="0" class="form-control" placeholder="Requested Amount" required></div>
                <div class="col-md-3"><input type="text" name="admin_remarks" class="form-control" placeholder="Remarks"></div>
                <div class="col-md-2"><button class="btn btn-primary">Create</button></div>
            </form>
        </div></div>
    </div>
</div>
<div class="row"><div class="col-sm-12"><div class="card"><div class="card-header"><h5>Requests</h5></div><div class="card-body">
<div class="table-responsive"><table class="table table-bordered table-striped agent-table">
<thead><tr><th>Agent</th><th>Requested</th><th>Available At Request</th><th>Bank Details</th><th>UPI</th><th>Request Date</th><th>Status</th><th>Remarks</th><th>Payment Date</th><th>Action</th></tr></thead><tbody>
<?php if ($requests && $requests->num_rows) { while ($row = $requests->fetch_assoc()) { ?>
<tr>
<td><?php echo agent_h($row['full_name']); ?></td>
<td><?php echo agent_money($row['requested_amount']); ?></td>
<td><?php echo agent_money($row['available_balance']); ?></td>
<td><?php echo agent_h($row['account_holder_name'] . ' | ' . $row['bank_name'] . ' | ' . $row['account_number'] . ' | ' . $row['ifsc_code'] . ' | ' . $row['branch_name']); ?></td>
<td><?php echo agent_h($row['upi_id']); ?></td>
<td><?php echo agent_h($row['request_date']); ?></td>
<td><?php echo agent_h($row['status']); ?></td>
<td><?php echo agent_h($row['admin_remarks']); ?></td>
<td><?php echo agent_h($row['payment_date']); ?></td>
<td>
<form method="post" class="agent-actions">
    <input type="hidden" name="update_request" value="1">
    <input type="hidden" name="withdrawal_id" value="<?php echo (int)$row['withdrawal_id']; ?>">
    <select name="status" class="form-control form-control-sm mb-1">
        <?php foreach (array('Pending','Approved','Rejected','Paid') as $s) { ?><option <?php echo $row['status'] === $s ? 'selected' : ''; ?>><?php echo $s; ?></option><?php } ?>
    </select>
    <input type="date" name="payment_date" class="form-control form-control-sm mb-1" value="<?php echo agent_h($row['payment_date']); ?>">
    <input type="text" name="admin_remarks" class="form-control form-control-sm mb-1" value="<?php echo agent_h($row['admin_remarks']); ?>" placeholder="Remarks">
    <button class="btn btn-sm btn-primary">Update</button>
</form>
</td>
</tr>
<?php }} else { ?><tr><td colspan="10" class="text-center">No withdrawal requests found.</td></tr><?php } ?>
</tbody></table></div>
</div></div></div></div>
<?php agent_admin_end(); ?>
