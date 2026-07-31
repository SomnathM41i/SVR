<?php
require_once('agent_common.php');
$agentId = (int)($_GET['agent_id'] ?? 0);
$planId = (int)($_GET['plan_id'] ?? 0);
$status = trim($_GET['status'] ?? '');
$fromDate = trim($_GET['from_date'] ?? '');
$toDate = trim($_GET['to_date'] ?? '');
$where = array("1=1");
if ($agentId > 0) { $where[] = "a.agent_id=$agentId"; }
if ($planId > 0) { $where[] = "s.plan_id=$planId"; }
if ($status !== '') { $where[] = "c.commission_status='" . $con->real_escape_string($status) . "'"; }
if ($fromDate !== '') { $where[] = "s.sale_date>='" . $con->real_escape_string($fromDate) . "'"; }
if ($toDate !== '') { $where[] = "s.sale_date<='" . $con->real_escape_string($toDate) . "'"; }
$sql = "SELECT a.agent_id, a.full_name,
        COUNT(DISTINCT s.sale_id) AS total_sales,
        COALESCE(SUM(s.plan_amount),0) AS total_sales_amount,
        COALESCE(SUM(c.commission_amount),0) AS total_commission,
        COALESCE(SUM(CASE WHEN c.commission_status='Pending' THEN c.commission_amount ELSE 0 END),0) AS pending_commission,
        COALESCE(SUM(CASE WHEN c.commission_status='On Hold' THEN c.commission_amount ELSE 0 END),0) AS hold_commission,
        COALESCE(SUM(CASE WHEN c.commission_status='Eligible' THEN c.commission_amount ELSE 0 END),0) AS eligible_commission,
        COALESCE(SUM(CASE WHEN c.commission_status='Paid' THEN c.commission_amount ELSE 0 END),0) AS paid_commission,
        COALESCE(SUM(CASE WHEN c.commission_status='Rejected' THEN c.commission_amount ELSE 0 END),0) AS rejected_commission
        FROM agents a
        LEFT JOIN agent_sales s ON s.agent_id=a.agent_id
        LEFT JOIN agent_commissions c ON c.sale_id=s.sale_id
        WHERE " . implode(' AND ', $where) . "
        GROUP BY a.agent_id, a.full_name
        ORDER BY a.full_name";
$rows = $con->query($sql);
$agents = agent_active_options($con);
$plans = agent_plan_options($con);
agent_admin_start('Commission Report');
?>
<div class="row"><div class="col-sm-12"><div class="card"><div class="card-body">
<form method="get" class="row g-2 mb-4">
<div class="col-md-2"><select name="agent_id" class="form-control"><option value="">Agent</option><?php foreach ($agents as $agent) { ?><option value="<?php echo (int)$agent['agent_id']; ?>" <?php echo $agentId === (int)$agent['agent_id'] ? 'selected' : ''; ?>><?php echo agent_h($agent['full_name']); ?></option><?php } ?></select></div>
<div class="col-md-2"><select name="plan_id" class="form-control"><option value="">Plan</option><?php foreach ($plans as $plan) { ?><option value="<?php echo (int)$plan['planid']; ?>" <?php echo $planId === (int)$plan['planid'] ? 'selected' : ''; ?>><?php echo agent_h($plan['plandisplayname']); ?></option><?php } ?></select></div>
<div class="col-md-2"><input type="date" name="from_date" class="form-control" value="<?php echo agent_h($fromDate); ?>"></div>
<div class="col-md-2"><input type="date" name="to_date" class="form-control" value="<?php echo agent_h($toDate); ?>"></div>
<div class="col-md-2"><select name="status" class="form-control"><option value="">Status</option><?php foreach (array('Pending','On Hold','Eligible','Withdrawal Requested','Approved','Paid','Rejected') as $s) { ?><option <?php echo $status === $s ? 'selected' : ''; ?>><?php echo $s; ?></option><?php } ?></select></div>
<div class="col-md-2"><button class="btn btn-secondary">Filter</button></div>
</form>
<div class="table-responsive"><table class="table table-bordered table-striped agent-table">
<thead><tr><th>Agent</th><th>Total Sales</th><th>Sales Amount</th><th>Commission Generated</th><th>Pending</th><th>On Hold</th><th>Eligible</th><th>Paid</th><th>Rejected</th><th>Available Balance</th><th>Total Withdrawn</th></tr></thead><tbody>
<?php if ($rows && $rows->num_rows) { while ($row = $rows->fetch_assoc()) {
    $aid = (int)$row['agent_id'];
    $withdrawn = $con->query("SELECT COALESCE(SUM(requested_amount),0) AS total FROM agent_withdrawal_requests WHERE agent_id=$aid AND status='Paid'")->fetch_assoc();
?>
<tr><td><?php echo agent_h($row['full_name']); ?></td><td><?php echo (int)$row['total_sales']; ?></td><td><?php echo agent_money($row['total_sales_amount']); ?></td><td><?php echo agent_money($row['total_commission']); ?></td><td><?php echo agent_money($row['pending_commission']); ?></td><td><?php echo agent_money($row['hold_commission']); ?></td><td><?php echo agent_money($row['eligible_commission']); ?></td><td><?php echo agent_money($row['paid_commission']); ?></td><td><?php echo agent_money($row['rejected_commission']); ?></td><td><?php echo agent_money(agent_available_balance($con, $aid)); ?></td><td><?php echo agent_money($withdrawn['total']); ?></td></tr>
<?php }} else { ?><tr><td colspan="11" class="text-center">No report data found.</td></tr><?php } ?>
</tbody></table></div>
</div></div></div></div>
<?php agent_admin_end(); ?>
