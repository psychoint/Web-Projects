<?php
session_start();

// Initialize the cart session if it hasn't been set
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product ID from POST
$product_id = $_POST['product_id'] ?? null;

// Add product to cart if not in cart yet
if ($product_id && !isset($_POST['remove_product']) && !isset($_POST['edit_quantity'])) {
    // Create an array of product IDs from the current cart
    $product_array_ids = array_column($_SESSION['cart'], "product_id");

    // Check if the product has already been added to the cart
    if (!in_array($product_id, $product_array_ids)) {
        // Create a new product array from POST data
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );

        // Add the new product to the cart
        $_SESSION['cart'][] = $product_array;
    } else {
        echo '<script>alert("Product was already added to the cart")</script>';
    }
}

// Update quantity in cart
if (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // Loop through cart to find and update the product by ID
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] == $product_id) {
            $_SESSION['cart'][$key]['product_quantity'] = $product_quantity;
            break;
        }
    }
    // Recalculate total after updating quantity
    calculateTotalCart();
}

// Remove product from cart
if (isset($_POST['remove_product'])) {
    $product_id_to_remove = $_POST['product_id'];

    // Loop through cart to find and remove the product by ID
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] == $product_id_to_remove) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    // Recalculate total after removing product
    calculateTotalCart();
}

// Calculate total function
function calculateTotalCart() {
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $price = $value['product_price'];
        $quantity = $value['product_quantity'];
        
        $total += ($price * $quantity);
    }
    $_SESSION['total'] = $total;
}

// Calculate total at the beginning to show it on the page
calculateTotalCart();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>



 <!--navbar-->
 <?php include 'navbar.html'; ?>

<!--Cart-->
<section class="cart container my-5 py-5">
<div class="container">
  <h2 class="font-weight-bolde">Your Cart</h2>
  <hr>
</div>
<table class="mt-5 pt-5">
  <tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Subtotal</th>
  </tr>

  <?php foreach ($_SESSION['cart'] as $key => $value) {
    if (empty($value['product_id'])) {
        continue; // Skip empty entries
    }
?>
<tr>
    <td>
        <div class="product-info">
            <img src="assets/imgs/<?php echo $value['product_image']; ?>"/>
            <div>
                <p><?php echo $value['product_name']; ?></p>
                <small><span>₱</span><?php echo $value['product_price']; ?></small>
                <br>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                    <input type="submit" name="remove_product" class="remove-btn" value="Remove">
                </form>
            </div>
        </div>
    </td>
    <td>
    <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
        <input type="submit" class="edit-btn" value="Edit" name="edit_quantity"/>
    </form>
</td>

    <td>
        <span>₱</span>
        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
    </td>
</tr>
<?php } ?>

</table>

<div class="cart-total">
  <table>

    <tr>
      <td>Total</td>
      <td>₱ <?php echo $_SESSION['total']; ?></td>
    </tr>
  </table>
</div>

<div class="checkout-container">
    <form method="POST" action="checkout.php">
        <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
    </form>
</div>

</section>

<!--Footer-->
<?php include 'footer.html'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>