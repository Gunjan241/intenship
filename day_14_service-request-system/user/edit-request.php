<?php

require_once "../classes/Middleware.php";
require_once "../classes/ServiceRequest.php";
require_once "../config/Database.php";

Middleware::requireRole("user");

$database = Database::getInstance();
$conn = $database->getConnection();

$id = $_GET['id'];

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM service_requests WHERE id=? AND user_id=?");

$stmt->bind_param("ii", $id, $userId);

$stmt->execute();

$result = $stmt->get_result();

$request = $result->fetch_assoc();

if (!$request) {

    die("Request Not Found");
}

if ($request['status'] != "Pending") {

    die("Only Pending Requests Can Be Edited");
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];

    $update = $conn->prepare("UPDATE service_requests SET title=?, category=?, description=?, priority=? WHERE id=? AND user_id=?");

    $update->bind_param(
        "ssssii",
        $title,
        $category,
        $description,
        $priority,
        $id,
        $userId
    );

    if ($update->execute()) {

        $message = "Request Updated Successfully";

        header("Refresh:1; url=my-requests.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Request</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">

            <h3>Edit Request</h3>

        </div>

        <div class="card-body">

            <?php if($message != "") { ?>

                <div class="alert alert-success">

                    <?php echo $message; ?>

                </div>

            <?php } ?>

            <form method="POST">

                <div class="mb-3">

                    <label>Title</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?php echo $request['title']; ?>"
                    >

                </div>

                <div class="mb-3">

                    <label>Category</label>

                    <input
                        type="text"
                        name="category"
                        class="form-control"
                        value="<?php echo $request['category']; ?>"
                    >

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                    ><?php echo $request['description']; ?></textarea>

                </div>

                <div class="mb-3">

                    <label>Priority</label>

                    <select name="priority" class="form-control">

                        <option <?php if($request['priority']=="Low") echo "selected"; ?>>

                            Low

                        </option>

                        <option <?php if($request['priority']=="Medium") echo "selected"; ?>>

                            Medium

                        </option>

                        <option <?php if($request['priority']=="High") echo "selected"; ?>>

                            High

                        </option>

                    </select>

                </div>

                <button type="submit" class="btn btn-primary">

                    Update Request

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>