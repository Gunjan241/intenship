<?php

session_start();
include 'config.php';

$error = '';

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['is_logged_in'] = true;

        if(isset($_POST['remember'])){

            setcookie(
                'remember_username',
                $username,
                time() + (86400 * 7)
            );

        }

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid Login";

    }

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Login System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">

</head>

<body class="login-body">

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-lg border-0 login-card">

                <div class="card-header text-center bg-primary text-white">

                    <h2>Login System</h2>

                </div>

                <div class="card-body">

                    <?php if($error != ''): ?>

                        <div class="alert alert-danger">

                            <?php echo $error; ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">Username</label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3 form-check">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="remember"
                            >

                            <label class="form-check-label">
                                Remember Me
                            </label>

                        </div>

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>