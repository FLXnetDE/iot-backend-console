<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable();

    data.addColumn('datetime', 'DateTime');
    data.addColumn('number', 'Value');

    <?php 
      $data = Data::getGoogleChartsGraphData('topic_name', 'weather/weatherstation001/temperature', 50);
      for($i = 0; $i < sizeof($data[0]); $i++) {
        echo 'data.addRow([new Date('.$data[0][$i].'), '.$data[1][$i].']);';
      }
    ?>

    var options = {
        title: 'Test graph',
        curveType: 'function',
        legend: {
          position:'none'
        },
        crosshair: {
          'trigger' : 'both'
        },
        hAxis: {
          textPosition: 'bottom'
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart'));

    chart.draw(data, options);
    }
</script>
<div id="chart" style="height: 400px"></div>