<?php require_once('../sys_dbconnection.php');  
 /*include'../dbconnectadmin.php';*/
 		$sid=$_GET['q'];
		
		$q="select * from e_dist where sid2='$sid' ORDER BY dist ASC";
		$rs2=mysqli_query($con,$q)or die(mysqli_error());
		 echo"<option value='' >Any</option>";
		  $i=0; ?>
		   <select class="selectpicker dropcss drop" >
			<?php  while($data=mysqli_fetch_assoc($rs2))
			  {	?>	 	
				 <option value="<?php echo $data['dist']; ?>" required><?php echo $data['dist']; ?></option>
			 <?php } ?>
         </select>