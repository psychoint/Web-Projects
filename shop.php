<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <title>Shop</title>
    <style>
    /* Flexbox for main container */
    .main-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    /* Search Section (Sticky) */
    #search {
        flex: 1;
        max-width: 30%;
        position: sticky; /* Make the search section sticky */
        top: 20px; /* Distance from the top of the viewport */
        align-self: start; /* Ensure it aligns to the top of the container */
        height: fit-content; /* Prevent unnecessary stretching */
    }

    /* Product Sections */
    .product-sections {
        flex: 2;
        max-width: 70%;
    }
</style>

</head>
<body>
<?php include('navbar.html'); ?>

<!-- Main Container -->
<div class="main-container my-5 py-5">
    <!-- Search Section -->
    <section id="search" class="ms-2">
        <div class="container">
            <p>Search Products</p>
            <hr>
        </div>
        <form>
            <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Category</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_one">
                        <label class="form-check-label" for="flexRadioDefault1">Shoes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_two" checked>
                        <label class="form-check-label" for="flexRadioDefault2">Coats</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_two" checked>
                        <label class="form-check-label" for="flexRadioDefault2">Watches</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="category_two" checked>
                        <label class="form-check-label" for="flexRadioDefault2">Bags</label>
                    </div>
                </div>
            </div>

            <div class="row mx-auto container mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Price</p>
                    <input type="range" class="form-range w-50" min="1" max="1000" id="customRange2">
                    <div class="w-50">
                        <span style="float: left;">1</span>
                        <span style="float:right;">1000</span>
                    </div>
                </div>
            </div>
            <div class="form-group my-3 mx-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>
        </form>
    </section>

    <!-- Product Sections -->
    <div class="product-sections">
        <!-- Basketball Shoes Section -->
        <section id="featured">
            <div class="container text-center">
                <h3>Basketball Shoes</h3>
                <hr class="mx-auto">
                <p style="font-weight: bold;">Check out some Basketball shoes for better performance in court</p>
            </div>
            <div class="row mx-auto container-fluid">
                <?php include ('get_basketball_shoes.php'); ?>
                <?php while($row = $basketballshoes_products->fetch_assoc()){ ?>
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
                        <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- Casual Shoes Section -->
        <section id="casual" class="my-5">
            <div class="container text-center">
                <h3>Casual Shoes</h3>
                <hr class="mx-auto">
                <p style="font-weight: bold;">Check out some Casual Shoes to match your style</p>
            </div>
            <div class="row mx-auto container-fluid">
                <?php include ('casual_shoes.php'); ?>
                <?php while($row = $casual_products->fetch_assoc()){ ?>
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
                        <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- Running Shoes Section -->
        <section id="running" class="my-5">
            <div class="container text-center">
                <h3>Running Shoes</h3>
                <hr class="mx-auto">
                <p style="font-weight: bold;">Run with precision with NIKKI running Shoes</p>
            </div>
            <div class="row mx-auto container-fluid">
                <?php include ('running_shoes.php'); ?>
                <?php while($row = $running_products->fetch_assoc()){ ?>
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
                        <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php include('footer.html'); ?>
</body>
</html>
