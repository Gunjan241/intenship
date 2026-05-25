<?php

include '../includes/config.php';

$id = $_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM students WHERE id='$id'"
);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['name'];

    $age = $_POST['age'];

    $city = $_POST['city'];

    $branch = $_POST['branch'];

    mysqli_query(
        $conn,

        "UPDATE students SET

        name='$name',
        age='$age',
        city='$city',
        branch='$branch'

        WHERE id='$id'"
    );

    header("Location: student_list.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Student</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="form-box large">

<h2>Edit Student</h2>

<form method="POST">

<input
type="text"
name="name"
value="<?php echo $row['name']; ?>">

<input
type="number"
name="age"
value="<?php echo $row['age']; ?>">

<input
type="text"
name="city"
value="<?php echo $row['city']; ?>">

<input
type="text"
name="branch"
value="<?php echo $row['branch']; ?>">

<button
type="submit"
name="update">

Update Student

</button>

</form>

</div>

</body>
</html>