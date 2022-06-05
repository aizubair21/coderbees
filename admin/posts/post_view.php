<?php
include "../connection.php";

if(!isset($_SESSION["admin_key"])){
    header("location: ../index.php");
}

$postStatus = 1;
$key = $_SESSION["admin_key"] ?? "";

$post = "SELECT * FROM posts";
$total_post = mysqli_num_rows(mysqli_query($conn, $post));
$post_approved = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE postStatus = '$postStatus'"));
 



$postId =$_GET['id'] ?? "";
if (isset($postId)) {

    // $post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM posts"));
    // $delete = "DELETE FROM posts WHERE postId='$postId'";

    // if (mysqli_query($conn, $delete)) {
    //     @unlink('../image/'.$post['image']);
    // }
    
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

    <title> All Post - Admin Dashoard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    
    <link href="<?php ADMIN_PATH ?>../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-5.1.0-dist/css/bootstrap-utilities.min.css">

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
            <?php include ADMIN_PATH."sideBar.php" ?>
        <!-- End of Sidebar -->


        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: #8080805e;">

                <!-- Topbar -->
                <?php include ADMIN_PATH."topBar.php" ?>
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
                                            <i class="fas fa-blog fa-2x text-primary"></i>
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
                                            <i class="fas fa-check-circle fa-2x text-success"></i>
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
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                            $block = "0";
                                                            $block_post =  mysqli_num_rows(mysqli_query($conn,"SELECT postId FROM posts  WHERE postStatus = '$block'"));
                                                            echo $block_post;
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-ban fa-2x text-danger"></i>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    echo ($total_post - ($post_approved+$block_post));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-pause fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-primary " style="overflow:scroll">
                                    <h6 class="m-0 font-weight-bold text-white">Posts Data</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-responsive"  id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <style>
                                                th {
                                                    text-align: center;
                                                }
                                            </style>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Tag</th>
                                                <th>Author</th>
                                                <th>Status</th>
                                                <th>Comments</th>
                                                <th>Feature Image</th>
                                                <th>Post Date</th>
                                                <th>Update</th></th>
                                                <th>E/D</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $post = "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory LEFT JOIN publisher ON publisherId=postPublisher ORDER BY 'postCreated_at'";
                                                $result = mysqli_query($conn, $post);

                                                while ($row = mysqli_fetch_assoc($result)) {?>
                                                    <style>
                                                        td {
                                                            font-size: 11px;
                                                            padding: 0;
                                                        }
                                                    </style>
                                                    
                                                    <tr>
                                                        <td style="padding:0px;">
                                                        
                                                            <?php echo $row["postId"] ?>
                                                        
                                                        </td>
                                                        <td style="padding:0px;" class="text-left"> <a href="/coderbees/posts?id=<?php echo  $row["postId"] ?>"> <?php echo  $row["postTitle"] ?> </a></td>
                                                        <td style="padding:0px;" class="text-left"><?php echo  $row["catName"] ?></td>
                                                        <td style="padding:0px;"><?php echo $row["postTag"] ?></td>
                                                        <td style="padding:0px;" class="text-left"> 
                                                            <?php echo $row["publisherUser_name"] ?>
                                                        </td>
                                                        <td style="padding:0px;">
                                                            <?php 
                                                                if ($row["postStatus"] == NULL) {
                                                                    echo "<strong class='text text-warning btn-sm'>Pending</strong>";
                                                                }elseif($row["postStatus"] == 1){?>
                                                                    <a href='post_unapprove.php?post=<?php echo $row["postId"] ?>' class='text text-success'>Unapprove</a>
                                                                <?php } else {?>
                                                                    <a href='post_unblock.php?post=<?php echo $row["postId"] ?>' class='btn btn-danger btn-sm'>Unblock</a>
                                                                <?php }
   
                                                            ?> 
                                                        </td>
                                                        <td style="padding:0px;"></td>
                                                        <td style="padding:0px;"><img style="width:70px" src="../image/<?php echo $row["postImage"] ?>" alt="Not Fount"></td>
                                                        <td style="padding:0px;"><?php echo $row["postCreated_at"] ?></td>
                                                        <td style="padding:0px;"><?php echo $row["postUpdate_at"] ?></td>
                                                        <td style="padding:0px;"  class="d-flex justify-content-center align-items-center">
                                                            <div class="d-flex">
                                                                <a href="post_view.php?id=<?php echo  $row["postId"] ?>" title="Delete" class="btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                                
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
    <script src="../js/demo/datatables-demo.js"></script>


</body>

</html>