<?php 
	require_once('sys_dbconnection.php');
	$data_config = $db->get_siteconfig();
    
    
    $auto_on_off = $data_config-> auto_approve;
    

    
?>