 <?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');
 	/*include'../dbconnectadmin.php';*/
 	$religion=$_GET['q'];
	$q="select * from caste where Religion='$religion' ORDER BY state ASC";
	$rs1=mysqli_query($con,$q);
	echo"<option value=''>Any</option>";
	$i=0;
	while( $data=mysqli_fetch_assoc($rs1))
	{
?>
	<option value="<?php echo $data['caste'];?>" required> <?php echo $data['caste']; ?> </option>
<?php  
	}
 ?>
			  
              
              
              