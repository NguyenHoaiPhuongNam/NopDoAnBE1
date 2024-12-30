<?php
session_start();

// Kiểm tra nếu ID được truyền qua GET
if (isset($_GET['id'])) {
    $product_id = (int) $_GET['id'];

    // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm khỏi giỏ hàng
    }

    // Chuyển hướng về trang giỏ hàng
    header("Location: cart.php");
} else {
    echo "Invalid request.";
}
?>
