<?php

include 'db.php';

$message = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // PASSWORD HASH
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // INSERT QUERY
    $sql = "INSERT INTO insta(name, username, email, password, role)
            VALUES('$name', '$username', '$email', '$hashed_password', '$role')";

    $result = mysqli_query($conn, $sql);

    if($result){

        header("Location: login.php");
        exit();

    } else {

        $message = "Registration Failed : " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Register</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="form-body">

<div class="form-box">

    <h2>Create Account</h2>

    <p class="msg"><?php echo $message; ?></p>

    <form method="POST">

        <input type="text"
               name="name"
               placeholder="Full Name"
               required>

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="email"
               name="email"
               placeholder="Email"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <select name="role" required>

            <option value="">Select Role</option>

            <option value="user">User</option>

            <option value="admin">Admin</option>

        </select>

        <button type="submit" name="register">

            Register

        </button>

    </form>

    <a href="login.php">

        Already have account?

    </a>

</div>

</body>
</html>