<?php

require_once "../classes/Middleware.php";
require_once "../config/Database.php";

Middleware::requireRole("admin");

$database = Database::getInstance();

$conn = $database->getConnection();

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>

    <title>Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">

            <h3>Registered Users</h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>

                </tr>

                <?php while($row = $users->fetch_assoc()) { ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['name']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td><?php echo $row['role']; ?></td>

                    <td><?php echo $row['created_at']; ?></td>

                </tr>

                <?php } ?>

            </table>

            <a href="dashboard.php" class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>

</body>
</html>