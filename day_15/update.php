<?php

require_once 'config/Database.php';
require_once 'classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$message = "";
$messageType = "";

// Update Product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $product->id = $_POST['id'];
    $product->name = $_POST['name'];
    $product->sku = $_POST['sku'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];

    if ($product->update()) {

        $message = "Product updated successfully.";
        $messageType = "success";

        // Reload updated data
        $product->readOne();

    } else {

        $message = "Failed to update product.";
        $messageType = "danger";
    }

} elseif (isset($_GET['id'])) {

    $product->id = $_GET['id'];

    if (!$product->readOne()) {
        die("Product not found.");
    }

} else {

    die("Invalid request.");
}

include_once 'includes/header.php';

?>

<h1>Update Product</h1>

<?php if (!empty($message)) : ?>
    <div class="alert alert-<?php echo $messageType; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form action="update.php?id=<?php echo $product->id; ?>" method="POST">

    <input
        type="hidden"
        name="id"
        value="<?php echo $product->id; ?>">

    <div class="form-group">
        <label>Product Name *</label>
        <input
            type="text"
            name="name"
            value="<?php echo htmlspecialchars($product->name); ?>"
            class="form-control"
            required>
    </div>

    <div class="form-group">
        <label>SKU Code *</label>
        <input
            type="text"
            name="sku"
            value="<?php echo htmlspecialchars($product->sku); ?>"
            class="form-control"
            required>
    </div>

    <div class="form-group">
        <label>Price *</label>
        <input
            type="number"
            step="0.01"
            name="price"
            value="<?php echo htmlspecialchars($product->price); ?>"
            class="form-control"
            required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea
            name="description"
            class="form-control"
            rows="4"><?php echo htmlspecialchars($product->description); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Update Product
    </button>

    <a href="index.php" class="btn btn-secondary">
        Cancel
    </a>

</form>

<?php include_once 'includes/footer.php'; ?>