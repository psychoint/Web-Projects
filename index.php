<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sir Ace Pogi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
  
<?php  include ('navbar.html')?>

<!--home-->
<section id="home">
    <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span> Best Prices</span> This Season</h1>
        <p> <strong>Sabon Pogi </strong>Magical soap na kapag ginamit ay popogi/gaganda agad</p>
        <button>Shop Now</button>
     </div>
</section>

<!--Brand-->

<section id="brand" class="container">
    <div class="row">
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/germ_protect_soap.jpg"/>
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/Whitening Soap.jpg"/>
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/acne_soap.jpg"/>
       

    </div>
</section>

<!--New-->
<section id="new" class="w-100">
  <div class="row p-0 m-0">
    <!--One-->
  <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class="img-fluid" src="assets/imgs/germ_protect_soap.jpg"/> 
    <div class="details">
      <h2>Germ Protect Soap</h2>
      <button class="text-uppercase"> Shop Now</button>
    </div>

  </div> 
  <!--Two-->
  <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class="img-fluid" src="assets/imgs/acne_soap.jpg"/> 
    <div class="details">
      <h2>Acne Clear Soap</h2>
      <button class="text-uppercase"> Shop Now</button>
    </div>

  </div> 

  <!--Three-->
  <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class="img-fluid" src="assets/imgs/Whitening Soap.jpg"/> 
    <div class="details">
      <h2>Whitening Soap</h2>
      <button class="text-uppercase"> Shop Now</button>
    </div>

  </div> 
</div>
</section>

<!--Featured-->
<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
<h3>Our Featured</h3>
<hr class="mx-auto">
<p> You can check out out featured products</p>
  </div>
                  
              <div class="row mx-auto container-fluid">
              <?php include ('get_featured_products.php'); ?>

                            <?php while($row = $featured_products->fetch_assoc()){?>


                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                  <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>

                  <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>

                  <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                  <h4 class="p-price">PHP<?php echo $row['product_price'];?></h4>
                  <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                  
                </div>
                <?php } ?>


  </div>
</section>

<!--Banner-->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4 style="color: white;" >MID SEASON SALE</h4>
    <h1 style="color: white;">SOAP Collection <br> UP to 30% off</h1>
    <button class="text-uppercase">Shop Now</button>
  </div>
</section>

<!--Basketball Shoes-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
<h3>Acne Soap</h3>
<hr class="mx-auto">
<p style="font-weight: bold;"> Sabon mo nato kupal</p>
  </div>

  <div class="row mx-auto container-fluid">
  <?php include ('get_basketball_shoes.php'); ?>

  <?php while($row = $basketballshoes_products->fetch_assoc()){?>

    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>

      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        
      </div>

      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price">PHP <?php echo $row['product_price'];?></h4>
      <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a></a>
     </div>
     <?php } ?>
  </div>
</section>

<!--Casual Shoes-->
<section id="casual" class="my-5">
  <div class="container text-center mt-5 py-5">
<h3>Germ Protect Soap</h3>
<hr class="mx-auto">
<p style="font-weight: bold;" > Sabon sa pwet </p>
  </div>

  <div class="row mx-auto container-fluid">
    
  <?php include ('casual_shoes.php'); ?>

<?php while($row = $casual_products->fetch_assoc()){?>


<div class="product text-center col-lg-3 col-md-4 col-sm-12">
<img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>

<div class="star">
<i class="fas fa-star"></i>
<i class="fas fa-star"></i>
<i class="fas fa-star"></i>
<i class="fas fa-star"></i>
<i class="fas fa-star"></i>
</div>

<h5 class="p-name"><?php echo $row['product_name']; ?></h5>
<h4 class="p-price">PHP<?php echo $row['product_price'];?></h4>
<a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a></div>
<?php } ?>
  </div>
</section>

<!--Running Shoes-->
<section id="running" class="my-5">
  <div class="container text-center mt-5 py-5">
<h3>Whitening Soap</h3>
<hr class="mx-auto">
<p style="font-weight: bold;">Sa soap na to magiging kupal ka</p>
  </div>


  <div class="row mx-auto container-fluid">
  <?php include ('running_shoes.php'); ?>
  <?php while($row = $running_products->fetch_assoc()){?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">

          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>

          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            
          </div>

          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">PHP <?php echo $row['product_price'];?></h4>
          <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button>
        </a></div>

        <?php } ?>

  </div>
</section>

<?php  include ('footer.html')?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>