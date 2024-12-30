<?php
// Kết nối cơ sở dữ liệu và bắt đầu session
include "../config.php";
include "../models/db.php";
require "../models/user.php";

$user = new User();

// Kiểm tra nếu form đăng ký đã được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Gọi phương thức addAccount để thêm tài khoản mới
    $message = $user->addAccount($username, $password, $role);

    // Kiểm tra nếu tài khoản đã được tạo thành công
    if ($message == "Account created successfully!") {
        // Chuyển hướng sang trang index.php khi đăng ký thành công
        header("Location: index.php?message=" . urlencode($message));
        exit; // Dừng thực thi mã tiếp theo
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up Page</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href="./style.css">
</head>

<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" action="signup.php" method="post">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" name="username" class="login__input" placeholder="User name" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" name="password" class="login__input" placeholder="Password" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <select name="role" class="login__input" required>
                            <option value="nhanvien">Nhân viên</option>
                        </select>
                    </div>

                    <button name="signup" type="submit" class="button login__submit">
                        <span class="button__text">Sign Up Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>

                <!-- Thông báo lỗi hoặc thành công -->
                <?php if (isset($message)): ?>
                    <p style="color: red; text-align: center;"><?php echo $message; ?></p>
                <?php endif; ?>
            </div>

            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>

</html>