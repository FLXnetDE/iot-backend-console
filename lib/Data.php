<?php
    class Data {

        // Get all available iot datasets
        public static function getData() {
            $sql = "SELECT * FROM iot_data";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get name of unique devices, sourced from datasets
        public static function getUniqueDevices() {
            $sql = "SELECT DISTINCT client_id FROM iot_data";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get name of unique topics, sourced from datasets
        public static function getUniqueTopics() {
            $sql = "SELECT DISTINCT topic_name FROM iot_data";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get latest dataset
        public static function getLatestDataset() {
            $sql = "SELECT * FROM iot_data ORDER BY date_received DESC LIMIT 1";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

        // Filter latest dataset
        public static function filterLatestDataset($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_data WHERE $key='$value' ORDER BY date_received DESC LIMIT 1";
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

    }
?>