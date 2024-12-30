<?php
class Product extends Db {
    // Lấy tất cả các sản phẩm
    public function getAllProducts() {
        $sql = self::$connection->prepare("SELECT * FROM `products`");
        $sql->execute();
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products;
    }

    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = self::$connection->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('i', $id); // Bind tham số $id (kiểu int)
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc(); // Lấy dòng dữ liệu duy nhất
            $stmt->close();
            return $product; // Trả về mảng kết hợp chứa thông tin sản phẩm
        } else {
            return null; // Trả về null nếu xảy ra lỗi
        }
    }

    public function getProductsTypeId1() {
        // Chuẩn bị câu truy vấn cố định
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `type_id` = 1");
        // Thực thi truy vấn
        $sql->execute();
        // Lấy kết quả
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        // Trả về danh sách sản phẩm
        return $products;
    }

    public function getProductsTypeId2() {
        // Chuẩn bị câu truy vấn cố định
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `type_id` = 2");
        // Thực thi truy vấn
        $sql->execute();
        // Lấy kết quả
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        // Trả về danh sách sản phẩm
        return $products;
    }

    public function getProductsTypeId3() {
        // Chuẩn bị câu truy vấn cố định
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `type_id` = 3");
        // Thực thi truy vấn
        $sql->execute();
        // Lấy kết quả
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        // Trả về danh sách sản phẩm
        return $products;
    }

    public function getProductsTypeId4() {
        // Chuẩn bị câu truy vấn cố định
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `type_id` = 4");
        // Thực thi truy vấn
        $sql->execute();
        // Lấy kết quả
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        // Trả về danh sách sản phẩm
        return $products;
    }

    public function getProductsTypeId5() {
        // Chuẩn bị câu truy vấn cố định
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `type_id` = 5");
        // Thực thi truy vấn
        $sql->execute();
        // Lấy kết quả
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        // Trả về danh sách sản phẩm
        return $products;
    }
    

    // Lấy các sản phẩm nổi bật
    public function getFeaturedProducts($limit = 10) {
        // Chuẩn bị câu lệnh SQL với LIMIT
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `feature` = 1 LIMIT ?");
        $sql->bind_param("i", $limit); // Gán giá trị $limit vào câu lệnh SQL
        $sql->execute();
        $result = $sql->get_result();
    
        // Trả về dữ liệu nếu có
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return []; // Trả về mảng rỗng nếu không có dữ liệu
    }

    public function getRecentProducts($limit = 10) {
        // Chuẩn bị câu lệnh SQL để lấy sản phẩm theo thứ tự thời gian giảm dần
        $sql = self::$connection->prepare("SELECT * FROM `products` ORDER BY `created_at` DESC LIMIT ?");
        $sql->bind_param("i", $limit); // Gán giá trị $limit vào câu lệnh SQL
        $sql->execute();
        $result = $sql->get_result();
    
        // Trả về dữ liệu nếu có
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return []; // Trả về mảng rỗng nếu không có dữ liệu
    }
    public function searchProducts($keyword, $page, $perPage) { 
        $start = ($page - 1) * $perPage;
        $sql = "SELECT * FROM products WHERE name LIKE ? LIMIT ?, ?";
        $stmt = Db::$connection->prepare($sql);
        $likeKeyword = '%' . $keyword . '%';
        $stmt->bind_param("sii", $likeKeyword, $start, $perPage);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    
    public function searchCount($keyword) {
        // Tạo câu lệnh SQL đếm số lượng sản phẩm khớp với từ khóa
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM `products` WHERE name LIKE ? ");
        
        // Chuẩn bị từ khóa tìm kiếm với ký tự đại diện '%'
        $likeKeyword = '%' . $keyword . '%';
        
        // Gắn tham số vào truy vấn
        $sql->bind_param("s", $likeKeyword);
        
        // Thực thi truy vấn
        $sql->execute();
        
        // Lấy kết quả từ truy vấn
        $result = $sql->get_result();
        
        // Lấy hàng đầu tiên của kết quả và trả về tổng số sản phẩm
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function findProductByKeyWord($keyWord, $pages, $perPage)
    {
        $start = ($pages - 1) * $perPage;
        $keyWord = "%$keyWord%";
        $sql = parent::$conn->prepare('SELECT * FROM products WHERE name LIKE ? LIMIT ?, ?');
        $sql->bind_param('sii', $keyWord, $start, $perPage);
        return parent::select($sql);
    }
    public function countProductByKeyWord($keyWord)
    {
        $keyWord = "%$keyWord%";
        $sql = parent::$conn->prepare('SELECT Count() FROM products WHERE name LIKE ?');
        $sql->bind_param('s', $keyWord);
        return parent::select($sql)[0]['Count()'];
    }
    

    public function addProduct($name, $type_id, $price, $pro_image, $description, $feature) {
        $sql = self::$connection->prepare("INSERT INTO products (name, type_id, price, pro_image, description, feature) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sisssi", $name, $type_id, $price, $pro_image, $description, $feature);
        return $sql->execute();
    }

    public function updateProduct($id, $name, $type_id, $price, $pro_image, $description, $feature) {
        $sql = self::$connection->prepare("UPDATE products SET name = ?, type_id = ?, price = ?, pro_image = ?, description = ?, feature = ? WHERE id = ?");
        $sql->bind_param("sisssii", $name, $type_id, $price, $pro_image, $description, $feature, $id);
        return $sql->execute();
    }
    
    public function deleteProduct($id) {
        $sql = self::$connection->prepare("DELETE FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
    

    public function getAllProductsLimit($offset = 0, $limit = 12) {
        $sql = "SELECT * FROM products LIMIT $offset, $limit";
        $result = self::$connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getTotalProducts() {
        $sql = "SELECT COUNT(*) AS total FROM products";
        $result = self::$connection->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
}
?>