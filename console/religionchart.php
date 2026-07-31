<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');

  /*include '../dbconnectadmin.php';*/
  
  
  $relsql=$con->query("select * from caste")or die(mysqli_error($con)  );
  

?>



<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Caste ', 'Groom', 'Bride' ],

          <?php  
                    $relsql=$con->query("select * from caste")or die(mysqli_error($con) );
 
                    
                      while($relrow = $relsql->fetch_assoc())
                      {
                        $caste=$relrow['Caste'];
                      $groomsql=$con->query("select IFNULL(Count(*),0) as num  from register where Caste='$caste' And Gender='Male' ")or die(mysqli_error($con) );
              $groom=0;
              if($groomrow=$groomsql->fetch_assoc())
              {
              $groom= $groomrow['num'];
              }
                      $bridesql=$con->query("select IFNULL(Count(*),0) as num  from register where Caste='$caste' And Gender='Female' ")or die(mysqli_error($con) );
  
              $bride=0;
              if($briderow=$bridesql->fetch_assoc())
              {
              $bride= $briderow['num'];
              }
              if($bride>0 || $groom>0)
              {

            ?>

          ['<?php echo $caste;?>', <?php echo $groom?> , <?php echo $bride?> ],
          <?php } 
            }
          ?>

          
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',

          },
            
          bars: 'horizontal', // Required for Material Bar Charts.
          colors: ['#7267EF', '#EA4D4D', '#FFA21D']
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 100%; height: 100%;"></div>
  </body>
</html>