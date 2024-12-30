-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 25, 2024 lúc 04:19 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create database `doan_nhom1`;
use `doan_nhom1`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan_nhom1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufactures`
--

CREATE TABLE `manufactures` (
  `manu_id` int(11) NOT NULL,
  `manu_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manufactures`
--

INSERT INTO `manufactures` (`manu_id`, `manu_name`) VALUES
(1, 'Hãng A'),
(2, 'Hãng B'),
(3, 'Hãng C'),
(4, 'Hãng D'),
(5, 'Hãng E');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `manu_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `pro_image` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `feature` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `manu_id`, `type_id`, `price`, `pro_image`, `description`, `feature`, `created_at`) VALUES
(1, 'Burger Classic', 1, 1, 50000, 'burger_classic.jpg', 'Bánh burger vị cổ điển.', 1, '2024-12-12 07:35:22'),
(2, 'Pizza Margherita', 2, 1, 120000, 'pizza_margherita.jpg', 'Pizza phô mai tươi ngon.', 1, '2024-12-12 07:35:22'),
(3, 'Hotdog', 3, 1, 40000, 'hotdog.jpg', 'Hotdog thơm ngon, tiện lợi.', 0, '2024-12-12 07:35:22'),
(4, 'Sandwich', 1, 1, 30000, 'sandwich.jpg', 'Bánh mì sandwich mềm mại.', 0, '2024-12-12 07:35:22'),
(5, 'Taco', 4, 1, 45000, 'taco.jpg', 'Taco với nhân thịt bò đặc biệt.', 1, '2024-12-12 07:35:22'),
(6, 'Fried Chicken', 5, 1, 70000, 'fried_chicken.jpg', 'Gà rán giòn tan.', 1, '2024-12-12 07:35:22'),
(7, 'French Fries', 3, 1, 20000, 'french_fries.jpg', 'Khoai tây chiên giòn.', 0, '2024-12-12 07:35:22'),
(8, 'Spring Roll', 2, 1, 35000, 'spring_roll.jpg', 'Chả giò truyền thống.', 0, '2024-12-12 07:35:22'),
(9, 'Noodles', 4, 1, 40000, 'noodles.jpg', 'Mì xào đậm vị.', 1, '2024-12-12 07:35:22'),
(10, 'Dumplings', 5, 1, 45000, 'dumplings.jpg', 'Há cảo thơm ngon.', 0, '2024-12-12 07:35:22'),
(11, 'Coca Cola', 1, 2, 10000, 'coca_cola.jpg', 'Nước ngọt có ga phổ biến.', 1, '2024-12-12 07:35:22'),
(12, 'Pepsi', 2, 2, 10000, 'pepsi.jpg', 'Đồ uống giải khát yêu thích.', 1, '2024-12-12 07:35:22'),
(13, 'Orange Juice', 3, 2, 20000, 'orange_juice.jpg', 'Nước cam tươi ngon.', 1, '2024-12-12 07:35:22'),
(14, 'Lemonade', 4, 2, 15000, 'lemonade.jpg', 'Nước chanh thanh mát.', 0, '2024-12-12 07:35:22'),
(15, 'Green Tea', 5, 2, 12000, 'green_tea.jpg', 'Trà xanh vị ngọt.', 1, '2024-12-12 07:35:22'),
(16, 'Black Coffee', 1, 2, 15000, 'black_coffee.jpg', 'Cà phê đen đậm vị.', 0, '2024-12-12 07:35:22'),
(17, 'Latte', 2, 2, 25000, 'latte.jpg', 'Cà phê sữa latte.', 1, '2024-12-12 07:35:22'),
(18, 'Smoothie', 3, 2, 30000, 'smoothie.jpg', 'Sinh tố trái cây tươi.', 0, '2024-12-12 07:35:22'),
(19, 'Energy Drink', 4, 2, 20000, 'energy_drink.jpg', 'Đồ uống năng lượng.', 1, '2024-12-12 07:35:22'),
(20, 'Milkshake', 5, 2, 25000, 'milkshake.jpg', 'Sữa lắc hương vị.', 0, '2024-12-12 07:35:22'),
(21, 'Potato Chips', 1, 3, 15000, 'potato_chips.jpg', 'Snack khoai tây giòn tan.', 1, '2024-12-12 07:35:22'),
(22, 'Chocolate Bar', 2, 3, 25000, 'chocolate_bar.jpg', 'Thanh chocolate hảo hạng.', 0, '2024-12-12 07:35:22'),
(23, 'Popcorn', 3, 3, 20000, 'popcorn.jpg', 'Bỏng ngô bơ ngọt.', 1, '2024-12-12 07:35:22'),
(24, 'Biscuits', 4, 3, 12000, 'biscuits.jpg', 'Bánh quy thơm ngon.', 0, '2024-12-12 07:35:22'),
(25, 'Granola Bar', 5, 3, 30000, 'granola_bar.jpg', 'Thanh granola dinh dưỡng.', 1, '2024-12-12 07:35:22'),
(26, 'Candy', 1, 3, 10000, 'candy.jpg', 'Kẹo ngọt nhiều hương vị.', 0, '2024-12-12 07:35:22'),
(27, 'Trail Mix', 2, 3, 35000, 'trail_mix.jpg', 'Hỗn hợp hạt khô và trái cây.', 1, '2024-12-12 07:35:22'),
(28, 'Pretzels', 3, 3, 20000, 'pretzels.jpg', 'Bánh pretzel mặn.', 0, '2024-12-12 07:35:22'),
(29, 'Dried Fruits', 4, 3, 40000, 'dried_fruits.jpg', 'Trái cây sấy khô.', 1, '2024-12-12 07:35:22'),
(30, 'Cheese Crackers', 5, 3, 18000, 'cheese_crackers.jpg', 'Bánh quy phô mai.', 0, '2024-12-12 07:35:22'),
(31, 'Frozen Pizza', 1, 4, 100000, 'frozen_pizza.jpg', 'Pizza đông lạnh tiện lợi.', 1, '2024-12-12 07:35:22'),
(32, 'Ice Cream', 2, 4, 50000, 'ice_cream.jpg', 'Kem lạnh nhiều vị.', 0, '2024-12-12 07:35:22'),
(33, 'Frozen Vegetables', 3, 4, 30000, 'frozen_vegetables.jpg', 'Rau củ đông lạnh.', 1, '2024-12-12 07:35:22'),
(34, 'Frozen Dumplings', 4, 4, 45000, 'frozen_dumplings.jpg', 'Há cảo đông lạnh.', 0, '2024-12-12 07:35:22'),
(35, 'Frozen Fish', 5, 4, 80000, 'frozen_fish.jpg', 'Cá đông lạnh chất lượng.', 1, '2024-12-12 07:35:22'),
(36, 'Frozen Chicken', 1, 4, 75000, 'frozen_chicken.jpg', 'Gà đông lạnh.', 0, '2024-12-12 07:35:22'),
(37, 'Frozen Beef', 2, 4, 90000, 'frozen_beef.jpg', 'Thịt bò đông lạnh.', 1, '2024-12-12 07:35:22'),
(38, 'Ice Cubes', 3, 4, 20000, 'ice_cubes.jpg', 'Đá viên sạch.', 0, '2024-12-12 07:35:22'),
(39, 'Frozen Shrimp', 4, 4, 85000, 'frozen_shrimp.jpg', 'Tôm đông lạnh.', 1, '2024-12-12 07:35:22'),
(40, 'Frozen Sausage', 5, 4, 60000, 'frozen_sausage.jpg', 'Xúc xích đông lạnh.', 0, '2024-12-12 07:35:22'),
(41, 'Rice', 1, 5, 20000, 'rice.jpg', 'Gạo trắng chất lượng cao.', 1, '2024-12-12 07:35:22'),
(42, 'Cooking Oil', 2, 5, 50000, 'cooking_oil.jpg', 'Dầu ăn tinh khiết.', 1, '2024-12-12 07:35:22'),
(43, 'Salt', 3, 5, 10000, 'salt.jpg', 'Muối biển tự nhiên.', 0, '2024-12-12 07:35:22'),
(44, 'Sugar', 4, 5, 15000, 'sugar.jpg', 'Đường trắng tinh luyện.', 0, '2024-12-12 07:35:22'),
(45, 'Flour', 5, 5, 25000, 'flour.jpg', 'Bột mì làm bánh.', 1, '2024-12-12 07:35:22'),
(46, 'Soy Sauce', 1, 5, 30000, 'soy_sauce.jpg', 'Nước tương đậm đà.', 1, '2024-12-12 07:35:22'),
(47, 'Vinegar', 2, 5, 20000, 'vinegar.jpg', 'Giấm lên men tự nhiên.', 0, '2024-12-12 07:35:22'),
(48, 'Spices', 3, 5, 40000, 'spices.jpg', 'Gia vị đa dạng, phong phú.', 1, '2024-12-12 07:35:22'),
(49, 'Fish Sauce', 4, 5, 35000, 'fish_sauce.jpg', 'Nước mắm nguyên chất.', 0, '2024-12-12 07:35:22'),
(50, 'Chili Powder', 5, 5, 25000, 'chili_powder.jpg', 'Bột ớt cay nồng.', 1, '2024-12-12 07:35:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_types`
--

CREATE TABLE `product_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_types`
--

INSERT INTO `product_types` (`type_id`, `type_name`) VALUES
(1, 'Thức ăn nhanh'),
(2, 'Đồ uống giải khát'),
(3, 'Thức ăn nhẹ'),
(4, 'Thực phẩm đông lạnh'),
(5, 'Nguyên liệu nấu ăn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `address` text NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `name`, `date`, `address`, `role`) VALUES
(1, 'phuongnam', '12345678', 'Nguyễn Hoài Phương Nam', '0000-00-00', 'Vo Van Ngan', 'Admin'),
(2, 'phuongnam', '12345678', 'Nam dep trai', '2024-12-10', 'vo van ngan', 'admin'),
(3, 'nhanvien1', '12345678', 'bao ve', '2024-12-09', 'le van viet', 'nhanvien');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`manu_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `manu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `product_types`
--
ALTER TABLE `product_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
