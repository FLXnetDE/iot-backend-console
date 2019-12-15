<?php
    if(!isset($_GET['id'])) {
        Helper::redirect('index');
        return;
    }
    $id = $_GET['id'];

    $monitor = ControlMonitor::getControlMonitor('id', $id);

    var_dump($monitor);
?>