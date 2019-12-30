<?php
    if(!isset($_GET['id'])) {
        Helper::redirect('index');
        return;
    }
    $id = $_GET['id'];

    $monitor = ControlMonitor::getControlMonitor('id', $id);

    if(!isset($_GET['limit'])) {
        $limit = 25;
    } else {
        $limit = $_GET['limit'];
    }    
?>
<div class="card">
    <h5 class="card-header">
        <i class="<?php echo $monitor['icon']; ?>"></i>&nbsp;<strong><?php echo $monitor['name']; ?></strong> in <?php echo $monitor['unit']; ?>
    </h5>
</div>
<br>
<div class="card">
    <div class="card-body">
        <strong>Source</strong>
        <span class="badge badge-primary"><?php echo $monitor['source']; ?></span>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <strong>Latest measurement</strong>
        <span class="badge badge-success">
            <?php echo Data::filterLatestDataset('topic_name', $monitor['source'])['message_payload'].$monitor['unit']; ?>
        </span>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <div id="chart" style="height: 400px; width: 100%"></div>
        <hr>
        <div class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-filter"></i>&nbsp;Filter
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownFilter">
                <a class="dropdown-item" href="?p=history&id=<?php echo $id; ?>&limit=10">Show last 10 datasets</a>
                <a class="dropdown-item" href="?p=history&id=<?php echo $id; ?>&limit=25">Show last 25 datasets</a>
                <a class="dropdown-item" href="?p=history&id=<?php echo $id; ?>&limit=50">Show last 50 datasets</a>
                <a class="dropdown-item" href="?p=history&id=<?php echo $id; ?>&limit=-1">Show all available datasets</a>
            </div>
        </div>
    </div>
</div>
<!-- Google Charts based graph -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(
            <?php echo Data::getGoogleChartsGraphData('topic_name', $monitor['source'], $monitor['name'].' in '.$monitor['unit'], $limit); ?>
        );

        var options = {
            curveType: 'function',
            legend: { 
                position: 'none'
            },
            crosshair: {
                'trigger' : 'both'
            },
            hAxis: { 
                textPosition: 'bottom',
                format : 'MMM yyyy'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart'));

        chart.draw(data, options);
      }
</script>