<?php
    if(isset($_SESSION['user'])) {
        $user = User::getUser('user_name', $_SESSION['user']);
        $group = Group::getGroup('id', $user['group_id']);
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1F3D5C;">
    <a class="navbar-brand" href="?p=index"><i class="fas fa-database"></i>&nbsp;IOT Backend Console</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <?php
            if(Helper::isLoggedIn()) {
                ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="?p=index"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                        </li>
                        <!-- Control groups -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-object-group"></i>&nbsp;Control groups
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                    $cu_groups = ControlGroup::getControlGroups($user['id']);
                                    while($cug = $cu_groups->fetch_assoc()) {
                                        ?>
                                            <a class="dropdown-item" href="?p=control_group&id=<?php echo $cug['id']; ?>"><i class="fas fa-object-group"></i>&nbsp;<?php echo $cug['group_name']; ?></a>
                                        <?php
                                    }
                                ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?p=create_control_group"><i class="fas fa-plus"></i>&nbsp;Create control group</a>
                            </div>
                        </li>
                        <!-- Device management -->
                        <li class="nav-item">
                            <a class="nav-link" href="?p=devices"><i class="fas fa-microchip"></i>&nbsp;Device management</a>
                        </li>
                        <!-- Administrative pages -->
                        <?php
                            if($group['perm_level'] < 3) {
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="?p=datasets"><i class="fas fa-database"></i>&nbsp;Global datasets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="?p=statistics"><i class="fas fa-chart-bar"></i>&nbsp;Global statistics</a>
                                    </li>
                                <?php
                            }
                        ?>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- User -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>&nbsp;<?php echo $user['user_name'] . ' (' . Group::getGroup('id', $user['group_id'])['name'] . ')'; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?p=profile"><i class="fas fa-cog"></i>&nbsp;Profile</a>
                                <?php
                                    if($group['perm_level'] < 3) {
                                        ?>
                                            <a class="dropdown-item" href="?p=administration"><i class="fas fa-cogs"></i>&nbsp;Administration</a>
                                        <?php
                                    }
                                ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?p=logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                            </div>
                        </li>
                    </ul>
                <?php
            } else {

            }
        ?>
    </div>
</nav>