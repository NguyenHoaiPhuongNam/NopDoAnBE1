<?php
require 'models/db.php';
require 'models/items.php';
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $manu_id = $_POST['manu_id'];
    $type_id = $_POST['type_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $feature = isset($_POST['feature']) ? 1 : 0;

    // Xử lý upload hình ảnh
    if (!empty($_FILES['pro_image']['name'])) {
        $image = $_FILES['pro_image'];
        $imageName = basename($image['name']);
        $uploadDir = 'img/';
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            $imageNameToSave = $imageName;
        } else {
            echo "Lỗi khi tải lên tệp hình ảnh.";
            exit;
        }
    } else {
        // Nếu không có hình ảnh mới, giữ nguyên hình ảnh cũ
        $imageNameToSave = $_POST['old_image'];
    }

    // Truy vấn cập nhật sản phẩm
    $query = "
        UPDATE products
        SET name = :name, manu_id = :manu_id, type_id = :type_id, price = :price, 
            pro_image = :pro_image, description = :description, feature = :feature
        WHERE id = :id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id' => $id,
        'name' => $name,
        'manu_id' => $manu_id,
        'type_id' => $type_id,
        'price' => $price,
        'pro_image' => $imageNameToSave,
        'description' => $description,
        'feature' => $feature
    ]);

    header("Location: admin_products.php");
}
?>
