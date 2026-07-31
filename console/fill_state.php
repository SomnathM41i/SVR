 <?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');
 
 		$country=$_GET['q'];
		$q="select * from e_state where cid='$country' ORDER BY state ASC";
		$rs1=mysqli_query($con,$q);
		 echo"<option value=''>Any</option>";
		  $i=0;
			  while($data=mysqli_fetch_assoc($rs1))
			  { ?>
				 
			  <option value="<?php echo $data['state']; ?>" required> <?php echo $data['state']; ?> </option>

			<?php  } ?>
			  
              
              
              