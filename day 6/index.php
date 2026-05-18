<?php

include 'config.php';


// INSERT DATA

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $std = $_POST['std'];

    $sql = "INSERT INTO student(name, rollno, age, city, std)
            VALUES('$name','$rollno','$age','$city','$std')";

    $result = mysqli_query($conn, $sql);

    if(!$result){
        die("Insert Failed : " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit();
}


// FETCH DATA

$fetch = "SELECT * FROM student";

$result = mysqli_query($conn, $fetch);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Student Management System</title>

    <style>

        body{
            font-family: Arial;
            background: #0f172a;
            padding: 20px;
            color: white;
        }

        h1{
            text-align: center;
            color: #38bdf8;
        }

        .btn{
            background: #22c55e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn:hover{
            background: #16a34a;
        }

        .back-btn{
            background: #64748b;
        }

        .back-btn:hover{
            background: #475569;
        }

        form{
            background: #1e293b;
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
            border: 1px solid #334155;
            border-radius: 5px;
            background: #0f172a;
            color: white;
        }

        input::placeholder{
            color: #94a3b8;
        }

        table{
            width: 95%;
            margin: 30px auto;
            border-collapse: collapse;
            background: #1e293b;
            color: white;
        }

        table, th, td{
            border: 1px solid #334155;
        }

        th{
            background: #2563eb;
            color: white;
        }

        th, td{
            padding: 12px;
            text-align: center;
        }

        tr:nth-child(even){
            background: #0f172a;
        }

        .delete-btn{
            background: #ef4444;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete-btn:hover{
            background: #dc2626;
        }

    </style>

</head>

<body>

<h1>Student Management System</h1>

<?php if(isset($_GET['add'])){ ?>

<form method="POST">

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

    <button type="submit"
            name="submit"
            class="btn">
        Submit
    </button>

    <br><br>

    <a href="index.php" class="btn back-btn">
        Back
    </a>

</form>

<?php } else { ?>

<a href="index.php?add=1" class="btn">
    Add Student
</a>

<table>

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Roll No</th>
        <th>Age</th>
        <th>City</th>
        <th>STD</th>
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