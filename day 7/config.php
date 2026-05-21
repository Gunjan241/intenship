<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "school";
$port = 3306;

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>