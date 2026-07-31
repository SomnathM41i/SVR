<?php 
require_once('sys_dbconnection.php');

//error_reporting(0);

<?php 
$id = $_SESSION['matriid'];
$reason = mysqli_real_escape_string($con,$_POST['reason']);
$type = $_POST['type'];

$qry= mysqli_query($con,"insert into delete_request(matriid,reason,reason_type) values('$id','$reason','$type')")or svr_db_fail($con);
//echo "insert into delete_request(matriid,reason,reason_type) values('$id','$reason','$type')";


?>
<script>window.location = 'settings'</script>




