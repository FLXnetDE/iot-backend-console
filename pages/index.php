<?php
    if(Helper::isLoggedIn()) {
        include './pages/dashboard.php';
    } else {
        Helper::redirect('login');
    }
?>