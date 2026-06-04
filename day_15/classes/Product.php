<?php

class Product
{
    private $conn;
    private $table_name = "products";

    // Product properties
    public $id;
    public $name;
    public $sku;
    public $price;
    public $description;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create Product
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
                  (name, sku, price, description)
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            return false;
        }

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bind_param(
            "ssds",
            $this->name,
            $this->sku,
            $this->price,
            $this->description
        );

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }

    // Read All Products
    public function readAll()
    {
        $query = "SELECT id, name, sku, price, description, created_at
                  FROM " . $this->table_name . "
                  ORDER BY created_at DESC";

        return $this->conn->query($query);
    }

    // Read Single Product
    public function readOne()
    {
        $query = "SELECT name, sku, price, description
                  FROM " . $this->table_name . "
                  WHERE id = ?
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $this->id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->name = $row['name'];
            $this->sku = $row['sku'];
            $this->price = $row['price'];
            $this->description = $row['description'];

            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }

    // Update Product
    public function update()
    {
        $query = "UPDATE " . $this->table_name . "
                  SET
                      name = ?,
                      sku = ?,
                      price = ?,
                      description = ?
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            return false;
        }

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param(
            "ssdsi",
            $this->name,
            $this->sku,
            $this->price,
            $this->description,
            $this->id
        );

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }

    // Delete Product
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . "
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            return false;
        }

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }
}

?>