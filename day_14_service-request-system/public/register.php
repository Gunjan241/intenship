<?php

require_once "../classes/Auth.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $auth = new Auth();

    $result = $auth->register(
        $_POST['name'],
        $_POST['email'],
        $_POST['password']
    );

    $message = $result['message'];
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

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">

                    <h3>User Registration</h3>

                </div>

                <div class="card-body">

                    <?php if($message != "") { ?>

                        <div class="alert alert-info">

                            <?php echo $message; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label>Name</label>

                            <input type="text" name="name" class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input type="email" name="email" class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input type="password" name="password" class="form-control">

                        </div>

                        <button type="submit" class="btn btn-primary w-100">

                            Register

                        </button>

                    </form>

                    <div class="mt-3 text-center">

                        <a href="login.php">Already have account?</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>