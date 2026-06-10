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

$result = $product->getProducts();

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>View Products</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#f4f6f9;
padding:30px;
}

.container{
width:100%;
max-width:1200px;
margin:auto;
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

h1{
text-align:center;
margin-bottom:20px;
color:#333;
}

.top-bar{
display:flex;
justify-content:space-between;
margin-bottom:20px;
flex-wrap:wrap;
gap:10px;
}

.search-box{
padding:10px;
width:300px;
border:1px solid #ccc;
border-radius:8px;
}

.btn{
padding:10px 15px;
border:none;
border-radius:8px;
color:white;
text-decoration:none;
font-weight:bold;
}

.add-btn{
background:#28a745;
}

.back-btn{
background:#6c757d;
}

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

table th{
background:#007bff;
color:white;
padding:12px;
}

table td{
padding:12px;
text-align:center;
border-bottom:1px solid #ddd;
}

table tr:hover{
background:#f1f1f1;
}

img{
width:70px;
height:70px;
object-fit:cover;
border-radius:8px;
}

.edit{
background:#ffc107;
padding:8px 12px;
color:black;
text-decoration:none;
border-radius:6px;
font-weight:bold;
}

.delete{
background:#dc3545;
padding:8px 12px;
color:white;
text-decoration:none;
border-radius:6px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h1>📦 Product List</h1>

<div class="top-bar">

<input
type="text"
id="searchInput"
class="search-box"
placeholder="Search Product..."
onkeyup="searchProduct()"
>

<div>

<a href="add_product.php" class="btn add-btn">
➕ Add Product
</a>

<a href="dashboard.php" class="btn back-btn">
⬅ Dashboard
</a>

</div>

</div>

<table id="productTable">

<tr>
<th>SR NO</th>
<th>Image</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Quantity</th>
<th>Action</th>
</tr>

<?php
$sr = 1;
while($row = $result->fetch_assoc()) {
?>


<tr>

<td><?php echo $sr++; ?></td> 

<td>
<img src="uploads/<?php echo $row['image']; ?>">
</td>

<td><?php echo $row['product_name']; ?></td>

<td><?php echo $row['category']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>

<a
href="edit_product.php?id=<?php echo $row['id']; ?>"
class="edit"
>
Edit
</a>

<a
href="delete_product.php?id=<?php echo $row['id']; ?>"
class="delete"
onclick="return confirm('Delete this product?')"
>
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<script>

function searchProduct()
{
let input =
document.getElementById("searchInput")
.value.toUpperCase();

let table =
document.getElementById("productTable");

let tr =
table.getElementsByTagName("tr");

for(let i=1;i<tr.length;i++)
{
let td =
tr[i].getElementsByTagName("td")[2];

if(td)
{
let txt =
td.textContent || td.innerText;

tr[i].style.display =
txt.toUpperCase().indexOf(input) > -1
? ""
: "none";
}
}
}

</script>

</body>
</html>