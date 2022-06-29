<?php


include "connection.php";

if (!isset($_SESSION['admin_key'])) {
    header("location: index.php");
}

if (isset($_POST["insert_publisher"])) {

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
    } elseif ($name == '') {
        $name_error = 'Required fill ';
    } elseif ($email == '') {
        $email_error = 'Required fill ';
    } elseif ($password == '') {
        $password_error = 'Required fill ';
    } else {
        $data = "SELECT * FROM publisher WHERE email='$email'";
        $result = mysqli_query($conn, $data);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            $email_error = "already exists!.";

            if (strlen($_POST['publisher_password']) < 8) {
                $password_error = "Too short";
            }
        } else {
            if (strlen($_POST['publisher_password']) < 8) {
                $password_error = "Too short";
            } else {
                $sql = "INSERT INTO publisher (name, user_name, email, phone, password, created_at, country) VALUES ('$name','$user_name','$email','$phone','$password','$created_at','$country')";
                if (mysqli_query($conn, $sql)) {
                    header("location: ../publisher.php");

                    $name = '';
                    $user_name = '';
                    $email = '';
                    $phone = '';
                } else {
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .hide {
            display: none;
        }

        .show {
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
                                            Total Publishers</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            echo mysqli_num_rows(mysqli_query($conn, "SELECT publisherId FROM publisher"))
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

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Active</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $active = 1;
                                            echo mysqli_num_rows(mysqli_query($conn, "SELECT publisherId FROM publisher WHERE publisherStatus = '$active'")) ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Block Publisher</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $status = 0;
                                            $category_qry = mysqli_num_rows(mysqli_query($conn, "SELECT publisherId FROM publisher WHERE publisherStatus = '$status'"));
                                            echo $category_qry;
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ban fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New In
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                                                    <?php
                                                    $block_post = mysqli_num_rows(mysqli_query($conn, "SELECT publisherId FROM publisher WHERE publisherStatus IS NULL"));
                                                    echo $block_post;
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users  fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                </div>

                <!-- Begin Page Content -->
                <div class="row p-1">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Publisher Data</h6>
                                <a class="btn btn-primary btn-sm px-3 rounded-pill shadow-lg" href="#">Add publisher</a>
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
                                        <tbody>

                                            <?php
                                            $sql = "select * from publisher";
                                            $result = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                                <tr>
                                                    <style>
                                                        td {
                                                            text-align: center;
                                                            font-size: 12px;
                                                        }
                                                    </style>
                                                    <td><img style="width:100px ;height:100px" src="#" alt="Not Found"></td>
                                                    <td style="text-align:left"><?php echo $row["publisherUser_name"] ?></td>
                                                    <td style="text-align:left"><?php echo $row["publisherEmail"] ?></td>
                                                    <td style="text-align:left"><?php echo $row["publisherPhone"] ?></td>
                                                    <th style="text-align:left"><?php echo $row['publisherCountry'] ?></th>
                                                    <td></td>
                                                    <td><?php echo $row["publisherCreated_at"] ?></td>
                                                    <td>
                                                        <?php echo $row["publisherStatus"] == 0 ? "<span title=' This publisher is banned now. A banned user uncapable to to any thing.' class='btn btn-danger btn-sm'><i class='fas fa-ban'></i> </span>" : "<span title='Publisher are capable his work.' class='btn btn-success btn-sm'> <i class='fas fa-check-circle'></i> </span>"; ?>

                                                    </td>
                                                    <td>
                                                        <?php if ($row["publisherStatus"] == 1) { ?>
                                                            <a href="publisher/blockPublisher.php?id=<?php echo $row['publisherId'] ?>" title="Want to block this publisher ?" class="btn btn-danger btn-sm"> <i class="fas fa-ban"></i> Block ?</a>
                                                        <?php } else { ?>
                                                            <a href="publisher/unblockPublisher.php?id=<?php echo $row['publisherId'] ?>" name="unblock" title="Want to unblock ?" class="btn btn-success btn-sm"> <i class="fas fa-check"></i> Unblock</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td id="action">


                                                        <div class="d-flex justify-content-between">
                                                            <a style="border-right:3px solid gray; padding-right:3px" href="publisher/delete.php?id=<?php echo  $row["publisherId"] ?>" title="Delete"><i></i>Delete</a>
                                                            <a href="publisher/update.php?id=<?php echo  $row["publisherId"] ?>" title="Update"><i></i>Update</a>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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