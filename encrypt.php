
<?php 
	session_start();
	$ID = $_GET['id'];
	$data = substr("$ID", 2);
	echo $data;
	$encrypt = ( $data * 101 * 101) / 101 ;
	//echo $encrypt;
	$link = "decrypt?id=ND".urlencode( base64_encode( $data ) )
	;

	echo $link;
	header("location:$link");
	exit;
?>