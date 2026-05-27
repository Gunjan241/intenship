<?php

include '../../includes/auth.php';
include '../../includes/db.php';

$search = "";

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $stmt = $conn->prepare("SELECT * FROM employees
                            WHERE fullname LIKE ?");

    $searchTerm = "%$search%";

    $stmt->bind_param("s",$searchTerm);

    $stmt->execute();

    $result = $stmt->get_result();

}else{

    $result = $conn->query("SELECT * FROM employees");

}

include '../../includes/header.php';

?>

<style>

body{
    background:#f4f6f9;
}

.page-wrapper{
    padding:30px;
}

.employee-title{
    font-size:40px;
    font-weight:bold;
}

.table img{
    border-radius:50%;
    object-fit:cover;
}

.card{
    border:none;
    border-radius:15px;
}

.table{
    margin-bottom:0;
}

.action-buttons a{
    margin-right:5px;
    margin-bottom:5px;
}

</style>

<div class="container-fluid page-wrapper">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="employee-title">
All Employees
</h2>

<a href="create.php" class="btn btn-primary px-4">
Add Employee
</a>

</div>

<form method="GET" class="mb-4">

<div class="row g-2">

<div class="col-md-10">

<input type="text"
name="search"
class="form-control"
placeholder="Search Employee Name..."
value="<?= $search ?>">

</div>

<div class="col-md-2">

<button class="btn btn-dark w-100">
Search
</button>

</div>

</div>

</form>

<div class="card shadow">

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover align-middle">

<tr class="table-dark">

<th>ID</th>
<th>Photo</th>
<th>Employee ID</th>
<th>Full Name</th>
<th>Email</th>
<th>Department</th>
<th>Designation</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?= $row['id']; ?></td>

<td>

<img src="../../uploads/profiles/<?= $row['profile_photo']; ?>"
width="60"
height="60">

</td>

<td><?= $row['employee_id']; ?></td>

<td><?= $row['fullname']; ?></td>

<td><?= $row['email']; ?></td>

<td><?= $row['department']; ?></td>

<td><?= $row['designation']; ?></td>

<td>

<?php if($row['status']=="Active"){ ?>

<span class="badge bg-success">
Active
</span>

<?php }else{ ?>

<span class="badge bg-danger">
Inactive
</span>

<?php } ?>

</td>

<td class="action-buttons">

<a href="profile.php?id=<?= $row['id']; ?>"
class="btn btn-primary btn-sm">
Profile
</a>

<a href="edit.php?id=<?= $row['id']; ?>"
class="btn btn-success btn-sm">
Edit
</a>

<a href="delete.php?id=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</div>

<?php include '../../includes/footer.php'; ?>