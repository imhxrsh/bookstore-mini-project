<?php
include 'configs.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['useremail']);
    $password = mysqli_real_escape_string($conn, md5($_POST['userpass']));


    $userdb = mysqli_query($conn, "SELECT * FROM `user` WHERE user_email ='$email'  AND user_password = '$password'") or die('Query Failed');

    if (mysqli_num_rows($userdb) > 0) {
        $row = mysqli_fetch_assoc($userdb);
        if ($row['user_type'] == 'admin') {
            $_SESSION['adminname'] = $row['user_name'];
            $_SESSION['adminemail'] = $row['user_email'];
            $_SESSION['adminid'] = $row['user_id'];
            header('location:admin');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['username'] = $row['user_name'];
            $_SESSION['useremail'] = $row['user_email'];
            $_SESSION['userid'] = $row['user_id'];
            header('location:index.php');
        }
    } else {
        $message[] = 'Incorrect Mail or Password.Try Again';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="container p-5 col-10">
                <div class="text-center alert alert-secondary alert-dismissible fade show" role="alert">
                <div>' . $message . '</div>
                </div>
            </div>';
        }
    }
    ?>
    <div class="login container">
        <div class="justify-content-center row">
            <div class="col-5">
                <form action="" method="POST">
                    <div class="form-outline mb-4">
                        <input type="text" name="useremail" required class="form-control" />
                        <label class="form-label" for="useremail">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="userpass" class="form-control" />
                        <label class="form-label" for="userpass">Password</label>
                    </div>

                    <button type="submit" name="submit" value="Login" class="btn btn-primary btn-block mb-4">Sign in</button>

                    <div class="text-center">
                        <p>Not a member? <a href="signup.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
</body>

</html>