<?php
session_start();

$error = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "admin123")
    {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#667eea,#764ba2);
}

.login-container{
    width:400px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border-radius:20px;
    padding:40px;
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    color:#fff;
}

.login-container h1{
    text-align:center;
    margin-bottom:10px;
    font-size:32px;
}

.login-container p{
    text-align:center;
    margin-bottom:30px;
    color:#e0e0e0;
}

.input-group{
    margin-bottom:20px;
}

.input-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.input-group input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    outline:none;
    font-size:15px;
}

.btn{
    width:100%;
    padding:12px;
    background:#00c6ff;
    background:linear-gradient(to right,#00c6ff,#0072ff);
    border:none;
    border-radius:10px;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    transform:translateY(-2px);
}

.error{
    background:#ff4d4d;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    text-align:center;
}

.footer{
    text-align:center;
    margin-top:20px;
    color:#ddd;
    font-size:14px;
}

</style>
</head>

<body>

<div class="login-container">

    <h1>🔐 Admin Login</h1>
    <p>Product Management System</p>

    <?php if($error!=""){ ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn">
            Login
        </button>

    </form>

    <div class="footer">
        © <?php echo date("Y"); ?> Product Management System
    </div>

</div>

</body>
</html>