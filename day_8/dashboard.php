<?php

include 'auth.php';

?>

<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="#">
            My App
        </a>

        <div>

            <span class="text-white me-3">

                Welcome,
                <?php echo $_SESSION['full_name']; ?>

            </span>

            <a href="profile.php" class="btn btn-outline-light btn-sm">
                Profile
            </a>

            <a href="logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container dashboard-container">

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card dashboard-card">

                <div class="card-body">

                    <h5>Total Students</h5>

                    <h1>120</h1>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card dashboard-card">

                <div class="card-body">

                    <h5>Total Courses</h5>

                    <h1>8</h1>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card dashboard-card">

                <div class="card-body">

                    <h5>Total Teachers</h5>

                    <h1>15</h1>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>