 <?php require_once('sys_dbconnection.php');
 /*include 'dbconnectadmin.php';*/
 		$religion=$_GET['q'];
		//echo $religion;
		$q="select * from caste where Religion='$religion' AND  status= 'enable' ORDER BY caste ASC";
		//echo "select * from caste where Religion='$religion' ORDER BY caste ASC";
		$rs1=mysqli_query($con,$q);
		$num1=mysqli_num_rows($rs1);
		 echo"<option value=''>Any </option>";
		  $i=0;
				  
			   while( $data=mysqli_fetch_assoc($rs1))
			  {
				 	
				  echo "<option value='".$data['Caste']."'>".$data['Caste']."</option>";
			  }
 ?>
			
			  
                                                                                                                                                                                                                                                                                                                                                                                                       
              
              