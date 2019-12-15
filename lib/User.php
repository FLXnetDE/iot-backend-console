<?php
    class User {

        // Get all users
        public static function getUsers() {
            $sql = "SELECT * FROM iot_users";
            $sql = Database::get_mysql()->real_escape_string($sql);
            return Database::get_mysql()->query($sql);
        }

        // Get specific user
        public static function getUser($key, $value) {
            $key = Database::get_mysql()->real_escape_string($key);
            $value = Database::get_mysql()->real_escape_string($value);
            $sql = "SELECT * FROM iot_users WHERE $key='$value'";
            return Database::get_mysql()->query($sql)->fetch_assoc();
        }

        // Check login credentials
        public static function login($username, $password) {
            $user = User::getUser('user_name', $username);
            if($user != null && $user['user_password'] == md5($password)) {
                $millis = Helper::currentMillis();
                $sql = "UPDATE iot_users SET last_login='$millis' WHERE user_name='$username'";
                Database::get_mysql()->query($sql);
                return true;
            }
            return false;
        }

    }
?>