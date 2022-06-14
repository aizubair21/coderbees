<?php


include "connection.php";

if (!isset($_SESSION['admin_key'])) {
    header("location: index.php");
}

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


    if ($user_name == '') {
        $user_name_error = 'Required fill ';
    }elseif($name == ''){
        $name_error = 'Required fill ';
    }elseif($email == ''){
        $email_error = 'Required fill ';
    }elseif($password == ''){
        $password_error = 'Required fill ';
    }else {
        $data = "SELECT * FROM publisher WHERE email='$email'";
        $result = mysqli_query($conn, $data);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
            $email_error = "already exists!.";

            if(strlen($_POST['publisher_password']) <8 ){
                $password_error = "Too short";
            }

        }else {
            if(strlen($_POST['publisher_password']) < 8 ){
                $password_error = "Too short";
            }else {
                $sql = "INSERT INTO publisher (name, user_name, email, phone, password, created_at, country) VALUES ('$name','$user_name','$email','$phone','$password','$created_at','$country')";
                if (mysqli_query($conn, $sql)) {
                    header("location: ../publisher.php");

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
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Publisher - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .hide {
            display: none;
        }
        .show{
            display: flex;
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
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    <?php include "topBar.php" ?>
                <!-- End of Topbar -->
                 <!-- Content Row -->
                <div class="row px-2">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Subscriber</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
                                                echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subscriber"))
                                            ?>
                                        
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Begin Page Content -->
                <div class="row p-1">
                    <div class="col-12" >
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Subscriber Data</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable">
                                        <thead>
                                            
                                            <tr>
                                               <th>Id</th>
                                               <th>Email</th>
                                               <th>Subscription</th>
                                               <th>From</th>
                                               <th>Modify</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                    
                                        <?php 
                                            $sql = "select * from subscriber";
                                            $result = mysqli_query($conn, $sql);
                                            
                                            while ($row = mysqli_fetch_assoc($result)) {?>
                                            
                                                    <tr>
                                                        <style>
                                                            td{
                                                               text-align: center;
                                                               font-size: 12px;
                                                            }
                                                        </style>
                                                        <td style="text-align:left"><?php echo $row["subscriberId"] ?></td>
                                                        <td style="text-align:left"><?php echo $row["subscriberEmail"] ?></td>
                                                        
                                                        <td>
                                                            <?php  if($row["subscribeStatus"] = 1){?>
                                                                <a class="btn btn-success btn-sm"> <i class="fas fa-check"></i>  Active </a>
                                                            <?php } else {?>
                                                                <a href="allow_subscriber.php?id=<?php echo $row['subscriberId'] ?>" name="unblock" title="Want to unblock ?" class="btn btn-success btn-sm"> <i class="fas fa-check"></i> Unblock</a>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $row["subscribeOn"] ?></td>
                                                        <td id="action">
                                                               
                                                          
                                                            <div class="d-block">
                                                                <a class="btn btn-danger btn-sm" style="padding-right:3px" href="subscribe_delete.php?id=<?php echo  $row["subscriberId"] ?>" title="Delete" ><i class="fas fa-ban"></i> End </a>
                                                               
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    
                                                    
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

 

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js.map"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        
    </script>

</body>

</html>