<!--index của log in -->
<?php
include "../config.php";
include "../models/db.php";
require "../models/user.php";
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginNam'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$employees = "nhanvien";
	$admin = "admin";

	if ($user->getAccount($username, $password, $employees)) {
		header("Location: ../index.php");
		exit();
	} elseif ($user->getAccount($username, $password, $admin)) {
		header("Location: ../admin_products.php");
		exit();
	} else {
		$message = "Tên đăng nhập hoặc mật khẩu không đúng.";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
	<link rel='stylesheet' href="./style.css">
</head>

<body>
	<div class="container">
		<div class="screen">
			<div class="screen__content">
				<form class="login" action="" method="post">
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input type="text" name="username" class="login__input" placeholder="User name / Email"
							required>
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input type="password" name="password" class="login__input" placeholder="Password" required>
					</div>
					<button name="loginNam" type="submit" class="button login__submit">
						<span class="button__text">Log In Now</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>

					<a href="signup.php" class="">Sign Up</a>

				</form>
				<?php if (!empty($message)): ?>
					<p style="color: red; text-align: center;"><?php echo $message; ?></p>
				<?php endif; ?>
				<div class="social-login">
					<h3>log in via</h3>
					<div class="social-icons">
						<a href="#" class="social-login__icon fab fa-instagram"></a>
						<a href="#" class="social-login__icon fab fa-facebook"></a>
						<a href="#" class="social-login__icon fab fa-twitter"></a>
					</div>
				</div>
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