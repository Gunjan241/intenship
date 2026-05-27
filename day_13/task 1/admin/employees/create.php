<?php

include '../../includes/auth.php';
include '../../includes/db.php';

$message = "";

if(isset($_POST['submit'])){

    $employee_id = $_POST['employee_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];
    $joining_date = $_POST['joining_date'];
    $status = $_POST['status'];

    // PHOTO UPLOAD

    $photo = $_FILES['photo']['name'];

    $tmp = $_FILES['photo']['tmp_name'];

    $newphoto = uniqid() . $photo;

    move_uploaded_file(
        $tmp,
        "../../uploads/profiles/" . $newphoto
    );

    // INSERT QUERY

    $stmt = $conn->prepare("INSERT INTO employees(
        employee_id,
        fullname,
        email,
        mobile,
        department,
        designation,
        salary,
        joining_date,
        status,
        profile_photo
    ) VALUES(?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param(
        "ssssssssss",
        $employee_id,
        $fullname,
        $email,
        $mobile,
        $department,
        $designation,
        $salary,
        $joining_date,
        $status,
        $newphoto
    );

    if($stmt->execute()){

        $message = "Employee Added Successfully";

    }else{

        $message = "Failed To Add Employee";

    }
}

include '../../includes/header.php';

?>

<div class="card shadow p-4">

<h2 class="mb-4">Add Employee</h2>

<?php if($message!=""){ ?>

<div class="alert alert-success">
<?= $message ?>
</div>

<?php } ?>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">

<label>Employee ID</label>

<input type="text"
name="employee_id"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Full Name</label>

<input type="text"
name="fullname"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile</label>

<input type="text"
name="mobile"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Department</label>

<input type="text"
name="department"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Designation</label>

<input type="text"
name="designation"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Salary</label>

<input type="number"
name="salary"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Joining Date</label>

<input type="date"
name="joining_date"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option value="Active">Active</option>

<option value="Inactive">Inactive</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Profile Photo</label>

<input type="file"
name="photo"
class="form-control">

</div>

</div>

<button class="btn btn-primary" name="submit">
Save Employee
</button>

<a href="view.php" class="btn btn-dark">
View Employees
</a>

</form>

</div>

<?php include '../../includes/footer.php'; ?>