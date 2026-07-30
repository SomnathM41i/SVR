<?php
require_once('agent_common.php');
$agents = agent_active_options($con);
$plans = agent_plan_options($con);
$selectedAgent = (int)($_GET['agent_id'] ?? ($_POST['agent_id'] ?? 0));
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $selectedAgent > 0) {
    foreach ($plans as $plan) {
        $planId = (int)$plan['planid'];
        $enabled = isset($_POST['plan'][$planId]);
        $percentage = isset($_POST['commission'][$planId]) ? (float)$_POST['commission'][$planId] : 0;
        if ($enabled && $percentage >= 0) {
            $status = 'Active';
            $stmt = $con->prepare("INSERT INTO agent_plan_assignments (agent_id, plan_id, commission_percentage, status, updated_at) VALUES (?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE commission_percentage=VALUES(commission_percentage), status='Active', updated_at=NOW()");
            $stmt->bind_param("iids", $selectedAgent, $planId, $percentage, $status);
            $stmt->execute();
            $stmt->close();
        } else {
            $stmt = $con->prepare("UPDATE agent_plan_assignments SET status='Inactive', updated_at=NOW() WHERE agent_id=? AND plan_id=?");
            $stmt->bind_param("ii", $selectedAgent, $planId);
            $stmt->execute();
            $stmt->close();
        }
    }
    $message = 'Plan assignments updated successfully.';
}

$assignments = array();
if ($selectedAgent > 0) {
    $result = $con->query("SELECT * FROM agent_plan_assignments WHERE agent_id=$selectedAgent");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $assignments[(int)$row['plan_id']] = $row;
        }
    }
}

agent_admin_start('Assign Plans');
?>
<div class="row"><div class="col-sm-12"><div class="card"><div class="card-body">
<?php if ($message) { ?><div class="alert alert-success"><?php echo agent_h($message); ?></div><?php } ?>
<form method="get" class="row g-2 mb-4">
    <div class="col-md-5">
        <select name="agent_id" class="form-control" required>
            <option value="">Select Agent</option>
            <?php foreach ($agents as $agent) { ?>
            <option value="<?php echo (int)$agent['agent_id']; ?>" <?php echo $selectedAgent === (int)$agent['agent_id'] ? 'selected' : ''; ?>>
                <?php echo agent_h($agent['full_name'] . ' - ' . $agent['mobile']); ?>
            </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2"><button class="btn btn-secondary">Load Plans</button></div>
</form>

<?php if ($selectedAgent > 0) { ?>
<form method="post">
    <input type="hidden" name="agent_id" value="<?php echo $selectedAgent; ?>">
    <div class="table-responsive">
        <table class="table table-bordered agent-table">
            <thead><tr><th>Assign</th><th>Plan</th><th>Plan Price</th><th>Commission %</th></tr></thead>
            <tbody>
            <?php foreach ($plans as $plan) {
                $planId = (int)$plan['planid'];
                $assigned = isset($assignments[$planId]) && $assignments[$planId]['status'] === 'Active';
                $percent = isset($assignments[$planId]) ? $assignments[$planId]['commission_percentage'] : '';
            ?>
                <tr>
                    <td><input type="checkbox" name="plan[<?php echo $planId; ?>]" value="1" <?php echo $assigned ? 'checked' : ''; ?>></td>
                    <td><?php echo agent_h($plan['plandisplayname']); ?></td>
                    <td><?php echo agent_money($plan['planamount']); ?></td>
                    <td><input type="number" min="0" max="100" step="0.01" class="form-control" name="commission[<?php echo $planId; ?>]" value="<?php echo agent_h($percent); ?>" placeholder="0.00"></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <button class="btn btn-primary">Save Assignments</button>
</form>
<?php } ?>
</div></div></div></div>
<?php agent_admin_end(); ?>
