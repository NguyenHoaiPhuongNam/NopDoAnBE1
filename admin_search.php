<?php
require "config.php";
require "models/db.php";
require "models/items.php";

// Khởi tạo đối tượng Product
$product = new Product();

// Lấy từ khóa tìm kiếm từ URL
$query = isset($_GET['query']) ? htmlspecialchars(trim($_GET['query'])) : ''; // Lọc và loại bỏ khoảng trắng

// Khởi tạo biến cho kết quả tìm kiếm
$searchResults = [];
$totalResults = 0;
$page = $_GET['page'] ?? 1;
$perPage = 8;
$total = $product->searchCount($query);
$pages = ceil($total / $perPage);
// Gọi hàm tìm kiếm và đếm số lượng sản phẩm nếu từ khóa không rỗng
if (!empty($query)) {
    $searchResults = $product->searchProducts($query, $page, $perPage); // Lấy danh sách sản phẩm
    $totalResults = $product->searchCount($query);    // Đếm số lượng sản phẩm
}
include "admin_header.php";
?>




<?php if (!empty($query)): ?>
    <?php if (!empty($searchResults)): ?>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-4 g-4">
            <?php foreach ($searchResults as $product => $value): ?>
                                <div class="col-lg-6">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="row g-0">
                                            <div class="col-3">
                                                <img class="img-fluid rounded-start" 
                                                    src="img/<?php echo $value['pro_image']; ?>" 
                                                    alt="<?php echo $value['name']; ?>" 
                                                    style="width: 100%; object-fit: cover;">
                                            </div>
                                            <div class="col-9">
                                                <div class="card-body">
                                                    <h5 class="card-title text-primary"><?php echo $value['name']; ?></h5>
                                                    <p class="card-text mb-2 text-muted">
                                                        <?php echo $value['description']; ?>
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="text-danger fw-bold"><?php echo $value['price']; ?>₫</span>
                                                        <a href="admin_editproduct.php?id=<?php echo $value['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                                        <a href="admin_removeproduct.php?id=<?php echo $value['id']; ?>" 
                                                            onclick="return confirm('Are you sure you want to delete this product?');" 
                                                            class="btn btn-sm btn-outline-danger">Delete</a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
            </div>
        </div>



    <?php else: ?>
        <!-- <p class="text-danger">Không tìm thấy sản phẩm nào phù hợp với từ khóa "<?= htmlspecialchars($query) ?>".</p> -->
    <?php endif; ?>
<?php else: ?>
    <p class="text-warning">Vui lòng nhập từ khóa để tìm kiếm sản phẩm.</p>
<?php endif; ?>
<nav aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center mt-5">
        <?php if ($page > 1): ?>
            <li class="page-item"><a class="page-link" href="search.php?query=c&page=<?php echo $page - 1?>">Previous</a>
            </li>
        <?php endif; ?>
        <?php
        for ($i = 1; $i <= $pages; $i++):
            ?>
            <li class="page-item"><a class="page-link" href="search.php?query=c&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        endfor;
        ?>
        <?php if ($page < $pages): ?>
            <li class="page-item"><a class="page-link" href="search.php?query=c&page=<?php echo $page + 1 ?>">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php include "footer.php"; ?>