<?php

require_once "../classes/Middleware.php";
require_once "../classes/ServiceRequest.php";

Middleware::requireRole("admin");

$service = new ServiceRequest();

if (isset($_GET['id']) && isset($_GET['status'])) {

    $service->updateStatus($_GET['id'], $_GET['status']);
}

$requests = $service->getAll();

?>

<!DOCTYPE html>
<html>
<head>

    <title>All Requests</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">

            <h3>All Requests</h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th>ID</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Action</th>

                </tr>

                <?php while($row = $requests->fetch_assoc()) { ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['name']; ?></td>

                    <td><?php echo $row['title']; ?></td>

                    <td><?php echo $row['status']; ?></td>

                    <td><?php echo $row['priority']; ?></td>

                    <td>

                        <a href="?id=<?php echo $row['id']; ?>&status=Approved" class="btn btn-success btn-sm">

                            Approve

                        </a>

                        <a href="?id=<?php echo $row['id']; ?>&status=Rejected" class="btn btn-danger btn-sm">

                            Reject

                        </a>

                        <a href="?id=<?php echo $row['id']; ?>&status=Completed" class="btn btn-primary btn-sm">

                            Complete

                        </a>

                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>