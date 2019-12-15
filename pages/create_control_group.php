<?php
    if(isset($_POST['group_name'])) {
        $group_name = $_POST['group_name'];

        if(!isset($_POST['on_dashboard'])) {
            $on_dashboard = 0;
        } else {
            $on_dashboard = 1;
        }

        $result = ControlGroup::create($user['id'], $group_name, $on_dashboard);

        if($result) {
            Notification::setSession('success', 'fa fa-check', 'Created new control group '.$group_name.'!');
            Helper::redirect('index');
        } else {
            echo "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> Error: Could not create new control group, please try again!</div>";
        }
    }
?>
<div class="card">
    <h5 class="card-header"><i class="fas fa-plus"></i>&nbsp;Create control group</h5>
</div>
<br>
<div class="card">
    <div class="card-body">
        <form method="POST" action="?p=create_control_group">
            <div class="form-group">
                <input name="group_name" type="text" class="form-control" placeholder="Name of the control group (e.g. Weatherstation)">
            </div>
            <div class="custom-control custom-checkbox mr-sm-2">
                <input name="on_dashboard" type="checkbox" class="custom-control-input" id="onDashboardCheckbox">
                <label class="custom-control-label" for="onDashboardCheckbox">Show on dashboard</label>
            </div>
            <br>
            <button type="submit" class="btn btn-success btn-block" value=""><i class="fas fa-plus"></i>&nbsp;Create new control group</button>
        </form>
    </div>
</div>