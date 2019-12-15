<?php
    if(!isset($_GET['id'])) {
        Helper::redirect('index');
        return;
    }
    $id = $_GET['id'];
    $control_group = ControlGroup::getControlGroup('id', $id);
?>
<div class="card">
    <h5 class="card-header"><i class="fas fa-plus"></i>&nbsp;Add control to group <?php echo $control_group['group_name']; ?></h5>
</div>
<br>
<?php
    if(!isset($_GET['step'])) {
        ?>
            <div class="card">
                <h5 class="card-header"><div class="badge badge-primary">Step 1</div> Basic information</h5>
                <div class="card-body">
                    <form method="POST" action="?p=add_control&id=<?php echo $id; ?>&step=2">
                        <div class="form-group">
                            <label>Name of the control (e.g. Temperature)</label>
                            <input name="unit_name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Use icon HTML from fontawesome.com</label>
                            <input name="icon" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Control type</label>
                            <select name="type" class="form-control">
                                <option value="MONITOR">Monitor</option>
                                <option value="SWITCH">Switch</option>
                            </select>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success"><i class="fas fa-arrow-right"></i>&nbsp;Step 2</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    } else if(isset($_GET['step']) && $_GET['step'] == 2) {
        $unit_name = $_POST['unit_name'];
        $icon = $_POST['icon'];
        $type = $_POST['type'];

        ?>
            <div class="card">
                <h5 class="card-header"><div class="badge badge-primary">Step 2</div> Data field information</h5>
                <div class="card-body">
                    <h5 class="badge badge-info"><?php echo $type; ?></h5>
                    <br>
                    <form method="POST" action="?p=add_control&id=<?php echo $id; ?>&step=3">

                        <?php
                            if($type == "MONITOR") {
                                ?>
                                    <div class="form-group">
                                        <label>MQTT topic to be monitored (latest value will be displayed, history graph can be shown)</label>
                                        <input name="source" type="text" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Output value unit (e.g. °C, %, hPa)</label>
                                        <input name="unit" type="text" class="form-control">
                                    </div>
                                    <input type="hidden" name="unit_name" value="<?php echo $unit_name; ?>">
                                    <input type="hidden" name="icon" value="<?php echo $icon; ?>">
                                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                                <?php
                            } else if($type == "SWITCH") {
                                ?>
                                <div class="form-group">
                                    <label>Device MQTT topic</label>
                                    <input name="type_destination" type="text" class="form-control">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Value for state <span class="badge badge-success">ON</span></label>
                                    <input name="type_value" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Value for state <span class="badge badge-danger">OFF</span></label>
                                    <input name="type_unit" type="text" class="form-control">
                                </div>
                                <input type="hidden" name="unit_name" value="<?php echo $unit_name; ?>">
                                <input type="hidden" name="icon" value="<?php echo $icon; ?>">
                                <input type="hidden" name="type" value="<?php echo $type; ?>">
                            <?php
                            }
                        ?>
                        <br>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i>&nbsp;Add unit group</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    } else if(isset($_GET['step']) && $_GET['step'] == 3) {
        $unit_name = $_POST['unit_name'];
        $icon = $_POST['icon'];
        $type = $_POST['type'];
        $result = null;

        switch($type)
        {
            case "MONITOR":
                $result = ControlMonitor::create($id, $unit_name, $icon, $_POST['source'], $_POST['unit']);
                break;
            case "SWITCH":

                break;
        }

        Helper::redirect('control_group&id='.$id);
    }
?>