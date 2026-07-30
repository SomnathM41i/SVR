<?php
require_once('common.php');
ap_require_login();
$agentId = ap_agent_id();
$availability = ap_commission_availability($con, $agentId);

$stats = array(
    'My Customers' => ap_scalar($con, "SELECT COUNT(*) FROM agent_customers WHERE agent_id=?", $agentId),
    'My Sales' => ap_scalar($con, "SELECT COUNT(*) FROM agent_sales WHERE agent_id=?", $agentId),
    'On Hold Commission' => ap_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE agent_id=? AND commission_status='On Hold'", $agentId),
    'Eligible Balance' => ap_available_balance($con, $agentId),
    'Paid Commission' => ap_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE agent_id=? AND commission_status='Paid'", $agentId),
    'Withdrawal Requests' => ap_scalar($con, "SELECT COUNT(*) FROM agent_withdrawal_requests WHERE agent_id=?", $agentId)
);

ap_start('Dashboard');
?>
<?php if ($availability['message'] !== '') { ?>
<div class="alert alert-warning"><?php echo ap_h($availability['message']); ?></div>
<?php } ?>
<div class="ap-grid">
<?php foreach ($stats as $label => $value) { ?>
    <div class="ap-card">
        <div class="ap-stat-label"><?php echo ap_h($label); ?></div>
        <div class="ap-stat-value"><?php echo strpos($label, 'Commission') !== false || strpos($label, 'Balance') !== false ? ap_money($value) : ap_h($value); ?></div>
    </div>
<?php } ?>
</div>
<div class="ap-card">
    <h5 class="mb-3">Assigned Plans</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead><tr><th>Plan</th><th>Amount</th><th>Your Commission</th></tr></thead>
            <tbody>
            <?php $plans = ap_assigned_plans($con, $agentId); if ($plans) { foreach ($plans as $plan) { ?>
                <tr><td><?php echo ap_h($plan['plandisplayname']); ?></td><td><?php echo ap_money($plan['planamount']); ?></td><td><?php echo ap_money($plan['commission_percentage']); ?>%</td></tr>
            <?php }} else { ?>
                <tr><td colspan="3" class="text-center">No plans assigned yet.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php ap_end(); ?>
