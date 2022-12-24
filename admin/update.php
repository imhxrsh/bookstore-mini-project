<?php

include '../configs.php';

session_start();


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
    <?php include 'header.php';?>

    <section class="container">
        <?php
        if (isset($_GET['update'])) {
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
            if (mysqli_num_rows($update_query) > 0) {
                while ($fetch_update = mysqli_fetch_assoc($update_query)) {
        ?>
                    <div class="row justify-content-center py-5">
                        <div class="text-center pb-3">
                            <h1>Update Product</h1>
                        </div>
                        <div class="card" style="height: auto; width: 30rem;">
                            <div class="justify-content-center text-center card-body add-products">
                                <h3 class="card-title p-2">Edit Product Details</h3>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                                    <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                                    <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                                    <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="form-control p-2 m-2" placeholder="Product Name" required>
                                    <input type="number" min="0" name="update_price" value="<?php echo $fetch_update['price']; ?>" class="form-control p-2 m-2" placeholder="Product Price" required>
                                    <input class="form-control m-2" name="image" accept="image/jpg, image/jpeg, image/png" type="file">
                                    <button type="submit" value="update product" name="update_product" class="btn btn-primary m-2">Edit Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
        <?php
                }
            }
        } else {
            echo '<div class="text-center alert alert-danger" role="alert">
            Improper URL Supplied
          </div>';
        }
        ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>