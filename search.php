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
include "header.php";
?>




<?php if (!empty($query)): ?>
    <?php if (!empty($searchResults)): ?>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-4 g-4">
                <?php foreach ($searchResults as $product): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/<?= htmlspecialchars($product['pro_image']) ?> ">

                            <div class="card-body">

                                <h5 class="card-title"><?php echo $product['name'] ?></h5>
                                <p><?= htmlspecialchars($product['description']) ?></p>

                                <p class="card-text"><?php echo $product['price'] ?></p>

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