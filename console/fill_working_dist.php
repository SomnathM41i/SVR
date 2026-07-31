<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');
 
 		$sid=$_GET['q'];
		
		$q="select * from e_dist where sid2='$sid' ORDER BY dist ASC";
		$rs2=mysqli_query($con,$q)or svr_db_fail($con);
		 echo"<option value='' >Any</option>";
		  $i=0; ?>
		   <select class="selectpicker dropcss drop" >
			<?php  while($data=mysqli_fetch_assoc($rs2))
			  {	?>	 	
				 <option value="<?php echo $data['dist']; ?>" required><?php echo $data['dist']; ?></option>
			 <?php } ?>
         </select>