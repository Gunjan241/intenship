<?php

include '../includes/auth.php';

include '../includes/config.php';

/* ASCENDING ORDER */
$result = mysqli_query(
    $conn,
    "SELECT * FROM students ORDER BY id ASC"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Students</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<h1 class="title">
User Management System
</h1>

<div class="top-btn">

<a href="add_student.php">
Add Student
</a>

</div>

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>Age</th>
<th>City</th>
<th>Branch</th>
<th>Profile</th>
<th>Resume</th>
<th>Action</th>

</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['age']; ?>
</td>

<td>
<?php echo $row['city']; ?>
</td>

<td>
<?php echo $row['branch']; ?>
</td>

<td>

<img
class="profile-img"
src="../assets/uploads/profile/<?php echo $row['profile_photo']; ?>">

</td>

<td>

<a
target="_blank"
href="../assets/uploads/resume/<?php echo $row['resume']; ?>">

View Resume

</a>

</td>

<td>

<a
class="edit-btn"
href="edit_student.php?id=<?php echo $row['id']; ?>">

Edit

</a>

<a
class="delete-btn"
href="delete_student.php?id=<?php echo $row['id']; ?>">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>