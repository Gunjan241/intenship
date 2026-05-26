<?php
require_once "Product.php";

session_start();

if(!isset($_SESSION['products'])){

    $_SESSION['products'] = [

        new Product("Laptop", "Electronics", 45000, 5),
        new Product("Keyboard", "Accessories", 799, 12),
        new Product("Mouse", "Accessories", 499, 0),
        new Product("Office Chair", "Furniture", 3500, 3)

    ];
}

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $availability = $_POST['availability'];

    if($availability == "Out of Stock"){
        $stock = 0;
    }

    $_SESSION['products'][] = new Product($name, $category, $price, $stock);
}

if(isset($_POST['delete'])){

    $index = $_POST['index'];

    unset($_SESSION['products'][$index]);

    $_SESSION['products'] = array_values($_SESSION['products']);
}

$products = $_SESSION['products'];

?>

<!DOCTYPE html>
<html>

<head>

    <title>Product Management</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            font-family:Arial, sans-serif;
            background:linear-gradient(to right, #dbeafe, #eef2ff);
            padding:40px;
        }

        .container{

            max-width:1250px;
            margin:auto;
            background:white;
            padding:35px;
            border-radius:18px;
            box-shadow:0 8px 20px rgba(0,0,0,0.15);

        }

        h1{

            text-align:center;
            color:#0b1f3a;
            margin-bottom:30px;
            font-size:42px;

        }

        .form-box{

            display:grid;
            grid-template-columns:repeat(5,1fr);
            gap:15px;
            margin-bottom:30px;

        }

        input,
        select{

            padding:14px;
            border:1px solid #ccc;
            border-radius:8px;
            font-size:16px;

        }

        .add-btn{

            background:#16a34a;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:16px;
            font-weight:bold;
            transition:0.3s;
            padding:14px 20px;
        }

        .add-btn:hover{

            background:#15803d;
            transform:scale(1.03);

        }

        table{

            width:100%;
            border-collapse:collapse;
            margin-top:20px;
            overflow:hidden;
            border-radius:12px;

        }

        th{

            background:#1e3a8a;
            color:white;
            padding:18px;
            font-size:20px;

        }

        td{

            padding:16px;
            border:1px solid #ddd;
            text-align:center;
            font-size:18px;

        }

        tr:nth-child(even){

            background:#f8fafc;

        }

        tr:hover{

            background:#dbeafe;
            transition:0.3s;

        }

        .yes{

            color:#16a34a;
            font-weight:bold;
            font-size:18px;

        }

        .no{

            color:#dc2626;
            font-weight:bold;
            font-size:18px;

        }

        .price{

            color:#2563eb;
            font-weight:bold;

        }

        .discount{

            color:#9333ea;
            font-weight:bold;

        }

        .delete-btn{

            background:#dc2626;
            color:white;
            border:none;
            padding:10px 16px;
            border-radius:8px;
            cursor:pointer;
            font-size:15px;
            font-weight:bold;
            transition:0.3s;
        }

        .delete-btn:hover{

            background:#b91c1c;
            transform:scale(1.05);

        }

    </style>

</head>

<body>

<div class="container">

    <h1>🛒 Product Management</h1>

    <form method="POST">

        <div class="form-box">

            <input type="text" name="name" placeholder="Product Name" required>

            <input type="text" name="category" placeholder="Category" required>

            <input type="number" name="price" placeholder="Price" required>

            <input type="number" name="stock" placeholder="Stock" required>

            <select name="availability" required>

                <option value="">Select Availability</option>

                <option value="In Stock">In Stock</option>

                <option value="Out of Stock">Out of Stock</option>

            </select>

        </div>

        <button type="submit" name="add_product" class="add-btn">
            ➕ Add Product
        </button>

    </form>

    <table>

        <tr>

            <th>#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Availability</th>
            <th>10% Discount</th>
            <th>Action</th>

        </tr>

        <?php foreach ($products as $index => $product): ?>

        <tr>

            <td>
                <?= $index + 1 ?>
            </td>

            <td>
                <?= htmlspecialchars($product->getName()) ?>
            </td>

            <td>
                <?= htmlspecialchars($product->getCategory()) ?>
            </td>

            <td class="price">
                Rs. <?= number_format($product->getPrice(), 2) ?>
            </td>

            <td>
                <?= $product->getStock() ?>
            </td>

            <td class="<?= $product->isAvailable() ? 'yes' : 'no' ?>">

                <?= $product->isAvailable() ? '✅ In Stock' : '❌ Out of Stock' ?>

            </td>

            <td class="discount">

                Rs. <?= number_format($product->getDiscountedPrice(10), 2) ?>

            </td>

            <td>

                <form method="POST">

                    <input type="hidden" name="index" value="<?= $index ?>">

                    <button type="submit" name="delete" class="delete-btn">
                        🗑 Delete
                    </button>

                </form>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>
</html>