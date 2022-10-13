<?php
require 'connection.php';

if (isset($_SESSION['publisher_key'])) {
    header("location: index.php");
}

$email_error = '';
$pass_error = '';

if (isset($_POST["Publisher_login"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $data = "SELECT * FROM publisher WHERE publisherEmail='$email'";
    $result = mysqli_query($conn, $data);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($count == 1) {

        $db_password = $row['publisherPassword'];
        if (password_verify($password, $row["publisherPassword"]) || $password == $row["publisherPassword"]) {
            $_SESSION["publisher_key"] = $row["publisherId"];
            header("location: index.php");
        } else {
            $pass_error = "Password not matched !";
        }
    } else {
        $email_error = "No publisher fount associative this email.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher Login - login publisher to task</title>

    <link rel="stylesheet" href="/coderbees/bootstrap-5.1.0-dist/css/bootstrap.min.css">

</head>

<body>

    <div class="main_body">
        <div class="container">
            <div class="row" style="height:100vh; padding:10px; ">
                <div class="col-lg-3">
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                            Login As Publisher
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-floating mb-3">

                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                                    <label for="floatingInput">User Email</label>
                                    <strong class="text text-danger">
                                        <?php echo $email_error ?>
                                    </strong>
                                </div>

                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                    <label for="floatingPassword">Password</label>
                                    <strong class="text text-danger">
                                        <?php echo $pass_error ?>
                                    </strong>
                                </div><br>

                                <div>
                                    <button class="btn btn-primary btn-lg" name="Publisher_login" type="submit">Login</button>
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


    <?php
    include "footer.php";
    include '../unset_session.php';
    ?>
</body>

</html>