<?php 

session_start();
include('connection.php');

if(!isset($_SESSION['logged_in'])){
header('location: login.php');
exit;

}

        if(isset($_GET['logout'])){
          if(isset($_SESSION['logged_in'])){
            unset($_SESSION['logged_in']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']); 
            header('location:login.php');
            exit;
          } 
        }

        if(isset($_POST['change_password'])){
          $password = $_POST['password'];
          $confirmPassword = $_POST['confirmPassword'];
          $user_email = $_SESSION['user_email'];
          if($password !== $confirmPassword ){
            header('location:account.php?error="Password dont match');


        //if password less than 6 characters
        }else if(strlen($password)< 6){
            header('location:account.php?error=password must be atleast 6 characters');
        }else{
          $stmt = $conn -> prepare("UPDATE users SET user_password=? WHERE user_email=?");
          $stmt ->bind_param('ss',$password, $user_email);
   
   
          if($stmt ->execute()){
            header('location:account.php?message=password has been updated successfully');
          }else{
            header('location:account.php?error=could not update password');

          }
        }
        }



        //get orders

        if(isset($_SESSION['logged_in'])){
          
          $user_id = $_SESSION['user_id'];

          $stmt = $conn -> prepare("SELECT * FROM orders WHERE user_id =?");
          
          $stmt->bind_param('i', $user_id);
          
          $stmt -> execute();

          $orders = $stmt->get_result();

        }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

<?php  include ('navbar.html')?>

<!--Account-->
<section class="my-5 py-5">
<div class="row container mx-auto">
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
    <p class="text-center" style="color:green"> <?php if(isset($_GET['register_success'])){ echo $_GET['register_success'];}?></p>
    <p class="text-center" style="color:green"> <?php if(isset($_GET['login_success'])){ echo $_GET['login_success'];}?></p>


        <h3 class="font-weight-bold">Account Info</h3>
        <hr class="mx-auto"/>
        <div class="account-info">
<p>Name: <span> <?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?> </span></p>
<p>Email: <span> <?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];}?> </span></p>
<p><a href="#orders" id="orders-btn">Your Orders</a></p>
<p><a href="account.php?logout=1" id="logout-btn">Log-out</a></p>

        </div>
    </div>


    <div class="col-lg-6 col-md-12 col-sm-12">
        <form id="account-form" method="POST" action="account.php">
          <p class="text-center" style="color:red"> <?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
          <p class="text-center" style="color:green"> <?php if(isset($_GET['message'])){ echo $_GET['message'];}?></p>

            <h3>Change Password</h3>
            <hr class="mx-auto"/>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required/>
            </div>
            <div class="form-group">
                <label> Confirm Password</label>
                <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required/>
            </div>
            <div class="form-group">
                <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn"/>
            </div>
        </form>
    </div>
</div>
</section>


<!--Orders-->

<section id="orders" class="orders container my-2 py-3">
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">Your Orders</h2>
      <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
      <tr>
        <th>Order Id</th>
        <th>Order Cost</th>
        <th>Order status</th>
        <th>Order Date</th>
        <th>Order Details</th>

      </tr>

      <?php while ($row = $orders->fetch_assoc()){?>
              <tr>
                    <td>
                      <!-- <div >
                         <img src="assets/imgs/panda1.png"/>
                         
                        <div>
                            <p class="mt-3"><?php echo $row['order_id']; ?></p>
                        </div>
                      </div> -->
                      <span><?php echo $row['order_id']; ?></span>

                    </td>
                <td>
                  <span><?php echo $row['order_cost']; ?></span>
                </td>
                <td>
                  <span><?php echo $row['order_status']; ?></span>
                </td>
                  
                <td>
                <span><?php echo $row['order_date']; ?></span>
                </td>
                  <td>
                    <form method="POST" action="order_details.php">
                      <input type="hidden" value="<?php  echo $row['order_status'];?>" name="order_status"/>

                      <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id"/>
                      
                      <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details"/>
                    </form>
                  </td>
              </tr> 
            <?php } ?>
    </table>
    
    </section>



<!--Footer-->
<?php include ('footer.html')?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>