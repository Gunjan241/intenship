<?php

include '../includes/auth.php';

include '../includes/config.php';

if(isset($_POST['add'])){

    $name = $_POST['name'];

    $age = $_POST['age'];

    $city = $_POST['city'];

    $branch = $_POST['branch'];

    $profile = $_FILES['profile']['name'];

    $resume = $_FILES['resume']['name'];

    $tmp_profile = $_FILES['profile']['tmp_name'];

    $tmp_resume = $_FILES['resume']['tmp_name'];

    move_uploaded_file(
        $tmp_profile,
        "../assets/uploads/profile/$profile"
    );

    move_uploaded_file(
        $tmp_resume,
        "../assets/uploads/resume/$resume"
    );

    $query = "INSERT INTO students(
                name,
                age,
                city,
                branch,
                profile_photo,
                resume
              )

              VALUES(
                '$name',
                '$age',
                '$city',
                '$branch',
                '$profile',
                '$resume'
              )";

    mysqli_query($conn, $query);

    header("Location: student_list.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Add Student</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="add-student-page">

<div class="form-box large">

<h2>Add Student</h2>

<form
method="POST"
enctype="multipart/form-data">

<input
type="text"
name="name"
placeholder="Student Name"
required>

<input
type="number"
name="age"
placeholder="Age"
required>

<input
type="text"
name="city"
placeholder="City"
required>

<input
type="text"
name="branch"
placeholder="Branch"
required>

<label>Profile Photo</label>

<input
type="file"
name="profile"
required>

<label>Resume PDF</label>

<input
type="file"
name="resume"
required>

<button
type="submit"
name="add">

Add Student

</button>

</form>

</div>

</div>

</body>
</html>