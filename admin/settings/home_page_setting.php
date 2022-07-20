<?php
include "../connection.php";

if (!isset($_SESSION["admin_key"])) {
    header("location: login.php");
}

$key = $_SESSION["admin_key"] ?? "";
// $setting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM site_setting "));
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

    <title>Home page setting - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../fontawesome-free-5.15.3-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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

                        <div class="card text-dark">
                            <div class="w-100 px-2 py-3 bg-secondary text-white fw-bolder">
                                <i class="fas fa-cog f-1 fw-bolder text-primary p-3 rounded-circle bg-light" style='font-size:35px;line-height:25px'></i>
                            </div>
                            <div class="card-body">
                                <form action="../function/home_page_setting.php" method="post">

                                    <!-- left  -->
                                    <div class="row justify-content-evenly my-2">

                                        <div class="col-lg-3 p-2 my-2">

                                            <div class="label bg-info text-light p-2" for="main-slider">Main Slider </div>
                                            <div class="form-text">
                                                Define is your main slider running or not.
                                            </div>
                                            <select name="main_slider" id="main-slider" class="form-control">
                                                <option value="0">Stop Showing Slides</option>
                                                <option value="1">Running</option>
                                            </select>

                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="form-label bg-info text-light p-2" for="slider-item">Main Slider Item : <span id="slider-item"></span> </div>
                                            <div class="form-text">
                                                How many slides do you want to show in your slider slides ?
                                            </div>
                                            <input type="number" name="main_slider_item" id="slider-item" onchange="slider_item(this.value)" class="form-control">
                                        </div>

                                        <!-- main slider order  -->
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-info text-light p-2" for="slider-order">Main Slider Order : <span id="slider-order"></span> </div>
                                            <div class="form-text">
                                                Which order you slides show ? ASEC [a-z], DESC [z-a]
                                            </div>
                                            <select name="main_slider_order" id="slider-order" class="form-control">
                                                <option value="ASEC">ASEC</option>
                                                <option value="DESC">DESC</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <label for="post-tag">Post Tag :</label>
                                            <div class="form-text">
                                                Do you want to show post targ in main slider.
                                            </div>
                                            <select name="show_post_tag" id="post-tag" class="form-control form-select">
                                                <option value="0">Hide</option>
                                                <option value="1">Show</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="row my-2 justify-content-evenly">

                                        <div class="col-lg-3 p-2 my-2">
                                            <label for="follow-widget">Follow Widgets ?</label>
                                            <div class="form-text">
                                                Is your follow us widgets shown in home page or not.
                                            </div>
                                            <select name="follow_us" id="follow" class="form-control">
                                                <option value="0">Hide from homepage</option>
                                                <option value="1">Shown in homepage</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <label for="newsletter">Newsletter :</label>
                                            <div class="form-text">
                                                Newsletter subscription field shown in homepage or not.
                                            </div>
                                            <select name="newsletter" id="newsletter" class="form-control">
                                                <option value="0">Hide</option>
                                                <option value="1">Show</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <label for="category">Category :</label>
                                            <div class="form-text">
                                                Where do you want to show your category. by default in main content.
                                            </div>
                                            <select name="cat_show_in" id="category" class="form-control">
                                                <option value="main">Show in main content</option>
                                                <option value="sideBar">Show in right side bar</option>
                                            </select>
                                        </div>


                                        <div class="col-lg-3 p-2 my-2">
                                            <label for="latest">Latest Post :</label>
                                            <div class="form-text">
                                                How many post show in latest post part.
                                            </div>
                                            <input type="number" name="latest" id="latest" class="form-control">
                                        </div>
                                    </div>

                                    <!-- define 4 category  -->
                                    <div class="row my-2">

                                        <div class="col-12 bg-info text-light p-3">
                                            <strong>Homepage post show accroding following category :</strong>
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-info text-light p-2" for="first">First Category :</div>
                                            <select class="form-control" name="cat_1" id="first">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-info text-light p-2" for="second">Second Category :</div>
                                            <select class="form-control" name="cat_2" id="second">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-info text-light p-2" for="third">Third Category :</div>
                                            <select class="form-control" name="cat_3" id="third">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-info text-light p-2" for="forth">Forth Category :</div>
                                            <select class="form-control" name="cat_4" id="forth">
                                                <option value=""></option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row my-2">
                                        <div class="col-lg-3 p-2 m-2">
                                            <div class="label bg-info text-light p-2">Post Tags Wigets :</div>
                                            <div class="form-text">
                                                Post tags wigets shown in homepage right sidebar
                                            </div>
                                            <select name="tags_in_main" id="tags" class="form-control">
                                                <option value="0">Hide</option>
                                                <option value="1">Show</option>
                                            </select>
                                        </div>
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
    <script>
        function slider_item(val) {
            document.getElementById("slider-item").innerHTML = val;
        }
    </script>
</body>

</html>