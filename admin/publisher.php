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

    <title>SB Admin 2 - Dashboard</title>

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

                <!-- Begin Page Content -->
                <div class="row p-1">
                    <div class="col-12" >
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Publisher Data</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable">
                                        <thead>
                                            
                                            <tr>
                                                <th>Image</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>From</th>
                                                <th>Posts</th>
                                                <th>Start From</th>
                                                <th>Status</th>
                                                <th>Operation</th>
                                                <th>E/D</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                    
                                        <?php 
                                            $sql = "select * from publisher";
                                            $result = mysqli_query($conn, $sql);
                                            
                                            while ($row = mysqli_fetch_assoc($result)) {?>
                                            
                                                    <tr>
                                                        <style>
                                                            td{
                                                               text-align: center;
                                                               font-size: 12px;
                                                            }
                                                        </style>
                                                        <td><img style="width:100px ;height:100px" src="#" alt="Not Found"></td>
                                                        <td style="text-align:left"><?php echo $row["user_name"] ?></td>
                                                        <td style="text-align:left"><?php echo $row["email"] ?></td>
                                                        <td style="text-align:left"><?php echo $row["phone"] ?></td>
                                                        <th style="text-align:left"><?php echo $row['country'] ?></th>
                                                        <td></td>
                                                        <td><?php echo $row["created_at"] ?></td>
                                                        <td>
                                                            <?php echo $row["status"] == 0 ? "<span title=' This publisher is banned now. A banned user uncapable to to any thing.' class='btn btn-danger btn-sm'><i class='fas fa-ban'></i> </span>" : "<span title='Publisher are capable his work.' class='btn btn-success btn-sm'> <i class='fas fa-check-circle'></i> </span>"; ?>
                                                        
                                                        </td>
                                                        <td>
                                                            <?php  if($row["status"] == 1){?>
                                                                <a href="publisher/blockPublisher.php?id=<?php echo $row['id'] ?>" title="Want to block this publisher ?" class="btn btn-danger btn-sm"> <i class="fas fa-ban"></i> Block ?</a>
                                                            <?php } else {?>
                                                                <a href="publisher/unblockPublisher.php?id=<?php echo $row['id'] ?>" name="unblock" title="Want to unblock ?" class="btn btn-success btn-sm"> <i class="fas fa-check"></i> Unblock</a>
                                                            <?php } ?>
                                                        </td>
                                                        <td >
                                                            <div class="d-flex" id="t_button">
                                                                <a href="publisher/delete.php?id=<?php echo  $row["id"] ?>" title="Delete" class="btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                                <a href="publisher/update.php?id=<?php echo  $row["id"] ?>" title="Update" class="btn-info btn-sm"><i class="fas fa-pen"></i></a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        document.getElementById("t_button").classlist.add("hide");
    </script>

</body>

</html>