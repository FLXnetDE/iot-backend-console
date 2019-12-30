<?php
    if(!($group['perm_level'] < 3)) {
        Helper::redirect('index');
        return;
    }
?>
<div class="card">
    <h5 class="card-header"><i class="fas fa-cogs"></i>&nbsp;Platform administration</h5>
</div>
<br>
<div class="card">
    <h5 class="card-header">
        <i class="fas fa-server"></i>&nbsp;IOT Backend application availability 
        <span class="badge badge-secondary"><?php echo MqttOverHttp::getConnectionInfo()[0].':'.MqttOverHttp::getConnectionInfo()[1]; ?></span>
    </h5>
    <div class="card-body">
        <?php
            $response = MqttOverHttp::checkAvailability();
            if(empty($response)) {
                ?>
                    <div class="alert alert-danger"><i class="fas fa-times"></i>&nbsp;<strong>IOT Backend application (MQTT & HTTP server) is not available!</strong></div>
                <?php
            } else {
                ?>
                    <div class="alert alert-success"><i class="fas fa-check"></i>&nbsp;<strong>IOT Backend application available!</strong>&nbsp;<?php echo $response; ?></div>
                <?php
            }
        ?>
    </div>
</div>