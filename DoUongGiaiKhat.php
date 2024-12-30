<?php
require_once "config.php";           
require "models/db.php";       
require "models/items.php";     
require "models/productypes.php"; 

// Khởi tạo các đối tượng
$product = new Product();
$protype = new ProductType();
$getAllproduct = $product->getAllProducts();
$getAllprotypes = $protype->getAllProductType();
$getFeaturedProducts = $product->getFeaturedProducts(10);
$getRecentProducts = $product->getRecentProducts(10);

$getProductsTypeId2 = $product->getProductsTypeId2();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <?php
                        if (isset($getAllprotypes) && is_array($getAllprotypes) && !empty($getAllprotypes)):
                            foreach ($getAllprotypes as $key => $value):
                                if ($value['type_id'] == 1): // Thức Ăn Nhanh
                                    ?>
                                    <a href="ThucAnNhanh.php?type_id=<?php echo urlencode($value['type_id']); ?>"
                                        class="nav-item nav-link">
                                        <?php echo htmlspecialchars($value['type_name']); ?>
                                    </a>
                                    <?php
                                elseif ($value['type_id'] == 2): // Đồ Uống Giải Khát
                                    ?>
                                    <a href="DoUongGiaiKhat.php?type_id=<?php echo urlencode($value['type_id']); ?>"
                                        class="nav-item nav-link active">
                                        <?php echo htmlspecialchars($value['type_name']); ?>
                                    </a>
                                    <?php
                                elseif ($value['type_id'] == 3): // Thức Ăn Nhẹ
                                    ?>
                                    <a href="ThucAnNhe.php?type_id=<?php echo urlencode($value['type_id']); ?>"
                                        class="nav-item nav-link">
                                        <?php echo htmlspecialchars($value['type_name']); ?>
                                    </a>
                                    <?php
                                elseif ($value['type_id'] == 4): // Thực Phẩm Đông Lạnh
                                    ?>
                                    <a href="ThucPhamDongLanh.php?type_id=<?php echo urlencode($value['type_id']); ?>"
                                        class="nav-item nav-link">
                                        <?php echo htmlspecialchars($value['type_name']); ?>
                                    </a>
                                    <?php
                                elseif ($value['type_id'] == 5): // Nguyên Liệu Nấu Ăn
                                    ?>
                                    <a href="NguyenLieuNauAn.php?type_id=<?php echo urlencode($value['type_id']); ?>"
                                        class="nav-item nav-link">
                                        <?php echo htmlspecialchars($value['type_name']); ?>
                                    </a>
                                    <?php
                                endif;
                            endforeach;
                        else: ?>
                            <p class="nav-item nav-link">Không có loại sản phẩm nào.</p>
                        <?php endif; ?>
                    </div>
                    <form action="search.php" method="GET" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Tìm sản phẩm..."
                            aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                    </form>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Đồ Uống Giải Khát</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- About Start -->
        
        <!-- About End -->
        <div class="tab-content container">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    <?php foreach ($getProductsTypeId2 as $key => $value): ?>
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
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <!-- Team Start -->
        
        <!-- Team End -->
        

        <!-- Footer Start -->
        <?php  include "footer.php" ?>

        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>