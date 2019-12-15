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

    }
?>