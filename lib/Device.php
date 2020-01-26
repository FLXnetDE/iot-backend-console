<?php
    class Device {

        // Get all device
        public static function getDevices($owner_id) {
            $sql = "SELECT * FROM iot_devices WHERE owner_id=$owner_id";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get specific device
        public static function getDevice($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_devices WHERE $key='$value'";
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

        // Request a list of the currently connected devices on the iot-backend-application
        public static function getConnectedClients() {
            $ini = parse_ini_file('app.ini');
            $request = curl_init('http://'.$ini['broker_host'].':'.$ini['broker_http_port'].'/clients');
            curl_setopt($request, CURLOPT_HEADER, 0);
            curl_setopt($request, CURLOPT_POST, 0);
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($request);
            curl_close($request);
            return $response;
        }

    }
?>
