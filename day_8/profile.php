<?php

include 'auth.php';

?>

<!DOCTYPE html>
<html>
<head>

    <title>Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card profile-card">

        <div class="card-header">

            <h3>User Profile</h3>

        </div>

        <div class="card-body">

            <p>
                <b>User ID:</b>
                <?php echo $_SESSION['user_id']; ?>
            </p>

            <p>
                <b>Username:</b>
                <?php echo $_SESSION['username']; ?>
            </p>

            <p>
                <b>Full Name:</b>
                <?php echo $_SESSION['full_name']; ?>
            </p>

            <p>
                <b>Role:</b>
                <?php echo $_SESSION['role']; ?>
            </p>

            <a href="dashboard.php" class="btn btn-primary">
                Back
            </a>

            <a href="logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>

</div>

</body>
</html>