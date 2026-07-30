<?php
require_once('../sys_dbconnection.php');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if (!isset($con)) {
    echo json_encode(["status" => "error", "message" => "Database connection not found"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'GET') {
    $matriID = $db->setfilter($_GET['MatriID'] ?? '');

    if (empty($matriID)) {
        echo json_encode(["status" => "error", "message" => "MatriID is required"]);
        exit;
    }

    $sql = "SELECT token FROM fcm_tokens WHERE MatriID = ? LIMIT 1";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $matriID);
    $stmt->execute();
    $res = $stmt->get_result();
    $token = $res->fetch_assoc()['token'] ?? null;

    echo json_encode([
        "status" => "success",
        "message" => $token ? "Token retrieved successfully" : "No token found for this MatriID",
        "fcm_token" => $token
    ]);
    exit;
}


if ($method === 'POST') {
    $matriID = $db->setfilter($_POST['MatriID'] ?? '');
    $fcm_token = $db->setfilter($_POST['fcm_token'] ?? '');

    if (empty($matriID) || empty($fcm_token)) {
        echo json_encode(["status" => "error", "message" => "MatriID and FCM token are required"]);
        exit;
    }

    
    $sqlDeleteSameToken = "DELETE FROM fcm_tokens WHERE token = ? AND MatriID != ?";
    $stmtDelToken = $con->prepare($sqlDeleteSameToken);
    $stmtDelToken->bind_param("ss", $fcm_token, $matriID);
    $stmtDelToken->execute();

    $sqlDeleteSameMatri = "DELETE FROM fcm_tokens WHERE MatriID = ? AND token != ?";
    $stmtDelMatri = $con->prepare($sqlDeleteSameMatri);
    $stmtDelMatri->bind_param("ss", $matriID, $fcm_token);
    $stmtDelMatri->execute();

    
    $sqlUpsert = "INSERT INTO fcm_tokens (MatriID, token, created_at)
                  VALUES (?, ?, NOW())
                  ON DUPLICATE KEY UPDATE token = VALUES(token), created_at = NOW()";
    $stmt = $con->prepare($sqlUpsert);
    $stmt->bind_param("ss", $matriID, $fcm_token);
    $stmt->execute();

    echo json_encode([
        "status" => "success",
        "message" => "Token saved successfully",
        "fcm_token" => $fcm_token
    ]);
    exit;
}


echo json_encode(["status" => "error", "message" => "Invalid request method"]);
exit;
?>
