<?php

include 'config.php';

$id = intval($_GET['id']);

$sql = "DELETE FROM student WHERE student_id = $id";

$result = mysqli_query($conn, $sql);

if(!$result){
    die("Delete Failed : " . mysqli_error($conn));
}

header("Location: index.php");

exit();

?>