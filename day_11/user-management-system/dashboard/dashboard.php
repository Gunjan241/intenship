<?php

include '../includes/auth.php';

include '../includes/config.php';

$total = mysqli_query(
    $conn,
    "SELECT * FROM students"
);

$count = mysqli_num_rows($total);

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="navbar">

<h2>User Management System</h2>

<a href="../auth/logout.php">
Logout
</a>

</div>

<div class="dashboard-card">

<h3>Total Students</h3>

<h1><?php echo $count; ?></h1>

</div>

<div class="action-btns">

<a href="../student/add_student.php">
Add Student
</a>

<a href="../student/student_list.php">
View Students
</a>

</div>

</body>
</html>