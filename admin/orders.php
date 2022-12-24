<?php

include '../configs.php';

session_start();


if (isset($_POST['update_order'])) {

    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
    $message[] = 'payment status has been updated!';
}

if (isset($_GET['approve'])) {
    $approve_id = $_GET['approve'];
    mysqli_query($conn, "UPDATE `orders` SET `pay_status` = 'completed'") or die('query failed');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="container">
        <div class="row justify-content-center">
            <div class="text-center pb-3">
                <h1>Placed Orders</h1>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    if (mysqli_num_rows($select_orders) > 0) {
                        while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    ?>
                        <div class="card col-lg-5 col m-3">
                        <p class="m-2"><strong>Name</strong> <?php echo $fetch_orders['name']; ?></p>
                        <p class="m-2"><strong>Phone</strong> <?php echo $fetch_orders['phone']; ?></p>
                        <p class="m-2"><strong>E-mail</strong> <?php echo $fetch_orders['email']; ?></p>
                        <p class="m-2"><strong>Address</strong> <?php echo $fetch_orders['address']; ?></p>
                        <p class="m-2"><strong>Payment Method</strong> <?php echo $fetch_orders['pay_method']; ?></p>
                        <p class="m-2"><strong>Product ID</strong> <?php echo $fetch_orders['placed_on']; ?></p>
                        <p class="m-2"><strong>Price</strong> <?php echo $fetch_orders['total_price']; ?></p>
                        <a class="text-center" href="orders.php?approve=<?php echo $fetch_orders['id']; ?>"><button type="button" name="approve" class="m-3 btn btn-primary">Approve</button></a>
                    </div>
                    <?php
                        }
                    } else {
                        echo '<div class="container"><div class="text-center">No Products added yet!</div></div>';
                    }
                    ?>
                </div>
            </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>