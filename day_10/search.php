// search.php

<?php

include 'config.php';

$result = null;

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $sql = "SELECT * FROM student
            WHERE name LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Search Student</title>

</head>

<body>

<form method="GET">

<input type="text" name="search">

<button type="submit">Search</button>

</form>

<?php

if($result && mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

echo $row['name'];

}

}

?>

</body>
</html>