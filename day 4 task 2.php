<?php

session_start();

$products = [

    ["id"=>1,"name"=>"Samsung Galaxy A17","price"=>23000,"image"=>"📱"],
    ["id"=>2,"name"=>"Laptop","price"=>60000,"image"=>"💻"],
    ["id"=>3,"name"=>"Earbuds","price"=>1000,"image"=>"🎧"],
    ["id"=>4,"name"=>"A.C","price"=>25000,"image"=>"❄️"],
    ["id"=>5,"name"=>"Fan","price"=>3000,"image"=>"🌀"]
];

if(!isset($_SESSION["cart"])){

    $_SESSION["cart"] = [];
}

// Add To Cart
if(isset($_POST["add"])){

    $id = $_POST["id"];

    foreach($products as $p){

        if($p["id"] == $id){

            $_SESSION["cart"][] = $p;
        }
    }
}

// Search
$search = "";

if(isset($_GET["search"])){

    $search = strtolower($_GET["search"]);
}

$filtered = [];

foreach($products as $p){

    if($search == "" || strpos(strtolower($p["name"]),$search)!==false){

        $filtered[] = $p;
    }
}

// Product Card Function
function card($p){

    echo "

    <div class='card'>

        <h1>{$p['image']}</h1>

        <h2>{$p['name']}</h2>

        <p>₹{$p['price']}</p>

        <form method='POST'>

            <input type='hidden' name='id' value='{$p['id']}'>

            <button name='add'>Add To Cart</button>

        </form>

    </div>
    ";
}

// Cart Total
$total = array_sum(array_column($_SESSION["cart"],"price"));

$gst = $total * 0.18;

$grand = ceil($total + $gst);

?>

<!DOCTYPE html>
<html>
<head>

<title>Mini E-Commerce</title>

<style>

body{
    font-family:Arial;
    margin:0;
    background:#fff8e1;
}

.navbar{
    background:#6a1b9a;
    color:white;
    padding:15px;
    display:flex;
    justify-content:space-between;
}

.container{
    padding:20px;
}

.products{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.card{
    width:220px;
    background:#f3e5f5;
    padding:20px;
    text-align:center;
    border-radius:10px;
    box-shadow:0px 0px 8px #ba68c8;
}

button{
    background:#8e24aa;
    color:white;
    border:none;
    padding:10px;
    width:100%;
    border-radius:5px;
}

button:hover{
    background:#4a148c;
}

.bill{
    background:#ede7f6;
    padding:20px;
    margin-top:30px;
    width:300px;
    border-radius:10px;
    box-shadow:0px 0px 8px #9575cd;
}

</style>

</head>

<body>

<div class="navbar">

<h2>Mini E-Commerce</h2>

<div>

Cart Items: <?php echo count($_SESSION["cart"]); ?>

</div>

</div>

<div class="container">

<form method="GET">

<input type="text" name="search" placeholder="Search Product">

<button>Search</button>

</form>

<br>

<div class="products">

<?php

foreach($filtered as $p){

    card($p);
}

?>

</div>

<?php if(count($_SESSION["cart"]) > 0){ ?>

<div class="bill">

<h2>Bill</h2>

<p>Subtotal: ₹<?php echo $total; ?></p>

<p>GST (18%): ₹<?php echo $gst; ?></p>

<h3>Total: ₹<?php echo $grand; ?></h3>

</div>

<?php } ?>

</div>

</body>
</html>