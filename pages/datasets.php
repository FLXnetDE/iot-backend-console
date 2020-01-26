<?php
  if (isset($_GET['page']) && $_GET['page'] != 0) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $recordsPerPage = 10;
?>
<div class="card">
    <h5 class="card-header"><i class="fas fa-database"></i>&nbsp;Global datasets</h5>
</div>
<br>
<div class="card">
    <div class="card-body">
        <?php
            $totalPages = Data::countData();
            $data = Data::pagination($page, $recordsPerPage);
            echo 'Total amount of datasets <span class="badge badge-success">' . $totalPages . '</span>';
        ?>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
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
                                <td><?php echo $d['id']; ?></td>
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
        <br>
        <nav aria-label="pagination">
          <ul class="pagination justify-content-center">
            <?php
              if($page > 1) {
                ?>
                  <li class="page-item"><a class="page-link" href="?p=datasets&page=1">First</a></li>
                  <li class="page-item"><a class="page-link" href="?p=datasets&page=<?php echo $page - 1; ?>"><?php echo $page - 1; ?></a></li>
                <?php
              } else {
                ?>
                  <li class="page-item disabled"><a class="page-link" href="#">First</a></li>
                <?php
              }
            ?>
            <li class="page-item active"><a class="page-link" href="?p=datasets&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php
              if($page < ceil($totalPages / $recordsPerPage)) {
                ?>
                  <li class="page-item"><a class="page-link" href="?p=datasets&page=<?php echo $page + 1; ?>"><?php echo $page + 1; ?></a></li>
                  <li class="page-item"><a class="page-link" href="?p=datasets&page=<?php echo ceil($totalPages / $recordsPerPage); ?>">Last</a></li>
                <?php
              } else {
                ?>
                  <li class="page-item disabled"><a class="page-link" href="#">Last</a></li>
                <?php
              }
            ?>
          </ul>
        </nav>
    </div>
</div>
