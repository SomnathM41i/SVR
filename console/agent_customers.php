<?php
require_once('agent_common.php');

$plans = agent_plan_options($con);
$statuses = array('Interested', 'Follow Up', 'Purchased', 'Not Interested');
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_customer'])) {
    $customerId = (int)($_POST['customer_id'] ?? 0);
    $updatePlanId = (int)($_POST['plan_id'] ?? 0);
    $updateStatus = trim($_POST['customer_status'] ?? '');
    $updateNotes = trim($_POST['notes'] ?? '');

    if (!in_array($updateStatus, $statuses, true)) {
        $updateStatus = 'Interested';
    }

    $updatePlanName = '';
    if ($updatePlanId > 0) {
        foreach ($plans as $planOption) {
            if ((int)$planOption['planid'] === $updatePlanId) {
                $updatePlanName = $planOption['plandisplayname'];
                break;
            }
        }
    }

    if ($customerId > 0) {
        $stmt = $con->prepare("UPDATE agent_customers SET plan_id=?, plan_name=?, customer_status=?, notes=?, updated_at=NOW() WHERE customer_id=?");
        if ($stmt) {
            $stmt->bind_param("isssi", $updatePlanId, $updatePlanName, $updateStatus, $updateNotes, $customerId);
            if ($stmt->execute()) {
                $message = 'Agent customer updated successfully.';
            } else {
                $error = 'Unable to update agent customer.';
            }
            $stmt->close();
        } else {
            $error = 'Unable to prepare update request.';
        }

        if ($error === '' && $updateStatus === 'Purchased' && $updatePlanId > 0) {
            $stmt = $con->prepare("SELECT c.*, mp.planamount
                FROM agent_customers c
                LEFT JOIN membershipplan mp ON mp.planid=c.plan_id
                WHERE c.customer_id=?
                LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("i", $customerId);
                $stmt->execute();
                $customerResult = $stmt->get_result();
                if ($customer = $customerResult->fetch_assoc()) {
                    $saleReference = 'AGC-' . $customerId;
                    $created = agent_create_commission_for_sale(
                        $con,
                        $saleReference,
                        '',
                        $customer['customer_name'],
                        $customer['customer_mobile'],
                        $customer['customer_email'],
                        (int)$customer['agent_id'],
                        $customer['plan_name'],
                        (float)$customer['planamount'],
                        date('Y-m-d')
                    );
                    if ($created) {
                        $message = 'Agent customer updated and commission created successfully.';
                    } else {
                        $message = 'Agent customer updated. Commission was not created because this plan is not assigned to the agent with an active commission percentage.';
                    }
                }
                $stmt->close();
            }
        }
    }
}

$agentId = (int)($_GET['agent_id'] ?? 0);
$planId = (int)($_GET['plan_id'] ?? 0);
$customerStatus = trim($_GET['customer_status'] ?? '');
$fromDate = trim($_GET['from_date'] ?? '');
$toDate = trim($_GET['to_date'] ?? '');

$where = array("1=1");
if ($agentId > 0) { $where[] = "c.agent_id=$agentId"; }
if ($planId > 0) { $where[] = "c.plan_id=$planId"; }
if ($customerStatus !== '') { $where[] = "c.customer_status='" . $con->real_escape_string($customerStatus) . "'"; }
if ($fromDate !== '') { $where[] = "DATE(c.created_at)>='" . $con->real_escape_string($fromDate) . "'"; }
if ($toDate !== '') { $where[] = "DATE(c.created_at)<='" . $con->real_escape_string($toDate) . "'"; }

$sql = "SELECT c.*, a.full_name AS agent_name
        FROM agent_customers c
        LEFT JOIN agents a ON a.agent_id=c.agent_id
        WHERE " . implode(' AND ', $where) . "
        ORDER BY c.customer_id DESC";
$customers = $con->query($sql);
$agents = agent_active_options($con);

agent_admin_start('Agent Customers');
?>
<div class="row"><div class="col-sm-12"><div class="card"><div class="card-body">
<?php if ($message !== '') { ?>
<div class="alert alert-success"><?php echo agent_h($message); ?></div>
<?php } ?>
<?php if ($error !== '') { ?>
<div class="alert alert-danger"><?php echo agent_h($error); ?></div>
<?php } ?>
<form method="get" class="row g-2 mb-4">
    <div class="col-md-2">
        <select name="agent_id" class="form-control">
            <option value="">Agent</option>
            <?php foreach ($agents as $agent) { ?>
            <option value="<?php echo (int)$agent['agent_id']; ?>" <?php echo $agentId === (int)$agent['agent_id'] ? 'selected' : ''; ?>>
                <?php echo agent_h($agent['full_name']); ?>
            </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="plan_id" class="form-control">
            <option value="">Plan</option>
            <?php foreach ($plans as $plan) { ?>
            <option value="<?php echo (int)$plan['planid']; ?>" <?php echo $planId === (int)$plan['planid'] ? 'selected' : ''; ?>>
                <?php echo agent_h($plan['plandisplayname']); ?>
            </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2"><input type="date" name="from_date" class="form-control" value="<?php echo agent_h($fromDate); ?>"></div>
    <div class="col-md-2"><input type="date" name="to_date" class="form-control" value="<?php echo agent_h($toDate); ?>"></div>
    <div class="col-md-2">
        <select name="customer_status" class="form-control">
            <option value="">Customer Status</option>
            <?php foreach ($statuses as $status) { ?>
            <option value="<?php echo agent_h($status); ?>" <?php echo $customerStatus === $status ? 'selected' : ''; ?>><?php echo agent_h($status); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-12"><button class="btn btn-secondary">Filter</button></div>
</form>

<div class="table-responsive">
<table class="table table-bordered table-striped agent-table">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Agent</th>
            <th>Registered ID</th>
            <th>Interested/Purchased Plan</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Added</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($customers && $customers->num_rows) { while ($row = $customers->fetch_assoc()) { ?>
        <tr>
            <td><?php echo agent_h($row['customer_name']); ?></td>
            <td><?php echo agent_h($row['customer_mobile']); ?></td>
            <td><?php echo agent_h($row['customer_email']); ?></td>
            <td><?php echo agent_h($row['agent_name']); ?></td>
            <td><?php echo agent_h($row['registered_matri_id'] ?? ''); ?></td>
            <td><?php echo agent_h($row['plan_name']); ?></td>
            <td><?php echo agent_h($row['customer_status']); ?></td>
            <td><?php echo nl2br(agent_h($row['notes'])); ?></td>
            <td><?php echo agent_h($row['created_at']); ?></td>
            <td style="min-width:260px;">
                <form method="post" class="agent-actions">
                    <input type="hidden" name="update_customer" value="1">
                    <input type="hidden" name="customer_id" value="<?php echo (int)$row['customer_id']; ?>">
                    <select name="plan_id" class="form-control form-control-sm mb-2">
                        <option value="0">No Plan</option>
                        <?php foreach ($plans as $planOption) { ?>
                        <option value="<?php echo (int)$planOption['planid']; ?>" <?php echo (int)$row['plan_id'] === (int)$planOption['planid'] ? 'selected' : ''; ?>>
                            <?php echo agent_h($planOption['plandisplayname']); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <select name="customer_status" class="form-control form-control-sm mb-2">
                        <?php foreach ($statuses as $status) { ?>
                        <option value="<?php echo agent_h($status); ?>" <?php echo $row['customer_status'] === $status ? 'selected' : ''; ?>>
                            <?php echo agent_h($status); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <textarea name="notes" class="form-control form-control-sm mb-2" rows="2" placeholder="Notes"><?php echo agent_h($row['notes']); ?></textarea>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </form>
            </td>
        </tr>
    <?php }} else { ?>
        <tr><td colspan="10" class="text-center">No agent customers found.</td></tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div></div></div></div>
<?php agent_admin_end(); ?>
