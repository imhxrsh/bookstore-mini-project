<?php

include '../configs.php';

session_start();


if (isset($_POST['add_product'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../assets/uploaded_img/' . $image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'product name already added';
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

        if ($add_product_query) {
            if ($image_size > 2000000) {
                $message[] = 'image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'product added successfully!';
            }
        } else {
            $message[] = 'product could not be added!';
        }
    }
}


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
    header('location:products.php');
}

if (isset($_POST['update_product'])) {

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/' . $update_old_image);
        }
    }

    header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include 'header.html';?>

    <section class="container">
        <div class="row justify-content-center py-5">
            <div class="text-center pb-3">
                <h1>Products</h1>
            </div>
            <div class="card" style="height: auto; width: 30rem;">
                <div class="justify-content-center text-center card-body add-products">
                    <h3 class="card-title p-2">ADD PRODUCTS</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="name" class="form-control p-2 m-2" placeholder="Product Name" required>
                        <input type="number" min="0" name="price" class="form-control p-2 m-2" placeholder="Product Price" required>
                        <input class="form-control m-2" name="image" accept="image/jpg, image/jpeg, image/png" type="file" required>
                        <button type="submit" value="add product" name="add_product" class="btn btn-primary m-2">Add Product</button>
                    </form>
                </div>

            </div>
    </section>

    <section class="products">
        <div class="d-flex flex-row container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                        <div class="col-lg-3 col-md-6 col m-3">
                            <div class="card text-center">

                                <img src="../assets/uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <h3 class="mt-3"><?php echo $fetch_products['name']; ?></h3>
                                <h4>₹<?php echo $fetch_products['price']; ?>/-</h4>
                                <h5><strong>Product ID -</strong>  <?php echo $fetch_products['id']; ?></h5>
                                <div class="col text-center m-3">
                                    <a href="update.php?update=<?php echo $fetch_products['id']; ?>"><button type="button" class="btn btn-primary">Update</button></a>
                                    <a href="products.php?delete=<?php echo $fetch_products['id']; ?>" onclick="return confirm('delete this product?');"><button type="button" class="btn btn-danger">Delete</button></a>
                                </div>
                            </div>
                        </div>
            <?php
                }
            } else {
                echo '<div class="container"><div class="text-center">No Products added yet!</div></div>';
            }
            ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>