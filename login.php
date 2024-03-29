<?php
//site title
$title = "User Login";

//active nav
$active = "login";

require 'connection.php';


//get previous url. if not exist index.php is set.
$redirectURI = $_SERVER['HTTP_REFERER'];
// echo $redirectURI;

if ($key = $_SESSION['user_key'] ?? "") {
    header("location: $redirectURI ?? index.php");
}

$email_error = '';
$pass_error = '';

?>
<?php include "header.php " ?>
<div class="main_body">
    <div class="container">
        <div class="row" style="height:100vh; padding:10px; ">
            <div class="col-lg-3">
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <?php
                    if ($key) :
                    ?>

                        <div class="card-body alert alert-info">
                            <h6>Successfully login</h6>
                            <a href="<?php echo $redirectURI ?>" class="btn btn-outline-secondary">Go to previous page</button>
                        </div>
                    <?php
                    else :
                    ?>

                        <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                            User Login
                        </div>
                        <form name="UserLogin" action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="uri" value="<?php echo $redirectURI ?>">
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
                                    <button class="btn btn-primary btn-lg" name="user_login" type="button" id="userLoginButton" onclick="userLogin(this, UserLogin.email.value, UserLogin.password.value, UserLogin.uri.value)" id="userLoginButton">Login</button>
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
            <?php
                    endif;

            ?>
            </form>
            </div>
        </div>
    </div>
</div>

<?php

include "footer.php"

?>