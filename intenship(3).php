<?php

$attendance = [

    101 => [
        "name"=>"Viren",
        "days"=>["P","P","A","P","P","P","A","P","P","P","P","A","P","P","P","P","P","A","P","P"]
    ],

    102 => [
        "name"=>"Rahul",
        "days"=>["P","A","A","P","P","A","A","P","P","P","A","A","P","P","A","P","P","A","P","A"]
    ],

    103 => [
        "name"=>"Priya",
        "days"=>["P","P","P","P","P","P","P","P","P","P","P","P","P","P","P","P","P","P","P","P"]
    ],

    104 => [
        "name"=>"Sneha",
        "days"=>["P","P","P","A","A","P","P","A","A","P","P","A","P","A","P","A","P","P","A","P"]
    ],

    105 => [
        "name"=>"Karan",
        "days"=>["A","A","P","A","A","P","A","A","P","A","A","P","A","A","P","A","A","P","A","A"]
    ]

];

$students = [];

$totalAttendance = 0;

$detainedStudents = [];

foreach($attendance as $roll => $student){

    $numeric = array_map(function($day){

        if($day == "P"){
            return 1;
        }
        else{
            return 0;
        }

    },$student["days"]);

    $present = array_sum($numeric);

    $absent = 20 - $present;

    $percentage = ($present / 20) * 100;

    if($percentage >= 75){
        $status = "Regular";
        $color = "green";
    }
    elseif($percentage >= 60){
        $status = "Warning";
        $color = "orange";
    }
    else{
        $status = "Detained";
        $color = "red";

        $detainedStudents[] = [
            "name"=>$student["name"],
            "percentage"=>$percentage
        ];
    }

    $students[] = [

        "roll"=>$roll,
        "name"=>$student["name"],
        "days"=>$student["days"],
        "present"=>$present,
        "absent"=>$absent,
        "percentage"=>$percentage,
        "status"=>$status,
        "color"=>$color

    ];

    $totalAttendance += $percentage;
}

usort($students,function($a,$b){

    return $b["percentage"] <=> $a["percentage"];

});

$avgAttendance = $totalAttendance / count($students);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Attendance Dashboard</title>

    <style>

        body{
            font-family: Arial;
            background: #f2f2f2;
            padding: 20px;
        }

        h1{
            text-align: center;
            color: purple;
        }

        .cards{
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card{
            flex: 1;
            background: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 30px;
        }

        th{
            background: purple;
            color: white;
            padding: 10px;
        }

        td{
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even){
            background: #f9f9f9;
        }

        .green{
            background: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .orange{
            background: orange;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .red{
            background: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .present{
            background: lightgreen;
            font-weight: bold;
        }

        .absent{
            background: #ff9999;
            font-weight: bold;
        }

    </style>

</head>

<body>

<h1>Student Attendance Tracker Dashboard</h1>

<div class="cards">

    <div class="card">

        <h2>Total Students</h2>

        <h1><?php echo count($students); ?></h1>

    </div>

    <div class="card">

        <h2>Average Attendance</h2>

        <h1><?php echo number_format($avgAttendance,2); ?>%</h1>

    </div>

    <div class="card">

        <h2>Students Detained</h2>

        <h1><?php echo count($detainedStudents); ?></h1>

    </div>

</div>

<h2>Main Attendance Table</h2>

<table border="1">

<tr>

    <th>Roll No</th>
    <th>Name</th>
    <th>Present</th>
    <th>Absent</th>
    <th>Attendance %</th>
    <th>Status</th>

</tr>

<?php foreach($students as $s){ ?>

<tr>

    <td><?php echo $s["roll"]; ?></td>

    <td><?php echo $s["name"]; ?></td>

    <td><?php echo $s["present"]; ?></td>

    <td><?php echo $s["absent"]; ?></td>

    <td><?php echo number_format($s["percentage"],2); ?>%</td>

    <td>

        <span class="<?php echo $s["color"]; ?>">

            <?php echo $s["status"]; ?>

        </span>

    </td>

</tr>

<?php } ?>

</table>

<h2>Detained Students</h2>

<table border="1">

<tr>

    <th>Name</th>
    <th>Attendance %</th>

</tr>

<?php foreach($detainedStudents as $d){ ?>

<tr>

    <td><?php echo $d["name"]; ?></td>

    <td><?php echo number_format($d["percentage"],2); ?>%</td>

</tr>

<?php } ?>

</table>

<h2>Full Attendance Grid</h2>

<table border="1">

<tr>

    <th>Roll</th>
    <th>Name</th>

    <?php

    for($i=1; $i<=20; $i++){

        echo "<th>Day $i</th>";
    }

    ?>

</tr>

<?php foreach($students as $s){ ?>

<tr>

    <td><?php echo $s["roll"]; ?></td>

    <td><?php echo $s["name"]; ?></td>

    <?php

    foreach($s["days"] as $day){

        if($day == "P"){
            echo "<td class='present'>P</td>";
        }
        else{
            echo "<td class='absent'>A</td>";
        }
    }

    ?>

</tr>

<?php } ?>

</table>

</body>
</html>
