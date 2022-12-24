<?php

include 'configs.php';

session_start();
$prevprice = $_POST['product_price'];
$previd = $_POST['product_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'header.php';?>
    <section class="checkout">
        <div class="container">
            <div class="card row">
                <div class="card-body">
                    <h3 class="card-title">Checkout</h3>
                    <form action="process.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" id="number" name="number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="method" class="form-label">Payment Method</label>
                                    <select class="form-select" id="method" name="method" required>
                                        <option value="Cash On Delivery">Cash On Delivery</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Net Banking">Net Banking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="flat" class="form-label">Flat No.</label>
                                    <input type="number" class="form-control" id="flat" name="flat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="street" class="form-label">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>
                                <input type="hidden" name="lodaprice" value="<?php echo $prevprice ?>">
                                <input type="hidden" name="product_id" value="<?php echo $previd ?>">
                            </div>
                        </div>
                        <div class="justify-content-center text-center mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Place Order</button>
                        </div>
                    </form>
            </div>
        </div>
    </section>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    
</body>

</html>