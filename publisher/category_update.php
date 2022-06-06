<?php


include "connection.php";

if(!isset($_SESSION["publisher_key"])){
    header("location: ../login.php");
}

 $id = $_REQUEST['id'] ?? "";
//echo $id;
if(isset($_POST["caegory_update"])){
    
    $name_error = "";
    $user_name_error = "";
    $email_error = "";
    $phone_error = "";
    $password_error = "";
    $error = '';

    $name = $_POST["name"];
    $slug =str_replace(" ","-",$name);
    $author = $_POST["author"];
    $image = $_FILES["image"]["name"];
    $description = $_POST["description"];
    $uid = $_POST["update_id"];

    if(!$_FILES["image"]['name']){

        $sql = "UPDATE `category` SET `catName`='$name',`catSlug`='$slug',`catAuthor`='$author',`catDescription`='$description' WHERE catId = '$id'";
        if (mysqli_query($conn, $sql)) {
            header("location: category_index.php");
            //echo "done";
            $name = '';
            $slug = '';
            $author = '';
            $description = '';
        }else{
            echo mysqli_error($conn);
        }

    }else {
        $sql = "UPDATE category SET catName='$name', catSlug='$slug', catAuthor='$author', catImage ='$image',catDescription='$description' WHERE catId = '$id'";
        if (mysqli_query($conn, $sql)) {
            @unlink('../image/category/'.$row['image']);
            if ($_FILES["image"]['name'] != ''){

                if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {
                   
                   if(strlen($_FILES["image"]["name"]) > 50){
                        ?>
                            <script>
                                alert("Image Name Too long. Please short it !");
                            </script>
                        <?php
                   }else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], "../image/category/". $_FILES["image"]['name'])) {
                            ?>
                                <script>
                                    alert("Success, Upload done.");
                                </script>
                            <?php
                            header("location: category_index.php");
                            //echo "upload done";

                        }else {
                            ?>
                                <script>
                                    alert("Faild to upload ! !");
                                </script>
                            <?php
                        }
                   }
        
                }else {
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
        }else{
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

    <title>SB Admin 2 - Dashboard</title>

    
    <!-- Custom fonts for this template-->
    <link href="<?php PUBLISHER_PATH ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php PUBLISHER_PATH ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php PUBLISHER_PATH ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sideBar.php" ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topBar.php" ?>

                <!-- Begin Page Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <div class="card">
                                <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                                    Category Edit
                                </div>

                                <?php 
                                    $sql = "SELECT * FROM category where catId = '$id'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                ?>
        
                            
                                <div class="card-body">

                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <input type="hidden" name="update_id" value="<?php echo ($_REQUEST['id']) ?>">

                                            <div>
                                                <label class="form-label" for="name ">Name :</label>
                                                <input type="text" name="name" value="<?php echo $row['catName'] ?>" id="name" placeholder="Nname..." class="form-control">
                                            </div><br>

                                            <div>
                                                <label class="form-label" for="author ">Author :</label>
                                                <select name="author" id="author" class="form-control">
                                                    <?php 
                                                        $res = mysqli_query($conn, "SELECT * FROM publisher");
                                                        while($auth = mysqli_fetch_assoc($res)) {?>

                                                            <option <?php echo($auth["publisherId"] == $row["catAuthor"]) ? 'SELECTED' : '' ?> value="<?php echo $auth["publisherId"];?>"><?php echo $auth["publisherUser_name"] ?></option>
                                                        
                                                            <?php } ?>
                                                    </select>
                                            </div><hr>

                                            <div>
                                                <label class="form-label" for="description ">Description :</label>
                                                <input type="text" name="description" value="<?php echo $row['description'] ?? "" ?>" id="description" placeholder="category description..." class="form-control">
                                            </div><hr>

                                        
                                            <div>
                                                <label class="form-label" for="image ">image :</label>
                                                <input type="file" name="image" id="image" placeholder="image..." class="form-control form-upload">
                                            </div><hr>
                                           

                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <a class="btn btn-danger" href="category_index.php">Cancel</a>
                                                <strong>OR</strong>
                                                <button type="submit" name="caegory_update"  class="btn btn-primary">Update</button>
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

</body>

</html>