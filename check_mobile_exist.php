<?php
require_once('sys_dbconnection.php');

$strcm = trim(strip_tags($_GET['q']));

if ($strcm != "") {

    // Check mobile length
    if (strlen($strcm) == 10) {

        $check = "SELECT Mobile FROM register WHERE Mobile='$strcm'";
        $qry = mysqli_query($con, $check);

        if (mysqli_num_rows($qry) > 0) {

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