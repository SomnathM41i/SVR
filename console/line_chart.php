<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');

      /*include '../dbconnectadmin.php';*/
      //FOR Paid
      $query = "SELECT Status,COUNT(Name) FROM register where Status='Paid' "; 
      $result = mysqli_query($con,$query);
      while ($row = mysqli_fetch_array($result))
      {
        //echo $row['COUNT(Name)'];  
      }  

      //FOR UnPaid
      $query1 = "SELECT Status,COUNT(Name) FROM register where Status='Active' "; 
      $result1 = mysqli_query($con,$query1);
      while ($row1 = mysqli_fetch_array($result1))
      {
        //echo $row1['COUNT(Name)'];  
      }
      
  ?>
  <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Months', 'free'],
          ['JAN',  176],
          ['FEB',  0],
          
          ['MAR',  0]
        ]);

        var options = {
          title: ' ',
          curveType: 'function',
          
          legend: { position: "none" },
          hAxis: {textPosition:'none', color: 'white'},
          vAxis: {textPosition:'none', color: 'white'},
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 200px; height: 200px"></div>
  </body>
</html>
