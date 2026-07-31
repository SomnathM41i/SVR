<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
  /*include '../dbconnectadmin.php';*/
  
  //MALE MEMBER
  $relsql=$con->query("select * from caste")or die(mysqli_error($con)  );
  
     

?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() 
      {
        var data = google.visualization.arrayToDataTable
        ([
          ['Status', 'count'],
          ['Completed',91],
          ['Incompleted', <?php echo 91-91 ?>]
        ]);
        var options = 
        {
          title: 'CASTE',
          pieHole: 0.9,
          //is3D: true,
          legend: 'none',
          pieSliceTextStyle: {
            align: 'center',
            color: 'black',
          },
          slices: 
          {
            0: {color: 'darkblue'}, 
            1: {color: 'red'},
           
          }
          //pieStartAngle: 100,
          //is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
   
  </script>
  <style type="text/css">
    
    .chart_wrap
    {
      position: relative;
      padding-bottom: 100;
      height: 0;
      width: 100%;
      overflow: hidden;
    } 
    .donutchart
    {
      position: absolute;
      top: 0;
      left: 0;
      height: 500px;
    }
  </style>
  </head>
  <body>
    <div id="donutchart" style="width: 100%; height: 300px;"> </div>
  </body>
</html>


