<?php 
	foreach( $_GET as $key => $data)
	{
		echo $_GET[$key];
		$data = substr("$_GET[$key]", 2);
		echo $data;
		//$data = base64_decode( urldecode($data) );
		$decrypt = ( ( ( $data * 101 ) / 101 ) /101);
		//echo $data;
	}
	echo  base64_decode( urldecode($decrypt) );
?>