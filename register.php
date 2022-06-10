
<?php

$title = "Register As User";
$active = "register";
include "header.php";
include 'connection.php';
//session_unset();
if (isset($_SESSION['user_key'])) {
    header("location: index.php");
}

$name_error = "";
$user_name_error = "";
$email_error = "";
$phone_error = "";
$password_error = "";
$error = '';


if (isset($_POST['register']) && $_POST["email"] != "" && $_POST["password"] != "" ) {

    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";
    $password = password_hash($_POST["password"],  PASSWORD_DEFAULT);
    $created_at = date("M/d/Y");

    if($name == ''){
        $name_error = 'Required fill ';
    }elseif($email == ''){
        $email_error = 'Required fill ';
    }elseif($password == ''){
        $password_error = 'Required fill ';
    }else {

        $data = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($conn, $data);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
            $email_error = $email." already exists!.";

            if(strlen($_POST['password']) <8 ){
                $password_error = "Password at lest 8 digit.";
            }

        }else {
            if(strlen($_POST['password']) < 8 ){
                $password_error = "Password at lest 8 digit.";
            }else {
               $sql = "INSERT INTO users (userName, userEmail, userPhone, userPassword, userCreated_at) VALUES ('$name','$email','$phone','$password','$created_at')";
               if (mysqli_query($conn, $sql)) {
                   $users = mysqli_fetch_array(mysqli_query($conn, "SELECT userEmail FROM users WHERE userEmail = $email"));
                    
                    $_SESSION['user_key'] = $users["userId"];
                        header("location: login.php");

                    $name = '';
                    $user_name = '';
                    $email = '';
                    $phone = '';
                }else{
                    echo mysqli_error($conn);
                }

            }
        }
    }

}

?>


    <div class="main_body" >
       <div class="container">
            <div class="row" style="margin-top: 30px; padding:10px; ">
                <div class="col-3">
                </div>

                <div class="col-6">
                    <div class="card">
                    <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                        Register As User
                    </div>
                    <?php if(isset($_SESSION['register'])) { ?>
                        <div class="alert alert-success">
                            <p>Register success. <a href="login.php">Login Now</a></p>
                        </div>
                    <?php }else {?>

                   
                    <div class="card-body">

                        <form action="register.php" method="post" enctype="multipart/form-data">
                            <div class="input-group d-flex justify-content-between ">
                                <div>
                                    <label class="form-label" for="name">User Name :</label>
                                    <input type="text" name="name" id="name" placeholder="Your Name..." class="form-control form-input" autofocus value="<?php echo $name ?? '' ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="text text-danger">
                                        <?php echo $name_error ?>
                                    </div>
                                </div><br>
                               
                            </div>
                            <br>
                            <div>
                                <label class="form-label" for="email ">User Email  :</label>
                                <input type="email" name="email" id="email" placeholder="Your email..." class="form-control form-input" value="<?php echo $email ?? '' ?>">
                                <div class="text text-danger">
                                    <?php echo $email_error ?>
                                </div>
                            </div>
                                <br>
                            <div>
                                <label class="form-label" for="phone">User Phone :</label>
                                <input type="phone" name="phone" id="phone" placeholder="Your phone number..." class="form-control form-input" value="<?php echo $phone ?? '' ?>">
                                <div class="text text-danger">
                                    <?php echo $phone_error ?>
                                </div>
                            </div>
                            <br>

                            <div>
                                <label class="form-label" for="Password">User Login password :</label>
                                <input type="password" name="password" id="password" placeholder="Your password..." class="form-control form-input">
                                <strong class="text text-danger">
                                    <?php echo $password_error ?>
                                </strong>
                                <div class="text text-danger">
                                    <?php echo $error ?>
                                </div>
                            </div><br>

                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div><br>

                            <div class="d-flex justify-content-between align-items-baseline">
                                <a class="btn btn-danger" href="index.php">Cancel</a>
                               <button name="register" class="btn btn-success">Register</button>
                            </div>

                        </form>

                            <hr>
                        </div>

                        <div style="padding:8px" class="d-flex justify-content-evenly align-items-baseline">
                            <p>Already register ? </p>
                            <a href="login.php" class="text text-info">Login Now !</a>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
       </div>
    </div>
    <br></br><br>
    
<?php include "footer.php";  ?>