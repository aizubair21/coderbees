<?php


include "../connection.php";
include "../../configuration/QueryHandeler.php";

$mysql = new DBInsert;
$select = new DBSelect;

if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}

if (isset($_POST["category_insert"])) {

    $name_error = "";
    $image_error = '';

    $name = trim($_POST["name"]);
    $slug = $slug = strtolower(str_replace(" ", "-", $name));
    $author = $auth_admin["adminId"];
    $image = $_FILES["image"]["name"];
    $description = $_POST["description"];
    $created_at = date("y-m-d");

    //database category
    $cat_qry = $select->select(['catName'])->from('category')->get();
    $cat = $cat_qry->fetch_assoc();

    //error handle 
    if (empty($name)) {
        $name_error = "Fild is required";
    }
    if ($cat["catName"] == $name) {
        $name_error = "Category already exist!";
        $GLOBALS['exist'] = "yes";
    }


    //if there no error
    if ((empty($name_error) && empty($image_error))) :
        if (!$_FILES["image"]['name']) {

            $sql = $mysql->insert("category", ['catName', 'catSlug', 'catAuthor', 'catCreated_at', 'catDescription'], [$name, $slug, $author, $created_at, $description]);
            if ($sql == 'success') {
                $_SESSION['status'] = 'category_added';
                header("location: index_category.php");
                $name = '';
                $slug = '';
                $author = '';
                $description = '';
            } else {
                echo mysqli_error($conn);
            }
        } else {
            $sql = $mysql->insert('category', ['catName', 'catSlug', 'catAuthor', 'catCreated_at', 'catImage', 'catDescription'], [$name, $slug, $author, $created_at, $image, $description]);
            if (mysqli_query($conn, $sql)) {
                if ($_FILES["image"]['name'] != '') {

                    if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {

                        if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../image/category" . $_FILES["image"]['name'])) {
                            @unlink("../../image/category/" . $cat["catImage"]);
?>
                            <script>
                                alert("Successfully inserted ");
                                window.location.href = "index.php";
                            </script>
                        <?php

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

    <title>Category Insert - Admin Dashboard</title>

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
        <?php include  "../sideBar.php"; ?>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "../topBar.php"; ?>
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

                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div>

                                            <div>
                                                <label class="form-label" for="name ">Name :</label>
                                                <input type="text" name="name" id="name" placeholder="Nname..." value="<?php echo ($name) ?? "" ?>" class="form-control <?php echo (isset($name_error)) ? "is-invalid" : "" ?>">
                                                <?php
                                                if (!empty($name_error)) {
                                                    echo "<strong class='text text-danger'> $name_error </strong>";
                                                }
                                                ?>
                                            </div><br>

                                            <div>
                                                <label class="form-label" for="description ">Description :</label>
                                                <input type="text" name="description" id="description" placeholder="category description..." class="form-control">
                                            </div>
                                            <hr>

                                            <div>
                                                <label class="form-label" for="image ">image :</label>
                                                <input type="file" name="image" id="image" placeholder="image..." class="form-control form-file">
                                                <?php
                                                if (isset($image_error)) {
                                                    echo "<strong class='text text-danger'> {$image_error} </strong>";
                                                }
                                                ?>
                                            </div>
                                            <hr>

                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <a class="btn btn-danger" href="index.php">Cancel</a>
                                                <strong>OR</strong>
                                                <button type="submit" name="category_insert" class="btn btn-primary">Insert</button>
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
    <!-- <script src="../vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="../js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="../js/demo/chart-pie-demo.js"></script> -->

    <!-- Page level plugins -->
    <!-- <script src="../vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="../js/demo/datatables-demo.js"></script> -->

</body>

</html>