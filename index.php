<?php
require_once "config.php";
require "models/db.php";
require "models/items.php";
require "models/productypes.php";

// Khởi tạo các đối tượng
$product = new Product();
$protype = new ProductType();
$getAllproduct = $product->getAllProducts();
$getAllprotypes = $protype->getAllProductType();
$getFeaturedProducts = $product->getFeaturedProducts(10);
$getRecentProducts = $product->getRecentProducts(10);

if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $results = $product->searchProducts($keyword);
}
if (isset($results)) {
    foreach ($results as $product) {
        echo "<h3>" . $product['name'] . "</h3>";
        echo "<p>" . $product['description'] . "</p>";
        echo "<p>Giá: " . $product['price'] . " VND</p>";
    }
}
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $results = $product->searchProducts($keyword);  // Gọi phương thức searchProducts
    foreach ($results as $product) {
        echo "<h3>" . $product['name'] . "</h3>";
        echo "<p>" . $product['description'] . "</p>";
        echo "<p>Giá: " . $product['price'] . " VND</p>";
    }
}



// Bao gồm các tệp giao diện
include "header.php";
include "products.php";
include "footer.php";
