<?php
require_once('agent_common.php');
$id = (int)($_GET['id'] ?? 0);
$hasSales = $con->query("SELECT sale_id FROM agent_sales WHERE agent_id=$id LIMIT 1");
if ($hasSales && $hasSales->num_rows > 0) {
    $stmt = $con->prepare("UPDATE agents SET status='Inactive', updated_at=NOW() WHERE agent_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
} else {
    $stmt = $con->prepare("DELETE FROM agent_plan_assignments WHERE agent_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $stmt = $con->prepare("DELETE FROM agents WHERE agent_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header('Location: agents');
exit;
?>
