<?php
	require_once('includes/bootstrap.php');
	
	

	//FOR HINDU
	$query = "SELECT Religion,COUNT(Name) FROM register where Religion='Hindu-maratha' "; 
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	
	//FOR MUSLIM
	$query1 = "SELECT Religion,COUNT(Name) FROM register where Religion='Muslim' "; 
	$result1 = mysqli_query($con,$query1);
	$row1 = mysqli_fetch_array($result1);

	//FOR CHRISTAN
	$query2 = "SELECT Religion,COUNT(Name) FROM register where Religion='Christian' "; 
	$result2 = mysqli_query( $con,$query2 );
	$row2 = mysqli_fetch_array( $result2 );

	//FOR JAIN

	$query3 = "SELECT Religion,COUNT(Name) FROM register where Religion='Jain'  "; 
	$result3 = mysqli_query( $con,$query3 );
	$row3 = mysqli_fetch_array( $result3 );

	//FOR SIKH

	$query4 = "SELECT Religion,COUNT(Name) FROM register where Religion='Sikh' "; 
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
		$val1 = ( $row['COUNT(Name)'] / 360 ) * 100;
 		$val2 = ( $row1['COUNT(Name)'] / 360 ) * 100;
 		$val3 = ( $row2['COUNT(Name)'] / 360 ) * 100;
 		$val4 =  ( $row3['COUNT(Name)'] / 360 ) * 100;
 		$val5 =  ( $row4['COUNT(Name)'] / 360 ) * 100;
 		$val6 =  ( $row5['COUNT(Name)'] / 360 ) * 100;
 		$val7 =  ( $row6['COUNT(Name)'] / 360 ) * 100;

		
	}
 	else
 	{
 		echo "ERROR";
 	}

 	//FOR PIE CHART
	
	
 	
	$dataPoints = array
	( 
		array("label"=>"CHRISTAN", "y"=> $val3),
		array("label"=>"MUSLIM", "y"=> $val2),
		array("label"=>"HINDU", "y"=> $val1),
		array("label"=>"JAIN ", "y"=> $val4),
		array("label"=>"SIKH ", "y"=> $val5),
		array("label"=>"BUDHHIST ", "y"=> $val5),
		array("label"=>"Inter-Religion ", "y"=> $val7),
	)
?>

<!DOCTYPE HTML>
<html>
<head><!--
<style>
	#canvas-holder 
	{
  		width: 100%;
  		margin-top: 50px;
  		text-align: center;
	}

	#chartjs-tooltip 
	{
  		opacity: 1;
  		position: absolute;
  		background: rgba(0, 0, 0, .7);
  		color: white;
  		border-radius: 3px;
  		-webkit-transition: all .1s ease;
  		transition: all .1s ease;
  		pointer-events: none;
  		-webkit-transform: translate(-50%, 0);
  		transform: translate(-50%, 0);
	}

	.chartjs-tooltip-key 
	{
  		display: inline-block;
  		width: 10px;
  		height: 10px;
  		margin-right: 10px;
	}

	window.chartColors = 
{
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(231,233,237)'
}; 
backgroundColor:[	window.chartColors.orange,
						window.chartColors.blue,
						window.chartColors.green,
						window.chartColors.red,
					],
	 options: {
    			responsive: true,
    			legend: {
      						display: true,
      						labels: {
        								padding: 20
      								},
    					},
    			tooltips: 	{
      							enabled: false,
    						}
  				}
</style>-->
<script>
window.onload = function() {
 

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		
	},
	data: [{
		type: "pie",
		indexLabel: "{y}",
		
		yValueFormatString: "#,##0.00\"%\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}],
	
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style=" width: 250%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--<form action="#" method="POST">
</form>-->
</body>
</html> 