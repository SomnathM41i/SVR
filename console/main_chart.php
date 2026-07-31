<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  
  $que = "SELECT COUNT(Name) FROM register where MONTH(Regdate) = 1 && YEAR(Regdate) = 2021 ";
  $res = mysqli_query($con,$que);
  $row = mysqli_fetch_array($res);
  $val = $row['COUNT(Name)'];

  


?>


<html>
 <head>
   <style>
    body
  {
      
    display: flex;
    
  }
    .chartWithOverlay {
        
           position: relative;
           width: 700px;
    }
    .overlay {
            
          width: 200px;
          height: 200px;
          position: absolute;
            /* chartArea left */
    }

   </style>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

   <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = new google.visualization.arrayToDataTable([
        ['Months', 'Members'],
        ['Jan', 1],
        ['Feb', 0],
        ['Mar', 2],
        ['Apr', 3],
        ['June', 1],
        ['July', 0],
        ['Aug', 1],
        ['Dec', 0]
      
      ]);

      var options = {
        legend: 'none',
        hAxis: {textPosition:'none', color: 'black'},
        vAxis: {textPosition:'none', color: 'black'},
      
      };

      var chart = new google.visualization.LineChart(document.getElementById('line-chart'));
      chart.draw(data, options);
    }
    </script>
 </head>

 <body>
  <div class="chartWithOverlay">

   <div id="line-chart" style="width: 100%; height: 50;"></div>

  
 </div>

</body>

</html>