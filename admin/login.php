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
                        <strong id="error" class="alert text-danger px-4 py-1"></strong>
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="card-body">
                                <div class="form-floating mb-3">

                                    <input type="email" class="form-control <?php echo ($admin->emailErr) ? "is-invalid" : "" ?>" id="floatingInput" placeholder="name@example.com" name="email">
                                    <label for="floatingInput">User Email</label>
                                </div>
                                <strong><?php $admin->isError($admin->emailErr) ?></strong>

                                <div class="form-floating">
                                    <input type="password" class="form-control <?php echo ($admin->passwordErr) ? "is-invalid" : "" ?>" id="floatingPassword" placeholder="Password" name="password" autocomplete="off">
                                    <label for="floatingPassword">Password</label>
                                    <?php $admin->isError($admin->passwordErr) ?>
                                </div><br>

                                <div>
                                    <button class="btn btn-primary btn-lg" name="login" type="submit" >Login</button>
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

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    //make login with ajux
    document.querySelector('#adminLogin').addEventListener("click", (e) => {

        //get form input  data by id
        let email = document.querySelector("#floatingInput");
        let password = document.querySelector("#floatingPassword");

        if (email == "" || password == "") {
            document.getElementById("error").innerHTML = "Please, Fill The Input Field";
        } else {

            //make a bootstrap spinner for ajux loading
            let spinner = '<div><span class="spinner-border spinner-border-sm" role="status"></span> Verifying...</div>'

            //get the login button for make ajux loading
            let targetButton = e.target;

            //when this function call, spinner show in login button
            targetButton.innerHTML = spinner;

            axios.post("/coderbees/admin/function/admin.login.php?email=" + email.value + "&password=" + password.value)
                .then(function(response) {

                    //empty input field after get response from server
                    email.value = "";
                    password.value = "";
                    
                    console.log(response);
                    if (response.data == "success") {
                        window.location.reload();
                    } else {
                        //whten get response from server, it stop showing spinner animation
                        targetButton.innerHTML = "Login";


                        document.getElementById('error').innerHTML = "Email or Password are invalid !";
                        setTimeout(function() {
                            document.getElementById('error').innerHTML = "";
                        }, 3000)

                    }
                })
                .catch(function(error) {

                    //empty input field after get response
                    email.value = "";
                    password.value = "";
                    console.log(error);
                });

        }

    })
</script>

</html>