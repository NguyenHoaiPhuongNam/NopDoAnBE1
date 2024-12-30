<?php
require 'models/db.php';
require 'models/items.php';
require 'config.php';

// Xử lý khi người dùng gửi biểu mẫu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type_id = $_POST['type_id'];
    $manu_id = $_POST['manu_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $feature = isset($_POST['feature']) ? 1 : 0;

    // Xử lý upload hình ảnh
    $image = $_FILES['pro_image'];
    $imageName = basename($image['name']);
    $uploadDir = 'img/';
    $uploadFile = $uploadDir . $imageName;

    if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
        // Thêm sản phẩm vào cơ sở dữ liệu
        $db = new Db();
        $stmt = $db::$connection->prepare("INSERT INTO products (name, type_id, manu_id, price, pro_image, description, feature) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('siidssi', $name, $type_id, $manu_id, $price, $imageName, $description, $feature);

        if ($stmt->execute()) {
            header("Location: admin_products.php"); // Chuyển hướng về trang sản phẩm
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Lỗi khi tải lên tệp hình ảnh.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-xxl py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="mb-0">Add New Product</h3>
                </div>
                <div class="card-body">
                    <form action="admin_addproduct.php" method="POST" enctype="multipart/form-data">
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" required>
                        </div>

                        <!-- Manufacturer -->
                        <div class="mb-3">
                            <label for="manuId" class="form-label">Manufacturer</label>
                            <select class="form-control" id="manuId" name="manu_id" required>
                                <?php
                                $db = new Db();
                                $result = $db::$connection->query("SELECT * FROM manufactures");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['manu_id'] . "'>" . $row['manu_name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No manufacturers available</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Product Type -->
                        <div class="mb-3">
                            <label for="typeId" class="form-label">Product Type</label>
                            <select class="form-control" id="typeId" name="type_id" required>
                                <?php
                                $result = $db::$connection->query("SELECT * FROM product_types");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No product types available</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price (₫)</label>
                            <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter product price" required>
                        </div>

                        <!-- Product Image -->
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage" name="pro_image" accept="image/*" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" name="description" rows="4" placeholder="Enter product description" required></textarea>
                        </div>

                        <!-- Feature -->
                        <div class="mb-3">
                            <label for="feature" class="form-label">Featured</label>
                            <select class="form-select" id="feature" name="feature" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <!-- Submit and Cancel buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save me-2"></i> Save Product
                            </button>
                            <a href="admin_products.php" class="btn btn-danger">
                                <i class="fa fa-times me-2"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
