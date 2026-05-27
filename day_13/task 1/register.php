<?php

include 'includes/db.php';

$message = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(name,email,password)
                            VALUES(?,?,?)");

    $stmt->bind_param("sss",$name,$email,$password);

    if($stmt->execute()){

        $message = "Registration Successful";

    }else{

        $message = "Registration Failed";

    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow mx-auto" style="max-width:500px;">

<h2 class="mb-4 text-center">Register</h2>

<?php if($message!=""){ ?>

<div class="alert alert-info">
<?= $message ?>
</div>

<?php } ?>

<form method="POST">

<input type="text"
name="name"
class="form-control mb-3"
placeholder="Enter Name"
required>

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

<button class="btn btn-primary w-100" name="register">
Register
</button>

</form>

<div class="text-center mt-3">

<a href="login.php">
Already Have Account?
</a>

</div>

</div>

</div>

</body>
</html>