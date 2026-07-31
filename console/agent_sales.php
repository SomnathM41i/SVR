<?php
require_once('agent_common.php');
$agentId = (int)($_GET['agent_id'] ?? 0);
$planId = (int)($_GET['plan_id'] ?? 0);
$paymentStatus = trim($_GET['payment_status'] ?? '');
$commissionStatus = trim($_GET['commission_status'] ?? '');
$fromDate = trim($_GET['from_date'] ?? '');
$toDate = trim($_GET['to_date'] ?? '');
$where = array("1=1");
if ($agentId > 0) { $where[] = "s.agent_id=$agentId"; }
if ($planId > 0) { $where[] = "s.plan_id=$planId"; }
if ($paymentStatus !== '') { $where[] = "s.payment_status='" . $con->real_escape_string($paymentStatus) . "'"; }
if ($commissionStatus !== '') { $where[] = "c.commission_status='" . $con->real_escape_string($commissionStatus) . "'"; }
if ($fromDate !== '') { $where[] = "s.sale_date>='" . $con->real_escape_string($fromDate) . "'"; }
if ($toDate !== '') { $where[] = "s.sale_date<='" . $con->real_escape_string($toDate) . "'"; }
$sql = "SELECT s.*, a.full_name AS agent_name, c.commission_percentage, c.commission_amount, c.commission_status, c.eligible_date,
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
        FROM agent_sales s
        LEFT JOIN agents a ON a.agent_id=s.agent_id
        LEFT JOIN agent_commissions c ON c.sale_id=s.sale_id
        WHERE " . implode(' AND ', $where) . "
        ORDER BY s.sale_date DESC, s.sale_id DESC";
$sales = $con->query($sql);
$agents = agent_active_options($con);
$plans = agent_plan_options($con);
$statuses = array('Pending','On Hold','Eligible','Withdrawal Requested','Approved','Paid','Rejected');

agent_admin_start('Agent Sales');
?>
<div class="row"><div class="col-sm-12"><div class="card"><div class="card-body">
<form method="get" class="row g-2 mb-4">
    <div class="col-md-2"><select name="agent_id" class="form-control"><option value="">Agent</option><?php foreach ($agents as $agent) { ?><option value="<?php echo (int)$agent['agent_id']; ?>" <?php echo $agentId === (int)$agent['agent_id'] ? 'selected' : ''; ?>><?php echo agent_h($agent['full_name']); ?></option><?php } ?></select></div>
    <div class="col-md-2"><select name="plan_id" class="form-control"><option value="">Plan</option><?php foreach ($plans as $plan) { ?><option value="<?php echo (int)$plan['planid']; ?>" <?php echo $planId === (int)$plan['planid'] ? 'selected' : ''; ?>><?php echo agent_h($plan['plandisplayname']); ?></option><?php } ?></select></div>
    <div class="col-md-2"><input type="date" name="from_date" class="form-control" value="<?php echo agent_h($fromDate); ?>"></div>
    <div class="col-md-2"><input type="date" name="to_date" class="form-control" value="<?php echo agent_h($toDate); ?>"></div>
    <div class="col-md-2"><select name="payment_status" class="form-control"><option value="">Payment Status</option><?php foreach (array('Pending','Clear','Failed','Refunded') as $s) { ?><option <?php echo $paymentStatus === $s ? 'selected' : ''; ?>><?php echo $s; ?></option><?php } ?></select></div>
    <div class="col-md-2"><select name="commission_status" class="form-control"><option value="">Commission Status</option><?php foreach ($statuses as $s) { ?><option <?php echo $commissionStatus === $s ? 'selected' : ''; ?>><?php echo $s; ?></option><?php } ?></select></div>
    <div class="col-md-12"><button class="btn btn-secondary">Filter</button></div>
</form>
<div class="table-responsive">
<table class="table table-bordered table-striped agent-table">
<thead><tr><th>Customer</th><th>Mobile</th><th>Email</th><th>Agent</th><th>Plan</th><th>Amount</th><th>Source</th><th>Payment Ref</th><th>Payment</th><th>Sale</th><th>Sale Date</th><th>Commission %</th><th>Commission</th><th>Status</th><th>Eligible Date</th></tr></thead>
<tbody>
<?php if ($sales && $sales->num_rows) { while ($row = $sales->fetch_assoc()) { ?>
<tr>
<td><?php echo agent_h($row['customer_name']); ?></td><td><?php echo agent_h($row['customer_mobile']); ?></td><td><?php echo agent_h($row['customer_email']); ?></td><td><?php echo agent_h($row['agent_name']); ?></td><td><?php echo agent_h($row['plan_name']); ?></td><td><?php echo agent_money($row['plan_amount']); ?></td><td><?php echo agent_h($row['source_label'] ?? 'Manual Customer Purchase'); ?></td><td><?php echo agent_h($row['payment_reference_id'] ?? ''); ?></td><td><?php echo agent_h($row['payment_status']); ?></td><td><?php echo agent_h($row['sale_status']); ?></td><td><?php echo agent_h($row['sale_date']); ?></td><td><?php echo agent_money($row['commission_percentage']); ?>%</td><td><?php echo agent_money($row['commission_amount']); ?></td><td><?php echo agent_h($row['commission_status']); ?></td><td><?php echo agent_h($row['eligible_date']); ?></td>
</tr>
<?php }} else { ?><tr><td colspan="15" class="text-center">No agent sales found.</td></tr><?php } ?>
</tbody></table>
</div>
</div></div></div></div>
<?php agent_admin_end(); ?>
