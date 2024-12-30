<?php
class ProductType
{
    private $db;

    public function __construct()
    {
        $this->db = new Db(); // Khởi tạo đối tượng Db
    }

    public function getAllProductType()
    {
        $sql = "SELECT * FROM product_types"; // Câu lệnh SQL
        $result = Db::$connection->query($sql); // Sử dụng kết nối tĩnh

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Trả về tất cả loại sản phẩm
        } else {
            die("Error: " . Db::$connection->error); // In ra lỗi nếu có
        }
    }



    // Phương thức tìm kiếm sản phẩm theo từ khóa
    public function searchProducts($keyword)
    {
        $sql = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
        $stmt = $this->db->connection->prepare($sql); // Sử dụng prepare() để chuẩn bị câu lệnh
        $searchTerm = '%' . $keyword . '%';
        $stmt->bind_param("ss", $searchTerm, $searchTerm); // Liên kết tham số
        $stmt->execute(); // Thực thi câu lệnh
        $result = $stmt->get_result(); // Lấy kết quả

        return $result->fetch_all(MYSQLI_ASSOC); // Trả về tất cả kết quả
    }
}
