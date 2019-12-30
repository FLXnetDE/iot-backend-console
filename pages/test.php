<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(
            <?php echo Data::getGoogleChartsGraphData('topic_name', 'weather/weatherstation001/temperature', 'Test temperature in °C'); ?>
        );

        var options = {
            title: 'Test graph',
            curveType: 'function',
            vAxis: {title: "Temperature in °C"},
            legend:{position:'none'},
            crosshair: {"trigger" : "both"}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>
<div id="curve_chart" style="height: 400px"></div>