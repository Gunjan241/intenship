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

$msg = "";

if(isset($_POST['add_product']))
{
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp,"uploads/".$image);

    if(
        $product->addProduct(
            $product_name,
            $category,
            $price,
            $quantity,
            $description,
            $image
        )
    )
    {
        $msg = "Product Added Successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Product</title>

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

.success{
background:#28a745;
color:white;
padding:12px;
border-radius:10px;
margin-bottom:15px;
text-align:center;
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

.btn{
width:100%;
padding:12px;
background:#007bff;
color:white;
border:none;
border-radius:10px;
font-size:16px;
cursor:pointer;
}

.btn:hover{
background:#0056b3;
}

.back{
display:block;
text-align:center;
margin-top:15px;
text-decoration:none;
font-weight:bold;
}

select{
width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:10px;
outline:none;
font-size:15px;
background:white;
}

</style>

</head>
<script>

document
.querySelector('input[type="file"]')
.addEventListener('change',function(e){

const file = e.target.files[0];

if(file)
{
let reader = new FileReader();

reader.onload = function(event)
{
let img =
document.getElementById('preview');

img.src = event.target.result;
img.style.display='block';
}

reader.readAsDataURL(file);
}

});

</script>
<body>

<div class="container">

<h1>➕ Add Product</h1>

<?php
if($msg!="")
{
    echo "<div class='success'>$msg</div>";
}
?>

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Product Name</label>
<input type="text" name="product_name" required>
</div>

<div class="form-group">
<label>Category</label>

<select name="category" required class="input-box">

<option value="">Select Category</option>

<option value="Mobile">
Mobile
</option>

<option value="Laptop">
Laptop
</option>

<option value="Electronics">
Electronics
</option>

<option value="Accessories">
Accessories
</option>

<option value="Clothing">
Clothing
</option>

<option value="Home Appliance">
Home Appliance
</option>

<option value="Furniture">
Furniture
</option>

<option value="Books">
Books
</option>

</select>

</div>

<div class="form-group">
<label>Price</label>
<input type="number" name="price" required>
</div>

<div class="form-group">
<label>Quantity</label>
<input type="number" name="quantity" required>
</div>

<div class="form-group">
<label>Description</label>
<textarea name="description"></textarea>
</div>

<div class="form-group">
<label>Product Image</label>
<input type="file" name="image" required>
</div>

<button type="submit" name="add_product" class="btn">
Add Product
</button>

</form>

<a href="dashboard.php" class="back">
⬅ Back to Dashboard
</a>

</div>

</body>
</html>