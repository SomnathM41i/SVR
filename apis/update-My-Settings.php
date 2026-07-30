<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('../sys_dbconnection.php'); 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed"]);
    exit;
}

try {
    // Get MatriID from POST data
    $matriid = isset($_POST['MatriID']) ? mysqli_real_escape_string($con, $_POST['MatriID']) : '';
    if (empty($matriid)) {
        echo json_encode(["status" => "error", "message" => "MatriID is required"]);
        exit;
    }

    // Validate MatriID exists in the database
    $userCheck = mysqli_query($con, "SELECT horoscope_visibility, phone_visibility, photo_visibility FROM register WHERE MatriID='$matriid'");
    if (mysqli_num_rows($userCheck) == 0) {
        echo json_encode(["status" => "error", "message" => "Invalid MatriID"]);
        exit;
    }

    // Get existing user data
    $existingUser = mysqli_fetch_array($userCheck);

    // Get POST data for settings
    $horoscope_visibility = isset($_POST['horoscope']) ? mysqli_real_escape_string($con, $_POST['horoscope']) : '';
    $phone_visibility = isset($_POST['phone']) ? mysqli_real_escape_string($con, $_POST['phone']) : '';
    $photo_visibility = isset($_POST['photo']) ? mysqli_real_escape_string($con, $_POST['photo']) : '';
    
    // Validate at least one setting is provided unless restoring defaults
    if (empty($horoscope_visibility) && empty($phone_visibility) && empty($photo_visibility) && !isset($_POST['is_default'])) {
        echo json_encode(["status" => "error", "message" => "At least one setting must be provided"]);
        exit;
    }

    // Prepare update fields
    $updateFields = [];
    $hasChanges = false;

    // Check and update horoscope visibility
    if (!empty($horoscope_visibility)) {
        if ($existingUser['horoscope_visibility'] != $horoscope_visibility) {
            $updateFields[] = "horoscope_visibility='$horoscope_visibility'";
            $hasChanges = true;
        }
    }

    // Check and update phone visibility
    if (!empty($phone_visibility)) {
        if ($existingUser['phone_visibility'] != $phone_visibility) {
            $updateFields[] = "phone_visibility='$phone_visibility'";
            $hasChanges = true;
        }
    }

    // Check and update photo visibility
    if (!empty($photo_visibility)) {
        if ($existingUser['photo_visibility'] != $photo_visibility) {
            $updateFields[] = "photo_visibility='$photo_visibility'";
            $hasChanges = true;
        }
    }

    // If no changes detected and not restoring defaults
    if (!$hasChanges && !isset($_POST['is_default']) && (!empty($horoscope_visibility) || !empty($phone_visibility) || !empty($photo_visibility))) {
        echo json_encode([
            "status" => "success",
            "message" => "No changes detected",
            "current_settings" => [
                "horoscope_visibility" => $existingUser['horoscope_visibility'],
                "phone_visibility" => $existingUser['phone_visibility'],
                "photo_visibility" => $existingUser['photo_visibility']
            ]
        ]);
        exit;
    }

    // Update only if there are changes or restoring defaults
    if ($hasChanges || isset($_POST['is_default'])) {
        if (isset($_POST['is_default']) && $_POST['is_default'] == '1') {
            // Set default settings
            $updateFields = [
                "horoscope_visibility='paidhoro'",
                "phone_visibility='paidphone'",
                "photo_visibility='paidphoto'"
            ];
            $hasChanges = true; // Ensure update proceeds
        }

        if ($hasChanges) {
            $updateQuery = "UPDATE register SET " . implode(', ', $updateFields) . " WHERE MatriID='$matriid'";
            $qry = mysqli_query($con, $updateQuery);
            
            if (!$qry) {
                echo json_encode(["status" => "error", "message" => "Failed to update settings: " . mysqli_error($con)]);
                exit;
            }
            
            // Fetch updated settings
            $updatedQuery = mysqli_query($con, "SELECT horoscope_visibility, phone_visibility, photo_visibility FROM register WHERE MatriID='$matriid'");
            $updatedUser = mysqli_fetch_array($updatedQuery);

            $message = isset($_POST['is_default']) && $_POST['is_default'] == '1' ? "Default settings restored successfully" : "Settings updated successfully";
            
            echo json_encode([
                "status" => "success",
                "message" => $message,
                "updated_fields" => [
                    "horoscope_visibility" => $updatedUser['horoscope_visibility'],
                    "phone_visibility" => $updatedUser['phone_visibility'],
                    "photo_visibility" => $updatedUser['photo_visibility']
                ]
            ]);
        }
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

// Close database connection
mysqli_close($con);
?>