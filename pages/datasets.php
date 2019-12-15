<div class="card">
    <h5 class="card-header"><i class="fas fa-database"></i>&nbsp;Global datasets</h5>
</div>
<br>
<div class="card">
    <div class="card-body">
        <?php
            $data = Data::getData();
            echo 'Total amount of datasets <span class="badge badge-success">' . $data->num_rows . '</span>';
        ?>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Client-ID</th>
                    <th scope="col">Topic Name</th>
                    <th scope="col">Message Payload</th>
                    <th scope="col">Date Received</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($d = $data->fetch_assoc()) {
                        ?>
                            <tr>
                                <th><?php echo $d['client_id']; ?></th>
                                <td><?php echo $d['topic_name']; ?></td>
                                <td><?php echo $d['message_payload']; ?></td>
                                <td><?php echo $d['date_received']; ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>