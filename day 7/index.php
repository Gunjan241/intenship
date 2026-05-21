<?php

include 'config.php';


// INSERT DATA

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $std = $_POST['std'];

    $sql = "INSERT INTO student(
            name,
            rollno,
            age,
            city,
            std
            )

            VALUES(
            '$name',
            '$rollno',
            '$age',
            '$city',
            '$std'
            )";

    $insert = mysqli_query($conn, $sql);

    if(!$insert){
        die("Insert Failed : " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit();
}


// SEARCH + FETCH DATA

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
            color: #ffeaa7;
            font-size: 40px;
            text-shadow: 0 0 15px #fdcb6e;
            margin-bottom: 30px;
        }

        .btn{
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            color: white;
            padding: 12px 22px;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn:hover{
            transform: scale(1.05);
            box-shadow: 0 0 15px #ff6a00;
        }

        .back-btn{
            background: linear-gradient(45deg, #636e72, #2d3436);
        }

        form{
            background: rgba(255,255,255,0.08);
            width: 400px;
            margin: 20px auto;
            padding: 25px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }

        input{
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            box-sizing: border-box;
            border: none;
            border-radius: 8px;
            background: rgba(255,255,255,0.1);
            color: white;
            outline: none;
            font-size: 15px;
        }

        input::placeholder{
            color: #dfe6e9;
        }

        table{
            width: 95%;
            margin: 30px auto;
            border-collapse: collapse;
            background: rgba(255,255,255,0.08);
            border-radius: 15px;
            overflow: hidden;
            backdrop-filter: blur(8px);
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }

        th{
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            color: white;
            padding: 16px;
            font-size: 18px;
        }

        td{
            padding: 14px;
            text-align: center;
            font-size: 16px;
        }

        tr:nth-child(even){
            background: rgba(255,255,255,0.05);
        }

        tr:hover{
            background: rgba(255,255,255,0.15);
            transition: 0.3s;
        }

        .edit-btn{
            background: linear-gradient(45deg, #00b894, #55efc4);
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete-btn{
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .top-buttons{
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .search-form{
            text-align: center;
            margin-top: 20px;
            background: transparent;
            box-shadow: none;
            width: 100%;
        }

        .search-input{
            width: 250px;
        }

        .no-data{
            text-align: center;
            margin-top: 20px;
            color: #ff7675;
            font-size: 20px;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <h1>Student Management System</h1>

    <?php

    if(isset($_GET['add'])){

    ?>

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

        <button class="btn" type="submit" name="submit">
            Save Student
        </button>

        <br><br>

        <a href="index.php" class="btn back-btn">
            Back
        </a>

    </form>

    <?php

    } else {

    ?>

    <div class="top-buttons">

        <a href="index.php?add=1" class="btn">
            Add Student
        </a>

    </div>

    <form class="search-form" method="GET">

        <input class="search-input"
               type="text"
               name="search"
               placeholder="Search Student Name">

        <button class="btn" type="submit">
            Search
        </button>

    </form>

    <?php

    if(mysqli_num_rows($result) > 0){

    ?>

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

        <?php

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['name']; ?></td>

            <td><?php echo $row['rollno']; ?></td>

            <td><?php echo $row['age']; ?></td>

            <td><?php echo $row['city']; ?></td>

            <td><?php echo $row['std']; ?></td>

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

        <?php
        }
        ?>

    </table>

    <?php

    } else {

        echo "<div class='no-data'>No Student Found</div>";
    }

    }
    ?>

</body>
</html>