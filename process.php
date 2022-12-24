<?php

include 'configs.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'Flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].'.');
    $price = mysqli_real_escape_string($conn, $_POST['lodaprice']);
    $id = mysqli_real_escape_string($conn, $_POST['product_id']);


    mysqli_query($conn, "INSERT INTO `orders`(name, phone, email, pay_method, address, total_pdts, total_price, placed_on) VALUES('$name', '$number', '$email', '$method', '$address', 1, '$price', '$id')") or die('query failed');
    
    header('location:product.php');