<?php

session_start();

include 'includes/db.php';

$message = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");

    $stmt->bind_param("s",$email);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            $_SESSION['user'] = $user['name'];

            header("Location: admin/dashboard.php");
            exit();

        }else{

            $message = "Wrong Password";

        }

    }else{

        $message = "Email Not Found";

    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow mx-auto" style="max-width:500px;">

<h2 class="mb-4 text-center">Login</h2>

<?php if($message!=""){ ?>

<div class="alert alert-danger">
<?= $message ?>
</div>

<?php } ?>

<form method="POST">

<input type="email"
name="email"
class="form-control mb-3"
placeholder="Enter Email"
required>

<input type="password"
name="password"
class="form-control mb-3"
placeholder="Enter Password"
required>

<button class="btn btn-success w-100" name="login">
Login
</button>

</form>

<div class="text-center mt-3">

<a href="register.php">
Create Account
</a>

</div>

</div>

</div>

</body>
</html>