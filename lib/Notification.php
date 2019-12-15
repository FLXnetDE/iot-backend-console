<?php
    class Notification {

        // Get notifications
        public static function getNotifications() {
            $sql = "SELECT * FROM notifications";
            return get_mysql()->query($sql);
        }
        
        // Get amount of current notifications
        public static function count() {
            $sql = "SELECT COUNT(id) FROM notifications WHERE has_read='0'";
            return get_mysql()->query($sql)->fetch_assoc()['COUNT(id)'];
        }

        // Mark notification as read
        public static function readNotification($id) {
            $sql = "UPDATE notifications SET has_read='1' WHERE id='$id'";
            get_mysql()->query($sql);
        }

        // Set notification alert
        public static function setSession($color, $icon, $text) {
            $_SESSION['notification'] = "<div class='alert alert-" . $color . "'><i class='" . $icon . "'></i> " . $text . "</div>";
        }
    }
?>