<?php
require 'models/db.php';
require 'models/items.php';
require 'config.php';

$id = $_GET['id'];
$product = new Product();
$product->deleteProduct($id);

header("Location: admin_products.php");
