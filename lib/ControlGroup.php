<?php
    class ControlGroup {

        // Get all available control groups by user
        public static function getControlGroups($owner_id) {
            $sql = "SELECT * FROM iot_control_groups WHERE owner_id=$owner_id";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get specific ControlGroup
        public static function getControlGroup($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_control_groups WHERE $key='$value'";
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

        // Get controls in group
        public static function getMembers($group_id) {
            $sql = "SELECT * FROM iot_controls_in_groups WHERE group_id=$group_id";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Create new control unit group
        public static function create($owner_id, $group_name, $on_dashboard) {
            $sql = "INSERT INTO iot_control_groups (owner_id, group_name, on_dashboard) VALUES ('$owner_id', '$group_name', '$on_dashboard')";
            return Database::get_mysql()->query($sql) != null;
        }
        
        public static function link($unit_group_id, $control_type, $control_id) {
            $sql = "INSERT INTO iot_controls_in_groups (group_id, control_type, control_id) 
            VALUES ('$unit_group_id', '$control_type', '$control_id')";
            return Database::get_mysql()->query($sql) != null;
        }

    }
?>