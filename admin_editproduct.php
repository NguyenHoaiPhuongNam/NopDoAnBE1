<?php
// Require necessary files
require 'models/db.php';
require 'models/items.php';
require 'config.php';

// Khởi tạo kết nối DB
$db = new Db();

// Xử lý nếu có ID sản phẩm
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Lấy thông tin sản phẩm từ DB
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = Db::$connection->prepare($sql);
    $stmt->bind_param('i', $product_id); // ràng buộc tham số là kiểu integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu có sản phẩm
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc(); // Lấy dữ liệu sản phẩm
    } else {
        // Nếu không tìm thấy sản phẩm
        echo "Product not found!";
        exit();
    }

    // Lấy dữ liệu manufacturer và product types để điền vào các dropdown
    $sql_manufacturer = "SELECT * FROM manufactures";
    $result_manufacturer = Db::$connection->query($sql_manufacturer);

    $sql_product_types = "SELECT * FROM product_types";
    $result_product_types = Db::$connection->query($sql_product_types);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cập nhật thông tin sản phẩm
    $name = $_POST['name'];
    $type_id = $_POST['type_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $feature = isset($_POST['feature']) ? 1 : 0;
    $manu_id = $_POST['manu_id'];

    // Xử lý upload hình ảnh
    $imageName = $product['pro_image']; // Nếu không thay đổi hình ảnh, giữ tên cũ
    if ($_FILES['pro_image']['name']) {
        $image = $_FILES['pro_image'];
        $imageName = basename($image['name']);
        $uploadDir = 'img/';
        $uploadFile = $uploadDir . $imageName;
        move_uploaded_file($image['tmp_name'], $uploadFile);
    }

    // Cập nhật sản phẩm vào DB
    $sql_update = "UPDATE products SET name = ?, type_id = ?, price = ?, pro_image = ?, description = ?, feature = ?, manu_id = ? WHERE id = ?";
    $stmt_update = Db::$connection->prepare($sql_update);
    $stmt_update->bind_param('siisssii', $name, $type_id, $price, $imageName, $description, $feature, $manu_id, $product_id);
    $stmt_update->execute();

    // Điều hướng về trang sản phẩm
    header("Location: admin_products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>

    <form action="admin_editproduct.php?id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
        <!-- Product Name -->
        <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        </div>

        <!-- Manufacturer -->
        <div class="mb-3">
            <label for="manuId" class="form-label">Manufacturer</label>
            <select class="form-control" id="manuId" name="manu_id" required>
                <?php while ($row = $result_manufacturer->fetch_assoc()): ?>
                    <option value="<?php echo $row['manu_id']; ?>" <?php echo $row['manu_id'] == $product['manu_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['manu_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Product Type -->
        <div class="mb-3">
            <label for="typeId" class="form-label">Product Type</label>
            <select class="form-control" id="typeId" name="type_id" required>
                <?php while ($row = $result_product_types->fetch_assoc()): ?>
                    <option value="<?php echo $row['type_id']; ?>" <?php echo $row['type_id'] == $product['type_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['type_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="productPrice" class="form-label">Price (₫)</label>
            <input type="number" class="form-control" id="productPrice" name="price" value="<?php echo $product['price']; ?>" required>
        </div>

        <!-- Product Image -->
        <div class="mb-3">
            <label for="productImage" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="productImage" name="pro_image" accept="image/*">
            <img src="img/<?php echo $product['pro_image']; ?>" alt="Current image" width="100" height="100">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="productDescription" class="form-label">Description</label>
            <textarea class="form-control" id="productDescription" name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <!-- Feature -->
        <div class="mb-3">
            <label for="feature" class="form-label">Featured</label>
            <select class="form-control" id="feature" name="feature" required>
                <option value="1" <?php echo $product['feature'] == 1 ? 'selected' : ''; ?>>Yes</option>
                <option value="0" <?php echo $product['feature'] == 0 ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Save Product</button>
            <a href="admin_products.php" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
