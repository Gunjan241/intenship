<?php

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");

if(!isset($_SESSION['user'])){

    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>
<script>

history.pushState(null, null, location.href);

window.onpopstate = function () {

    history.go(1);

};

</script>

<body class="dashboard-body">

<div class="dashboard-box">

    <h1>

        Welcome,
        <?php echo $_SESSION['user']; ?>

    </h1>

    <div class="info">

        <p>

            <strong>Role :</strong>

            <?php echo $_SESSION['role']; ?>

        </p>

        <p>

            <strong>Status :</strong>

            Active ✅

        </p>

    </div>

    <a href="logout.php"
       class="logout-btn">

        Logout

    </a>

</div>

</body>
</html>