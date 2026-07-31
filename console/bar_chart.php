<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
 
?>
<html>
<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart()
    {
      var data = google.visualization.arrayToDataTable
      ([
        ["Element", "Using", { role: "style" } ],
        ["Mobile", 50, 'color: #76A7FA'],
        ["Tablet", 10.49, 'color: #76A7FA'],
        ["Laptop", 40, 'color: #76A7FA']
      ]);
      var view = new google.visualization.DataView(data);
      /*view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);*/
      var options = 
      {
        title: " ",
       
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        hAxis: {textPosition:'none', color: 'white'},
        vAxis: {textPosition:'none', color: 'white'},
        //hAxis.baselineColor: 'none',
        //hAxis: {textPosition: 'in'}, vAxis: {textPosition: 'in'},
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }
  </script>
  <style type="text/css">
    .chart_wrap
    {
      position: relative;
      padding-bottom: 100;
      width: 100%;
      height: 100%;
      overflow: hidden;
       
    } 
    .columnchart_values
    {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>
  <div id="chart_wrap">
     <div id="columnchart_values" style="width: 100%; height: 100%;"></div>  
  </div>
</body>
</html>