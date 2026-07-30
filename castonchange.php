<?php require_once('sys_dbconnection.php');
//fetch_second_level_category.php
/*include('dbconnectadmin.php');*/
if(isset($_POST["selected"]))
{
 $id = join("','", $_POST["selected"]);
 //echo $id;
 $query = mysqli_query($con,"SELECT * FROM caste WHERE status='enable' and Religion IN ('".$id."')");
 //$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
 $output = '';
   echo'<option value="Any">Any</option>';
  while($row = mysqli_fetch_assoc($query)) {
	
	$output .='<option value="'.$row['Caste'].'">'.$row['Caste'].'</option>';
							} 
/* foreach($rows as $row)
 {    
  $output .= '<option value="'.$row["Caste"].'">'.$row["Caste"].'</option>';
 }*/
 
 echo $output;
}

?>

