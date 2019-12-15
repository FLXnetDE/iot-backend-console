<?php
    $devices = Device::getDevices($user['id']);
?>
<div class="card">
    <h5 class="card-header"><i class="fas fa-microchip"></i>&nbsp;Device management</h5>
</div>
<br>
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Device name</th>
                    <th scope="col">Device key</th>
                    <th scope="col">Is locked</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($d = $devices->fetch_assoc()) {
                        ?>
                            <tr>
                                <th><?php echo $d['id']; ?></th>
                                <td><?php echo $d['device_name']; ?></td>
                                <td><?php echo $d['device_key']; ?></td>
                                <?php
                                    if($d['is_locked'] == 0) {
                                        echo '<td><span class="badge badge-success">No</span></td>';
                                        echo '<td><a href="?p=lock_device&id='.$d['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a></td>';
                                    } else {
                                        echo '<td><span class="badge badge-danger">Yes</span></td>';
                                        echo '<td><a href="?p=unlock_device&id='.$d['id'].'" class="btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a></td>';
                                    }
                                ?>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<a href="?p=add_device" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>&nbsp;Add device</a>