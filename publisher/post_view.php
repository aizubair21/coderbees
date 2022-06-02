<?php
include "connection.php";

if(!isset($_SESSION["publisher_key"])){
    //header("location: /coderbee/login.php");
}

$status = 1;
$key = $_SESSION["publisher_key"] ?? "";
$post = "SELECT * FROM posts";
$total_post = mysqli_num_rows(mysqli_query($conn, $post));
$post_approved = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE status = '$status'"));
 

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
    <link href="<?php PUBLISHER_PATH?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php PUBLISHER_PATH?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        td{
            text-align: center;
            font-size: 12px;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php include PUBLISHER_PATH."sideBar.php" ?>
        <!-- End of Sidebar -->


        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: #8080805e;">

                <!-- Topbar -->
                <?php include PUBLISHER_PATH."topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Publisher CP</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Short Overview</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Posts</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_post?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-blogger-b fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Approved</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $post_approved  ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Block
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Waitting For Approval</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h6 class="m-0 font-weight-bold text-white">Posts Data</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" style="background-color: rgba(0,0,0,.1);" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <style>
                                                th {
                                                    text-align: center;
                                                }
                                            </style>
                                            <tr>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Status</th>
                                                <th>Comments</th>
                                                <th>Image</th>
                                                <th>Post time</th>
                                                <th>E/D</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $post = "SELECT * FROM posts";
                                                $result = mysqli_query($conn, $post);

                                                while ($row = mysqli_fetch_assoc($result)) {?>
                                                    
                                                    <tr>
                                                        <td class="text-left"> <?php echo  $row["title"] ?> </td>
                                                        <td class="text-left"><?php echo  $row["category"] ?></td>
                                                        <td class="text-left"><?php echo  $row["author"] ?></td>
                                                        <td>
                                                            <?php 
                                                            
                                                                echo $row["status"] != 1 ? "<strong class='text text-danger'>waiting</strong>" : "<strong class='text text-success'>Approved</strong>";
                                                            ?> 
                                                        </td>
                                                        <td></td>
                                                        <td><img style="width:70px" src="uploads/post/<?php echo $row["image"] ?>" alt="Not Fount"></td>
                                                        <td><?php echo $row["created_at"] ?></td>
                                                        <td  class="d-flex justify-content-center align-items-center">
                                                            <div class="d-flex">
                                                                <a href="delete.php?id=<?php echo  $row["id"] ?>" title="Delete" class="btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                                <a href="update.php?id=<?php echo  $row["id"] ?>" title="Update" class="btn-info btn-sm"><i class="fas fa-pen-alt"></i></a>
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

                    <!-- Content Row -->

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


    <!-- Bootstrap core JavaScript-->
    <script src="<?php PUBLISHER_PATH?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php PUBLISHER_PATH?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php PUBLISHER_PATH?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php PUBLISHER_PATH?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php PUBLISHER_PATH?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php PUBLISHER_PATH?>js/demo/chart-area-demo.js"></script>
    <script src="<?php ROOT_PATH?>js/demo/chart-pie-demo.js"></script>
    <script src="<?php PUBLISHER_PATH?>js/demo/datatables-demo.js"></script>

</body>

</html>