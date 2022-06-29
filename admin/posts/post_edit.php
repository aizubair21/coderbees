<?php
include "../connection.php";

if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}

$key = $_SESSION["admin_key"] ?? "";
$postId = $_REQUEST["post"];


//get upldated datq
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT postImage FROM posts WHERE postId = '$postId'"));




//post update 

if (isset($_POST["post_update"])) {

    $name_error = "";
    $user_name_error = "";
    $email_error = "";
    $phone_error = "";
    $password_error = "";
    $error = '';

    $name = $_POST["title"];
    $tag = $_POST["tag"];
    $author = $auth_admin["adminId"];
    $image = $_FILES["image"]["name"];
    $description = $_POST["description"];
    $update = date("y-m-d");
    $category = $_POST["category"];
    $status = 0;

    if (!$_FILES["image"]['name']) {

        $sql = "UPDATE posts SET postTitle='$name', postTag='$tag',postStatus='$status', postCategory='$category', postPublisher='$author', post='$description', postUpdate_at='$update' WHERE postId = '$postId'";
        if (mysqli_query($conn, $sql)) {
            header("location: post_view.php");
            $name = '';
            $slug = '';
            $author = '';
            $description = '';
        } else {
            echo mysqli_error($conn);
        }
    } else {
        $sql = "UPDATE `posts` SET `postTitle`='$name',`postPublisher`='$author',`postImage`='$image',`postCategory`='$category',`postTag`='$tag',`postStatus`='$status',`post`='$description',`postUpdate_at`='$update' WHERE postId = '$postId'";
        if (mysqli_query($conn, $sql)) {
            @unlink('../../image/' . $row['postImage']);
            if ($_FILES["image"]['name'] != '') {

                if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {

                    if (strlen($_FILES["image"]["name"]) > 100) {
?>
                        <script>
                            alert("Image Name Too long. Please short it !");
                            window.location.href = "post_view.php";
                        </script>
                        <?php
                    } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../image/" . $_FILES["image"]['name'])) {
                            $_SESSION['status'] = 'post_updated';
                            header("location: post_view.php");
                        } else {
                        ?>
                            <script>
                                alert("Faild to upload ! !");
                            </script>
                    <?php
                        }
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

    <title>Edit post - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        td {
            text-align: center;
            font-size: 12px;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "../sideBar.php" ?>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "../topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Update and Edit post</h1>
                    </div>

                    <!-- Content Row -->

                    <!-- Content Row -->

                    <form action="" method="post" class=" text-dark" enctype="multipart/form-data">
                        <style>
                            input,
                            select {
                                background-color: transparent !important;

                            }
                        </style>
                        <?php
                        $post_id = $_GET['post'];
                        $post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postStatus = 1 AND posts.postId = '$post_id'"));
                        ?>

                        <div class="row">
                            <!-- left side -->
                            <div class="col-lg-8">
                                <!-- title -->
                                <div>
                                    <label for="title">Post Title :</label>
                                    <input type="text" name="title" id="title" placeholder="post title.." class="form-control" value=" <?php echo $post["postTitle"] ?>">
                                    <div class="form-text text-info">
                                        <i class="fas fa-arrow-circle-right"></i> give your post a meaningfull and unique title
                                        <p><?php $name_erro ?? "" ?></p>
                                    </div>

                                </div>

                                <!-- post -->
                                <div>
                                    <label for="description">Post Details :</label>
                                    <textarea type="text" class="form-control" name="description" id="summernote"><?php echo $post["post"] ?></textarea>
                                    <div class="form-text">
                                        Describe your post
                                    </div>
                                </div>

                                <div class="my-2">
                                    <label for="M-des">Meta Description :</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="">
                                    <div class="form-text text-info">
                                        <i class="fas fa-arrow-circle-right"></i> Meta Description will show in the search page
                                    </div>
                                </div>
                            </div>

                            <!-- right side -->
                            <div class="col-lg-4">

                                <!-- category -->
                                <div>
                                    <label for="category">Category :</label>
                                    <select name="category" id="category" class="form-select form-control" aria-label="Default select example">
                                        <option> Select category </option>
                                        <?php

                                        $result = mysqli_query($conn, "SELECT * FROM category");
                                        while ($row = mysqli_fetch_array($result)) { ?>

                                            <option <?php if ($row["catId"] == $post["postCategory"]) {
                                                        echo "SELECTED";
                                                    } ?> value="<?php echo $row["catId"] ?>"><?php echo $row["catName"] ?></option>

                                        <?php }
                                        ?>
                                    </select>
                                    <div class="form-text text-info">
                                        <i class="fas fa-arrow-circle-right"></i> it is required to select a category. it is make easier to find post.
                                        <p><?php $cat_error ?? "" ?></p>
                                    </div>
                                </div>

                                <!-- tags -->
                                <div>
                                    <label for="tab">Tag :</label>
                                    <input type="text" name="tag" id="tag" class="form-control" placeholder="ex : intetainment" value="<?php echo $post["postTag"] ?>">
                                </div><br>

                                <!-- keywords -->
                                <div>
                                    <label for="keyword">Keywords :</label>
                                    <input type="text" name="keyword" id="keyword" class="form-control" value="" placeholder="Ex: fashion, design">
                                    <div class="form-text text text-info">
                                        <i class="fas fa-arrow-circle-right"></i> With perfect keyword it make easy to find by search engine crowler.
                                    </div>
                                </div><br>


                                <!-- image -->
                                <label for="image">Post Image :</label><br>
                                <div class="col-md-6 text-align-center p-2 border ">
                                    <div>
                                        <label for="image">Feature Image</label>
                                    </div>
                                    <img width="100%" style="box-sizing: border-box;" src="/coderbees/image/<?php echo $post["postImage"] ?>" alt="Not Found" id="image">
                                </div>
                                <div>
                                    <style>
                                        label.label input[type="file"] {
                                            position: absolute;
                                            top: -10000px;
                                            opacity: 0;
                                        }

                                        .label {
                                            cursor: pointer;
                                            border: 1px solid #cccccc;
                                            border-radius: 5px;
                                            padding: 5px 15px;
                                            margin: 5px;
                                            background: #dddddd;
                                            display: inline-block;
                                        }

                                        .label:hover {
                                            background: #5cbd95;
                                        }

                                        .label:active {
                                            background: #9fa1a0;
                                        }

                                        .label:invalid+span {
                                            color: #000000;
                                        }

                                        .label:valid+span {
                                            color: #ffffff;
                                        }
                                    </style>
                                    <label class="label">
                                        <input type="file" name="image" id="image">
                                        <span>Update</span>
                                    </label>

                                    <div>
                                        <p><?php echo $image_error ?? "" ?></p>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-6 pe-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Terms & Condition</label>
                            <div class="form-text">
                                By clicking update you are agree with our Terms & Conditonal statement. If you not see out Term's and Condition please see Term's page.
                            </div>
                        </div>
                        <div class="col-lg-4 mt-5">
                            <button class="btn btn-outline-primary btn-md rounded-pill shadow-lg"> <i class="fas fa-sync pr-2 "></i> Edit & Update</button>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 3,
            height: 500,
        });
    </script>

</body>

</html>