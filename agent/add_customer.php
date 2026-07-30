<?php
require_once('common.php');
ap_require_login();
$agentId = ap_agent_id();
$plans = ap_assigned_plans($con, $agentId);
$errors = array();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['customer_name'] ?? '');
    $mobile = trim($_POST['customer_mobile'] ?? '');
    $email = trim($_POST['customer_email'] ?? '');
    $planId = (int)($_POST['plan_id'] ?? 0);
    $status = $_POST['customer_status'] ?? 'Interested';
    $notes = trim($_POST['notes'] ?? '');

    if ($name === '') { $errors[] = 'Customer name is required.'; }
    if ($mobile === '') { $errors[] = 'Customer mobile is required.'; }
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = 'Customer email is invalid.'; }
    if (!in_array($status, array('Interested','Follow Up','Purchased','Not Interested'), true)) { $status = 'Interested'; }

    $planName = null;
    if ($planId > 0) {
        foreach ($plans as $plan) {
            if ((int)$plan['planid'] === $planId) {
                $planName = $plan['plandisplayname'];
                break;
            }
        }
        if ($planName === null) { $errors[] = 'Selected plan is not assigned to you.'; }
    }

    if (!$errors) {
        $stmt = $con->prepare("INSERT INTO agent_customers (agent_id, customer_name, customer_mobile, customer_email, plan_id, plan_name, customer_status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssisss", $agentId, $name, $mobile, $email, $planId, $planName, $status, $notes);
        $stmt->execute();
        $stmt->close();
        $message = 'Customer added successfully.';
    }
}

ap_start('Add Customer');
?>
<div class="ap-card">
<?php if ($message) { ?><div class="alert alert-success"><?php echo ap_h($message); ?></div><?php } ?>
<?php if ($errors) { ?><div class="alert alert-danger"><?php echo ap_h(implode(' ', $errors)); ?></div><?php } ?>
<form method="post">
    <div class="row">
        <div class="col-md-6 form-group"><label>Customer Name *</label><input class="form-control" name="customer_name" required></div>
        <div class="col-md-6 form-group"><label>Customer Mobile *</label><input class="form-control" name="customer_mobile" required></div>
        <div class="col-md-6 form-group"><label>Customer Email</label><input type="email" class="form-control" name="customer_email"></div>
        <div class="col-md-6 form-group"><label>Interested/Purchased Plan</label><select class="form-control" name="plan_id"><option value="0">Select Plan</option><?php foreach ($plans as $plan) { ?><option value="<?php echo (int)$plan['planid']; ?>"><?php echo ap_h($plan['plandisplayname']); ?> - <?php echo ap_money($plan['planamount']); ?></option><?php } ?></select></div>
        <div class="col-md-6 form-group"><label>Status</label><select class="form-control" name="customer_status"><option>Interested</option><option>Follow Up</option><option>Purchased</option><option>Not Interested</option></select></div>
        <div class="col-md-12 form-group"><label>Notes</label><textarea class="form-control" name="notes" rows="4"></textarea></div>
    </div>
    <button class="btn btn-primary">Save Customer</button>
</form>
</div>
<?php ap_end(); ?>
