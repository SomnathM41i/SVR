<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
  
  $date = date('Y');
  
  for($i=1;$i<=12;$i++)
  {

    $que = "SELECT COUNT(Name) FROM register where MONTH(Regdate) = $i && Gender= 'Male' && YEAR(Regdate) = $date ";
    $res = mysqli_query($con,$que);
    $row = mysqli_fetch_array($res);
    $val = $row['COUNT(Name)'];

    $que1 = "SELECT COUNT(Name) FROM register where MONTH(Regdate) = $i && Gender= 'Female' && YEAR(Regdate) = $date ";
    $res1 = mysqli_query($con,$que1);
    $row1 = mysqli_fetch_array($res1);
    $val1 = $row1['COUNT(Name)'];
    
    //UPDATE TABLE CHART
    $query = "UPDATE chart SET Groom= $val, Bride= $val1 WHERE ID=$i";
    $result = mysqli_query($con,$query);
  }
  $query = "SELECT Month,Groom,Bride FROM chart ";
  $res = mysqli_query($con,$query);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['MONTH','GROOM','BRIDE', ],
            <?php
              $month=date("n");
              while ( $row = $res->fetch_assoc() )
              {
                echo "['".$row['Month']."',".$row['Groom'].",".$row['Bride']."],";  
              }
            ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <style type="text/css">
      .chart_wrap
      {
        position: relative;
        padding-bottom: 100;
        height: 0;
        overflow: hidden;
        height: 300px;
        width: 100%;
      } 
      .columnchart_material
      {
        position: absolute;
        top: 0;
        left: 0;
        height: 300px;
        width: 100%;
      }

    </style>
  </head>
  <body>
    <div id="columnchart_material" style="width: 100%; height: 300px;"></div>
  </body>
</html>