<?php 
	if( !isset($_SESSION['MatriID'] ) )
	{
		header("Location: index");
		exit;  
	}
?>