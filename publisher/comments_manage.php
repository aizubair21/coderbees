<?php
include "connection.php";

if (!isset($_SESSION["publisher_key"])) {
    header("location: login.php");
}

$key = $_SESSION["publisher_key"] ?? "";
$auth_id = $auth_publisher["publisherId"];

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Comment Manage - Publisher Dashboard Coderbees </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-5.1.0-dist/css/bootstrap-utilities.min.css">

    <!-- toaster_plugin -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include PUBLISHER_PATH . "sideBar.php" ?>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include PUBLISHER_PATH . "topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Publishe's Post Comment Manage</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" id="dataTable">
                                        <tbody>
                                            <?php
                                            $comments_qry = mysqli_query($conn, "SELECT commentId, comment, commentOn, commentStatus, commentUser,commentsPostId, postTitle FROM comments LEFT JOIN posts ON posts.postId = comments.commentsPostId WHERE comments.postPublisherId = '$auth_id' ORDER BY comments.commentId DESC");
                                            while ($comment = mysqli_fetch_assoc($comments_qry)) { ?>

                                                <tr>
                                                    <th><?php echo $comment["commentId"] ?></th>
                                                    <td>
                                                        <div>
                                                            <?php echo "Post Title : " . $comment["postTitle"] ?> <a href="../single_post.php?post_id=<?php echo $comment['commentsPostId'] ?>"> <i class="fas fa-eye" title="See Post's"></i> </a>
                                                        </div>
                                                        <hr>
                                                        <div class="text-dark">
                                                            <?php echo $comment["comment"] ?>
                                                        </div>
                                                        <div>
                                                            <?php echo $comment["commentUser"] . " | " . $comment["commentOn"] ?>
                                                        </div><br>

                                                        <div>

                                                            <?php
                                                            if ($comment["commentStatus"] == NULL || $comment["commentStatus"] == 0) {
                                                                echo '<a class="btn btn-info btn-sm m-2" href="comments_approve.php?comment_id=' . urldecode($comment["commentId"]) . '">Approve</a>';
                                                                echo '<a class="btn btn-danger btn-sm m-2" href="comments_delete.php?delete_id=' . $comment["commentId"] . '">Delete</a>';
                                                            } else {
                                                                echo '<button class="btn btn-success btn-sm m-2">Approved</button>';
                                                                echo '<a class="btn btn-danger btn-sm m-2" href="comments_delete.php?delete_id=' . $comment["commentId"] . '">Delete</a>';
                                                            }

                                                            ?>

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'comment_approved') {
    ?>
            <script>
                toastr.success('Comment Approved. Now This comment shown in webpage.!');
            </script>
        <?php
        };

        if ($_SESSION['status'] == 'comment_deleted') {
        ?>
            <script>
                toastr.success('You delete a commnt. comment delete both from server and webpage.!');
            </script>
        <?php
        }
        if ($_SESSION['status'] == 'comment_updated') {
        ?>
            <script>
                toastr.success('Comment Successfully Updated!');
            </script>
    <?php
        }
    }
    include '../unset_session.php';
    ?>

</body>

</html>