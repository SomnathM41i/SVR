<?php
require_once('agent_common.php');
$id = (int)($_GET['id'] ?? 0);
$agent = $con->query("SELECT * FROM agents WHERE agent_id=$id")->fetch_assoc();
if (!$agent) { header('Location: agents'); exit; }
$plans = $con->query("SELECT apa.*, mp.plandisplayname, mp.planamount FROM agent_plan_assignments apa LEFT JOIN membershipplan mp ON mp.planid=apa.plan_id WHERE apa.agent_id=$id ORDER BY mp.plandisplayname");
agent_admin_start('View Agent');
?>
<div class="row">
    <div class="col-md-6"><div class="card"><div class="card-header"><h5>Personal Details</h5></div><div class="card-body">
        <p><strong>Name:</strong> <?php echo agent_h($agent['full_name']); ?></p>
        <p><strong>Mobile:</strong> <?php echo agent_h($agent['mobile']); ?></p>
        <p><strong>Email:</strong> <?php echo agent_h($agent['email']); ?></p>
        <p><strong>Address:</strong> <?php echo nl2br(agent_h($agent['address'])); ?></p>
        <p><strong>City/State/Pincode:</strong> <?php echo agent_h($agent['city'] . ' ' . $agent['state'] . ' ' . $agent['pincode']); ?></p>
        <p><strong>Joining Date:</strong> <?php echo agent_h($agent['joining_date']); ?></p>
        <p><strong>Status:</strong> <?php echo agent_h($agent['status']); ?></p>
        <p><strong>Notes:</strong> <?php echo nl2br(agent_h($agent['notes'])); ?></p>
        <a class="btn btn-primary" href="agent_edit?id=<?php echo $id; ?>">Edit</a>
    </div></div></div>
    <div class="col-md-6"><div class="card"><div class="card-header"><h5>Bank / UPI Details</h5></div><div class="card-body">
        <p><strong>Account Holder:</strong> <?php echo agent_h($agent['account_holder_name']); ?></p>
        <p><strong>Bank:</strong> <?php echo agent_h($agent['bank_name']); ?></p>
        <p><strong>Account Number:</strong> <?php echo agent_h($agent['account_number']); ?></p>
        <p><strong>IFSC:</strong> <?php echo agent_h($agent['ifsc_code']); ?></p>
        <p><strong>Branch:</strong> <?php echo agent_h($agent['branch_name']); ?></p>
        <p><strong>UPI ID:</strong> <?php echo agent_h($agent['upi_id']); ?></p>
    </div></div></div>
</div>
<div class="row"><div class="col-sm-12"><div class="card"><div class="card-header"><h5>Assigned Plans</h5></div><div class="card-body">
<table class="table table-bordered"><thead><tr><th>Plan</th><th>Amount</th><th>Commission %</th><th>Status</th></tr></thead><tbody>
<?php if ($plans && $plans->num_rows) { while ($plan = $plans->fetch_assoc()) { ?>
<tr><td><?php echo agent_h($plan['plandisplayname']); ?></td><td><?php echo agent_money($plan['planamount']); ?></td><td><?php echo agent_money($plan['commission_percentage']); ?>%</td><td><?php echo agent_h($plan['status']); ?></td></tr>
<?php }} else { ?><tr><td colspan="4" class="text-center">No assigned plans.</td></tr><?php } ?>
</tbody></table>
</div></div></div></div>
<?php agent_admin_end(); ?>
