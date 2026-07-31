<?php 
	require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
	$query = mysqli_query($con,"SELECT * FROM `paiddetails` WHERE 1");
	$count = mysqli_num_rows($query);
	/*echo $count;*/
	while ($row = mysqli_fetch_array($query)){
		//echo '<br>'.$row['Pactivedate'].'<br>';
		$date = $row['Pactivedate'];
		$id = $row['Paidid'];
		$newDate = date("Y-m-d", strtotime($date ));
		/*echo '<br>'.$id;
		echo '<br>'.$date.'<br>';
		echo $newDate.'<br>';*/
		mysqli_query($con, "UPDATE `paiddetails` SET `Pactivedate`='$newDate' WHERE Paidid ='$id'");
	}
?>