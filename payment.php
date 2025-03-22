<?php
session_start();

include('connection.php'); // Include your database connection file

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id']; // Get order ID
    $amount = $_POST['order_cost']; // Get amount to be paid

    // Assume payment is successful for this example
    $payment_status = true; // Simulating payment success

    if ($payment_status) {
        // Update order_status in the database
        $query = "UPDATE orders SET order_status = 'paid' WHERE order_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $order_id);

        if ($stmt->execute()) {
            $message = "Payment successful! Your order status has been updated.";
        } else {
            $message = "Payment processed, but we couldn't update the order status. Please contact support.";
        }
    } else {
        $message = "Payment failed! Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

<?php include 'navbar.html'; ?>

        <!--Payment-->
        <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">
        <p>Total Payment: PHP <?php echo $_SESSION['total'];?></p>
        <div class="container mt-5">
        <h2 class="text-center">Payment Page</h2>
        <hr>
        <?php if (isset($message)): ?>
            <div class="alert alert-info text-center">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="payment.php" method="POST" class="text-center">

            </div>
            <div class="form-group mb-3">
                <label for="amount">Amount (PHP):</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
    </div>
        </section>
    

<?php include 'footer.html'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>