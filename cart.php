<?php
session_start();
require 'config.php';
require 'models/db.php';
require 'models/items.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($action == 'add') {
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
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$product_id]['quantity']++;
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} elseif ($action == 'view') {
    echo json_encode($_SESSION['cart'] ?? []);
} elseif ($action == 'remove') {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    echo json_encode(['success' => true]);
}

if ($action == 'increase') {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    }
    header("Location: cart_view.php");
    exit();
} elseif ($action == 'decrease') {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']--;
        if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
            unset($_SESSION['cart'][$product_id]); // Xóa nếu số lượng <= 0
        }
    }
    header("Location: cart_view.php");
    exit();
} elseif ($action == 'remove') {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    header("Location: cart_view.php");
    exit();
}

?>
