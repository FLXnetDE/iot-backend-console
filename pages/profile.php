<div class="card">
    <h5 class="card-header"><i class="fas fa-cog"></i>&nbsp;Profile</h5>
</div>
<br>
<div class="card">
    <div class="card-body">
        <p><i class="fas fa-user"></i>&nbsp;<?php echo $user['user_name']; ?></p>
        <p>
            <i class="fas fa-users"></i>&nbsp;<?php echo Group::getGroup('id', $user['group_id'])['name']; ?>
            <span class="badge badge-primary"><?php echo Group::getGroup('id', $user['group_id'])['perm_level']; ?></span>
        </p>
        <p><i class="fas fa-envelope"></i>&nbsp;<?php echo $user['user_mail']; ?></p>
        <p>
            <i class="fas fa-lock"></i>&nbsp;**********
            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>&nbsp;Change password</a>
        </p>
        <p><i class="fas fa-clock"></i>&nbsp;Last login <strong><?php echo Helper::getDate($user['last_login']); ?></strong></p>
        <p><i class="fas fa-sign-in-alt"></i>&nbsp;Registered since <strong><?php echo Helper::getDate($user['date_created']); ?></strong></p>
    </div>
</div>