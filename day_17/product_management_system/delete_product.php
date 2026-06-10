<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include 'config/database.php';
include 'classes/Product.php';

$database = new Database();
$db = $database->connect();

$product = new Product($db);

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $product->deleteProduct($id);

    header("Location: view_products.php");
    exit();
}
?>