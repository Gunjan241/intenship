<?php

require_once "../config/Database.php";

class Auth {

    private $conn;

    public function __construct() {

        $database = Database::getInstance();

        $this->conn = $database->getConnection();
    }

    // REGISTER

    public function register($name, $email, $password) {

        $name = trim($name);
        $email = trim($email);
        $password = trim($password);

        if (empty($name) || empty($email) || empty($password)) {

            return [
                "success" => false,
                "message" => "All fields are required"
            ];
        }

        // CHECK EMAIL

        $check = $this->conn->prepare("SELECT id FROM users WHERE email=?");

        $check->bind_param("s", $email);

        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            return [
                "success" => false,
                "message" => "Email already exists"
            ];
        }

        // HASH PASSWORD

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");

        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {

            return [
                "success" => true,
                "message" => "Registration Successful"
            ];
        }

        return [
            "success" => false,
            "message" => "Registration Failed"
        ];
    }

    // LOGIN

    public function login($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                session_start();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                return [
                    "success" => true,
                    "role" => $user['role']
                ];
            }
        }

        return [
            "success" => false,
            "message" => "Invalid Email or Password"
        ];
    }

    // LOGOUT

    public function logout() {

        session_start();

        session_destroy();

        header("Location: login.php");
    }
}

?>