<?php 
require_once('sys_dbconnection.php');
/*include('dbconnectadmin.php');*/
//error_reporting(0);
//session_start();?>
<?php 
$id = $_SESSION['matriid'];
$reason = mysqli_real_escape_string($con,$_POST['reason']);
$type = $_POST['type'];

$qry= mysqli_query($con,"insert into delete_request(matriid,reason,reason_type) values('$id','$reason','$type')")or die(mysqli_error($con));
//echo "insert into delete_request(matriid,reason,reason_type) values('$id','$reason','$type')";
//exit;

?>
<script>window.location = 'settings'</script>




