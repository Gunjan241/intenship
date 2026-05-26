<?php
class Product {
private $name;
private $category;
private $price;
private $stock;
public function __construct($name, $category, $price, $stock) {
$this->name = $name;
$this->category = $category;
$this->setPrice($price);
$this->setStock($stock);
}
public function setPrice($price) {
if ($price < 0) {
$price = 0;
}
$this->price = $price;
}
public function setStock($stock) {
if ($stock < 0) {
$stock = 0;
}
$this->stock = $stock;
}
public function getName() { return $this->name; }
public function getCategory() { return $this->category; }
public function getPrice() { return $this->price; }
public function getStock() { return $this->stock; }
public function isAvailable() {
return $this->stock > 0;
}
public function getDiscountedPrice($discountPercent) {
if ($discountPercent < 0 || $discountPercent > 100) {
$discountPercent = 0;
}
return $this->price - (($this->price * $discountPercent) / 100);
}
}
?>