<?php
include "../connection.php";

if (!isset($_SESSION["admin_key"])) {
    header("location: login.php");
}

$key = $_SESSION["admin_key"] ?? "";
$setting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM site_setting "));
// print_r($setting);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coderbees - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- toaster Plugin -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <style>
        td {
            text-align: center;
            font-size: 12px;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "../sideBar.php" ?>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "../topBar.php" ?>
                <!-- End of Topbar -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="w-100 p-2 bg-primary text-white font-bolder">
                                Site Setting
                            </div>
                            <div class="card-body">
                                <form action="../function/general_setting.php" method="post">
                                    <div class="mb-3">
                                        <label for="title">Site Meta Title :</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="pashion house" value="<?php echo $setting['title'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description">Site Meta Description :</label>
                                        <input type="text" name="description" id="description" class="form-control" placeholder="give your absolute fashion sollution" value="<?php echo $setting['description'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="keyword">Site Kewords :</label>
                                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Ex: pashion, design" value="<?php echo $setting['keyword'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="about">About Site :</label>
                                        <input type="text" name="about" id="about" class="form-control" placeholder="This is fashion house............" value="<?php echo $setting['about'] ?>">
                                        <div class="form-text text text-info h6">
                                            You site description. It shown on bottom footer.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address">Company Address :</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="12/a Noth, 1200, Dkaha" value="<?php echo $setting['address'] ?>">
                                        <div class="form-text text text-info h6">
                                            Address will shown in contact page
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone">Contact Phone :</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="+880 1798-558960" value="<?php echo $setting['phone'] ?>">
                                        <div class="form-text text text-info">
                                            Phon shown in footer.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">Contact Email :</label>
                                        <input type="email" name="email" id="email" placeholder="admin@example.xyz" class="form-control" value="<?php echo $setting['email'] ?>">
                                        <div class="fom-text text text-info">
                                            Email will shown in footer.
                                        </div>
                                    </div>

                                    <div class="my-4">
                                        <button class="btn btn-primary" name="site_setting"> <i class="fas fa-sync"></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <!-- /.container-fluid -->


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
    <script src="<?php echo  ADMIN_PATH ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo  ADMIN_PATH ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo  ADMIN_PATH ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo  ADMIN_PATH ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo  ADMIN_PATH ?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo  ADMIN_PATH ?>js/demo/chart-area-demo.js"></script>
    <script src="<?php echo  ADMIN_PATH ?>js/demo/chart-pie-demo.js"></script>
    <script src="<?php echo  ADMIN_PATH ?>js/demo/datatables-demo.js"></script>

    <!-- toaster plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'post_approved') {
    ?>
            <script>
                toastr.success('Post Finally Approved. Post now shown in homee.');
            </script>
        <?php
        };

        if ($_SESSION['status'] == 'post_deleted') {
        ?>
            <script>
                toastr.warning('Post Completely Deleted!');
            </script>
        <?php
        }
        if ($_SESSION['status'] == 'post_updated') {
        ?>
            <script>
                toastr.success('Post Successfully Updated!');
            </script>
    <?php
        }
    }
    include '../../unset_session.php';
    ?>

</body>

</html>