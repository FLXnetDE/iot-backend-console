<?php
    class Database {

        // Returns the MySQL connection
        public static function get_mysql() {
            $ini = parse_ini_file('app.ini');
            $mysqli = new mysqli($ini['db_host'], $ini['db_user'], $ini['db_password'], $ini['db_name']);
            $mysqli->set_charset("utf8");
            return $mysqli;
        }

    }
?>