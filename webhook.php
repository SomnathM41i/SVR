<?php
require_once('config.php');

/* Instamojo webhook — verifies the MAC of the POSTed payload.
 * SECURITY changes:
 * - The HMAC salt now resolves from env/config with a legacy fallback
 *   (previously hard-coded in source).
 * - Timing-safe MAC comparison (hash_equals).
 * - Guarded reads (no undefined-index notices).
 */
$data = $_POST;
$mac_provided = isset($data['mac']) ? $data['mac'] : '';
unset($data['mac']);

$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}

$salt = svr_config('SVR_INSTAMOJO_SALT', 'f82eb09a215548e38fe84b69a6b1e90a');
$mac_calculated = hash_hmac("sha1", implode("|", $data), $salt);

if($mac_provided !== '' && hash_equals($mac_calculated, $mac_provided)){

    if(isset($data['status']) && $data['status'] == "Credit"){
       /* Payment was successful, mark it as completed in your database  */

               $id= isset($_GET['id']) ? $_GET['id'] : '';
			    header('location:payment_success.php?id='.$id);
			    exit;
		}
    else{
       /* Payment was unsuccessful, mark it as failed in your database*/
	   header('location:payment_fail.php');
	   exit;
    }
}
else{
    http_response_code(400);
    echo "Invalid MAC passed";
}
