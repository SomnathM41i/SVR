<?php
require_once('common.php');
ap_require_login();
$agentId = ap_agent_id();
$availability = ap_commission_availability($con, $agentId);
$stmt = $con->prepare("SELECT c.*, s.customer_name, s.customer_mobile, s.plan_name, s.plan_amount,
    CASE WHEN EXISTS (
        SELECT 1 FROM agent_sales ps
        WHERE ps.agent_id=s.agent_id
        AND ps.sale_id<s.sale_id
        AND (
            (LENGTH(s.customer_matri_id) > 0 AND ps.customer_matri_id=s.customer_matri_id)
            OR (LENGTH(s.customer_mobile) > 0 AND ps.customer_mobile=s.customer_mobile)
            OR (LENGTH(s.customer_email) > 0 AND LOWER(ps.customer_email)=LOWER(s.customer_email))
        )
    ) THEN 'Renew Plan Commission' ELSE 'Manual Customer Purchase' END AS source_label
    FROM agent_commissions c
    LEFT JOIN agent_sales s ON s.sale_id=c.sale_id
    WHERE c.agent_id=?
    ORDER BY c.sale_date DESC, c.commission_id DESC");
$stmt->bind_param("i", $agentId);
$stmt->execute();
$commissions = $stmt->get_result();

$stmt = $con->prepare("SELECT c.*
    FROM agent_customers c
    WHERE c.agent_id=?
    AND NOT EXISTS (
        SELECT 1
        FROM agent_sales s
        WHERE s.agent_id=c.agent_id
        AND (
            (c.customer_mobile <> '' AND s.customer_mobile = c.customer_mobile)
            OR (c.customer_email <> '' AND s.customer_email = c.customer_email)
        )
    )
    ORDER BY c.customer_id DESC");
$stmt->bind_param("i", $agentId);
$stmt->execute();
$pendingCustomers = $stmt->get_result();

ap_start('My Commission');
?>
<div class="alert alert-info">
    Commission is generated only after Admin confirms the customer sale and activates the purchased plan. New customers added by you stay in pending/follow-up until Admin completes the sale.
</div>
<?php if ($availability['message'] !== '') { ?>
<div class="alert alert-warning"><?php echo ap_h($availability['message']); ?></div>
<?php } ?>
<div class="ap-grid">
    <div class="ap-card"><div class="ap-stat-label">Available Balance</div><div class="ap-stat-value"><?php echo ap_money(ap_available_balance($con, $agentId)); ?></div></div>
    <div class="ap-card"><div class="ap-stat-label">On Hold</div><div class="ap-stat-value"><?php echo ap_money(ap_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE agent_id=? AND commission_status='On Hold'", $agentId)); ?></div></div>
    <div class="ap-card"><div class="ap-stat-label">Paid</div><div class="ap-stat-value"><?php echo ap_money(ap_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE agent_id=? AND commission_status='Paid'", $agentId)); ?></div></div>
</div>
<div class="ap-card">
    <h5 class="mb-3">Confirmed Commission</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead><tr><th>Customer</th><th>Mobile</th><th>Plan</th><th>Plan Amount</th><th>Source</th><th>%</th><th>Commission</th><th>Status</th><th>Sale Date</th><th>Eligible Date</th></tr></thead>
            <tbody>
            <?php if ($commissions->num_rows) { while ($row = $commissions->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo ap_h($row['customer_name']); ?></td>
                    <td><?php echo ap_h($row['customer_mobile']); ?></td>
                    <td><?php echo ap_h($row['plan_name']); ?></td>
                    <td><?php echo ap_money($row['plan_amount']); ?></td>
                    <td><?php echo ap_h($row['source_label'] ?? 'Manual Customer Purchase'); ?></td>
                    <td><?php echo ap_money($row['commission_percentage']); ?>%</td>
                    <td><?php echo ap_money($row['commission_amount']); ?></td>
                    <td>
                        <?php echo ap_h($row['commission_status']); ?>
                        <?php if ($row['commission_status'] === 'On Hold' && $row['eligible_date'] !== '') { ?>
                            <div class="text-muted small">Available on <?php echo ap_h(date('d M Y', strtotime($row['eligible_date']))); ?></div>
                        <?php } ?>
                    </td>
                    <td><?php echo ap_h($row['sale_date']); ?></td>
                    <td><?php echo ap_h($row['eligible_date']); ?></td>
                </tr>
            <?php }} else { ?>
                <tr><td colspan="10" class="text-center">No commission records yet.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="ap-card mt-3">
    <h5 class="mb-3">Waiting for Admin Sale Confirmation</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead><tr><th>Customer</th><th>Mobile</th><th>Email</th><th>Interested/Purchased Plan</th><th>Status</th><th>Added</th></tr></thead>
            <tbody>
            <?php if ($pendingCustomers->num_rows) { while ($row = $pendingCustomers->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo ap_h($row['customer_name']); ?></td>
                    <td><?php echo ap_h($row['customer_mobile']); ?></td>
                    <td><?php echo ap_h($row['customer_email']); ?></td>
                    <td><?php echo ap_h($row['plan_name']); ?></td>
                    <td><?php echo ap_h($row['customer_status']); ?></td>
                    <td><?php echo ap_h($row['created_at']); ?></td>
                </tr>
            <?php }} else { ?>
                <tr><td colspan="6" class="text-center">No pending customers.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php ap_end(); ?>
