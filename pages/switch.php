<?php
    if(!isset($_GET['id'])) {
        Helper::redirect('index');
        return;
    }
    $id = $_GET['id'];
    $switch = ControlSwitch::getControlSwitch('id', $id);

    if(!isset($_GET['state'])) {
        Helper::redirect('index');
        return;
    }
    $state = $_GET['state'];

    if($state == 0) {
        $payload = $switch['value_0'];
    } else if($state == 1) {
        $payload = $switch['value_1'];
    }

    $response = MqttOverHttp::publish($switch['destination'], $payload);

    if(empty($response)) {
        Notification::setSession('danger', 'fa fa-times', 'MQTTOverHTTP failed, received no response from the server.');
    } else {
        ControlSwitch::switchFunction($id, $state);
        Notification::setSession('success', 'fa fa-check', $response);
    }

    Helper::redirect('index');
?>