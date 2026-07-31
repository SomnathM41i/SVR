 <?php require_once('sys_dbconnection.php');
 
 		$day=$_GET['q'];
		if($day=='1'||$day=='3'||$day=='5'||$day=='7'||$day=='8'||$day=='10'||$day=='12')
		{
		$q="select * from day where day<=31";
		
        }
		elseif($day=='4'||$day=='6'||$day=='9'||$day=='11')
		{
			$q="select * from day where day<31";
		}
		elseif($day=='2')
		{
			$q="select * from day where day<30";
		}

		$rs1=mysqli_query($con,$q);
		$num1=mysqli_num_rows($rs1);
		
		  $i=0;
				  
			   while( $data=mysqli_fetch_assoc($rs1))
			  {
				 	
				  echo "<option value='".$data['day']."'>".$data['day']."</option>";
			  }
 ?>
			
			  
                                                                                                                                                                                                                                                                                                                                                                                                       
              
              