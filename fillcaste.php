 <?php require_once('includes/bootstrap.php');
 
 		$religion=$_GET['q'];
		
		$q="select * from caste where Religion='$religion' AND  status= 'enable' ORDER BY caste ASC";
		
		$rs1=mysqli_query($con,$q);
		$num1=mysqli_num_rows($rs1);
		 echo"<option value=''>Any </option>";
		  $i=0;
				  
			   while( $data=mysqli_fetch_assoc($rs1))
			  {
				 	
				  echo "<option value='".$data['Caste']."'>".$data['Caste']."</option>";
			  }
 ?>
			
			  
                                                                                                                                                                                                                                                                                                                                                                                                       
              
              