<?php

require_once "../classes/Middleware.php";

Middleware::requireRole("user");

?>

<!DOCTYPE html>
<html>
<head>

    <title>User Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{

            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:Arial, Helvetica, sans-serif;
        }

        .dashboard-card{

            width:100%;
            max-width:1100px;
            border:none;
            border-radius:25px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            box-shadow: 0px 10px 40px rgba(0,0,0,0.4);
            overflow:hidden;
        }

        .dashboard-body{

            padding:70px 50px;
            text-align:center;
        }

        .welcome-text{

            font-size:60px;
            font-weight:bold;
            color:#ffffff;
            margin-bottom:15px;
        }

        .system-text{

            color:#cbd5e1;
            font-size:22px;
            margin-bottom:40px;
        }

        .divider{

            height:2px;
            background:rgba(255,255,255,0.2);
            margin-bottom:50px;
            border:none;
        }

        .custom-btn{

            padding:18px 40px;
            font-size:20px;
            border-radius:15px;
            margin:20px;
            font-weight:bold;
            border:none;
            transition:0.3s;
            min-width:230px;
            letter-spacing:0.5px;
        }

        .custom-btn:hover{

            transform:translateY(-5px) scale(1.03);
        }

        .btn-create{

            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            color:white;
            box-shadow:0px 8px 20px rgba(139,92,246,0.4);
        }

        .btn-create:hover{

            background: linear-gradient(135deg, #7c3aed, #5b21b6);
            color:white;
        }

        .btn-requests{

            background: linear-gradient(135deg, #10b981, #047857);
            color:white;
            box-shadow:0px 8px 20px rgba(16,185,129,0.4);
        }

        .btn-requests:hover{

            background: linear-gradient(135deg, #059669, #065f46);
            color:white;
        }

        .btn-logout{

            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color:white;
            box-shadow:0px 8px 20px rgba(239,68,68,0.4);
        }

        .btn-logout:hover{

            background: linear-gradient(135deg, #dc2626, #991b1b);
            color:white;
        }

        @media(max-width:768px){

            .welcome-text{

                font-size:38px;
            }

            .custom-btn{

                width:100%;
                margin:12px 0;
            }

            .dashboard-body{

                padding:40px 25px;
            }
        }

    </style>

</head>

<body>

<div class="dashboard-card">

    <div class="dashboard-body">

        <h1 class="welcome-text">

            Welcome,
            <?php echo $_SESSION['name']; ?>

        </h1>

        <p class="system-text">

            Smart Service Request Management System

        </p>

        <hr class="divider">

        <a href="create-request.php" class="btn custom-btn btn-create">

            Create Request

        </a>

        <a href="my-requests.php" class="btn custom-btn btn-requests">

            My Requests

        </a>

        <a href="../public/logout.php" class="btn custom-btn btn-logout">

            Logout

        </a>

    </div>

</div>

</body>
</html>