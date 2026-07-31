<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');


if(isset($_POST['country'])) {
      $id =$_POST["country"]; 
	  echo $id;
	  
	$query12 ="SELECT * FROM caste WHERE Religion IN ('".$id."')";
	

	$results =mysqli_query($con,$query);
?>

	<option value="">Select Caste</option>
	<option value="">Any</option>
<?php
	
		 while($row1 = mysqli_fetch_array($results)) {
?>
	<option value="<?php echo $row1["Caste"]; ?>"><?php echo $row1["Caste"]; ?></option>
<?php
	}
 } 
?>


 

<?php
/* removed dead include: include('dbconnectadmin.php'); - include target never existed in this tree */
//require_once("DBController.php");

if(isset($_GET['country_id'])) {
        $coun_id =  $_GET["country_id"];  
		
	 $query ="SELECT * FROM caste WHERE Religion IN ($coun_id)";
	 $results = $con->runQuery($query);
	
	

     while($row12 = mysqli_fetch_array($results)) { ?>
	
	 
         <option value="<?php echo $row12['Caste'] ?>"><?php echo $row12['Caste'] ?></option>
		 
<?php } 
	
} 
?>















