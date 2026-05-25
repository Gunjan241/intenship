<?php

include '../includes/config.php';

$message = '';

if(isset($_POST['signup'])){

    $full_name = $_POST['full_name'];

    $username = $_POST['username'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $check = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE username='$username'"
    );

    if(mysqli_num_rows($check) > 0){

        $message = "Username Already Exists";

    } else {

        $query = "INSERT INTO users(
                    full_name,
                    username,
                    password,
                    role
                  )

                  VALUES(
                    '$full_name',
                    '$username',
                    '$password',
                    'Admin'
                  )";

        if(mysqli_query($conn, $query)){

            $message = "Signup Successful";

        } else {

            $message = "Signup Failed";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Signup</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body class="login-body">

<div class="form-box">

<h2>Create Account</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input
type="text"
name="full_name"
placeholder="Full Name"
required>

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
name="signup">
Signup
</button>

<a href="login.php">
Already Have Account?
</a>

</form>

</div>

</body>
</html>