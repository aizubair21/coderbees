<?php

include "../connection.php";
include "../../configuration/QueryHandeler.php";
$mysql_insert = new DBInsert;

if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}

if (isset($_POST["category_add"]) && $_POST["name"] != "") {
    $name = trim($_POST["name"]);
    $slug = strtolower(str_replace(" ", "-", $name));
    //print_r($auth_user['id']);
    $author = $_SESSION["admin_key"];
    $created_at = date("y-m-d");

    $sql = $mysql_insert->insert("category", ['catName', 'catSlug', 'catAuthor', 'catCreated_at'], [$name, $slug, $author, $created_at]);
    if ($sql == 'success') {
        header("location: index_category.php");
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

    <title>Category View - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- toaster  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "../sideBar.php"; ?>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "../topBar.php"; ?>
                <!-- End of Topbar -->

                <div class="row px-2">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Category</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            echo mysqli_num_rows(mysqli_query($conn, "SELECT catId FROM category"))
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

                    <!-- <div class="col-xl-3 col-md-6 mb-4" title="Category are empty. Not posted yet those category.">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div  class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Empty</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php  ?>
                                        </div>
                                </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Earnings (Monthly) Card Example -->



                    <!-- Earnings (Monthly) Card Example -->


                    <!-- Pending Requests Card Example -->
                </div>

                <!-- Begin Page Content -->
                <div class="row p-1">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Category Data</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>

                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Image</th>
                                                <th>Created At</th>
                                                <th>Author</th>
                                                <th>Posts</th>
                                                <th>E/D</th>
                                            </tr>
                                        </thead>
                                        <!-- <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>

                                            <?php
                                            $sql = "SELECT category.catId, category.catName, category.catSlug, category.catCreated_at, category.catImage, publisher.publisherUser_name FROM category LEFT JOIN publisher ON publisher.publisherId = category.catAuthor";
                                            $result = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                                <tr>
                                                    <style>
                                                        td {
                                                            text-align: left;
                                                            color: black;
                                                            font-size: 13px;
                                                        }
                                                    </style>

                                                    <td> <a href="/coderbees/admin/category_view?category=<?php echo $row["catId"] ?>"><?php echo $row["catName"] ?></a> </td>
                                                    <td><?php echo $row["catSlug"] ?></td>
                                                    <td><img style="width:50px; height:50px" src="../../image/category<?php echo $row["catImage"] ?>" alt="Not Found"></td>
                                                    <td><?php echo $row["catCreated_at"] ?></td>
                                                    <td>
                                                        <?php
                                                        echo $row["publisherUser_name"] ?? "";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $catId = $row["catId"];
                                                        $active = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts  WHERE postCategory = $catId AND postStatus = 1"));
                                                        echo $active;
                                                        ?>
                                                    </td>
                                                    <td class="d-flex justify-content-center align-items-center">
                                                        <div class="d-flex">
                                                            <a href="delete_category.php?id=<?php echo  $row["catId"] ?>" title="Delete" class="btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                            <a href="update_category.php?id=<?php echo  $row["catId"] ?>" title="Update" class="btn-info btn-sm"><i class="fas fa-pen-alt"></i></a>
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
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                            </div>
                            <div class="card-body">
                                <form action="index_category.php" method="POST">
                                    <div>
                                        <label for="name">Category Name :</label>
                                        <input type="text" name="name" id="name" placeholder="Category Name" class="form-control form-input">
                                    </div>
                                    <div style="padding-top: 8px; float:right">
                                        <button type="submit" class="btn btn-primary btn-sm" name="category_add">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Category Statistics View</h6>
                            </div>
                            <div class="card-body">
                                <div style="display: grid; grid-template-columns:1fr 1fr; text-align:center; grid-template-rows: 1fr 1fr; grid-row-gap: 2px; grid-column-gap: 2px; color:white;">
                                    <div class="bg-info rounded p-1 fw-bold fs-1 text-align-center">
                                        <strong class="text-bold">Category</strong>

                                        <p>01</p>
                                    </div>
                                    <div class="bg-info rounded p-1 fw-bold fs-1 text-align-center">
                                        <strong class="text-bold">Active</strong>

                                        <p>01</p>
                                    </div>

                                    <div class="bg-info rounded p-1 fw-bold fs-1 text-align-center">
                                        <strong class="text-bold">Muted</strong>

                                        <p>01</p>
                                    </div>
                                    <div class="bg-info rounded p-1 fw-bold fs-1 text-align-center">
                                        <strong class="text-bold">Author</strong>

                                        <p>01</p>
                                    </div>
                                    <div class="bg-info rounded p-1 fw-bold fs-1 text-align-center">
                                        <strong class="text-bold">Most Post</strong>

                                        <p>01</p>
                                    </div>

                                    <div class="bg-info rounded p-1 fw-bold fs-1 text-align-center">
                                        <strong class="text-bold">Deleted</strong>

                                        <p>01</p>
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

    <!-- toastr plugin  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'category_added') {
    ?>
            <script>
                toastr.success('Category added successfully.');
            </script>
        <?php
        }

        if ($_SESSION['status'] == 'category_deleted') {
        ?>
            <script>
                toastr.success('Cateogry Completely Deleted!');
            </script>
        <?php
        }

        if ($_SESSION['status'] == 'category_delete_error') {
        ?>
            <script>
                toastr.warning('ERROR ! something went wrong. Not deleted.');
            </script>
        <?php
        }


        if ($_SESSION['status'] == 'category_updated') {
        ?>
            <script>
                toastr.success('Category Updated!');
            </script>
    <?php
        }
    }
    include '../../unset_session.php';
    ?>




</body>

</html>