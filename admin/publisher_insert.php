<?php

include "connection.php";

if(isset($_POST["insert_publisher"])){
        
    $name_error = "";
    $user_name_error = "";
    $email_error = "";
    $phone_error = "";
    $password_error = "";
    $error = '';

    $name = $_POST["publisher_name"];
    $user_name = $_POST["publisher_username"];
    $email = $_POST["publisher_email"];
    $phone = $_POST["publisher_phone"];
    $password = password_hash($_POST["publisher_password"], PASSWORD_DEFAULT);
    $country = $_POST["publisher_country"];
    $created_at = date("Y-m-d");
    //echo $created_at;

    $data = "SELECT * FROM publisher WHERE email='$email'";
    $result = mysqli_query($conn, $data);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        $email_error = $email." already exists!.";

        if(strlen($_POST['publisher_password']) <8 ){
            $password_error = "Password at lest 8 digit.";
        }

    }else {
        if(strlen($_POST['publisher_password']) < 8 ){
            $password_error = "Password at lest 8 digit.";
        }else {
            $sql = "INSERT INTO publisher (name, user_name, email, phone, password, created_at, country) VALUES ('$name','$user_name','$email','$phone','$password','$created_at','$country')";
            if (mysqli_query($conn, $sql)) {
                header("location: publisher.php");

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
?>



<?php


if(!isset($_SESSION["key"])){
    header("location: login.php");
}

$key = $_SESSION["key"] ?? "";


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .active {
            color:green;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php include "sideBar.php" ?>
        <!-- End of Sidebar -->


        
        <!-- Content Wrapper -->
        <div id="content_wrapper">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Add Publisher</h6>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data" >
                                
                                    <div>
                                        <input type="text" name="publisher_name" id="publisher_name" placeholder="Publisher Name" class="form-control">
                                        <strong class="text text-danger">
                                            <?php echo $name_error ?? "" ?>
                                        </strong>
                                    </div><br>
                                    <div>
                                        
                                        <input type="text" name="publisher_username" id="publisher_username" max="11" placeholder="Username" class="form-control" required>
                                        <strong class="text text-danger">
                                            <?php echo $user_name_error ?? "" ?>
                                        </strong>
                                    </div><br>
                                    <div>
                                        
                                        <input type="phone" name="publisher_phone" id="publisher_phone" placeholder="phone" class="form-control" require_once>
                                        <strong class="text text-danger">
                                            <?php echo $phone_error ?? "" ?>
                                        </strong>
                                    </div><br>
                                    <div>
                                        <input type="email" name="publisher_email" id="publisher_email" placeholder="publisher@gmail.com" class="form-control" required>
                                        <strong class="text text-danger">
                                            <?php echo $email_error ?? "" ?>
                                        </strong>
                                    </div><br>

                                    <div>
                                        <input type="password" name="publisher_password" id="publisher_password" placeholder="Password" class="form-control" required>
                                    </div><br>

                                    <div>
                                        <input typy="text" name="publisher_country" id="publisher_country" placeholder="Country" class="form-control">
                                    </div><br>
                                    
                                    <div>
                                        <button type="submit" style="float:right" href="#" class="btn btn-primary" name="insert_publisher" >Add Publisher</bu>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>