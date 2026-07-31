<?php
require_once(dirname(__FILE__).'/protect.php');
require_once('agent_common.php');

$status = isset($_GET['status']) ? $_GET['status'] : '';
$where = '';
if ($status === 'Active' || $status === 'Inactive') {
    $where = "WHERE status='" . $con->real_escape_string($status) . "'";
}
$agents = $con->query("SELECT * FROM agents $where ORDER BY agent_id DESC");

agent_admin_start('All Agents');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Agents</h5>
                <a href="agent_add" class="btn btn-primary btn-sm"><i class="feather icon-plus"></i> Add Agent</a>
            </div>
            <div class="card-body">
                <form method="get" class="row g-2 mb-3">
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="Active" <?php echo $status === 'Active' ? 'selected' : ''; ?>>Active</option>
                            <option value="Inactive" <?php echo $status === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2"><button class="btn btn-secondary">Filter</button></div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped agent-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Joining Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($agents && $agents->num_rows > 0) { while ($row = $agents->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo (int)$row['agent_id']; ?></td>
                                <td><?php echo agent_h($row['full_name']); ?></td>
                                <td><?php echo agent_h($row['mobile']); ?></td>
                                <td><?php echo agent_h($row['email']); ?></td>
                                <td><?php echo agent_h($row['city']); ?></td>
                                <td><?php echo agent_h($row['joining_date']); ?></td>
                                <td><span class="badge bg-<?php echo $row['status'] === 'Active' ? 'success' : 'secondary'; ?>"><?php echo agent_h($row['status']); ?></span></td>
                                <td class="agent-actions">
                                    <a class="btn btn-sm btn-info" href="agent_view?id=<?php echo (int)$row['agent_id']; ?>">View</a>
                                    <a class="btn btn-sm btn-primary" href="agent_edit?id=<?php echo (int)$row['agent_id']; ?>">Edit</a>
                                    <a class="btn btn-sm btn-warning" href="agent_status?id=<?php echo (int)$row['agent_id']; ?>"><?php echo $row['status'] === 'Active' ? 'Deactivate' : 'Activate'; ?></a>
                                    <a class="btn btn-sm btn-danger" onclick="return confirm('Delete this agent?');" href="agent_delete?id=<?php echo (int)$row['agent_id']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php }} else { ?>
                            <tr><td colspan="8" class="text-center">No agents found.</td></tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php agent_admin_end(); ?>
