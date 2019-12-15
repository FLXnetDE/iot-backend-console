<?php
    session_start();
    include('./lib/Loader.php');

    if(isset($_GET['p'])) {
        $p = $_GET['p'];
    } else {
        $p = 'index';
    }

    if(($p != 'index') && ($p != 'login') && ($p != 'register') && (!isset($_SESSION['user']))) {
        Helper::redirect('index');
    }
?>
<html>
    <head>
        <?php include('./pages/head.php'); ?>
    </head>
    <body>
        <?php include('./pages/header.php'); ?>
        <br>
        <div class="container">
            <?php
                if(isset($_SESSION['notification'])) {
                    echo $_SESSION['notification'];
                    unset($_SESSION['notification']);
                }

                $page = './pages/' . $p . '.php';
                $page_exists = file_exists($page);

                if(!$page_exists) {
                    $page = './pages/not_found.php';
                }
                
                include($page);
            ?>
        </div>
    </body>
</html>