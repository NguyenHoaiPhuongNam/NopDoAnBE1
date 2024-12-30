<?php
session_start();
require 'config.php';
require 'models/db.php';
require 'models/items.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['id']);
    $quantity = intval($_POST['quantity']);

    $product = new Product();
    $product_details = $product->getProductById($product_id);

    if ($product_details) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = [
                'id' => $product_details['id'],
                'name' => $product_details['name'],
                'price' => $product_details['price'],
                'image' => $product_details['pro_image'],
                'quantity' => $quantity,
            ];
        } else {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        }
    }

    // Redirect back to the product detail or another page
    header('Location: cart_view.php');
    exit();
}
?>
