<?php
    class ControlSwitch {

        // Get single control switch by key - value
        public static function getControlSwitch($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_control_switches WHERE $key='$value'";
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

        // Create new control switch
        public static function create($unit_group_id, $name, $icon, $destination, $value_1, $value_0) {
            $sql = "INSERT INTO iot_control_switches (name, icon, destination, value_1, value_0, state) 
                        VALUES ('$name', '$icon', '$destination', '$value_1', '$value_0', '0')";
            $con = Database::get_mysql();
            $con->query($sql);
            $unit_id = $con->insert_id;
            return ControlGroup::link($unit_group_id, 'SWITCH', $unit_id);
        }

        // Trigger switch function
        public static function switchFunction($id, $state) {
            $id = Database::get_mysql()->real_escape_string($id);
            $state = Database::get_mysql()->real_escape_string($state);
            $sql = "UPDATE iot_control_switches SET state='$state' WHERE id='$id'";
            Database::get_mysql()->query($sql);

            // Send MQTT - connection to iot-backend application via HTTP
        }

    }
?>