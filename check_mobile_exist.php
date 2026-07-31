<?php
require_once('sys_dbconnection.php');

$strcm = trim(strip_tags($_GET['q']));

if ($strcm != "") {

    // Check mobile length
    if (strlen($strcm) == 10) {

        // SECURITY (H1): prepared statement instead of raw interpolation.
        $num_rows = 0;
        $stmt = mysqli_prepare($con, "SELECT COUNT(*) AS c FROM register WHERE Mobile=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $strcm);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if ($res && ($r = mysqli_fetch_assoc($res))) { $num_rows = (int)$r['c']; }
            mysqli_stmt_close($stmt);
        }

        if ($num_rows > 0) {

            // Mobile already exists
            echo "<span style='color:#FF0000;'>Mobile Number already exists</span>";

        } else {

            // Mobile available
            echo "<span style='color:green;'>Mobile Number available</span>";
        }

    } else {

        // Invalid length
        echo "<span style='color:#FF0000;'>Enter 10 Digit Mobile Number</span>";
    }
}
?>