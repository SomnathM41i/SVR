<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
	
	
	//PAID MEMBER
	$query = "SELECT Status,COUNT(MatriID) FROM register where Status='Paid' "; 
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$val = $row['COUNT(MatriID)'];

	// UNPAID MEMEBER
	$query1 = "SELECT Name,COUNT(MatriID) FROM register where  Status='Active' "; 
	$result1 = mysqli_query($con,$query1);
	$row1 = mysqli_fetch_array($result1);
	$val1 = $row1['COUNT(MatriID)'];

	//TOTAL
	$res = mysqli_query($con,"SELECT COUNT(MatriID) FROM register");
	$ro = mysqli_fetch_array($res);
	$value = $ro['COUNT(MatriID)'];

  //MEMBERSHIP EXPIRED
  $res1 = mysqli_query($con,"SELECT COUNT(MatriID) FROM register WHERE Status='Expired' ");
	$ro1 = mysqli_fetch_array($res1);
	$value1 = $ro1['COUNT(MatriID)'];
	

?>
<?PHP  ?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('upcoming', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'TOTAL', 'FREE', 'PAID'],
          ['<?php echo date('Y');?>', <?php echo $value?>, <?php echo $val1?>, <?php echo $val?>],
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'horizontal',// Required for Material Bar Charts.
			colors: ['#7A1F39', '#EA4D4D', '#FFA21D','#76A7FA']
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    
  </body>
</html>

