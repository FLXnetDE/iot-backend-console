<?php
    if(!($group['perm_level'] < 3)) {
        Helper::redirect('index');
        return;
    }
?>
<div class="card">
    <h5 class="card-header"><i class="fas fa-chart-bar"></i>&nbsp;Global statistics</h5>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Overall datasets</h5>
                <p class="card-text">System is currently holding a total of <span class="badge badge-success"><?php echo Data::getData()->num_rows; ?></span> datasets</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Unique devices</h5>
                <p class="card-text">There are datasets from <span class="badge badge-success"><?php echo Data::getUniqueDevices()->num_rows; ?></span> unique IOT device(s)</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Unique mqtt topics</h5>
                <p class="card-text">Data was published in <span class="badge badge-success"><?php echo Data::getUniqueTopics()->num_rows; ?></span> unique mqtt topics</p>
            </div>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Latest data</h5>
        <?php
            $latest = Data::getLatestDataset();
        ?>
        <p class="card-text">Latest dataset is comming from <strong><?php echo $latest['client_id']; ?></strong> in topic <strong><?php echo $latest['topic_name']; ?></strong> at <strong><?php echo $latest['date_received']; ?></strong></p>
    </div>
</div>