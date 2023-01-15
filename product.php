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
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'header.html';?>

    <section class="text-center new-arrivals px-5">
        <div class="position-relative stroke-container">
            <h1>Our Books</h1>
        </div>

        <p class="py-3">
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
                                    <div class="col text-center m-3">
                                    <form action="checkout.php" method="post">
                                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                                        <button type="submit" value="Buy Now" name="buy_now" class="btn btn-primary">Buy Now</button>
                                    </form>
                                    </div>
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