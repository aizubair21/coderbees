<?php
include "connection.php";

if(!isset($_SESSION["admin_key"])){
    header("location: login.php");
}

$key = $_SESSION["admin_key"] ?? "";
$post = "SELECT * FROM posts";
$total_post = mysqli_num_rows(mysqli_query($conn, $post));
$post_approved = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE postStatus = '1'"));
 



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
    <link href="<?php ADMIN_PATH?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php ADMIN_PATH?>css/sb-admin-2.min.css" rel="stylesheet">

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
            <div id="content">

                <!-- Topbar -->
                <?php include ADMIN_PATH."topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Site Overview</a>
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
                                                Category</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $category_qry = mysqli_num_rows(mysqli_query($conn, "SELECT catId FROM category"));
                                                    echo $category_qry;    
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-id-card fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Publisher
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    
                                                        <?php 
                                                            $block = '1';
                                                            $block_post = mysqli_num_rows(mysqli_query($conn, "SELECT publisherId FROM publisher WHERE publisherStatus = '$block'"));
                                                            echo $block_post;
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users  fa-2x text-info"></i>
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
                                               Visitor</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                               
                                            </div>
                                    </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-circle fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Recent Request</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-bordered  table-responsive" style="width:100%">
                                        <thead>
                                            <style>
                                                body {
                                                    overflow-x: hidden;
                                                    position: absolute;
                                                    box-sizing: border-box;;
                                                }
                                                #publisher_details_modal{
                                                    position: fixed;
                                                    top:-100%;
                                                    left:50%;
                                                    width:300px;
                                                    padding:3px;
                                                    background-color: rgba(0,0,0,.2);
                                                    box-shadow:0px 0px 2px 0px black;
                                                    transition: all linear .3s;
                                                    border-radius: 5px;
                                                    
                                                }
                                                #publisher:hover {
                                                    cursor: pointer;
                                                }
                                                #publisher:hover~#publisher_details_modal{
                                                    top:-0%;
                                                    transition: all linear .3s;

                                                }
                                                tr:hover > #block_button {
                                                    opacity: 0;
                                                }
                                                #post_modal {
                                                    position: fixed;
                                                    top:-300%;
                                                    left: 50%;
                                                    transform: translate(-50%);
                                                    background-color: white;
                                                    text-align: justify;
                                                    box-shadow: 0px 0px 2px black;
                                                    border-radius: 5px;
                                                    z-index: 9999;
                                                }
                                                
                                                #modal_img {
                                                    width:50px;
                                                    height:50%;
                                                    border-radius: 30%;
                                                }
                            
                                            </style>
                                            <tr>
                                                <th>Post Id</th>
                                                <th>Publisher</th>
                                                <th>Title</th>
                                                <th>Post</th>
                                                <th>Category</th>
                                                <th>Post Time</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $result_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category  ON catId = postCategory LEFT JOIN publisher ON publisherId=postPublisher WHERE postStatus IS NULL");
                                                while ($req_post = mysqli_fetch_assoc($result_qry)) {?>

                                                    <tr>
                                                        
                                                        <td><?php echo $req_post["postId"] ?></td>

                                                        <td >
                                                            <strong id="publisher"><?php echo $req_post["publisherUser_name"] ?></strong>
                                                            
                                                            <div id="publisher_details_modal" style="text-align:left;"> 
                                                                <div class="card">
                                                                    <div class="">
                                                                        <img width="100%" src="/coderbees/publisher/uploads/image/<?php echo $req_post["publisherImage"] ?>" alt="Not Found !">
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <hr>
                                                                            <div class="d-flex justify-content-between align-items-baseline">
                                                                                <h5>
                                                                                    <?php echo $req_post["publisherUser_name"] ?>
                                                                                    <strong style="font-size: 12px;"><?php echo $req_post["publisherEmail"] ?></strong>
                                                                                </h5>
                                                                                
                                                                                <span style="font-size: 12px;"><?php echo $req_post["publisherCreated_at"] ?></span>
                                                                            </div>
                                                                            <div class="d-flex justify-content-between align-items-baseline">
                                                                                <?php if($req_post["publisherStatus"] = 1){ ?>  <button class="btn btn-success btn-sm disabled">Active</button>  <?php }else{ echo "<button class='btn btn-danger btn-sm disabled' >Block</button>"; }?>
                                                                            </div>
                                                                            <hr>
                                                                            <div>
                                                                                <strong>Posts : <?php ?></strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                            <hr>
                                                                <a id="block_button" class="text text-danger" href="#">Block Publisher</a>
                                                        </td>
                                                        <td><?php echo $req_post["postTitle"] ?></td>
                                                        <td>
                                                            <?php  echo substr_replace($req_post["post"],'...',200)  ?>
                                                            <hr>
                                                            <div id="admin_button">
                                                                <a class="text text-danger" href='posts/reject_post.php?post=<?php echo $req_post["postId"] ?>'>Delete</a>
                                                                <a class="text text-success px-3" href='posts/approve_post.php?post=<?php echo $req_post["postId"] ?>'>Approve</a>
                                                                <button id="post_modal_button" onclick="openPostModal()" class="text text-secoundry" >View</button>
                                                                <div id="post_modal">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                                <div>
                                                                                    <h3><?php echo $req_post["postTitle"] ?></h3>
                                                                                    <div>
                                                                                        <img id="modal_img" src="../image/<?php echo $req_post["publisherImage"] ?>" alt="<?php echo $req_post["publisherUser_name"] ?>">
                                                                                        <strong class="px-3"><?php echo $req_post["postCreated_at"] ?></strong>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div>
                                                                                    <?php echo $req_post["post"] ?>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <button style="float:right; margin:2px" onclick="closePostModal()" class="btn btn-danger btn-close">X</button>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $req_post["catName"] ?></td>
                                                        <td><?php echo $req_post["postCreated_at"] ?></td>
                                                       
                                                        
                                                    </tr>

                                                <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <script src="<?php ADMIN_PATH?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php ADMIN_PATH?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php ADMIN_PATH?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php ADMIN_PATH?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php ADMIN_PATH?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php ADMIN_PATH?>js/demo/chart-area-demo.js"></script>
    <script src="<?php ADMIN_PATH?>js/demo/chart-pie-demo.js"></script>
    <script src="<?php ADMIN_PATH?>js/demo/datatables-demo.js"></script>
    <script>
        function openPostModal () {
            document.getElementById("post_modal").style.top = 0+"px";
        }
        function closePostModal () {
            document.getElementById("post_modal").style.top = -100+"%";
        }
    </script>

</body>

</html>