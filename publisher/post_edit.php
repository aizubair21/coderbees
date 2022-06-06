<?php
include "connection.php";

if(!isset($_SESSION["publisher_key"])){
    header("location: ../login.php");
}

$key = $_SESSION["publisher_key"] ?? "";
$postId = $_REQUEST["id"];



//get upldated datq
$post = getSingleData("posts",$postId);


//post update 

if(isset($_POST["post_update"])){
    
    $name_error = "";
    $user_name_error = "";
    $email_error = "";
    $phone_error = "";
    $password_error = "";
    $error = '';

    $name = $_POST["title"];
    $tag = $_POST["tag"];
    $author = $auth_publisher["publisherId"];
    $image = $_FILES["image"]["name"];
    $description = $_POST["description"];
    $update = date("y-m-d");
    $category = $_POST["category"];
    $status = 0;

    if(!$_FILES["image"]['name']){

        $sql = "UPDATE posts SET postTitle='$name', postTag='$tag',postStatus='$status', postCategory='$category', postPublisher='$author', post='$description', postUpdate_at='$update' WHERE postId = '$postId'";
        if (mysqli_query($conn, $sql)) {
            header("location: post_view.php");
            $name = '';
            $slug = '';
            $author = '';
            $description = '';
        }else{
            echo mysqli_error($conn);
        }

    }else {
        $sql = "UPDATE `posts` SET `postTitle`='$name',`postPublisher`='$author',`postImage`='$image',`postCategory`='$category',`postTag`='$tag',`postStatus`='$status',`post`='$description',`postUpdate_at`='$update' WHERE postId = '$postId'";
        if (mysqli_query($conn, $sql)) {
            @unlink('../image/'.$row['image']);
            if ($_FILES["image"]['name'] != ''){

                if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {
                   
                   if(strlen($_FILES["image"]["name"]) > 100){
                        ?>
                            <script>
                                alert("Image Name Too long. Please short it !");
                                window.location.href = "post_view.php";
                            </script>
                        <?php
                   }else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], "../image/". $_FILES["image"]['name'])) {
                            ?>
                                <script>
                                    alert("Success, Upload done.");
                                </script>
                            <?php
                            header("location: post_view.php");

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

    <title>Post Edit - Coderbees publisher control</title>

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

<body id="page-top">

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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Update and Edit post</h1>
                    </div>

                    <!-- Content Row -->
                   
                    <!-- Content Row -->

                    <form action="" method="post" class="card text-dark" enctype="multipart/form-data" >
                        
                        <div class="row p-2 card-body">
                            <div class="col-lg-8">
                                <label for="title">Post Title :</label>
                                <input type="text" name="title" id="title" placeholder="post title.." class="form-control" value=" <?php echo $post["postTitle"] ?>">
                                <div class="form-text">
                                    give your post a meaningfull and unique title
                                    <p><?php $name_erro ?? "" ?></p>
                                </div>
                                
                            </div>
                            <div class="col-lg-4">
                                <label for="category">Category</label>
                                <select name="category" id="category"  class="form-select form-control" aria-label="Default select example" >
                                    <option > Select category </option>
                                    <?php 
                                        
                                        $result = getCategories();
                                        while ($row = mysqli_fetch_array($result)) {?>

                                            <option <?php echo '($row["catId"] == $post["postCategory"]) ? SELECTED : ""' ?> value="<?php echo $row["catId"] ?>" ><?php echo $row["catName"] ?></option>

                                        <?php }
                                    ?>
                                </select>
                                <div class="form-text">
                                    it is required to select a category. it is make easier to find post.
                                    <p><?php $cat_error ?? "" ?></p>
                                </div>
                            </div>
                            <div class="col-lg-12 my-2">
                                <label for="description">Post Details </label>
                                <textarea type="text" class="form-control" name="description" id="summernote"><?php echo $post["post"]?></textarea>
                                <div class="form-text">
                                    Describe your post
                                </div>
                            </div><hr>
                            <div class="col-md-12">
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="tab">Tag</label>
                                            <input type="text" name="tag" id="tag" class="form-control" placeholder="ex : intetainment" value="<?php echo $post["postTag"] ?>">
                                        </div><br>
            
                                        <div>
                                            <label for="image">Post Image</label><br>
                                            <input type="file" name="image" id="image" class="form-control form-input">
                                            <div>
                                                <p><?php echo $image_error ?? "" ?></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 text-align-center p-2 border " >
                                        <div>
                                            <label for="image">Feature Image</label>
                                        </div>
                                        <img width="30%" style="box-sizing: border-box;" src="uploads/post/<?php echo $post["postImage"] ?>" alt="Not Found" id="image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 float-end">
                                <input  type="submit" name="post_update" class="btn btn-primary btn-md float-end" value="Update">
                            </div>

                        </div>
                    </form>

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

    <!-- Page level plugins -->

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
      $('#summernote').summernote({
        tabsize: 3,
        height: 200
      });
    </script>

</body>

</html>