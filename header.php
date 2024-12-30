<!--header-->
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
                <a href="index.php" class="navbar-brand p-0">
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

                        <a href="./login/index.php" class="btn btn-secondary">Đăng Nhập</a>


                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
            </div>
        </div>
        <!-- Navbar & Hero End -->