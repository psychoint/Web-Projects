
<?php

session_start();
include ('connection.php');

if (isset($_POST['place_order'])){


//get user info and store it in the database
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$address = $_POST['address'];
$order_cost = $_SESSION['total'];
$order_status = "not paid";
$user_id = $_SESSION['user_id'];
$order_date = date('Y-m-d H:i:s');



$stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                    VALUE (?,?,?,?,?,?,?); ");

$stmt->bind_param('isiiiss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
$stmt->execute();

//issue new order and store order info in database
$order_id = $stmt->insert_id;


// get products from cart (from session )
foreach($_SESSION['cart'] as $key => $value){

    $product = $_SESSION['cart'][$key]; // Retrieve product details from the session
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];
    
    
//store each single item in order_items database
$stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image , product_price, product_quantity, user_id, order_date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param("iissiiis", $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

    $stmt1->execute();
    
    
}



//remove everything from the cart --> delay until the payment is done
//unset($_SESSION['cart']);


//inform user whether everything is fine or there is a problem 
header('location:payment.php?order_status="order placed successfully');

}


?>