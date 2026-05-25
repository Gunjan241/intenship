<?php

session_start();

include '../includes/config.php';

$error = '';

if(isset($_POST['login'])){

    $username = $_POST['username'];

    $password = $_POST['password'];

    $query = "SELECT * FROM users
              WHERE username='$username'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify(
            $password,
            $user['password']
        )){

            $_SESSION['user_id'] = $user['id'];

            $_SESSION['username'] = $user['username'];

            $_SESSION['is_logged_in'] = true;

            header(
                "Location: ../dashboard/dashboard.php"
            );

            exit();

        } else {

            $error = "Invalid Password";
        }

    } else {

        $error = "Invalid Username";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body class="login-body">

<div class="form-box">

<h2>Login System</h2>

<p class="error">

<?php echo $error; ?>

</p>

<form method="POST">

<input
type="email"
name="username"
placeholder="Email"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">
Login
</button>

<a href="signup.php">
Create Account
</a>

</form>

</div>

</body>
</html>