<?php

include '../../includes/auth.php';
include '../../includes/db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM employees WHERE id=$id");

$row = $result->fetch_assoc();

if(isset($_POST['update'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    $stmt = $conn->prepare("UPDATE employees
                            SET fullname=?, email=?, department=?
                            WHERE id=?");

    $stmt->bind_param("sssi",
        $fullname,
        $email,
        $department,
        $id
    );

    $stmt->execute();

    header("Location:view.php");
}

include '../../includes/header.php';

?>

<div class="card p-4 shadow">

<h2>Edit Employee</h2>

<form method="POST">

<div class="mb-3">

<label>Full Name</label>

<input type="text"
name="fullname"
class="form-control"
value="<?= $row['fullname']; ?>">

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="<?= $row['email']; ?>">

</div>

<div class="mb-3">

<label>Department</label>

<input type="text"
name="department"
class="form-control"
value="<?= $row['department']; ?>">

</div>

<button class="btn btn-success" name="update">
Update Employee
</button>

</form>

</div>

<?php include '../../includes/footer.php'; ?>