<?php

class Middleware {

    public static function requireLogin() {

        session_start();

        if (!isset($_SESSION['user_id'])) {

            header("Location: ../public/login.php");

            exit();
        }
    }

    public static function requireRole($role) {

        self::requireLogin();

        if ($_SESSION['role'] != $role) {

            die("Access Denied");
        }
    }
}

?>