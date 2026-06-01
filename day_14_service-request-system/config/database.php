<?php

class Database {

    private static $instance = null;

    private $conn;

    private function __construct() {

        $this->conn = new mysqli("localhost", "root", "", "service_request_system");

        if ($this->conn->connect_error) {

            die("Database Connection Failed : " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {

        if (self::$instance == null) {

            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection() {

        return $this->conn;
    }
}

?>