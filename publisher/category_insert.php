<?php


include "connection.php";

$id = $_REQUEST['id'] ?? "";

if (!isset($_SESSION["publisher_key"])) {
    header("location: login.php");
}

if (isset($_POST["category_insert"]) && ($_POST["name"] != "")) {

    $name = $_POST["name"];
    $slug = $slug = strtolower(str_replace(" ", "-", $name));
    $author = $auth_publisher["publisherId"];
    $image = $_FILES["image"]["name"];
    $description = $_POST["description"];
    $created_at = date("y-m-d");

    if (!$_FILES["image"]['name']) {

        $sql = "INSERT INTO category (catName, catSlug, catAuthor, catCreated_at, catDescription) VALUES('$name','$slug','$author','$created_at','$description')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['status'] = 'category_added';
            header("location: category_index.php");
            $name = '';
            $slug = '';
            $author = '';
            $description = '';
        } else {
            echo mysqli_error($conn);
        }
    } else {
        $sql = "INSERT INTO category (catName, catSlug, catAuthor, catCreated_at, catDescription, catImage) VALUES('$name','$slug','$author','$created_at','$image','$description')";
        if (mysqli_query($conn, $sql)) {
            if ($_FILES["image"]['name'] != '') {

                if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../image/category/" . $_FILES["image"]['name'])) {
                        header("location: category_index.php");
                    } else {
?>
                        <script>
                            alert("Faild to upload ! !");
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Only jpg, png, jpeg file support !");
                    </script>
<?php
                }
            };

            $name = '';
            $slug = '';
            $author = '';
            $description = '';
        } else {
            echo mysqli_error($conn);
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

    <title>SB Publisher - Dashboard</title>


    <!-- Custom fonts for this template-->
    <link href="<?php PUBLISHER_PATH ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php PUBLISHER_PATH ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php PUBLISHER_PATH ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include PUBLISHER_PATH . "sideBar.php"; ?>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include PUBLISHER_PATH . "topBar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <div class="card">
                                <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                                    Insert Category
                                </div>

                                <div class="card-body">

                                    <form action="category_insert.php" method="POST" enctype="multipart/form-data">
                                        <div>

                                            <div>
                                                <label class="form-label" for="name ">Name :</label>
                                                <input type="text" name="name" id="name" placeholder="Nname..." class="form-control">
                                            </div><br>

                                            <div>
                                                <label class="form-label" for="description ">Description :</label>
                                                <input type="text" name="description" id="description" placeholder="category description..." class="form-control">
                                            </div>
                                            <hr>



                                            <div>

                                                <label class="form-label" for="image ">image :</label>
                                                <input type="file" name="image" id="image" placeholder="image..." class="form-control form-file">
                                            </div>
                                            <hr>

                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <a class="btn btn-danger" href="index.php">Cancel</a>
                                                <strong>OR</strong>
                                                <button type="submit" name="category_insert" class="btn btn-primary">Add</button>
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
    <script src="<?php PUBLISHER_PATH ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php PUBLISHER_PATH ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php PUBLISHER_PATH ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php PUBLISHER_PATH ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php PUBLISHER_PATH ?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php PUBLISHER_PATH ?>js/demo/chart-area-demo.js"></script>
    <script src="<?php PUBLISHER_PATH ?>js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?php PUBLISHER_PATH ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php PUBLISHER_PATH ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php PUBLISHER_PATH ?>js/demo/datatables-demo.js"></script>
    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'post_added') {
    ?>
            <script>
                toastr.success('Post Finally Added!');
            </script>
        <?php
        };

        if ($_SESSION['status'] == 'post_deleted') {
        ?>
            <script>
                toastr.success('Post Completely Deleted!');
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
    include '../unset_session.php';
    ?>
</body>

</html>