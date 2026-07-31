<?php
/* SECURITY: verbose error reporting disabled in production. */
/* SECURITY: PHP error display disabled in production. */
/* SECURITY: PHP startup error display disabled in production. */

require_once('../sys_dbconnection.php');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Collect MatriID from GET
$matriId = $db->setfilter($_POST['MatriID'] ?? '');

// Helper: format 24-hour DB time to AM/PM
function formatTimeAMPM($time) {
    if (empty($time)) return "";
    return date("h:i A", strtotime($time));
}

try {
    if (!empty($matriId)) {
        // Fetch single user's meeting details
        $stmt = $con->prepare("SELECT * FROM kanda_pohe_meeting_requests WHERE user_id = ?");
        $stmt->bind_param("s", $matriId);
    } else {
        // Fetch all meetings
        $stmt = $con->prepare("SELECT * FROM kanda_pohe_meeting_requests ORDER BY created_at DESC");
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "MatriID" => $row['user_id'],
            "ProfileID" => $row['profile_id'],
            "PreferredDate" => $row['preferred_date'],
            "PreferredTime" => formatTimeAMPM($row['preferred_time']),
            "PreferredLocation" => $row['preferred_location'],
            "Notes" => $row['notes'],
            "AdminAssignedDate" => $row['admin_assigned_date'],
            "AdminAssignedTime" => formatTimeAMPM($row['admin_assigned_time']),
            "AdminAssignedLocation" => $row['admin_assigned_location'],
            "AdminRemarks" => $row['admin_remarks'],
            "Status" => $row['status'],
            "CreatedAt" => $row['created_at'],
            "UpdatedAt" => $row['updated_at']
        ];
    }

    echo json_encode([
        "status" => "success",
        "count" => count($data),
        "data" => $data
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
