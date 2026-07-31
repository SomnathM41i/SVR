<?php require_once('includes/bootstrap.php');
		
		
		
		$count_num = 0;	
		$id = $_SESSION['MatriID'];	
		/* Verify Email Account*/
		$q1 = mysqli_query($con,"select * from emailverify where MatriID='$id'");
		

		
		$q1f=mysqli_fetch_array($q1);
		$emailveri=$q1f['verification'];

		if( $emailveri != 'No' &&  $emailveri != '')
		{  
			
			$count_num =$count_num + 1;
			
		} 

 
	   /* Verify Compability*/
	   
	    $q2=mysqli_query($con,"select * from compatibility where MatriID='$login'");
		
		$q2f=mysqli_fetch_array($q2);
		$q2fn=mysqli_num_rows($q2);
        
		if($q2fn !='0')
		{ 
			echo '<br>'."COMP".'<BR>';
			$count_num = $count_num + 1;
			
		 } 
	   /* check Photo*/
	   
	    $q3=mysqli_query($con,"select * from register where MatriID='$login' and Photo1!='nophoto.jpg' and Photo1!=''");
		
		$q3f=mysqli_fetch_array($q3);
		$q3fn=mysqli_num_rows($q3);
        
		if($q3fn!='0')
		{ 
			echo '<br>'."PHOTO".'<BR>';
			$count_num = $count_num + 1;
			
		 } 
	   /* check Expire Date*/
	   
	    $q4=mysqli_query($con,"select * from register where MatriID='$login'");
		
		$q4f=mysqli_fetch_array($q4);
		$q4fn=mysqli_num_rows($q4);
        
		
		if($q4f['memtype']!='Free' && $q4f['Noofcontacts']>0 && strtotime($q4f['MemshipExpiryDate']) > strtotime(date('Y-m-d'))) 
		{
			
			$count_num =$count_num + 1;
			
		}
		else{
		 	
		  } 

		
?>

	