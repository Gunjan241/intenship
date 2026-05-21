<?php

include 'config.php';

$id = intval($_GET['id']);

$fetch = "SELECT * FROM student WHERE id = $id";

$result = mysqli_query($conn, $fetch);

if(!$result){
    die("Fetch Failed : " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $std = $_POST['std'];

    $sql = "UPDATE student SET

            name = '$name',
            rollno = '$rollno',
            age = '$age',
            city = '$city',
            std = '$std'

            WHERE id = $id";

    $update = mysqli_query($conn, $sql);

    if(!$update){
        die("Update Failed : " . mysqli_error($conn));
    }

    header("Location: index.php");

    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Student</title>

    <style>

        body{
            font-family: Arial;
            background: linear-gradient(135deg, #1f1c2c, #928dab);
            padding: 20px;
            margin: 0;
            color: white;
        }

        h1{
            text-align: center;
            color: #ffeaa7;
            margin-bottom: 30px;
            text-shadow: 0 0 10px #fdcb6e;
        }

        form{
            background: rgba(255,255,255,0.08);
            width: 400px;
            margin: auto;
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

        button{
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover{
            transform: scale(1.03);
            box-shadow: 0 0 15px #ff6a00;
        }

    </style>

</head>

<body>

    <h1>Edit Student</h1>

    <form method="POST">

        <input type="text"
               name="name"
               value="<?php echo $row['name']; ?>"
               required>

        <input type="number"
               name="rollno"
               value="<?php echo $row['rollno']; ?>"
               required>

        <input type="number"
               name="age"
               value="<?php echo $row['age']; ?>"
               required>

        <input type="text"
               name="city"
               value="<?php echo $row['city']; ?>"
               required>

        <input type="text"
               name="std"
               value="<?php echo $row['std']; ?>"
               required>

        <button type="submit" name="update">
            Update Student
        </button>

    </form>

</body>
</html>