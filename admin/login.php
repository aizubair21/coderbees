<?php
require 'connection.php';
require "link.php";

//require admin-controller
require "../controller/admin-controller.php";
//include "auth.php";

//make a obje
$admin = new adminController;
// print_r($admin);
//DBSelect 
$db = new DBSelect;

if (isset($_SESSION['admin_key'])) {
    header("location: index.php");
}

$email_error = '';
$pass_error = '';

if (isset($_POST["login"])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $admin->password($password);
    $admin->email($email);

    $response = $admin->login();
    if ($response == 'success') {
        header("location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="main_body">
        <div class="container">
            <div class="row" style="margin-top: 30px; padding:10px; ">
                <div class="col-lg-3">
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                            Log in
                        </div>
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-floating mb-3">

                                    <input type="email" class="form-control <?php echo ($admin->emailErr) ? "is-invalid" : "" ?>" id="floatingInput" placeholder="name@example.com" name="email">
                                    <label for="floatingInput">User Email</label>
                                    <?php $admin->isError($admin->emailErr) ?>
                                </div>

                                <div class="form-floating">
                                    <input type="password" class="form-control <?php echo ($admin->passwordErr) ? "is-invalid" : "" ?>" id="floatingPassword" placeholder="Password" name="password" autocomplete="off">
                                    <label for="floatingPassword">Password</label>
                                    <?php $admin->isError($admin->passwordErr) ?>
                                </div><br>

                                <div>
                                    <button class="btn btn-primary btn-lg" name="login" type="submit">Login</button>
                                </div>

                                <hr>
                            </div>
                            <div style="padding:5px 0px">
                                <div class="d-flex justify-content-evenly align-items-baseline">
                                    <p>Have an account ?</p>
                                    <a href="register.php" class="text text-info">Register now !</a>
                                </div>
                                <div style="text-align:center; padding-bottom:5px">
                                    <a href="forgot_password.php" class="text text-danger p-2"> Forgote Your Password ?</a>
                                </div>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>