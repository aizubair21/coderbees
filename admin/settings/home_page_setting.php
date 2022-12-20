<?php
include "../connection.php";
include "../../configuration/QueryHandeler.php";
$mysql = new DBSelect;

//get all data from database
$result = $mysql->select([])->from("home_page")->get();
$data = $result->fetch_assoc();


if (!isset($_SESSION["admin_key"])) {
    header("location: login.php");
}

$key = $_SESSION["admin_key"] ?? "";
// $setting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM site_setting "));
// print_r($data);
// die();
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

        .form-text {
            line-height: 16px;
            padding: 5px 0px;
            font-size: 13px;
        }

        .label {
            font-family: sans-serif;
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
                                <form name="setting">

                                    <!-- left  -->
                                    <div class="row justify-content-evenly my-2">

                                        <div class="col-lg-12 bg-info text-light p-2 m-2">
                                            Main Slider Setting
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">

                                            <label class="bg-info text-light p-2" for="main-slider">Main Slider :</label>
                                            <div class="form-text">
                                                Define is your main slider running or not.
                                            </div>
                                            <select name="main_slider" id="main-slider" class="form-control" onchange="go(setting.main_slider.name, setting.main_slider.value)">
                                                <option value="0">Stop Showing Slides</option>
                                                <option value="1">Running</option>
                                            </select>

                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <label class=" bg-info text-light p-2" for="slider-item">Main Slider Item : <span id="slider-item"></span> </label>
                                            <div class="form-text">
                                                How many slides do you want to show in slider slides ?
                                            </div>
                                            <input type="number" name="main_slider_item" id="slider-item" class="form-control" value="<?php echo $data["main_slider_item"] ?>" onchange="go(setting.main_slider_item.name, setting.main_slider_item.value)">
                                        </div>

                                        <!-- main slider order  -->
                                        <div class="col-lg-3 p-2 my-2">
                                            <label class=" bg-info text-light p-2" for="slider-order">Main Slider Order : <span id="slider-order"></span> </label>
                                            <div class="form-text">
                                                Which order slides show ? ASEC [a-z], DESC [z-a]
                                            </div>
                                            <select name="main_slider_order" id="slider-order" class="form-control" onchange="go(setting.main_slider_order.name, setting.main_slider_order.value)">
                                                <option <?php echo ($data['main_slider_order'] == 'ASEC') ? "SELECTED" : "" ?> value="ASEC">ASEC</option>
                                                <option <?php echo ($data['main_slider_order'] == 'DESC') ? "SELECTED" : "" ?> value="DESC">DESC</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <lable class=" bg-info text-light p-2" id="post-tag" for="post-tag">Main Slider Post Tag :</lable>
                                            <div class="form-text">
                                                Do you want to show post tag into main slider.
                                            </div>
                                            <select name="show_post_tag" id="post-tag" class="form-control form-select" onchange=" go(setting.show_post_tag.name, setting.show_post_tag.value)">
                                                <option <?php echo ($data['show_post_tag'] == '0') ? "SELECTED" : "" ?> value="0">No</option>
                                                <option <?php echo ($data['show_post_tag'] == '1') ? "SELECTED" : "" ?> value="1">Yes</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="row my-2 justify-content-evenly">

                                        <div class="col-lg-12 bg-primary text-light p-2 m-2">Right Side Widgets</div>

                                        <div class="col-lg-2 m-2 my-2">
                                            <label class="bg-primary text-light p-2" for="site_audit">Site Audit :</label>
                                            <div class="form-text">
                                                Site audit short overview show or not.
                                            </div>
                                            <select name="site_audit" id="site_audit" class="form-control" onchange="go(setting.follow_us.name, setting.follow_us.value)">
                                                <option <?php echo ($data['site_audit'] == '0') ? "SELECTED" : "" ?> value="0">Hide</option>
                                                <option <?php echo ($data['site_audit'] == '1') ? "SELECTED" : "" ?> value="1">Show</option>
                                                <!-- <option value="1">Shown in homepage</option> -->
                                            </select>
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <label class="bg-primary text-light p-2" for="follow-widget">Follow Widget :</label>
                                            <div class="form-text">
                                                Is your follow us widgets shown or not.
                                            </div>
                                            <select name="follow_us" id="follow-widget" class="form-control" onchange="go(setting.follow_us.name, setting.follow_us.value)">
                                                <option <?php echo ($data['follow_us'] == '0') ? "SELECTED" : "" ?> value="0">Hide</option>
                                                <option <?php echo ($data['follow_us'] == '1') ? "SELECTED" : "" ?> value="1">Show</option>
                                                <!-- <option value="1">Shown in homepage</option> -->
                                            </select>
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <label class="bg-primary text-light p-2" for="newsletter">Newsletter Widget :</label>
                                            <div class="form-text">
                                                Newsletter subscription field shown or not.
                                            </div>
                                            <select name="newsletter" id="newsletter" class="form-control" onchange="go(setting.newsletter.name, setting.newsletter.value)">
                                                <option <?php echo ($data['newsletter'] == '0') ? "SELECTED" : "" ?> value="0">Hide</option>
                                                <option <?php echo ($data['newsletter'] == '1') ? "SELECTED" : "" ?> value="1">Show</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-primary text-light p-2">Post Tags Widget :</div>
                                            <div class="form-text">
                                                Post tags wigets shown in homepage right sidebar or not ?
                                            </div>
                                            <select name="tags_in_main" id="tags" class="form-control" onchange="go(setting.tags_in_main.name, setting.tags_in_main.value)">
                                                <option <?php echo ($data['tags_in_main'] == '0') ? "SELECTED" : "" ?> value="0">Hide</option>
                                                <option <?php echo ($data['tags_in_main'] == '1') ? "SELECTED" : "" ?> value="1">Show</option>
                                            </select>
                                        </div>

                                        <!-- most view post -->
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-primary text-light p-2">Most Visited Posts :</div>
                                            <div class="form-text">
                                                Post tags wigets shown in homepage right sidebar or not ?
                                            </div>
                                            <select name="most_visited" id="tags" class="form-control" onchange="go(setting.most_visited.name, setting.most_visited.value)">
                                                <option <?php echo ($data['most_visited'] == '0') ? "SELECTED" : "" ?> value="0">Hide</option>
                                                <option <?php echo ($data['most_visited'] == '1') ? "SELECTED" : "" ?> value="1">Show</option>
                                            </select>
                                        </div>



                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 bg-info text-light p-2 m-2">
                                            Category
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <label class="label bg-info text-light p-2 m-2" for="category">Category :</label>
                                            <div class="form-text">
                                                Where do you want to show your category. by default in main content.
                                            </div>
                                            <select name="cat_show_in" id="category" class="form-control" onchange="go(setting.category.name, setting.category.value)">
                                                <option <?php echo ($data['cat_show_in'] == 'main') ? "SELECTED" : "" ?> value="main">Into Main Content</option>
                                                <option <?php echo ($data['cat_show_in'] == 'sideBar') ? "SELECTED" : "" ?> value="sideBar">Right SideBar</option>

                                            </select>
                                        </div>

                                        <div class="col-lg-3 p-2 my-2">
                                            <label class="bg-info text-light p-2 m-2" for="cat-item">Category Item :</label>
                                            <div class="form-text">
                                                How many category name want to show into category widgets
                                            </div>

                                            <input type="number" name="category_item" id="cat-item" class="form-control" value="<?php echo $data['category_item'] ?>" onchange="go(setting.category_item.name, setting.category_item.value)">
                                        </div>


                                    </div>

                                    <!-- define 4 category  -->
                                    <div class="row my-2">

                                        <div class="col-12 bg-warning text-light p-2">
                                            <strong>Homepage post show accroding following category :</strong>
                                        </div>

                                        <?php
                                        $cat = $mysql->select([])->from('category')->get();
                                        // $category = $cat->fetch_assoc();
                                        // $cat_len = $cat->num_rows;

                                        ?>

                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-warning text-light p-2" for="first">First Category :</div>
                                            <select class="form-control" name="cat_1" id="first" onchange="go(setting.cat_1.name, setting.cat_1.value)">
                                                <option value="">select category</option>
                                                <?php
                                                while ($category = $cat->fetch_assoc()) {
                                                ?>
                                                    <option <?php echo ($data['cat_1'] == $category["catId"]) ? "SELECTED" : "" ?> value="<?php echo  $category["catId"] ?>"> <?php echo $category["catName"] ?> </option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-warning text-light p-2" for="second">Second Category :</div>
                                            <select class="form-control" name="cat_2" id="second" onchange="go(setting.cat_2.name, setting.cat_2.value)">
                                                <option value="">select category</option>
                                                <?php

                                                $cat = $mysql->select([])->from('category')->get();
                                                while ($category = $cat->fetch_assoc()) {
                                                ?>
                                                    <option <?php echo ($data['cat_2'] == $category["catId"]) ? "SELECTED" : "" ?> value="<?php echo  $category["catId"] ?>"> <?php echo $category["catName"] ?> </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-warning text-light p-2" for="third">Third Category :</div>
                                            <select class="form-control" name="cat_3" id="third" onchange="go(setting.cat_3.name, setting.cat_3.value)">
                                                <option value="">select category</option>
                                                <?php

                                                $cat = $mysql->select([])->from('category')->get();
                                                while ($category3 = $cat->fetch_assoc()) {
                                                ?>
                                                    <option <?php echo $data['cat_3'] == $category3['catId'] ? "SELECTED" : "" ?> value="<?php echo  $category3["catId"] ?> "><?php echo $category3["catName"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-warning text-light p-2" for="forth">Forth Category :</div>
                                            <select class="form-control" name="cat_4" id="forth" onchange="go(setting.cat_4.name, setting.cat_4.value)">
                                                <option value="">select category</option>
                                                <?php

                                                $cat = $mysql->select([])->from('category')->get();
                                                while ($category4 = $cat->fetch_assoc()) {
                                                ?>
                                                    <option <?php echo $data['cat_4'] == $category4['catId'] ? "SELECTED" : "" ?> value="<?php echo  $category4["catId"] ?> "><?php echo $category4["catName"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row my-2">
                                        <div class="col-lg-3 p-2 my-2">
                                            <div class="label bg-primary text-light p-2" for="latest">Latest Post :</div>
                                            <div class="form-text">
                                                How many post show in latest post part.
                                            </div>
                                            <input type="number" name="latest" id="latest" class="form-control" value="<?php echo $data["latest"] ?>" onchange="go(setting.latest.name, setting.latest.value)">
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


        function go(name, value) {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                alert(this.responseText);
            }
            //coderbees/admin/funciton/home_page.php
            xhttp.open("GET", "../function/home_page.php?fild=" + name + "&value=" + value, true);
            xhttp.send();
        }
    </script>
</body>

</html>