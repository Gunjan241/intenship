<?php

require_once "../config/Database.php";

class ServiceRequest {

    private $conn;

    public function __construct() {

        $database = Database::getInstance();

        $this->conn = $database->getConnection();
    }

    // CREATE REQUEST

    public function create($data) {

        $stmt = $this->conn->prepare("
            INSERT INTO service_requests
            (
                user_id,
                title,
                category,
                description,
                priority,
                file_path
            )
            VALUES(?,?,?,?,?,?)
        ");

        $stmt->bind_param(
            "isssss",
            $data['user_id'],
            $data['title'],
            $data['category'],
            $data['description'],
            $data['priority'],
            $data['file_path']
        );

        return $stmt->execute();
    }

    // GET USER REQUESTS (ASCENDING ORDER)

    public function getByUser($userId) {

        $stmt = $this->conn->prepare("
            SELECT *
            FROM service_requests
            WHERE user_id=?
            ORDER BY id ASC
        ");

        $stmt->bind_param("i", $userId);

        $stmt->execute();

        return $stmt->get_result();
    }

    // GET ALL REQUESTS

    public function getAll() {

        $sql = "
            SELECT service_requests.*, users.name
            FROM service_requests
            JOIN users
            ON service_requests.user_id = users.id
            ORDER BY service_requests.id ASC
        ";

        return $this->conn->query($sql);
    }

    // UPDATE STATUS

    public function updateStatus($id, $status) {

        $stmt = $this->conn->prepare("
            UPDATE service_requests
            SET status=?
            WHERE id=?
        ");

        $stmt->bind_param("si", $status, $id);

        return $stmt->execute();
    }

    // DELETE REQUEST

    public function delete($id, $userId) {

        $stmt = $this->conn->prepare("
            DELETE FROM service_requests
            WHERE id=?
            AND user_id=?
            AND status='Pending'
        ");

        $stmt->bind_param("ii", $id, $userId);

        return $stmt->execute();
    }
}

?>