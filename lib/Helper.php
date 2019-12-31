<?php
    class Helper {

        // Check if user is logged in
        public static function isLoggedIn() {
            return isset($_SESSION['user']);
        }

        // Set a user as logged in
        public static function setLoggedIn($user) {
            $_SESSION['user'] = $user;
        }

        // Get user session
        public static function getUserSession() {
            return $_SESSION['user'];
        }

        // Redirect, based on JS
        public static function redirect($page) {
            echo '<script>window.location.href = "?p=' . $page . '";</script>';
        }

        // Convert milliseconds to date string / format
        public static function getDate($milliseconds) {
            $seconds = $milliseconds / 1000;
            return date("Y-m-d H:i:s", $seconds);
        }

        // Get current unix timestamp (milliseconds)
        public static function currentMillis() {
            return round(microtime(true) * 1000);
        }
    }
?>