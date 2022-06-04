<?php
include "link.php";
require "connection.php";


$email_error = '';
$name_error = '';
$pass_confirm_error = '';
$password_error = '';


$user_name = $_POST["user_name"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? '';
$password_confirmation = $_POST['password_confirmation'] ?? '';

//confirm
if(isset($_POST['confirm'])) {
    if($_POST['user_name'] == "") {
        $email_error = "Required field !";
    }


    if($_POST["email"] == "") {
        $email_error = "Requird field !";
    }

    if ($_POST['user_name'] != '' && $_POST['email'] != "") {
        if($row = isInAdminDatabase($user_name)){

            $id = $row["adminId"];

            if($row['adminEmail'] == $email) {
                $_SESSION['is_confirm'] = "$id";
            }else {
                $email_error = "This email isn't registered with this username.";
            }
        }else {
            $name_error = "Not a valid username !";
            $email = '';
        }
    }
}



//reset
if(isset($_POST['reset']) && isset($_SESSION['is_confirm'])) {
    if($_POST['password'] == "") {
        $password_error = "Required field !";
    }

    if($_POST['password_confirmation'] == "") {
        $pass_confirm_error = "Required field !";
    }

    if (strlen($password) >= 8 ) {
        if ($password == $password_confirmation) {

            $id= $_SESSION['is_confirm'];
            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $update = "UPDATE admin SET adminPassword = '$password_hash' WHERE adminId = '$id'";
            $result = mysqli_query($conn,$update);
            if ($result) {
                $password = '';
                session_unset('is_confirm');
                header("location: login.php");
            }
            
        }else {
            $pass_confirm_error = "Password not match ";
        }
    }else {
        $password_error = "Password at lest 8 digit ";
    }
}



?>

<pre>

</pre>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="bg-primary text-white p-3" style="font-size: 20px;">
                        Changer Your Password
                    </div>
                    
                    <div class="card-body">
                        <?php 
                            if (isset($_SESSION["is_confirm"])) {
                                ?>
                                <form action="forgot_password.php" method="POST">
                                    <fieldset>
                                        <legend class="alert alert-success" style="text-transform: uppercase; font-size:20px; font-weight:800;"> 
                                            Confirmed<br>
                                            <p style="font-size:15px; font-weight:400;">Now your can chagne your password .</p>
                                        </legend>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password" value="<?php echo $password ?? '' ?>">
                                            <label for="floatingPassword">Password </label>
                                            <strong class="text text-danger">
                                                <?php echo $password_error ?>
                                            </strong>

                                        </div><br>

                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="password_confirmation" name="password_confirmation" value="<?php echo $email ?? '' ?>">
                                            <label for="floatingPassword">password Confirmation  </label>
                                            <strong class="text text-danger">
                                                <?php echo $pass_confirm_error ?>
                                            </strong>

                                        </div><br>

                                        <button class="btn btn-outline-primary btn-md" name="reset" type="submit">Reset</button>

                                    </fieldset>
                                </form>
                                <?php
                            } else {
                                ?>
                                <form action="forgot_password.php" method="POST">
                                    <fieldset>
                                        <div class=" alert alert-info">
                                            
                                            <legend class="" style="text-transform: uppercase; font-size:20px; font-weight:800;;">Confirmation</legend>
                                            <i class="fas fa-circle-info"></i>
                                            <p class="text text-black">Let's confirm it's you or not. By confirming <strong>username</strong> and <strong>email !</strong> </p>

                                        </div>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingPassword" placeholder="User Name" name="user_name" value="<?php echo $user_name ?? '' ?>">
                                            <label for="floatingPassword">Your User Name </label>
                                            <strong class="text text-danger">
                                                <?php echo $name_error ?>
                                            </strong>

                                        </div><br>

                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="floatingPassword" placeholder="Registerd email" name="email" value="<?php echo $password_confirmation ?? '' ?>">
                                            <label for="floatingPassword">Your Registerd Email  </label>
                                            <strong class="text text-danger">
                                                <?php echo $email_error ?>
                                            </strong>

                                        </div><br>
                                        <div class="d-flex justify-content-between">
                                            
                                            <a href="/admin/index.php" class="btn btn-danger btn-md">Back</a>
                                            <button class="btn btn-outline-primary btn-md" name="confirm" type="submit">Confirm</button>

                                        </div>

                                    </fieldset>
                                </form>
                                <?php
                            }
                        ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>