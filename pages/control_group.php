<?php
    if(!isset($_GET['id'])) {
        Helper::redirect('index');
        return;
    }
    $id = $_GET['id'];
    $control_group = ControlGroup::getControlGroup('id', $id);
?>
<div class="card">
    <h5 class="card-header"><i class="fas fa-object-group"></i>&nbsp;<?php echo $control_group['group_name']; ?></h5>
</div>
<br>
<div class="card">
    <div class="card-body">
        <?php
            $controls = ControlGroup::getMembers($control_group['id']);
            while($control = $controls->fetch_assoc()) {

                switch($control['control_type'])
                {
                    case "MONITOR":
                        $monitor = ControlMonitor::getControlMonitor('id', $control['control_id']);
                        $data = Data::filterLatestDataset('topic_name', $monitor['source']);
                        ?>
                            <div class="card">
                                <h5 class="card-header">
                                    <?php echo $monitor['icon']; ?>&nbsp;<?php echo $monitor['name']; ?>
                                    <div class="badge badge-primary"><?php echo $monitor['source']; ?></div>
                                    <a href="?p=history&id=<?php echo $control['control_id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-chart-area"></i>&nbsp;Show graph</a>
                                </h5>
                                <div class="card-body">
                                    <?php
                                        if(empty($data['message_payload'])) {
                                            ?>
                                                <span class="badge badge-warning">No data available yet</span>
                                            <?php
                                        } else {
                                            ?>
                                                <strong><?php echo $data['message_payload'].$monitor['unit']; ?></strong>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <br>
                        <?php
                        break;
                    case "SWITCH":
                        $switch = ControlSwitch::getControlSwitch('id', $control['control_id']);
                        ?>
                            <div class="card">
                                <h5 class="card-header">
                                    <?php echo $switch['icon']; ?>&nbsp;<?php echo $switch['name']; ?>
                                    <div class="badge badge-primary"><?php echo $switch['destination']; ?></div>
                                    <?php
                                        if($switch['state'] == 0) {
                                            echo '<span class="badge badge-danger">Inactive</span>';
                                        } else if($switch['state'] == 1) {
                                            echo '<span class="badge badge-success">Active</span>';
                                        }
                                    ?>
                                </h5>
                                <div class="card-body">
                                    <?php
                                        if($switch['state'] == 0) {
                                            ?>
                                                <a href="?p=switch&id=<?php echo $switch['id']; ?>&state=1" class="btn btn-success btn-block">
                                                    <i class="fas fa-power-off"></i>&nbsp;ON
                                                </a>
                                            <?php
                                        } else if($switch['state'] == 1) {
                                            ?>
                                                <a href="?p=switch&id=<?php echo $switch['id']; ?>&state=0" class="btn btn-danger btn-block">
                                                    <i class="fas fa-power-off"></i>&nbsp;OFF
                                                </a>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <br>
                        <?php
                        break;
                }
            }
        ?>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <a href="?p=add_control&id=<?php echo $id; ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>&nbsp;Add new control unit</a>
    </div>
</div>