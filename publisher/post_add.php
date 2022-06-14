<?php
include "connection.php";

if(!isset($_SESSION["publisher_key"])){
    header("location: login.php");
}

$key = $_SESSION["publisher_key"] ?? "";


if(isset($_POST["post"])){

    $title = $_POST["title"];
    $author = $auth_publisher["publisherId"];
    $category = $_POST["category"];
    $tag = $_POST["tag"];
    $description = $_POST["description"];
    $created_at = date("Y-m-d");
    $image = $_FILES["image"]["name"];

    //echo $created_at;
    //add post
    $sql = "INSERT INTO posts (postTitle, postPublisher, postCategory, postTag, post, postImage, postCreated_at) VALUES ('$title','$author','$category','$tag','$description','$image','$created_at')";
    if (mysqli_query($conn, $sql)) {

        //upload post image to server
        if ($_FILES["image"]['name'] != ''){

            if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {
            
            if(strlen($_FILES["image"]["name"]) > 100){
                    ?>
                        <script>
                            alert("Image Name Too long. Please short it !");
                            window.location.href = "post_add.php";
                        </script>
                    <?php
            }else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../image/". $_FILES["image"]['name'])) {
                        
                    }else {
                        ?>
                            <script>
                                alert("Faild to upload your image !!");
                                window.location.href = "post_add.php";
                            </script>
                        <?php
                    }
            }

            }else {
                ?>
                    <script>
                        alert("Only jpg, png, jpeg file support !");
                        window.location.href = "post_add.php";
                    </script>
                <?php
            }

        };

        header("location: post_view.php");

        $name = '';
        $author = '';
        $email = '';
        $phone = '';
    }else{
        echo mysqli_error($conn);
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

    <title> Add post - coderbees publisher Control</title>

    <!-- Custom fonts for this template-->
    <link href="<?php PUBLISHER_PATH?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php PUBLISHER_PATH?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    
    <style>
        td{
            text-align: center;
            font-size: 12px;
        }
    </style>

</head>

<body id="page-top" >

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php include PUBLISHER_PATH."sideBar.php" ?>
        <!-- End of Sidebar -->


        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include PUBLISHER_PATH."topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="background-color: rgba(0,0,0,0.2);" >
                    <!-- Content Row -->
                    
                    <form action="" method="post" class="card text-dark" enctype="multipart/form-data" >
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Add A New Post</h6>
                        </div>
                        <div class="row p-2 card-body">
                            <div class="col-lg-8">
                                <label for="title">Post Title :</label>
                                <input type="text" name="title" id="title" placeholder="post title.." class="form-control">
                                <div class="form-text">
                                    give your post a meaningfull and unique title
                                    <p><?php $name_erro ?? "" ?></p>
                                </div>
                                
                            </div>
                            <div class="col-lg-4">
                                <label for="category">Category</label>
                                <select name="category" id="category"  class="form-select form-control" aria-label="Default select example">
                                    <option > Select category </option>
                                    <?php 
                                        
                                        $result = getCategories();
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='".$row['catId']."'>".$row['catName']."</option>";
                                        }
                                    ?>
                                </select>
                                <div class="form-text">
                                    it is required to select a category. it is make easier to find post.
                                    <p><?php $cat_error ?? "" ?></p>
                                </div>
                            </div>
                            <div class="col-lg-12 my-2">
                                <label for="description">Post Details </label>
                                <textarea class="form-control" name="description" id="summernote"></textarea>
                                <div class="form-text">
                                    Describe your post
                                </div>
                            </div><hr>

                            <div class="col-lg-6">
                                <label for="tab">Tag</label>
                                <input type="text" name="tag" id="tag" class="form-control" placeholder="ex : intetainment">
                            </div>

                            <div class="col-lg-6">
                                <label for="image">Post Image</label>
                                <input type="file" name="image" id="image" class="form-control form-input">
                                <div>
                                    Feature imag
                                    <p><?php echo $image_error ?? "" ?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 float-end">
                                <input  type="submit" name="post" class="btn btn-primary btn-md float-end" value="Post">
                            </div>

                        </div>
                    </form>
                    <!-- Content Row -->

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
    <script src="<?php PUBLISHER_PATH?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php PUBLISHER_PATH?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php PUBLISHER_PATH?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php PUBLISHER_PATH?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins
    <script src="<?php PUBLISHER_PATH?>vendor/chart.js/Chart.min.js"></script>

    

   sumernote  -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
      $('#summernote').summernote({
        placeholder: 'Write Your Posts',
        tabsize: 3,
        height: 200
      });
    </script>

</body>

</html>