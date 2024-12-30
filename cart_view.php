<?php
session_start();
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
    exit;
}

require_once "config.php";
require "models/db.php";
require "models/items.php";
require "models/productypes.php";
$product = new Product();
$protype = new ProductType();
$getAllproduct = $product->getAllProducts();
$getAllprotypes = $protype->getAllProductType();
$getFeaturedProducts = $product->getFeaturedProducts(10);
$getRecentProducts = $product->getRecentProducts(10);

include "header.php";
?>

<div class="container py-5">
    <h1 class="mb-4 text-center text-primary">Shopping Cart</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grand_total = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $total_price = $item['price'] * $item['quantity'];
                        $grand_total += $total_price;
                        ?>
                        <tr>
                            <td>
                                <?php if (!empty($item['image'])): ?>
                                    <img src="img/<?php echo $item['image']; ?>" alt="Product Image" class="img-thumbnail" style="width: 70px; height: 70px;">
                                <?php else: ?>
                                    <img src="img/default.jpg" alt="Default Image" class="img-thumbnail" style="width: 70px; height: 70px;">
                                <?php endif; ?>
                            </td>

                            <td class="text-start">
                                <strong><?php echo $item['name']; ?></strong>
                            </td>
                            <td>
                                <?php echo number_format($item['price']); ?>₫
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <form action="cart.php?action=decrease&id=<?php echo $item['id']; ?>" method="POST" class="me-2">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                    </form>
                                    <span class="px-2"><?php echo $item['quantity']; ?></span>
                                    <form action="cart.php?action=increase&id=<?php echo $item['id']; ?>" method="POST" class="ms-2">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                    </form>
                                </div>
                            </td>

                            <td>
                                <?php echo number_format($total_price); ?>₫
                            </td>
                            <td>
                                <a href="javascript:void(0);" 
                                class="btn btn-outline-danger btn-sm" 
                                onclick="confirmRemove(<?php echo $item['id']; ?>)">
                                    <i class="fa fa-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4 class="text-primary">Grand Total: <strong><?php echo number_format($grand_total); ?>₫</strong></h4>
            <a href="checkout.php" class="btn btn-success btn-lg">
                <i class="fa fa-check-circle"></i> Proceed to Checkout
            </a>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            <h4>Your cart is empty!</h4>
            <p><a href="products.php" class="btn btn-primary">Browse Products</a></p>
        </div>
    <?php endif; ?>
</div>

<script>
    function confirmRemove(productId) {
        if (confirm("Are you sure you want to remove this item from the cart?")) {
            // Nếu người dùng xác nhận, thực hiện yêu cầu AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `cart.php?action=remove&id=${productId}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Item removed successfully!");
                    // Reload lại trang để cập nhật giỏ hàng
                    window.location.reload();
                } else {
                    alert("Failed to remove item. Please try again.");
                }
            };
            xhr.send();
        }
    }
</script>


