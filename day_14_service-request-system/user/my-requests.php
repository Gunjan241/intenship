<?php

require_once "../classes/Middleware.php";
require_once "../classes/ServiceRequest.php";

Middleware::requireRole("user");

$service = new ServiceRequest();

$requests = $service->getByUser($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html>
<head>

    <title>My Requests</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{

            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height:100vh;
            padding:40px 0;
            font-family:Arial, Helvetica, sans-serif;
        }

        .main-card{

            background:#ffffff;
            border:none;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0px 10px 40px rgba(0,0,0,0.4);
        }

        .card-header-custom{

            background: linear-gradient(135deg, #ff6b6b, #7c3aed, #2563eb);
            padding:35px;
        }

        .card-header-custom h3{

            color:white;
            font-size:48px;
            font-weight:bold;
            margin:0;
            letter-spacing:1px;
        }

        .table{

            margin-top:15px;
        }

        .table thead th{

            background: linear-gradient(135deg, #7c3aed, #2563eb) !important;
            color:#ffffff !important;
            padding:22px;
            font-size:20px;
            font-weight:700;
            text-align:center;
            border:1px solid rgba(255,255,255,0.2);
            letter-spacing:0.5px;
        }

        .table tbody td{

            padding:22px;
            vertical-align:middle;
            font-size:18px;
            color:#111827 !important;
            font-weight:600;
            text-align:center;
            border:1px solid #d1d5db;
            background:white;
        }

        .table tbody tr:hover{

            background:#f3f4f6;
            transition:0.3s;
        }

        .status-pending{

            background:#facc15;
            color:black;
            padding:10px 18px;
            border-radius:14px;
            font-weight:bold;
            font-size:16px;
        }

        .status-approved{

            background:#22c55e;
            color:white;
            padding:10px 18px;
            border-radius:14px;
            font-weight:bold;
            font-size:16px;
        }

        .status-rejected{

            background:#ef4444;
            color:white;
            padding:10px 18px;
            border-radius:14px;
            font-weight:bold;
            font-size:16px;
        }

        .status-completed{

            background:#3b82f6;
            color:white;
            padding:10px 18px;
            border-radius:14px;
            font-weight:bold;
            font-size:16px;
        }

        .status-progress{

            background:#8b5cf6;
            color:white;
            padding:10px 18px;
            border-radius:14px;
            font-weight:bold;
            font-size:16px;
        }

        .custom-btn{

            padding:12px 24px;
            border:none;
            border-radius:14px;
            font-weight:bold;
            transition:0.3s;
            margin-right:10px;
            font-size:16px;
            color:white;
        }

        .custom-btn:hover{

            transform:translateY(-3px) scale(1.03);
            color:white;
        }

        .btn-view{

            background:linear-gradient(135deg, #00c6ff, #0072ff);
        }

        .btn-view:hover{

            background:linear-gradient(135deg, #0096c7, #005bea);
        }

        .btn-edit{

            background:linear-gradient(135deg, #f59e0b, #ff6b00);
        }

        .btn-edit:hover{

            background:linear-gradient(135deg, #d97706, #ea580c);
        }

        .btn-delete{

            background:linear-gradient(135deg, #ff416c, #ff4b2b);
        }

        .btn-delete:hover{

            background:linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .btn-back{

            background:linear-gradient(135deg, #4facfe, #00f2fe);
            color:white;
            padding:16px 35px;
            border:none;
            border-radius:16px;
            font-size:18px;
            font-weight:bold;
            margin-top:25px;
            transition:0.3s;
            text-decoration:none;
            display:inline-block;
        }

        .btn-back:hover{

            background:linear-gradient(135deg, #2563eb, #06b6d4);
            color:white;
            transform:translateY(-3px);
        }

        .locked-badge{

            background:#6b7280;
            padding:10px 16px;
            border-radius:14px;
            font-weight:bold;
            color:white;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card main-card">

        <div class="card-header-custom">

            <h3>

                My Service Requests

            </h3>

        </div>

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while($row = $requests->fetch_assoc()) { ?>

                        <tr>

                            <td><?php echo $row['id']; ?></td>

                            <td><?php echo $row['title']; ?></td>

                            <td><?php echo $row['category']; ?></td>

                            <td><?php echo $row['priority']; ?></td>

                            <td>

                                <?php

                                if($row['status']=="Pending"){

                                    echo "<span class='status-pending'>Pending</span>";

                                }elseif($row['status']=="Approved"){

                                    echo "<span class='status-approved'>Approved</span>";

                                }elseif($row['status']=="Rejected"){

                                    echo "<span class='status-rejected'>Rejected</span>";

                                }elseif($row['status']=="Completed"){

                                    echo "<span class='status-completed'>Completed</span>";

                                }else{

                                    echo "<span class='status-progress'>In Progress</span>";
                                }

                                ?>

                            </td>

                            <td>

                                <?php if($row['file_path']) { ?>

                                    <a
                                        href="../<?php echo $row['file_path']; ?>"
                                        target="_blank"
                                        class="btn custom-btn btn-view"
                                    >

                                        View File

                                    </a>

                                <?php } else { ?>

                                    <span class="text-muted">

                                        No File

                                    </span>

                                <?php } ?>

                            </td>

                            <td>

                                <?php if($row['status']=="Pending") { ?>

                                    <a
                                        href="edit-request.php?id=<?php echo $row['id']; ?>"
                                        class="btn custom-btn btn-edit"
                                    >

                                        Edit

                                    </a>

                                    <a
                                        href="delete-request.php?id=<?php echo $row['id']; ?>"
                                        class="btn custom-btn btn-delete"
                                        onclick="return confirm('Delete this request?')"
                                    >

                                        Delete

                                    </a>

                                <?php } else { ?>

                                    <span class="locked-badge">

                                        Locked

                                    </span>

                                <?php } ?>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

            <a href="dashboard.php" class="btn-back">

                Back Dashboard

            </a>

        </div>

    </div>

</div>

</body>
</html>