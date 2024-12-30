<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý thanh toán ở đây
    // ...
    $_SESSION['cart'] = [];
    header("Location: success.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <form action="checkout.php" method="POST">
            <p><strong>Total Amount: <?php echo number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart))); ?>₫</strong></p>
            <button type="submit" class="btn btn-success">Confirm Payment</button>
        </form>
    </div>
</body>
</html>
