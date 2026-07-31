<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
	
	
	
    
	//FOR HINDU
	$query = "SELECT * FROM caste where Religion='Hindu' "; 
	$result = mysqli_query($con,$query);
	
    
     
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() 
      {
        var data = google.visualization.arrayToDataTable
        ([
          ['Religion', 'Occurance'],
          <?php 
                while ( $row = mysqli_fetch_array($result) )
                {
                    $val=$row['Caste'];
                    $que= "SELECT Caste,Count(Name) FROM register where Caste='$val' ";
                    $res = mysqli_query($con,$que);
                    while($row1= mysqli_fetch_array($res))
                    {
                        
                        echo "['".$val."',".$row1['Count(Name)']."],";
                    }
                }
          ?>

        ]);

        var options = 
        {
          
          title: ' ',
          slices: 
          {
            0: {color: 'Orange'}, 
            1: {color: 'Green'},
            2: {color: 'red'},
            3: {color: '#000080'},
            4: {color: 'Blue'},
            5: {color: 'White'},
            6: {color: 'grey'},
          },
          legend: 
          {position: 'bottom'},
          pieSliceTextStyle:
          {color: 'black', fontName: 'Arial Black', fontSize: 10},
          is3D: true,
           animation:
          {
            duration: 1000,
            easing: 'out',
            "startup": true
          }
          
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>

    <style type="text/css">
      .chart_wrap
      {
        position: relative;
        padding-bottom: 100;
        height: 0;
        overflow: hidden;
      } 
      .piechart
      {
        position: absolute;
        top: 0;
        left: 0;
        height: 500px;
      }
    </style>
  </head>
  <body>
    <div id="chart_wrap">
      <div id="piechart"></div>  
    </div> 
  </body>
</html>
