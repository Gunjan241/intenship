<?php

class FileUpload {

    private $allowed = ['jpg','jpeg','png','pdf'];

    private $maxSize = 2097152;

    public function upload($file) {

        if ($file['error'] != 0) {

            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $this->allowed)) {

            throw new Exception("Only JPG, PNG, PDF allowed");
        }

        if ($file['size'] > $this->maxSize) {

            throw new Exception("File size must be less than 2MB");
        }

        $newName = uniqid("request_", true) . "." . $ext;

        $path = "../uploads/" . $newName;

        if (move_uploaded_file($file['tmp_name'], $path)) {

            return "uploads/" . $newName;
        }

        throw new Exception("File upload failed");
    }
}

?>