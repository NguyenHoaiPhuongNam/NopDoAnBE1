<?php
// Kiểm tra nếu ID được truyền qua URL
if (isset($_GET['id'])) {
    $product_id = (int) $_GET['id']; // Ép kiểu để tránh lỗi bảo mật

    // Kết nối tới database
    require "config.php";
    require "models/db.php";
    require "models/items.php";
    require "models/productypes.php";
    $protype = new ProductType();
    $product = new Product();
    $getAllprotypes = $protype->getAllProductType();
    $item = $product->getProductById($product_id); // Thêm phương thức này trong model

    if ($item) {
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
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->

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
                        <a href="index.php" class="nav-item nav-link active">Home</a>
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
                                        class="nav-item nav-link">
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

                        <a href="cart_view.php" class="nav-link">
                            Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
                        </a>


                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
            </div>
        </div>
        <!-- Navbar & Hero End -->
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-6">
                        <img src="img/<?php echo htmlspecialchars($item['pro_image']); ?>" 
                             class="img-fluid rounded" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    </div>
                    <div class="col-md-6">
                        <h1><?php echo htmlspecialchars($item['name']); ?></h1>
                        <p class="text-muted"><?php echo htmlspecialchars($item['description']); ?></p>
                        <h3 class="text-danger"><?php echo number_format($item['price']); ?>₫</h3>
                        <!-- Thêm nút Add to Cart -->
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control" style="width: 100px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Reservation</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Saturday</h5>
                        <p>09AM - 09PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 08PM</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <?php
    } else {
        echo "<p>Product not found.</p>";
    }
} else {
    echo "<p>No product ID provided.</p>";
}
?>
