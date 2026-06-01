<?php

require_once "../classes/Middleware.php";
require_once "../classes/ServiceRequest.php";
require_once "../classes/FileUpload.php";

Middleware::requireRole("user");

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    try {

        $upload = new FileUpload();

        $filePath = null;

        if (!empty($_FILES['file']['name'])) {

            $filePath = $upload->upload($_FILES['file']);
        }

        $service = new ServiceRequest();

        $data = [

            "user_id" => $_SESSION['user_id'],
            "title" => $_POST['title'],
            "category" => $_POST['category'],
            "description" => $_POST['description'],
            "priority" => $_POST['priority'],
            "file_path" => $filePath
        ];

        if ($service->create($data)) {

            $message = "Request Created Successfully";
        }

    } catch (Exception $e) {

        $message = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Create Request</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">

            <h3>Create Service Request</h3>

        </div>

        <div class="card-body">

            <?php if($message != "") { ?>

                <div class="alert alert-info">

                    <?php echo $message; ?>

                </div>

            <?php } ?>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">

                    <label>Title</label>

                    <input type="text" name="title" class="form-control" required>

                </div>

                <div class="mb-3">

                    <label>Category</label>

                    <select name="category" class="form-control">

                        <option>Technical</option>
                        <option>Payment</option>
                        <option>Maintenance</option>
                        <option>Other</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea name="description" class="form-control"></textarea>

                </div>

                <div class="mb-3">

                    <label>Priority</label>

                    <select name="priority" class="form-control">

                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Upload File</label>

                    <input type="file" name="file" class="form-control">

                </div>

                <button type="submit" class="btn btn-primary">

                    Submit Request

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>