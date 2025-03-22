<?php 
include 'connection.php';
$stmt = $conn -> prepare("SELECT * FROM products WHERE product_category = 'acne' LIMIT 4");
$stmt -> execute();

$basketballshoes_products = $stmt->get_result();

?>