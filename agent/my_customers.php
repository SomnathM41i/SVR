<?php
require_once('common.php');
ap_require_login();
$agentId = ap_agent_id();
$stmt = $con->prepare("SELECT * FROM agent_customers WHERE agent_id=? ORDER BY customer_id DESC");
$stmt->bind_param("i", $agentId);
$stmt->execute();
$customers = $stmt->get_result();

ap_start('My Customers');
?>
<div class="ap-card">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead><tr><th>Name</th><th>Mobile</th><th>Email</th><th>Registered ID</th><th>Plan</th><th>Status</th><th>Notes</th><th>Added</th></tr></thead>
            <tbody>
            <?php if ($customers->num_rows) { while ($row = $customers->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo ap_h($row['customer_name']); ?></td>
                    <td><?php echo ap_h($row['customer_mobile']); ?></td>
                    <td><?php echo ap_h($row['customer_email']); ?></td>
                    <td><?php echo ap_h($row['registered_matri_id'] ?? ''); ?></td>
                    <td><?php echo ap_h($row['plan_name']); ?></td>
                    <td><?php echo ap_h($row['customer_status']); ?></td>
                    <td><?php echo nl2br(ap_h($row['notes'])); ?></td>
                    <td><?php echo ap_h($row['created_at']); ?></td>
                </tr>
            <?php }} else { ?>
                <tr><td colspan="8" class="text-center">No customers added yet.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php ap_end(); ?>
