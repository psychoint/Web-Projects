<?php 
include('connection.php');

/* 
not paid 
shipped
delivered


*/

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];

    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    
    $stmt ->bind_param('i', $order_id);
    
    $stmt ->execute();
    
    $order_details = $stmt->get_result();
}else{ 
 header('location: account.php');
 exit;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

<?php  include ('navbar.html')?>

<!--Order details-->
<section id="orders" class="orders container my-2 py-3">
    <div class="container mt-5">
      <h2 class="font-weight-bold text-center">Order Details</h2>
      <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5 mx-auto">
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
      </tr>

      <?php while ($row = $order_details->fetch_array()){ ?>
              <tr>
                    <td>
                      <div class="product-info" >
                         <img src="assets/imgs/<?php echo $row['product_image'];?>"/>
                         
                        <div>
                            <p class="mt-3"><?php echo $row['product_name']; ?></p>
                        </div>
                      </div> 

                    </td>
                <td>
                  <span><?php echo $row['product_price']; ?></span>
                </td>
                <td>
                  <span><?php echo $row['product_quantity']; ?></span>
                </td>
                  
              </tr> 
              <?php } ?>

    </table>
        <?php 
        if($order_status == "not paid"){ ?>

            <form style="float: right;">
              
              <input type="submit" class="btn btn-primary" value="Pay Now">

            </form>
        <?php } ?>

    </section>


<?php include ('footer.html')?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>