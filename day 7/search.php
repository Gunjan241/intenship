<?php

include 'config.php';

$result = null;

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $sql = "SELECT * FROM student
            WHERE student_name LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Search Student</title>

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

        form{
            text-align: center;
            margin-top: 20px;
        }

        input{
            padding: 12px;
            width: 280px;
            border-radius: 10px;
            border: none;
            outline: none;
            background: rgba(255,255,255,0.15);
            color: white;
            font-size: 16px;
            backdrop-filter: blur(5px);
        }

        input::placeholder{
            color: #dfe6e9;
        }

        .btn{
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            color: white;
            padding: 12px 22px;
            border: none;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            margin-left: 5px;
        }

        .btn:hover{
            transform: scale(1.05);
            box-shadow: 0 0 15px #ff6a00;
        }

        table{
            width: 95%;
            margin: 40px auto;
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

        .no-data{
            text-align: center;
            margin-top: 30px;
            color: #ff7675;
            font-size: 24px;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <h1>🔍 Search Student</h1>

    <form method="GET">

        <input type="text"
               name="search"
               placeholder="Enter Student Name">

        <button class="btn" type="submit">
            Search
        </button>

        <a href="index.php" class="btn">
            Back
        </a>

    </form>

    <?php

    if($result && mysqli_num_rows($result) > 0){

    ?>

    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Age</th>
            <th>City</th>
            <th>STD</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td><?php echo $row['student_id']; ?></td>

            <td><?php echo $row['student_name']; ?></td>

            <td><?php echo $row['student_roll_no']; ?></td>

            <td><?php echo $row['student_age']; ?></td>

            <td><?php echo $row['student_city']; ?></td>

            <td><?php echo $row['student_std']; ?></td>

        </tr>

        <?php
        }
        ?>

    </table>

    <?php

    }elseif(isset($_GET['search'])){

        echo "<div class='no-data'>No Student Found</div>";
    }

    ?>

</body>
</html>