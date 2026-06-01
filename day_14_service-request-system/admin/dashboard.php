<?php

require_once "../classes/Middleware.php";
require_once "../config/Database.php";

Middleware::requireRole("admin");

$database = Database::getInstance();

$conn = $database->getConnection();

$totalUsers = $conn->query("SELECT * FROM users")->num_rows;

$totalRequests = $conn->query("SELECT * FROM service_requests")->num_rows;

$pendingRequests = $conn->query("SELECT * FROM service_requests WHERE status='Pending'")->num_rows;

$completedRequests = $conn->query("SELECT * FROM service_requests WHERE status='Completed'")->num_rows;

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f7fc;
        }

        .dashboard-card{
            border:none;
            border-radius:18px;
            color:white;
            transition:0.3s;
        }

        .dashboard-card:hover{
            transform:translateY(-5px);
        }

        .card-users{
            background:#0d6efd;
        }

        .card-requests{
            background:#198754;
        }

        .card-pending{
            background:#ffc107;
            color:black;
        }

        .card-completed{
            background:#dc3545;
        }

        .custom-btn{

            padding:15px 35px;
            font-size:18px;
            border-radius:12px;
            margin:15px;
            font-weight:bold;
            border:none;
            transition:0.3s;
        }

        .custom-btn:hover{
            transform:scale(1.05);
        }

        .btn-request{
            background:#6f42c1;
            color:white;
        }

        .btn-request:hover{
            background:#59359c;
            color:white;
        }

        .btn-users{
            background:#20c997;
            color:white;
        }

        .btn-users:hover{
            background:#169c78;
            color:white;
        }

        .btn-logout{
            background:#fd7e14;
            color:white;
        }

        .btn-logout:hover{
            background:#d96a0b;
            color:white;
        }

    </style>

</head>

<body>

<div class="container mt-5">

    <div class="text-center mb-5">

        <h1>

            Welcome Admin,
            <?php echo $_SESSION['name']; ?>

        </h1>

        <p class="text-muted">

            Smart Service Request Management System

        </p>

    </div>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-users shadow">

                <div class="card-body text-center">

                    <h5>Total Users</h5>

                    <h1>

                        <?php echo $totalUsers; ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-requests shadow">

                <div class="card-body text-center">

                    <h5>Total Requests</h5>

                    <h1>

                        <?php echo $totalRequests; ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-pending shadow">

                <div class="card-body text-center">

                    <h5>Pending</h5>

                    <h1>

                        <?php echo $pendingRequests; ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card dashboard-card card-completed shadow">

                <div class="card-body text-center">

                    <h5>Completed</h5>

                    <h1>

                        <?php echo $completedRequests; ?>

                    </h1>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-body text-center p-4">

            <a href="requests.php" class="btn custom-btn btn-request">

                View Requests

            </a>

            <a href="users.php" class="btn custom-btn btn-users">

                View Users

            </a>

            <a href="../public/logout.php" class="btn custom-btn btn-logout">

                Logout

            </a>

        </div>

    </div>

</div>

</body>
</html>