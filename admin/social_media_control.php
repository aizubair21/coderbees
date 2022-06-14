<?php


include "connection.php";

if (!isset($_SESSION['admin_key'])) {
    header("location: index.php");
}
$error = '';
if (isset($_POST["add_social_media"])) {
    $sml = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM social_media_link"));
    if ($sml > 0) {
        $fb = $_POST["Facebook"];
        $twit = $_POST["Twitter"];
        $li = $_POST["Linkedin"];
        $ins = $_POST["Instagram"];
        $yt = $_POST["Youtube"];
        $vimo = $_POST["Vimo"];

        $trancate = "TRUNCATE TABLE `social_media_link`";
        if (mysqli_query($conn, $trancate)) {
              $sml = mysqli_query($conn, "INSERT INTO `social_media_link`(`facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `vimo`) VALUES ('$fb','$twit','$ins','$li','$yt','$vimo')");
            if ($sml) {
                $error = "Successfully added !";
                echo "succcess";
            }else {
                echo mysqli_error($conn);
            }
        }

      
    }else {
        $fb = $_POST["Facebook"];
        $twit = $_POST["Twitter"];
        $li = $_POST["Linkedin"];
        $ins = $_POST["Instagram"];
        $yt = $_POST["Youtube"];
        $vimo = $_POST["Vimo"];

        $sml = mysqli_query($conn, "INSERT INTO `social_media_link`(`facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `vimo`) VALUES ('$fb','$twit','$ins','$li','$yt','$vimo')");
        if ($sml) {
            $error = "Successfully added !";
            echo "succcess";
        }else {
            echo mysqli_error($conn);
        }
    }
}

if (isset($_REQUEST["delete_all"])) {
    mysqli_query($conn, "DELETE * FROM social_media_link");
}
if (isset($_GET["update"])) {
    echo "udpate all";
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

    <title>Publisher - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .hide {
            display: none;
        }
        .show{
            display: flex;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sideBar.php" ?>
        <!-- End of Sidebar -->


        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    <?php include "topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                
                <div class="row p-1">
                    <div class="col-lg-8" >
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable">
                                        <thead>
                                            
                                            <tr>
                                                <th>Facebook</th>
                                                <th>Twitter</th>
                                                <th>LinkedIn</th>
                                                <th>Instagram</th>
                                                <th>Youtube</th>
                                                <th>Vimo</th>
                                                <th>Modify</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                    
                                        <?php 
                                            $sql = "select * from social_media_link";
                                            $result = mysqli_query($conn, $sql);
                                            
                                            while ($row = mysqli_fetch_assoc($result)) {?>
                                            
                                                    <tr>
                                                        <style>
                                                            td{
                                                               text-align: center;
                                                               font-size: 12px;
                                                            }
                                                        </style>

                                                        <td><?php echo $row["facebook"] ?></td>
                                                        <td><?php echo $row["twitter"] ?></td>
                                                        <td><?php echo $row["instagram"] ?></td>
                                                        <td><?php echo $row["linkedin"] ?></td>
                                                        <td><?php echo $row["youtube"] ?></td>
                                                        <td><?php echo $row["vimo"] ?></td>
                                                        <td>
                                                            <button type="success" name="delete_all" class="btn btn-warning btn-sm"> <i class="fas fa-trash"></i> All</button>    
                                                            <button type="success" name="update" class="btn btn-info btn-sm"> <i class="fas fa-pen"></i> All </button>    
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 p-5 font-weight-bold bg-primary font-weight-bold font-large text-light">Add Social Media</h6>
                            </div>
                            
                            <div class="card-body">
    
                                <form action="social_media_control.php" method="post">
                                    
                                        <div class="p-2 mb-1">
                                            <label for="facebook">Facebook Link</label>
                                            <input type="text" name="Facebook" id="facebook" placeholder="Facebook Follow Link" class="form-control form-input">
                                        </div>
                                        <div class="p-2 mb-1">
                                            <label for="facebook">Twitter Link</label>
                                            <input type="text" name="Twitter" id="Twitter" placeholder="Twitter Follow Link" class="form-control form-input">
                                        </div>
                                        <div class="p-2 mb-1">
                                            <label for="facebook">Instagram Link</label>
                                            <input type="text" name="Instagram" id="Instagram" placeholder="Instagram Follow Link" class="form-control form-input">
                                        </div>
                                        <div class="p-2 mb-1">
                                            <label for="facebook">Youtube Link</label>
                                            <input type="text" name="Youtube" id="Youtube" placeholder="Youtube Follow Link" class="form-control form-input">
                                        </div>
                                        <div class="p-2 mb-1">
                                            <label for="facebook">linkedin Link</label>
                                            <input type="text" name="Linkedin" id="linkedin" placeholder="linkedin Follow Link" class="form-control form-input">
                                        </div>
                                        <div class="p-2 mb-1">
                                            <label for="facebook">Vimo Link</label>
                                            <input type="text" name="Vimo" id="Vimo" placeholder="Vimo Follow Link" class="form-control form-input">
                                        </div>
                                        <br>
                                        <div>
                                            <button type="success" name="add_social_media" class="btn btn-success btn-lg">Add</button>
                                        </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js.map"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        
    </script>

</body>

</html>