// index.php

<?php

include 'config.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $std = $_POST['std'];

    $filename = $_FILES['file']['name'];

    $tempname = $_FILES['file']['tmp_name'];

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'doc'];

    if(!in_array($extension, $allowed)){
        die("Only JPG, JPEG and DOC files allowed");
    }

    $newfilename = time() . "_" . $filename;

    move_uploaded_file($tempname, "uploads/" . $newfilename);

    $sql = "INSERT INTO student(
            name,
            rollno,
            age,
            city,
            std,
            file
            )

            VALUES(
            '$name',
            '$rollno',
            '$age',
            '$city',
            '$std',
            '$newfilename'
            )";

    $insert = mysqli_query($conn, $sql);

    if(!$insert){
        die("Insert Failed : " . mysqli_error($conn));
    }

    header("Location: index.php");

    exit();
}

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $fetch = "SELECT * FROM student
              WHERE name LIKE '%$search%'";

}else{

    $fetch = "SELECT * FROM student";
}

$result = mysqli_query($conn, $fetch);

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Management System</title>

<style>

body{
    font-family: Arial;
    background: linear-gradient(135deg, #1f1c2c, #928dab);
    padding: 20px;
    color: white;
    margin: 0;
}

h1{
    text-align: center;
}

.btn{
    background: #ff6a00;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

form{
    width: 400px;
    margin: 20px auto;
}

input{
    width: 100%;
    padding: 12px;
    margin-top: 12px;
    box-sizing: border-box;
}

table{
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
    background: rgba(255,255,255,0.08);
}

th, td{
    padding: 14px;
    text-align: center;
}

.edit-btn{
    background: green;
    color: white;
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 5px;
}

.delete-btn{
    background: red;
    color: white;
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 5px;
}

</style>

</head>

<body>

<h1>Student Management System</h1>

<?php if(isset($_GET['add'])){ ?>

<form method="POST" enctype="multipart/form-data">

    <input type="text"
           name="name"
           placeholder="Enter Name"
           required>

    <input type="number"
           name="rollno"
           placeholder="Enter Roll Number"
           required>

    <input type="number"
           name="age"
           placeholder="Enter Age"
           required>

    <input type="text"
           name="city"
           placeholder="Enter City"
           required>

    <input type="text"
           name="std"
           placeholder="Enter Standard"
           required>

    <input type="file"
           name="file"
           accept=".jpg,.jpeg,.doc"
           required>

    <button class="btn" type="submit" name="submit">
        Save Student
    </button>

    <br><br>

    <a href="index.php" class="btn">
        Back
    </a>

</form>

<?php } else { ?>

<a href="index.php?add=1" class="btn">
    Add Student
</a>

<form method="GET">

    <input type="text"
           name="search"
           placeholder="Search Student">

    <button class="btn" type="submit">
        Search
    </button>

</form>

<table border="1">

<tr>

    <th>ID</th>
    <th>Name</th>
    <th>Roll No</th>
    <th>Age</th>
    <th>City</th>
    <th>STD</th>
    <th>File</th>
    <th>Action</th>

</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

    <td><?php echo $row['id']; ?></td>

    <td><?php echo $row['name']; ?></td>

    <td><?php echo $row['rollno']; ?></td>

    <td><?php echo $row['age']; ?></td>

    <td><?php echo $row['city']; ?></td>

    <td><?php echo $row['std']; ?></td>

    <td>

    <?php

    if($row['file'] != ""){

    ?>

    <a class="edit-btn"
       href="uploads/<?php echo $row['file']; ?>"
       target="_blank">

       View File

    </a>

    <?php

    }else{

        echo "No File";
    }

    ?>

    </td>

    <td>

        <a class="edit-btn"
           href="edit.php?id=<?php echo $row['id']; ?>">
           Edit
        </a>

        <a class="delete-btn"
           href="delete.php?id=<?php echo $row['id']; ?>">
           Delete
        </a>

    </td>

</tr>

<?php } ?>

</table>

<?php } ?>

</body>
</html>