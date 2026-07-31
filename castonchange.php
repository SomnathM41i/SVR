<?php require_once('sys_dbconnection.php');
//fetch_second_level_category.php

if(isset($_POST["selected"]))
{
 $id = join("','", $_POST["selected"]);
 
 $query = mysqli_query($con,"SELECT * FROM caste WHERE status='enable' and Religion IN ('".$id."')");
 
 $output = '';
   echo'<option value="Any">Any</option>';
  while($row = mysqli_fetch_assoc($query)) {
	
	$output .='<option value="'.$row['Caste'].'">'.$row['Caste'].'</option>';
							} 

 
 echo $output;
}

?>

