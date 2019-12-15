<?php
    if(isset($_POST['username'], $_POST['password'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $login = User::login($username, $password);

        if($login) {
            Helper::setLoggedIn($username);
            Notification::setSession('success', 'fa fa-check', 'Successfully logged in!');
            Helper::redirect('index');
        } else {
            echo "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> Login failed!</div>";
        }       
    }
?>
<div class="card col-md-4 offset-md-4">
    <div class="card-body">
        <form method="POST" action="?p=login">
            <div class="input-group input-group-seamless">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
                <input name="username" type="text" class="form-control" placeholder="Username" />
            </div>
            <br>
            <div class="input-group input-group-seamless">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <input name="password" type="password" class="form-control" placeholder="Password" />
            </div>
            <br>
            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i>&nbsp;Login</button>
        </form>
    </div>
</div>