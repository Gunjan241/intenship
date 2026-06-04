<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "shop_db";

    public $conn;

    // Create and return database connection
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->db_name
            );

            // Check connection
            if ($this->conn->connect_error) {
                throw new Exception(
                    "Connection failed: " . $this->conn->connect_error
                );
            }

        } catch (Exception $e) {
            die("Database Error: " . $e->getMessage());
        }

        return $this->conn;
    }
}

?>