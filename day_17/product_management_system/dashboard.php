<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include 'config/database.php';

$database = new Database();
$db = $database->connect();

$totalProducts = $db->query("SELECT * FROM products")->num_rows;

$totalCategories = $db->query("SELECT DISTINCT category FROM products")->num_rows;

?>

<!DOCTYPE html>

<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
display:flex;
background:#f4f6f9;
}

.sidebar{
width:250px;
height:100vh;
background:#1e293b;
position:fixed;
left:0;
top:0;
padding:20px;
}

.logo{
color:white;
font-size:24px;
font-weight:bold;
text-align:center;
margin-bottom:40px;
}

.sidebar a{
display:block;
padding:15px;
margin-bottom:10px;
text-decoration:none;
color:white;
border-radius:10px;
transition:.3s;
}

.sidebar a:hover{
background:#334155;
}

.main{
margin-left:250px;
width:calc(100% - 250px);
padding:30px;
}

.header{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
margin-bottom:25px;
}

.header h1{
color:#333;
}

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-bottom:25px;
}

.card{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.card h2{
font-size:35px;
margin-bottom:10px;
}

.card p{
color:#666;
font-size:18px;
}

.blue{
border-left:6px solid #0d6efd;
}

.green{
border-left:6px solid #198754;
}

.actions{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.action-card{
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
text-align:center;
text-decoration:none;
transition:.3s;
}

.action-card:hover{
transform:translateY(-5px);
}

.action-card h3{
margin-top:10px;
color:#333;
}

.icon{
font-size:45px;
}

.footer{
margin-top:30px;
text-align:center;
color:#666;
}

@media(max-width:768px){

.sidebar{
width:100%;
height:auto;
position:relative;
}

.main{
margin-left:0;
width:100%;
}

}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">
📦 Product Admin
</div>

<a href="dashboard.php">🏠 Dashboard</a>

<a href="add_product.php">➕ Add Product</a>

<a href="view_products.php">📦 View Products</a>

<a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="header">
<h1>Welcome Admin 👋</h1>
<p>Product Management System Dashboard</p>
</div>

<div class="stats">

<div class="card blue">
<h2><?php echo $totalProducts; ?></h2>
<p>Total Products</p>
</div>

<div class="card green">
<h2><?php echo $totalCategories; ?></h2>
<p>Total Categories</p>
</div>

</div>

<div class="actions">

<a href="add_product.php" class="action-card">
<div class="icon">➕</div>
<h3>Add Product</h3>
</a>

<a href="view_products.php" class="action-card">
<div class="icon">📦</div>
<h3>Manage Products</h3>
</a>

<a href="logout.php" class="action-card">
<div class="icon">🚪</div>
<h3>Logout</h3>
</a>

</div>

<div class="footer">
© <?php echo date("Y"); ?> Product Management System
</div>

</div>

</body>
</html>
