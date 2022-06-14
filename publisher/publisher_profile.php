<?php
include "connection.php";

if(!isset($_SESSION["publisher_key"])){
    header("location: login.php");
}

$key = $_SESSION["publisher_key"];
$publisher_qry = mysqli_query($conn, "SELECT * FROM publisher WHERE publisherId = $key AND publisherStatus = 1");
$publisher = mysqli_fetch_assoc($publisher_qry);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Dashboard - coderbees </title>

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
            <div id="content">

                <!-- Topbar -->
                <?php include PUBLISHER_PATH."topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    

                    <div class="row justify-content-center align-items-center p-2 mb-2 bg-primary">
                        <div class="col-lg-6">
                            <div class="image_body" style="text-align:center;">
                                <img class="image-fluid image" style="width:250px; height:250px; border-radius:5px" src="uploads/image/<?php echo $publisher["publisherImage"] ?>" alt="No Image Found !">
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center py-20 px-2 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex p-2 mb-2 bg-light">
                                        <strong class="text-secondry font-weight-bold font-medium"><?php echo $publisher["pbulisherName"] ?></strong>
                                    </div>
                                    
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
    <script src="<?php PUBLISHER_PATH?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php PUBLISHER_PATH?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php PUBLISHER_PATH?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php PUBLISHER_PATH?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="<?php PUBLISHER_PATH?>vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <script src="<?php PUBLISHER_PATH?>js/demo/chart-area-demo.js"></script>
    <script src="<?php ROOT_PATH?>js/demo/chart-pie-demo.js"></script>
    <script src="<?php PUBLISHER_PATH?>js/demo/datatables-demo.js"></script>

</body>

</html>