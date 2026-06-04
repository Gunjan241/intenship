<?php

require_once 'config/Database.php';
require_once 'classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        !empty($_POST['name']) &&
        !empty($_POST['sku']) &&
        !empty($_POST['price'])
    ) {

        $product->name = $_POST['name'];
        $product->sku = $_POST['sku'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];

        if ($product->create()) {
            $message = "Product added successfully.";
            $messageType = "success";
        } else {
            $message = "Failed to add product. SKU may already exist.";
            $messageType = "danger";
        }

    } else {
        $message = "Please fill all required fields.";
        $messageType = "danger";
    }
}

include_once 'includes/header.php';

?>

<h1>Create Product</h1>

<?php if (!empty($message)) : ?>
    <div class="alert alert-<?php echo $messageType; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form action="create.php" method="POST">

    <div class="form-group">
        <label>Product Name *</label>
        <input
            type="text"
            name="name"
            class="form-control"
            required>
    </div>

    <div class="form-group">
        <label>SKU Code *</label>
        <input
            type="text"
            name="sku"
            class="form-control"
            required>
    </div>

    <div class="form-group">
        <label>Price *</label>
        <input
            type="number"
            step="0.01"
            name="price"
            class="form-control"
            required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea
            name="description"
            class="form-control"
            rows="4"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Save Product
    </button>

    <a href="index.php" class="btn btn-secondary">
        Back
    </a>

</form>

<?php include_once 'includes/footer.php'; ?>