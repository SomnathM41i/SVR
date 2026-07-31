<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
	/*include '../dbconnectadmin.php';*/
	//PAID MEMBER
	$query = "SELECT Status,COUNT(Name) FROM register where Status='Paid' "; 
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$val = $row['COUNT(Name)'];

	// UNPAID MEMEBER
	$query1 = "SELECT Status,COUNT(Name) FROM register where  Status='Active' "; 
	$result1 = mysqli_query($con,$query1);
	$row1 = mysqli_fetch_array($result1);
	$val1 = $row1['COUNT(Name)'];

	//EXPIRED MEMEBER
	$query2 = "SELECT Status,COUNT(Name) FROM register where Status='Expired' "; 
	$result2 = mysqli_query($con,$query2);
	$row2 = mysqli_fetch_array($result2);
	$val2 = $row2['COUNT(Name)'];

	//BANNED MEMBERS
	$query3 = "SELECT Status,COUNT(Name) FROM register where Status='Banned' "; 
	$result3 = mysqli_query($con,$query3);
	$row3 = mysqli_fetch_array($result3);
	$val3 = $row3['COUNT(Name)'];
	
	// UPDATING DATA
	// FOR PAID
	$que = "UPDATE reg_count SET Count= $val WHERE ID= 1";
  $res = mysqli_query($con,$que);
	
	//FOR UNPAID
	$que1 = "UPDATE reg_count SET Count= $val1 WHERE ID= 2";
  $res1 = mysqli_query($con,$que1);
	
	//FOR EXPIRED
	$que2 = "UPDATE reg_count SET Count= $val2 WHERE ID= 3";
  $res2 = mysqli_query($con,$que2);

    //FOR BANNED
  $que2 = "UPDATE reg_count SET Count= $val3 WHERE ID= 4";
  $res2 = mysqli_query($con,$que2);
	
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() 
      {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'count'],
          <?php
          		$que1 = "SELECT Status,Count FROM reg_count";
          		$res1 = mysqli_query($con,$que1); 

          		 while ( $row = $res1->fetch_assoc() )
                  {
                    echo "['".$row['Status']."',".$row['Count']."],";  
                  }
          ?>
          
      ]);

      var options = 
      {
        title: '',
        legend: 
          {position: 'bottom'},
        pieHole: 0.5,
        animation:
        {
          duration: 1000,
          easing: 'out',
        },
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        
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
  
    <div id="donutchart" style="width: 100%; height: 500px;"> </div>
  </body>
</html>