<?php 
session_start();

include('connection.php');

                //if user has already registered, then take user to account page
             if(isset($_SESSION['logged_in'])){
                header('location:account.php');
                exit;
            }

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
//if password dont match
    if($password !== $confirmPassword ){
        header('location:register.php?error="Password dont match');
    

//if password less than 6 characters
    }else if(strlen($password)< 6){
        header('location:register.php?error=password must be atleast 6 characters');
    
    //if theres no error
    }else {
                //check whether there is a user with this email or not 
                $stmt1 = $conn ->prepare("SELECT count(*) FROM users where user_email=?");
                $stmt1->bind_param('s', $email);
                $stmt1->execute();
                $stmt1->bind_result($num_rows);
                $stmt1->store_result(); 
                $stmt1->fetch();
                //if there is a user already register with this email
                if ($num_rows !=0){
                    header('location:register.php?error=user with this email is already exist');
                    //if there is no user registered with this email before
                } else{
                        //create new user
                            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password)
                                            VALUES (?,?,?)");

                            $stmt->bind_param('sss', $name,$email,$password);

                            //if account was created successfully
                            if($stmt->execute()){
                                $user_id = $stmt->insert_id;
                                $_SESSION['user_id'] = $user_id;
                                $_SESSION['user_email'] = $email;
                                $_SESSION['name'] = $name;
                                $_SESSION['logged_in'] = true;
                                header('location: account.php?register_success="You registered successfully');
                            
                            //account could not be created
                            }else{
                                header('location:register.php?error="could not create an account at the moment');
                            }
                        }
            }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

<?php  include ('navbar.html')?>

<!--Login-->
<section class="my-5 py-5">
<div class="container text-center mt-3 pt-5">
    <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
    <h2 class="form-weight-bold">Register</h2>
    <hr class="mx-auto">
</div>
<div class="mx-auto container">
    <form id="register-form" method="POST" action="register.php">
    <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
        </div>

        <div class="form-group">
            <input type="submit" class="btn" id="register-btn" name="register" value="Register" />
        </div>

        <div class="form-group">
         <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
        </div>

    </form>
</div>
</section>









<!--Footer-->
<?php include ('footer.html')?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>