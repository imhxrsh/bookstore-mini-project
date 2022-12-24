<?php

include '../configs.php';

session_start();


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `user` WHERE user_id = '$delete_id'") or die('query failed');
   header('location:users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include 'header.html';?>

    <section class="container">
        <div class="row justify-content-center">
            <div class="text-center pb-3">
                <h1>Users Registered</h1>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `user`") or die('query failed');
                    while ($fetch_users = mysqli_fetch_assoc($select_users)) {
                    ?>
                        <div class="p-3 text-center card col-lg-3 col-md-5 col-sm-12 col-12 m-2">
                            <a><strong>User ID : </strong><?php echo $fetch_users['user_id']; ?></a>
                            <a><strong>Username : </strong><?php echo $fetch_users['user_name']; ?></a>
                            <a><strong>E-mail : </strong><?php echo $fetch_users['user_email']; ?></a>
                            <a><strong>User Type : </strong><span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                                                                                    echo 'var(--orange)';
                                                                                } ?>"><?php echo $fetch_users['user_type']; ?></span></a>
                            <div class="mt-3 justify-content-center"><a href="users.php?delete=<?php echo $fetch_users['user_id']; ?>"><button type="button" class="col-6 btn btn-danger">Delete User</button></a></div>
                        </div>
                    <?php
                    };
                    ?>
                </div>
            </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>