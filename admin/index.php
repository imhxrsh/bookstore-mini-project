<?php
include '../configs.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include 'header.php';?>

    <section class="container">
        <div class="row justify-content-center py-5">
            <div class="text-center">
                <h1>Dashboard</h1>
            </div>
            <div class="text-center col-lg-3 col-md-6 col mt-2">
                <div class="card" style="height: 10rem;">
                    <div class="card-body mt-4">
                        <h5 class="card-title">Payment Pendings</h5>
                        <?php
                        $total_pending = 0;
                        $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE pay_status ='pending' ") or die('query failed');
                        if (mysqli_num_rows($select_pending) > 0) {
                            while ($fetch_pending = mysqli_fetch_assoc($select_pending)) {
                                $total_price = $fetch_pending['total_price'];
                                $total_pending += $total_price;
                            };
                        }
                        ?>
                        <p class="card-text mt-2"><?php echo $total_pending; ?></p>
                    </div>
                </div>
            </div>
            <div class="text-center col-lg-3 col-md-6 col mt-2">
                <div class="card" style="height: 10rem;">
                    <div class="card-body mt-4">
                        <h5 class="card-title">Completed Payments</h5>
                        <?php
                        $total_completed = 0;
                        $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE pay_status ='completed' ") or die('query failed');
                        if (mysqli_num_rows($select_completed) > 0) {
                            while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                                $total_price = $fetch_completed['total_price'];
                                $total_completed += $total_price;
                            };
                        }
                        ?>
                        <p class="card-text mt-2"><?php echo $total_completed; ?></p>
                    </div>
                </div>
            </div>
            <div class="text-center col-lg-3 col-md-6 col mt-2">
                <div class="card" style="height: 10rem;">
                    <div class="card-body mt-4">
                        <h5 class="card-title">Orders placed</h5>
                        <?php
                        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ") or die('query failed');
                        $no_orders = mysqli_num_rows($select_orders);

                        ?>
                        <p class="card-text mt-2"><?php echo $no_orders;    ?></p>
                    </div>
                </div>
            </div>
            <div class="text-center col-lg-3 col-md-6 col mt-2">
                <div class="card" style="height: 10rem;">
                    <div class="card-body mt-4">
                        <h5 class="card-title">Total users</h5>
                        <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type ='user' ") or die('query failed');
                        $no_users = mysqli_num_rows($select_users);

                        ?>

                        <p class="card-text mt-2"><?php echo $no_users;    ?></p>
                    </div>
                </div>
            </div>
            <div class="text-center col-lg-3 col-md-6 col mt-2">
                <div class="card" style="height: 10rem;">
                    <div class="card-body mt-4">
                        <h5 class="card-title">Total Admins</h5>
                        <?php
                        $select_admin = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type ='admin' ") or die('query failed');
                        $no_admin = mysqli_num_rows($select_admin);

                        ?>
                        <p class="card-text mt-2"><?php echo $no_admin;    ?></p>
                    </div>
                </div>
            </div>
            <div class="text-center col-lg-3 col-md-6 col mt-2">
                <div class="card" style="height: 10rem;">
                    <div class="card-body mt-4">
                        <h5 class="card-title">Feedbacks</h5>
                        <?php
                        $select_fb = mysqli_query($conn, "SELECT * FROM `feedback` ") or die('query failed');
                        $no_fb = mysqli_num_rows($select_fb);

                        ?>
                        <p class="card-text mt-2"><?php echo $no_fb;    ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>