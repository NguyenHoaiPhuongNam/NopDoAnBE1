<?php
            require 'models/db.php';
            require 'models/items.php';
            require 'config.php';
            $product = new Product();
            $products = $product->getAllProducts();
            include "admin_header.php";   
?>




        

        <!-- Menu Start -->
    <div class="container-xxl py-5">
        <div class="">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                <h1 class="mb-5">All Items</h1>
            </div>
            
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                            <i class="fa fa-coffee fa-2x text-primary"></i>
                            <div class="ps-3">
                                <small class="text-body">Featured</small>
                                <h6 class="mt-n1 mb-0">Best Choice</h6>
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
                    <div class="text-start mb-4 ml-5">
                            <!-- Nút Add Product -->
                        <a href="admin_addproduct.php" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Thêm Sản Phẩm
                        </a>
                    </div>
                    <!-- Featured Products Tab -->
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <?php foreach ($products as $key => $value): ?>
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
                                                        <a href="admin_deleteproduct.php?id=<?php echo $value['id']; ?>" 
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

                    <!-- Others Tab -->
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <p class="text-muted">Coming Soon...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
