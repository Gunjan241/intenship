<?php

include '../../includes/auth.php';
include '../../includes/db.php';

// CHECK ID

if(!isset($_GET['id'])){

    die("Employee ID Missing");

}

$id = intval($_GET['id']);

// FETCH EMPLOYEE

$stmt = $conn->prepare("SELECT * FROM employees WHERE id=?");

$stmt->bind_param("i",$id);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){

    die("Employee Not Found");

}

$row = $result->fetch_assoc();

include '../../includes/header.php';

?>

<style>

body{
    background:#f4f6f9;
}

.profile-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
}

.profile-header{
    background:#0d6efd;
    padding:40px;
    text-align:center;
    color:white;
}

.profile-header img{
    width:150px;
    height:150px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid white;
    background:white;
}

.profile-body{
    padding:40px;
}

.info-box{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
}

.info-box h5{
    color:#666;
    margin-bottom:10px;
}

.info-box p{
    font-size:20px;
    font-weight:bold;
    margin:0;
}

</style>

<div class="container mt-5">

<div class="card shadow profile-card">

<div class="profile-header">

<img src="../../uploads/profiles/<?= $row['profile_photo']; ?>">

<h2 class="mt-3">
<?= $row['fullname']; ?>
</h2>

<p>
<?= $row['designation']; ?>
</p>

</div>

<div class="profile-body">

<div class="row">

<div class="col-md-6">

<div class="info-box">

<h5>Employee ID</h5>

<p><?= $row['employee_id']; ?></p>

</div>

</div>

<div class="col-md-6">

<div class="info-box">

<h5>Email</h5>

<p><?= $row['email']; ?></p>

</div>

</div>

<div class="col-md-6">

<div class="info-box">

<h5>Mobile</h5>

<p><?= $row['mobile']; ?></p>

</div>

</div>

<div class="col-md-6">

<div class="info-box">

<h5>Department</h5>

<p><?= $row['department']; ?></p>

</div>

</div>

<div class="col-md-6">

<div class="info-box">

<h5>Salary</h5>

<p>₹ <?= $row['salary']; ?></p>

</div>

</div>

<div class="col-md-6">

<div class="info-box">

<h5>Joining Date</h5>

<p><?= $row['joining_date']; ?></p>

</div>

</div>

<div class="col-md-6">

<div class="info-box">

<h5>Status</h5>

<p><?= $row['status']; ?></p>

</div>

</div>

</div>

<a href="view.php" class="btn btn-dark">
Back
</a>

</div>

</div>

</div>

<?php include '../../includes/footer.php'; ?>