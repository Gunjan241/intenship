<?php

include '../includes/auth.php';
include '../includes/db.php';

$total = $conn->query("SELECT * FROM employees")->num_rows;

$active = $conn->query("SELECT * FROM employees WHERE status='Active'")->num_rows;

$inactive = $conn->query("SELECT * FROM employees WHERE status='Inactive'")->num_rows;

include '../includes/header.php';

?>

<style>

body{
    background:#f4f6f9;
}

.dashboard-title{
    font-size:50px;
    font-weight:bold;
    margin-bottom:30px;
}

.card-box{
    border-radius:15px;
    padding:30px;
    color:white;
    box-shadow:0px 4px 15px rgba(0,0,0,0.1);
}

.card-box h2{
    font-size:40px;
    margin-top:10px;
}

.card1{
    background:#0d6efd;
}

.card2{
    background:#198754;
}

.card3{
    background:#dc3545;
}

.action-btns{
    margin-top:40px;
}

.action-btns a{
    padding:12px 25px;
    font-size:18px;
    border-radius:10px;
    margin-right:10px;
    margin-bottom:10px;
}

</style>

<div class="container-fluid mt-4">

<h1 class="dashboard-title">
Welcome <?= $_SESSION['user']; ?>
</h1>

<div class="row g-4">

<div class="col-md-4">

<div class="card-box card1">

<h4>Total Employees</h4>

<h2><?= $total ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box card2">

<h4>Active Employees</h4>

<h2><?= $active ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box card3">

<h4>Inactive Employees</h4>

<h2><?= $inactive ?></h2>

</div>

</div>

</div>

<div class="action-btns">

<a href="employees/create.php" class="btn btn-primary">
Add Employee
</a>

<a href="employees/view.php" class="btn btn-dark">
View Employees
</a>

<a href="employees/documents.php" class="btn btn-success">
Upload Documents
</a>

<a href="employees/view_documents.php" class="btn btn-warning">
View Documents
</a>

</div>

</div>

<?php include '../includes/footer.php'; ?>