<?php

require_once 'config/Database.php';
require_once 'classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$message = "";
$messageType = "";

// Delete Product
if (
    isset($_GET['action']) &&
    $_GET['action'] == 'delete' &&
    isset($_GET['id'])
) {
    $product->id = $_GET['id'];

    if ($product->delete()) {
        $message = "Product deleted successfully.";
        $messageType = "success";
    } else {
        $message = "Unable to delete product.";
        $messageType = "danger";
    }
}

$result = $product->readAll();

include_once 'includes/header.php';

?>

<h1>Inventory Control Panel Dashboard</h1>

<?php if (!empty($message)) : ?>
    <div class="alert alert-<?php echo $messageType; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<a href="create.php" class="btn btn-success">
    + Add New Product
</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Title</th>
            <th>SKU Code</th>
            <th>Unit Price</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        <?php if ($result && $result->num_rows > 0) : ?>

            <?php while ($row = $result->fetch_assoc()) : ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>

                    <td>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['sku']); ?>
                    </td>

                    <td>
                        $<?php echo number_format($row['price'], 2); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['description']); ?>
                    </td>

                    <td>

                        <a
                            href="update.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-primary"
                            style="padding:4px 8px; font-size:9pt;">
                            Edit
                        </a>

                        <a
                            href="index.php?action=delete&id=<?php echo $row['id']; ?>"
                            class="btn btn-danger"
                            style="padding:4px 8px; font-size:9pt;"
                            onclick="return confirm('Are you sure you want to delete this product?');">
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endwhile; ?>

        <?php else : ?>

            <tr>
                <td colspan="6" style="text-align:center;">
                    No products found in database.
                </td>
            </tr>

        <?php endif; ?>

    </tbody>
</table>

<?php include_once 'includes/footer.php'; ?>