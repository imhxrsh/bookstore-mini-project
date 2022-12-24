<?php
include 'configs.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['useremail']);
    $password = mysqli_real_escape_string($conn, md5($_POST['userpass']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['usercpass']));
    $usertype = $_POST['usertype'];

    $userdb = mysqli_query($conn, "SELECT * FROM `user` WHERE user_email ='$email'  AND user_password = '$cpassword'") or die('Query Failed');

    if (mysqli_num_rows($userdb) > 0) {
        $message[] = 'Existing User, Please Login';
    } else {
        if ($password != $cpassword) {
            $message[] = 'Passwords do not match.';
        } else {
            mysqli_query($conn, "INSERT INTO `user`(user_name,user_email,user_password,user_type) VALUES('$name','$email','$cpassword','$usertype')") or die('Query Failed');
            $message[] = 'Registered Successfully! Kindly Login to get access';
            header('location:login.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
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
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <div>' . $message . '</div>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            ';
        }
    }
    ?>
    <div class="login container">
        <div class="justify-content-center row">
            <div class="col-5">
                <form action="" method="POST">
                    <div class="form-outline mb-4">
                        <input type="text" name="username" id="username" class="form-control" />
                        <label class="form-label" for="username">Name</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="email" name="useremail" id="useremail" class="form-control" />
                        <label class="form-label" for="useremail">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="userpass" id="userpass" class="form-control" />
                        <label class="form-label" for="userpass">Password</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="usercpass" id="usercpass" class="form-control" />
                        <label class="form-label" for="usercpass">Confirm Password</label>
                    </div>

                    <div class="form-outline mb-4">
                        <select name="usertype" class="form-select">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" value="Register" class="btn btn-primary btn-block mb-4">Sign up</button>

                    <div class="text-center">
                        <p>Already a member? <a href="login.php">Login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('.alert').alert()
        })
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>