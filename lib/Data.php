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

        // Filter data by key - value
        public static function filterData($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_data WHERE $key='$value' ORDER BY date_received";
            return Database::get_mysql()->query($sql);
        }

        // Get data values to generate a Google Charts based graph
        public static function getGoogleChartsGraphData($key, $value, $descriptor, $limit) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);

            if($limit == -1) {
                $sql = "SELECT date_received, message_payload FROM iot_data WHERE $key='$value' ORDER BY date_received ASC";
            } else {
                $sql = "SELECT date_received, message_payload FROM (SELECT date_received, message_payload FROM iot_data WHERE $key='$value' ORDER BY date_received DESC LIMIT  $limit) sub ORDER BY date_received ASC";
            }

            $result = Database::get_mysql()->query($sql);

            $complete = array();
            $complete[] = array(array('label' => 'Date', 'type' => 'string'), $descriptor);
            
            while($row = $result->fetch_assoc())  {
                $dataset = array($row['date_received'], (double) $row['message_payload']);
                $complete[] = $dataset;
            }

            return json_encode($complete);
        }
    }
?>