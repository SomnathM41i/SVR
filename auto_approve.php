<?php 
	require_once('sys_dbconnection.php');
	$data_config = $db->get_siteconfig();
    //print_r($data_config); 
    /*$on_off = $data_config-> is_smtp_set;*/
    $auto_on_off = $data_config-> auto_approve;
    

    /*echo $auto_on_off;*/
?>