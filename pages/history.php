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

    $data = Data::getGoogleChartsGraphData('topic_name', $monitor['source'], $limit);
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
    <div class="card-header">
        <?php
            if($limit == -1) {
                ?>
                    <i class="fas fa-filter"></i>&nbsp;Showing all available datasets, starting from 
                <?php
            } else {
                ?>
                    <i class="fas fa-filter"></i>&nbsp;Showing the last <strong><?php echo $limit; ?></strong> datasets, starting from 
                <?php
            }
        ?>
        <?php
            echo '<strong>'.Helper::getDate($data[0][0]).'</strong>';
        ?>
    </div>
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
        var data = new google.visualization.DataTable();

        data.addColumn('datetime', 'DateTime');
        data.addColumn('number', '<?php echo $monitor['name'].' in '.$monitor['unit']; ?>');

        <?php
          for($i = 0; $i < sizeof($data[0]); $i++) {
            echo 'data.addRow([new Date('.$data[0][$i].'), '.$data[1][$i].']);';
          }
        ?>

        var options = {
            curveType: 'function',
            legend: {position:'none'},
            crosshair: {'trigger' : 'both'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart'));

        chart.draw(data, options);
      }
</script>