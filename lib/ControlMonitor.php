<?php
    class ControlMonitor {

        // Get all available control monitors by user
        public static function getControlMonitors($owner_id) {
            $sql = "SELECT * FROM iot_control_monitors WHERE owner_id=$owner_id";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get single control monitor by key - value
        public static function getControlMonitor($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_control_monitors WHERE $key='$value'";
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

        // Create new control monitor
        public static function create($unit_group_id, $name, $icon, $source, $unit) {
            $sql = "INSERT INTO iot_control_monitors (name, icon, source, unit) 
                        VALUES ('$name', '$icon', '$source', '$unit')";
            $con = Database::get_mysql();
            $con->query($sql);
            $unit_id = $con->insert_id;
            return ControlGroup::link($unit_group_id, 'MONITOR', $unit_id);
        }

    }
?>