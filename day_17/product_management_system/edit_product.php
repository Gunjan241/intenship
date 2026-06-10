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

$id = $_GET['id'];

$result = $product->getProductById($id);
$row = $result->fetch_assoc();

if(isset($_POST['update_product']))
{
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $image = $row['image'];

    if(!empty($_FILES['image']['name']))
    {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp,"uploads/".$image);
    }

    $product->updateProduct(
        $id,
        $product_name,
        $category,
        $price,
        $quantity,
        $description,
        $image
    );

    header("Location: view_products.php");
    exit();
}
?>

<!DOCTYPE html>

<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Product</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:linear-gradient(135deg,#667eea,#764ba2);
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
padding:30px;
}

.container{
width:100%;
max-width:700px;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h1{
text-align:center;
margin-bottom:25px;
color:#333;
}

.form-group{
margin-bottom:15px;
}

label{
display:block;
margin-bottom:6px;
font-weight:bold;
}

input,
textarea{
width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:10px;
outline:none;
}

textarea{
height:100px;
resize:none;
}

.current-image{
text-align:center;
margin-bottom:15px;
}

.current-image img{
width:120px;
height:120px;
object-fit:cover;
border-radius:10px;
border:2px solid #ddd;
}

.btn{
width:100%;
padding:12px;
background:#28a745;
color:white;
border:none;
border-radius:10px;
font-size:16px;
cursor:pointer;
font-weight:bold;
}

.btn:hover{
background:#218838;
}

.back{
display:block;
text-align:center;
margin-top:15px;
text-decoration:none;
font-weight:bold;
color:#333;
}

</style>

</head>

<body>

<div class="container">

<h1>✏ Edit Product</h1>

<form method="POST" enctype="multipart/form-data">

<div class="current-image">
<img src="uploads/<?php echo $row['image']; ?>">
</div>

<div class="form-group">
<label>Product Name</label>
<input type="text"
name="product_name"
value="<?php echo $row['product_name']; ?>"
required>
</div>

<div class="form-group">
<label>Category</label>
<input type="text"
name="category"
value="<?php echo $row['category']; ?>"
required>
</div>

<div class="form-group">
<label>Price</label>
<input type="number"
name="price"
value="<?php echo $row['price']; ?>"
required>
</div>

<div class="form-group">
<label>Quantity</label>
<input type="number"
name="quantity"
value="<?php echo $row['quantity']; ?>"
required>
</div>

<div class="form-group">
<label>Description</label>
<textarea name="description"><?php echo $row['description']; ?></textarea>
</div>

<div class="form-group">
<label>Change Image</label>
<input type="file" name="image">
</div>

<button type="submit"
name="update_product"
class="btn">
Update Product </button>

</form>

<a href="view_products.php" class="back">
⬅ Back To Products
</a>

</div>

</body>
</html>
