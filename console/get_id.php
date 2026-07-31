<?php 
require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
//AFTER ONCLICK OF SUBMIT BTN
if( isset( $_POST['submit'] ) )
{

	$MatriID = $_REQUEST['search'];
	//CHECKING FOR VALID PROFILE ID
	$check_id = mysqli_query($con,"SELECT * from register WHERE MatriID='$MatriID'");
	$check = mysqli_num_rows($check_id);
	//ACTUAL CONDITION 
	if( $check == 0)
	{
		//INVALID PROFIE ID
		header("Location:show_matches?ID=$MatriID&flag=1");
		exit;	
	}	
	else
	{
		//VALID PROFIE ID
		header("Location:show_matches?ID=$MatriID");
		exit;	
	}
		
}
?>