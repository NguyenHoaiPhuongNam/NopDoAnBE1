<?php 
// require "config.php";           
// require "models/db.php";       
// require "models/items.php";     
// require "models/productypes.php"; 

// Khởi tạo các đối tượng
// $product = new Product();
// $protype = new ProductType();

// Số bản ghi trên mỗi trang
$records_per_page = 10;

// Lấy số trang từ URL, nếu không có thì mặc định là 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Tính toán offset
$offset = ($page - 1) * $records_per_page;

// Cập nhật truy vấn SQL để lấy dữ liệu với phân trang
$getAllproduct = $product->getAllProducts($offset, $records_per_page); // Cập nhật phương thức để hỗ trợ phân trang

// Lấy tổng số sản phẩm để tính số trang
// $total_records = $product->getTotalProducts(); // Thêm phương thức này trong model để lấy tổng số sản phẩm
// $total_pages = ceil($total_records / $records_per_page);

// Lấy sản phẩm nổi bật và gần đây
$getFeaturedProducts = $product->getFeaturedProducts(10);
$getRecentProducts = $product->getRecentProducts(10);

// Bao gồm các tệp giao diện
// include "header.php";
?>
<div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam
                                dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed
                                stet lorem sit clita duo justo magna dolore erat amet</p>
                            <a href="" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A
                                Table</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="img/hero.png" alt="">
                        </div>
                    </div>
                </div>
 </div>

<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Most Popular Items</h1>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                        href="#tab-1">
                        <i class="fa fa-coffee fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Featured</small>
                            <h6 class="mt-n1 mb-0">Best choice</h6>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                        <i class="fa fa-hamburger fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Others</small>
                            <h6 class="mt-n1 mb-0">Stuff</h6>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content container">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php foreach ($getFeaturedProducts as $key => $value): ?>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded"
                                        src="img/<?php echo $value['pro_image']; ?>" 
                                        alt="<?php echo htmlspecialchars($value['name']); ?>" 
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <a href="product_detail.php?id=<?php echo $value['id']; ?>">
                                                <span><?php echo htmlspecialchars($value['name']); ?></span>
                                            </a>
                                            <span class="text-primary"><?php echo number_format($value['price']); ?>₫</span>
                                        </h5>
                                        <small class="fst-italic"><?php echo htmlspecialchars($value['description']); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php foreach ($getRecentProducts as $key => $value): ?>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded"
                                        src="img/<?php echo $value['pro_image']; ?>" 
                                        alt="<?php echo htmlspecialchars($value['name']); ?>" 
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <a href="product_detail.php?id=<?php echo $value['id']; ?>">
                                                <span><?php echo htmlspecialchars($value['name']); ?></span>
                                            </a>
                                            <span class="text-primary"><?php echo number_format($value['price']); ?>₫</span>
                                        </h5>
                                        <small class="fst-italic"><?php echo htmlspecialchars($value['description']); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
