<div class="card">
    <h5 class="card-header"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</h5>
</div>
<br>
<?php
    $control_groups = ControlGroup::getControlGroups($user['id']);
    while($control_group = $control_groups->fetch_assoc()) {
        if($control_group['on_dashboard'] == 1) {
            ?>
            <ul class="list-group">
                <li class="list-group-item list-group-item-success">
                    <strong><i class="fas fa-object-group"></i>&nbsp;<?php echo $control_group['group_name']; ?></strong>
                </li>
                <?php
                    $controls = ControlGroup::getMembers($control_group['id']);
                    while($control = $controls->fetch_assoc()) {
                        switch($control['control_type'])
                        {
                            case "MONITOR":
                                $monitor = ControlMonitor::getControlMonitor('id', $control['control_id']);
                                $data = Data::filterLatestDataset('topic_name', $monitor['source']);
                                ?>
                                    <li class="list-group-item">
                                        <?php echo $monitor['icon']; ?>&nbsp;<?php echo $monitor['name']; ?>

                                        <?php
                                            if(empty($data['message_payload'])) {
                                                ?>
                                                    <span class="badge badge-warning float-right">No data available yet</span>
                                                <?php
                                            } else {
                                                ?>
                                                    <strong><?php echo $data['message_payload'].$monitor['unit']; ?></strong>
                                                    <span class="badge badge-primary float-right">
                                                        <?php echo $data['date_received']; ?>
                                                    </span>
                                                <?php
                                            }
                                        ?>
                                    </li>
                                <?php
                                break;
                            case "SWITCH":
                                $switch = ControlSwitch::getControlSwitch('id', $control['control_id']);
                                ?>
                                    <li class="list-group-item">
                                        <?php
                                            echo $switch['icon']; ?>&nbsp;<?php echo $switch['name'];

                                            if($switch['state'] == 0) {
                                                ?>
                                                    <span class="badge badge-danger">Inactive</span>
                                                    <a href="?p=switch&id=<?php echo $switch['id']; ?>&state=1" class="btn btn-success btn-sm float-right" style="width: 120px">
                                                        <i class="fas fa-power-off"></i>&nbsp;ON
                                                    </a>
                                                <?php
                                            } else if($switch['state'] == 1) {
                                                ?>
                                                    <span class="badge badge-success">Active</span>
                                                    <a href="?p=switch&id=<?php echo $switch['id']; ?>&state=0" class="btn btn-danger btn-sm float-right" style="width: 120px">
                                                        <i class="fas fa-power-off"></i>&nbsp;OFF
                                                    </a>
                                                <?php
                                            }
                                        ?>
                                    </li>
                                <?php
                                break;
                        }
                    }
                ?>
            </ul>
            <br>
        <?php
        }
    }
?>
