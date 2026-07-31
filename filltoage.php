 <?php require_once('sys_dbconnection.php');
 /*include 'dbconnectadmin.php';*/
 		$toage=$_GET['q'];
		echo $toage;
		$q="select * from toage where toage>$toage";
//echo "select * from toage where toage>$toage";

		$rs1=mysqli_query($con,$q);
		$num1=mysqli_num_rows($rs1);
		
		  $i=0;
				  
			   while( $data=mysqli_fetch_assoc($rs1))
			  {
				 	
				  echo "<option value='".$data['toage']."'>".$data['toage']."</option>";
			  }
 ?>
			
			  
                                                                                                                                                                                                                                                                                                                                                                                                       
              
              