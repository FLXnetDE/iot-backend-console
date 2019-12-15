<?php
    class Group {

        // Get all users
        public static function getGroups() {
            $sql = "SELECT * FROM iot_groups";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get specific user
        public static function getGroup($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_groups WHERE $key='$value'";
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

    }
?>