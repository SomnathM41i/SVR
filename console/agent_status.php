<?php
require_once('agent_common.php');
$id = (int)($_GET['id'] ?? 0);
$agent = $con->query("SELECT status FROM agents WHERE agent_id=$id")->fetch_assoc();
if ($agent) {
    $newStatus = $agent['status'] === 'Active' ? 'Inactive' : 'Active';
    $stmt = $con->prepare("UPDATE agents SET status=?, updated_at=NOW() WHERE agent_id=?");
    $stmt->bind_param("si", $newStatus, $id);
    $stmt->execute();
    $stmt->close();
}
header('Location: agents');
exit;
?>
