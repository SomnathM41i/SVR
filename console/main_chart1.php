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
        ['Jan', 50],
        ['Feb', 07],
        ['Mar', 25],
        ['Apr', 30],
        ['June', 10],
        ['July', 15],
        ['Aug', 25],
        ['Dec', 20]
      
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

   <div id="line-chart" style="width: 150px; height: 50px;"></div>

  
 </div>

</body>

</html>