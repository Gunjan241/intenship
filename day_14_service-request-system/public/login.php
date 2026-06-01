<?php

require_once "../classes/Auth.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $auth = new Auth();

    $result = $auth->login(
        $_POST['email'],
        $_POST['password']
    );

    if ($result['success']) {

        if ($result['role'] == "admin") {

            header("Location: ../admin/dashboard.php");

        } else {

            header("Location: ../user/dashboard.php");
        }

        exit();
    }

    $message = $result['message'];
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

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">

                    <h3>User Login</h3>

                </div>

                <div class="card-body">

                    <?php if($message != "") { ?>

                        <div class="alert alert-danger">

                            <?php echo $message; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label>Email</label>

                            <input type="email" name="email" class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input type="password" name="password" class="form-control">

                        </div>

                        <button type="submit" class="btn btn-success w-100">

                            Login

                        </button>

                    </form>

                    <div class="mt-3 text-center">

                        <a href="register.php">Create New Account</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>