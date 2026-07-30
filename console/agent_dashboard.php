<?php
require_once('agent_common.php');

function agent_scalar($con, $sql) {
    $result = $con->query($sql);
    if ($result && ($row = $result->fetch_row())) {
        return $row[0] ?: 0;
    }
    return 0;
}

$stats = array(
    'Total Agents' => agent_scalar($con, "SELECT COUNT(*) FROM agents"),
    'Active Agents' => agent_scalar($con, "SELECT COUNT(*) FROM agents WHERE status='Active'"),
    'Inactive Agents' => agent_scalar($con, "SELECT COUNT(*) FROM agents WHERE status='Inactive'"),
    'Total Agent Sales' => agent_scalar($con, "SELECT COUNT(*) FROM agent_sales"),
    "Today's Sales" => agent_scalar($con, "SELECT COUNT(*) FROM agent_sales WHERE sale_date=CURDATE()"),
    'Monthly Sales' => agent_scalar($con, "SELECT COUNT(*) FROM agent_sales WHERE YEAR(sale_date)=YEAR(CURDATE()) AND MONTH(sale_date)=MONTH(CURDATE())"),
    'Pending Commission' => agent_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE commission_status='Pending'"),
    'On Hold Commission' => agent_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE commission_status='On Hold'"),
    'Eligible Commission' => agent_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE commission_status='Eligible'"),
    'Paid Commission' => agent_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE commission_status='Paid'"),
    'Rejected Commission' => agent_scalar($con, "SELECT COALESCE(SUM(commission_amount),0) FROM agent_commissions WHERE commission_status='Rejected'"),
    'Pending Withdrawals' => agent_scalar($con, "SELECT COUNT(*) FROM agent_withdrawal_requests WHERE status='Pending'"),
    'Approved Withdrawals' => agent_scalar($con, "SELECT COUNT(*) FROM agent_withdrawal_requests WHERE status='Approved'"),
    'Paid Withdrawals' => agent_scalar($con, "SELECT COUNT(*) FROM agent_withdrawal_requests WHERE status='Paid'")
);

agent_admin_start('Agent Dashboard');
?>
<div class="col-sm-12">
    <div class="agent-page-title">
        <span class="agent-title-badge"><i class="fas fa-user-tie"></i> Agent Dashboard</span>
    </div>
    <div class="agent-stat-grid">
<?php
$cardClasses = array('sc--total', 'sc--active', 'sc--inactive', 'sc--sales', 'sc--today', 'sc--sales', 'sc--hold', 'sc--hold', 'sc--active', 'sc--paid', 'sc--inactive', 'sc--withdrawal', 'sc--withdrawal', 'sc--paid');
$cardIcons = array('fa-users', 'fa-user-check', 'fa-user-slash', 'fa-chart-line', 'fa-calendar-day', 'fa-calendar-alt', 'fa-hourglass-half', 'fa-clock', 'fa-check-circle', 'fa-rupee-sign', 'fa-times-circle', 'fa-file-invoice', 'fa-thumbs-up', 'fa-money-check-alt');
$i = 0;
foreach ($stats as $label => $value) {
    $displayValue = is_numeric($value) && strpos($label, 'Commission') !== false ? agent_money($value) : agent_h($value);
    $cardClass = $cardClasses[$i] ?? 'sc--total';
    $cardIcon = $cardIcons[$i] ?? 'fa-chart-bar';
    $i++;
?>
        <div class="agent-stat-card <?php echo $cardClass; ?>">
            <div class="sc-label"><?php echo agent_h($label); ?></div>
            <div class="sc-value"><?php echo $displayValue; ?></div>
            <i class="fas <?php echo $cardIcon; ?> sc-icon"></i>
        </div>
<?php } ?>
    </div>
</div>
<?php agent_admin_end(); ?>
