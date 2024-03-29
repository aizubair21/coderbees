<?php


include "../connection.php";
include "../../configuration/QueryHandeler.php";
$update = new DBUpdate;
$mysql = new DBSelect;

if (!isset($_SESSION["admin_key"])) {
    header("location: ../../index.php");
}


$id = $_REQUEST['id'] ?? "";

if (isset($_POST["category_update"])) {

    $name_error = "";
    $image_error = '';

    $name = trim($_POST["name"]);
    $slug = strtolower(str_replace(" ", "-", $name));
    $author = $_POST["author"];
    $image = $_FILES["image"]["name"];
    $description = $_POST["description"];
    $uid = $_POST["update_id"];
    $row = getCategory($id);
    //print_r($row);
    //echo $created_at;
    // $cat_sql = $mysql->select(['catId', 'catName', 'catImage'])->from('category')->where("catId = $id")->get();
    $cat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE catId = $id"));

    //error handle 
    if (empty($name)) {
        $name_error = "Fild is required";
    }
    if ($cat["catName"] == $name) {
        $name_error = "Category already exist!";
    }


    //if there no error;
    if ((empty($name_error) && empty($image_error))) :
        if (!$_FILES["image"]['name']) {

            $sql = $update->on("category")->set(['catName', 'catSlug', 'catDescription', 'catAuthor'])->value([$name, $slug, $description, $author])->where("catId = $uid")->go();
            if ($sql = "success") {
                header("location: index_category.php");
                //echo "without image";
                $name = '';
                $slug = '';
                $author = '';
                $description = '';
            } else {
                echo $sql;
            }
        } else {
            $sql = $update->on("category")->set(['catName', 'catSlug', 'catImage', 'catDescription', 'catAuthor'])->value([$name, $slug, $image, $description, $author])->where("catId = $uid")->go();
            if ($sql == "success") {
                @unlink('../../image/category' . $row['catImage']);
                if ($_FILES["image"]['name'] != '') {

                    if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {

                        if (strlen($_FILES["image"]["name"]) > 100) {
                            $_SESSION['status'] = 'image_length_error';
                            header("location: index_category.php");
                        } else {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../image/category" . $_FILES["image"]['name'])) {
                                $_SESSION['status'] = 'category_updated';
                                header("location: index_category.php");
                            } else {
                                $_SESSION['status'] = 'image_error';
                            }
                        }
                    } else {
                        $_SESSION['status'] = 'image_type_error';
                    }
                };

                $name = '';
                $slug = '';
                $author = '';
                $description = '';
            } else {
                echo $sql;
            }
        }

    endif;
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

    <title>Category edit - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../function/logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <div class="card shadow">
                                <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                                    Update Your Publisher Info
                                </div>

                                <?php
                                $sql = "SELECT * FROM category where catId = '$id'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                ?>


                                <div class="card-body">

                                    <form action="update_category.php" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <input type="hidden" name="update_id" value="<?php echo ($_REQUEST['id']) ?>">

                                            <div>
                                                <label class="form-label" for="name ">Name :</label>
                                                <input type="text" name="name" value="<?php echo $row['catName'] ?>" id="name" placeholder="Nname..." class="form-control <?php echo (isset($name_error) ? "is-invalid" : "") ?>">
                                                <?php
                                                if (isset($name_error)) {
                                                    echo "<strong class='text text-danger'> {$name_error} </strong>";
                                                }
                                                ?>
                                            </div><br>
                                            <div>
                                                <label class="form-label" for="author ">Author :</label>
                                                <select name="author" id="author" class="form-control">
                                                    <?php
                                                    $pub = "SELECT * FROM publisher";
                                                    $result = mysqli_query($conn, $pub);
                                                    while ($author = mysqli_fetch_assoc($result)) { ?>
                                                        <option <?php if ($author["publisherId"] == $row["catAuthor"]) { ?> selected <?php } ?> value="<?php echo $author["publisherId"]; ?>"><?php echo $author["publisherUser_name"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div><br>

                                            <div>
                                                <label class="form-label" for="description ">Description :</label>
                                                <input type="text" name="description" value="<?php echo $row['catDescription'] ?? "" ?>" id="description" placeholder="category description..." class="form-control">
                                            </div><br>

                                            <div class="row">
                                                <div>
                                                    <img width="20%" src="../../image/<?php echo $row["catImage"] ?>" alt="">
                                                </div>
                                                <div>
                                                    <label class="form-label" for="image ">image :</label>
                                                    <input type="file" name="image" id="image" placeholder="image..." class="form-control from-file">
                                                </div>
                                            </div>
                                            <hr>


                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <a class="btn btn-danger" href="index.php"> <i class="fas fa-arrow-left pr-2"></i> Cancel</a>
                                                <strong>OR</strong>
                                                <button type="submit" name="category_update" class="btn btn-primary"> <i class="fas fa-sync pr-2"></i> Update</button>
                                            </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

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

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] = 'image_length_error') {

    ?>
            <script>
                toastr.warning('Warning ! Image length too long. Please, short it.');
            </script>
        <?php
        }

        if ($_SESSION['status'] = 'image_error') {
        ?>
            <script>
                toastr.warning('Faild to upload image.');
            </script>
        <?php
        }

        if ($_SESSION['status'] == 'image_type_error') {
        ?>
            <script>
                toastr.warning('Image not support! only jpg, png, jpeg image supported.');
            </script>
    <?php
        }
    }
    ?>


</body>

</html>