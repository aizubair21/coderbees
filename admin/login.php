
<?php
require 'connection.php';
require "link.php";

//include "auth.php";

if (isset($_SESSION['admin_key'])) {
    header("location: index.php");
}

$email_error = '';
$pass_error = '';

if (isset($_POST["login"]) ) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT adminId, adminPassword FROM admin WHERE adminEmail='$email'");
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if($count == 1){
        
        $db_password = $row['adminPassword'];
        if( password_verify($password,$db_password) ) {
            $_SESSION["admin_key"] = $row["adminId"];
            //header("location: index.php");
        }else {
            $pass_error = "Password not matched !";
        }

    }else {
       $email_error = "Username not register yet. <a class='text text-info' href='register.php'> register now</a>";
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


    <div class="main_body" >
       <div class="container">
            <div class="row" style="margin-top: 30px; padding:10px; ">
                <div class="col-3">
                </div>

                <div class="col-5">
                    <div class="card">
                        <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                            Log in
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
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" autocomplete="off">
                                    <label for="floatingPassword">Password</label>
                                    <strong class="text text-danger">
                                        <?php echo $pass_error ?>
                                    </strong>
                                </div><br>

                                <div>
                                    <button class="btn btn-primary btn-lg"  name="login" type="submit">Login</button>
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