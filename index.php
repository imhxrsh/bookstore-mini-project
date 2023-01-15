<?php

include 'configs.php';

session_start();


if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 
 }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'header.html';?>

    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 style="font-size: 25px">
                        All Your Books Under One Roof</h2>
                    <h1 style="font-size:61px; color: rgb(127, 185, 221)">THE BOOKYARD</h1>
                    <h2 style="font-size: 25px">READ TO LEARN,READ TO GROW</h2>
                    <button class="know-more btn btn-primary">Know More !</button>
                </div>
            </div>
        </div>
    </section>
    <section class="container text-center my-5">
        <div class="row mx-auto">
            <div class="col-lg-4 col-md-6 col-sm-12 p-5">
                <div class="px-2">
                    <img src="assets/img/log-in.jpg" alt="like-icon" class="img-fluid">
                    <h2 class="fw-bolder text-start">
                        LOG IN
                    </h2>
                    <br>
                    <p class="text-start">
                        You need to log in to order books.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 p-5">
                <div class="px-2">
                    <img src="assets/img/global-shipping.jpg" alt="like-icon" class="img-fluid">
                    <h2 class="fw-bolder text-start">
                        FREE GLOBAL SHIPPING
                    </h2>
                    <br>
                    <p class="text-start">
                        Free delivery to India, United Kingdom, United States, Australia, New Zealand,
                        Ireland, Indonesia, Israel, Singapore and 120+ countries worldwide.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 p-5">
                <div class="px-2">
                    <img src="assets/img/book-sellers.jpg" alt="like-icon" class="img-fluid">
                    <h2 class="fw-bolder text-start">
                        Book Sellers
                    </h2>
                    <br>
                    <p class="text-start">
                        The Book Depository online store is trusted by customers around the globe.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="container text-center my-5">
        <div class="position-relative stroke-container">
            <h1>Our Books</h1>
        </div>
    </div>

        <hr>

        <p class="py-3">
            SUCCESS IS THE SUM OF SMALL EFFORTS,REPEATED DAY IN AND DAY OUT! BE COMPETITIVE, BE SMARTER
        </p>


    </section>

    <section class="quote">
        <div class="container">
            <div class="row">
                <div class="quote-text col text-center">
                    <h1>THAT'S THE THING ABOUT BOOKS</h1>
                    <h2>THEY LET YOU TRAVEL WITHOUT MOVING YOUR FEET</h2>
                    <h1>EXPLORE THE WORLD, EXPLORE NEW THINGS!</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center new-arrivals py-5 px-5 m-5">
        <div class="position-relative stroke-container ">
            <h1>New Arrivals</h1>
        </div>

        <hr>

        <p class="py-3 ">
            BUY OUR NEWLY ARRIVED BOOKS AT THE MOST DISCOUTNED PRICES AND EXPLORE THE WORLD OF KNOWLEDGE
        </p>

        <div class="d-flex flex-row justify-content-center container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                            <div class="col-lg-3 col-md-5 col m-2">
                                <div class="card text-center">
                                    <img src="assets/uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                    <h3 class="m-2"><?php echo $fetch_products['name']; ?></h3>
                                    <h4>₹<?php echo $fetch_products['price']; ?>/-</h4>
                                </div>
                            </div>
            <?php
                }
            } else {
                echo '<div>No Products added yet!</div>';
            }
            ?>
        </div>
    </section>

    <?php include 'footer.html';?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    
</body>

</html>