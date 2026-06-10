<?php

class Product
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addProduct(
        $product_name,
        $category,
        $price,
        $quantity,
        $description,
        $image
    )
    {
        $sql = "INSERT INTO products
        (product_name,category,price,quantity,description,image)
        VALUES
        ('$product_name','$category','$price','$quantity','$description','$image')";

        return $this->conn->query($sql);
    }

    public function getProducts()
    {
        return $this->conn->query(
        "SELECT * FROM products ORDER BY id ASC"
        );
    }

    public function getProductById($id)
    {
        return $this->conn->query(
            "SELECT * FROM products WHERE id=$id"
        );
    }

    public function updateProduct(
        $id,
        $product_name,
        $category,
        $price,
        $quantity,
        $description,
        $image
    )
    {
        $sql = "UPDATE products SET
        product_name='$product_name',
        category='$category',
        price='$price',
        quantity='$quantity',
        description='$description',
        image='$image'
        WHERE id='$id'";

        return $this->conn->query($sql);
    }

    public function deleteProduct($id)
    {
        return $this->conn->query(
            "DELETE FROM products WHERE id=$id"
        );
    }
}
?>