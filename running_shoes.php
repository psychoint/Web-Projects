<?php 
include 'connection.php';
$stmt = $conn -> prepare("SELECT * FROM products WHERE product_category = 'whitening' LIMIT 4");
$stmt -> execute();

$running_products = $stmt->get_result();

?>