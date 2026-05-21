<?php

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include 'db.php';

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // SELECT QUERY
    $sql = "SELECT * FROM insta WHERE username='$username'";

    $result = mysqli_query($conn, $sql);

    // QUERY ERROR
    if(!$result){
        die("Query Failed : " . mysqli_error($conn));
    }

    // USER CHECK
    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        // PASSWORD VERIFY
        if(password_verify($password, $row['password'])){

            $_SESSION['user'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "Wrong Password";
        }

    } else {

        $message = "Username Not Found";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="form-body">

<div class="form-box">

    <h2>Login</h2>

    <p class="msg"><?php echo $message; ?></p>

    <form method="POST">

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit" name="login">

            Login

        </button>

    </form>

    <a href="register.php">

        Create New Account

    </a>

</div>

</body>
</html>