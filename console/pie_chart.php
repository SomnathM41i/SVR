<?php require_once('../sys_dbconnection.php');
	/*include '../dbconnectadmin.php';*/
	
	//FOR HINDU
	$query = "SELECT Religion,COUNT(Name) FROM register where Religion='Hindu' ";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	
	//FOR MUSLIM
	$query1 = "SELECT Religion,COUNT(Name) FROM register where Religion='Muslim'"; 
	$result1 = mysqli_query($con,$query1);
	$row1 = mysqli_fetch_array($result1);
	
	//FOR CHRISTAN
	$query2 = "SELECT Religion,COUNT(Name) FROM register where Religion='Christian' "; 
	$result2 = mysqli_query( $con,$query2 );
	$row2 = mysqli_fetch_array( $result2 );
	
	//FOR JAIN
	$query3 = "SELECT Religion,COUNT(Name) FROM register where Religion='Sikh'  ";
	$result3 = mysqli_query( $con,$query3 );
	$row3 = mysqli_fetch_array( $result3 );
	
	//FOR SIKH
	$query4 = "SELECT Religion,COUNT(Name) FROM register where Religion='Jain' "; 
	$result4 = mysqli_query( $con,$query4 );
	$row4 = mysqli_fetch_array( $result4 );
	
	//FOR BUDDHIST
	$query5 = "SELECT Religion,COUNT(Name) FROM register where Religion='Buddhist' "; 
	$result5 = mysqli_query( $con,$query5 );
	$row5 = mysqli_fetch_array( $result5 );
	
	//FOR INTER-RELIGION
	$query6 = "SELECT Religion,COUNT(Name) FROM register where Religion='Inter-Religion' "; 
	$result6 = mysqli_query( $con,$query6 );
	$row6 = mysqli_fetch_array( $result6 );
	
	if( $row && $row1 && $row2 && $row3 && $row4 && $row5 && $row6 )
	{
		$val1 = ( $row ['COUNT(Name)' ] );
 		$val2 = ( $row1 ['COUNT(Name)' ] );
 		$val3 = ( $row2 ['COUNT(Name)' ] );
 		$val4 = ( $row3 ['COUNT(Name)' ] );
 		$val5 = ( $row4 ['COUNT(Name)' ] );
 		$val6 = ( $row5 ['COUNT(Name)' ] );
 		$val7 = ( $row6 ['COUNT(Name)' ] );
 		/*echo $val1;
 		echo $val2;
 		echo $val3;
 		echo $val4;
 		echo $val5;
 		echo $val6;
 		echo $val7;*/

	}
 	else
 	{
 		echo "ERROR";
 	}

 	//UPDATING VALUE OF Occurance
 	$up = "UPDATE pie_chart SET Occurance= '$val1' where id=1" ;
 	$qu = mysqli_query( $con, $up);

 	$up1 = "UPDATE pie_chart SET Occurance= '$val2' where id=2" ;
 	$qu1 = mysqli_query( $con, $up1);

 	$up2 = "UPDATE pie_chart SET Occurance= '$val3' where id=3" ;
 	$qu2 = mysqli_query( $con, $up2);

 	$up3 = "UPDATE pie_chart SET Occurance= '$val5' where id=4" ;
 	$qu3 = mysqli_query( $con, $up3 );

 	$up4 = "UPDATE pie_chart SET Occurance= '$val4' where id=5" ;
 	$qu4 = mysqli_query( $con, $up4);

 	$up5 = "UPDATE pie_chart SET Occurance= '$val6' where id=6" ;
 	$qu5 = mysqli_query( $con, $up5);

 	$up6 = "UPDATE pie_chart SET Occurance= '$val7' where id=7" ;
 	$qu6 = mysqli_query( $con, $up6);
 	
?>
