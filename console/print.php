<?php
require_once(dirname(__FILE__).'/protect.php');

?>
<html>
<head>
    
</head>
<body>
<body>
	<center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
</body>
<script type="text/javascript">


	function PrintPage() 
	{
		window.print();
	}
</script>
</body>
</html>
