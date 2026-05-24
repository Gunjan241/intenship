// delete.php

<?php

include 'config.php';

$id = intval($_GET['id']);

$get = "SELECT file FROM student WHERE id = $id";

$data = mysqli_query($conn, $get);

$row = mysqli_fetch_assoc($data);

if($row['file'] != ""){

    unlink("uploads/" . $row['file']);
}

$sql = "DELETE FROM student WHERE id = $id";

$result = mysqli_query($conn, $sql);

if(!$result){
    die("Delete Failed : " . mysqli_error($conn));
}

header("Location: index.php");

exit();

?>