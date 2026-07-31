 <?php require_once('../includes/bootstrap.php');   
require_once(dirname(__FILE__).'/protect.php');
 	
 	$religion=$_GET['q'];
	$q="select * from caste where Religion='$religion' and status='enable' ORDER BY Caste ASC";
	$rs1=mysqli_query($con,$q);
	echo"<option value=''>Any</option>";
	$i=0;
	while( $data=mysqli_fetch_assoc($rs1))
	{
       ?>
	<option value="<?php echo $data['Caste'];?>" required> <?php echo $data['Caste']; ?> </option>
  <?php  } ?>
			  
              
              
              