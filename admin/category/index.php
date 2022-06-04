<?php

include"../connection.php";

if(isset($_POST["category_add"]) && $_POST["name"] != ""){
    $name = $_POST["name"];
    $slug = strtolower(str_replace(" ","-",$name)) ;
    //print_r($auth_user['id']);
    $author = $auth_user["id"];

    $sql = "INSERT INTO category (name, slug, author) VALUES('$name','$slug','$author')";
    if(mysqli_query($conn, $sql)){
        //header("location: index.php");
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

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php include ADMIN_PATH."sideBar.php"; ?>
        <!-- End of Sidebar -->


        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    <?php include ADMIN_PATH."topBar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="row p-1">
                    <div class="col-lg-9" >
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
                                        <tbody >

                                            <?php 
                                            $sql = "SELECT * FROM category";
                                            $result = mysqli_query($conn, $sql);
                                            
                                            while ($row = mysqli_fetch_assoc($result)) {?>
                                            
                                                <tr>
                                                    <style>
                                                        td{
                                                            text-align: left;
                                                            color:black;
                                                            font-size: 13px;
                                                        }
                                                    </style>
                                                    
                                                    <td> <a href="/coderbees/admin/category_view?category=<?php echo $row["catId"]?>"><?php echo $row["catName"] ?></a> </td>
                                                    <td><?php echo $row["catSlug"] ?></td>
                                                    <td><img style="width:50px; height:50px" src="../image/category<?php echo $row["catImage"] ?>" alt="Not Found"></td>
                                                    <td><?php echo $row["catCreated_at"] ?></td>
                                                    <td>
                                                        <?php 

                                                            $auth_id = $row["catAuthor"];
                                                            $pub = "SELECT * FROM publisher where publisherId='$auth_id'";
                                                            $publisher = mysqli_fetch_assoc(mysqli_query($conn, $pub));
                                                            echo $publisher["publisherUser_name"] ?? "";
                                                        ?>
                                                    </td>
                                                    <td>01</td>
                                                    <td  class="d-flex justify-content-center align-items-center">
                                                        <div class="d-flex">
                                                            <a href="delete.php?id=<?php echo  $row["catId"] ?>" title="Delete" class="btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                            <a href="update.php?id=<?php echo  $row["catId"] ?>" title="Update" class="btn-info btn-sm"><i class="fas fa-pen-alt"></i></a>
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
                                <form action="index.php" method="POST">
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

</body>

</html>