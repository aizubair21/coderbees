<?php
include "../connection.php";

if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}

$key = $_SESSION["admin_key"] ?? "";


if (isset($_POST["post"])) {

    $title = $_POST["title"];
    $author = $auth_admin["adminId"];
    $category = $_POST["category"];
    $tag = $_POST["tag"];
    $description = $_POST["description"];
    $created_at = date("Y-m-d");
    $image = $_FILES["image"]["name"];

    //echo $created_at;
    //add post
    $sql = "INSERT INTO posts (postTitle, postPublisher, postCategory, postTag, post, postImage, postCreated_at, postStatus) VALUES ('$title','$author','$category','$tag','$description','$image','$created_at',1)";
    if (mysqli_query($conn, $sql)) {

        //upload post image to server
        if ($_FILES["image"]['name'] != '') {

            if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {

                if (strlen($_FILES["image"]["name"]) > 50) {
?>
                    <script>
                        alert("Image Name Too long. Please short it !");
                        window.location.href = "post_add.php";
                    </script>
                    <?php
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../image/" . $_FILES["image"]['name'])) {
                    } else {
                    ?>
                        <script>
                            alert("Faild to upload your image !!");
                            window.location.href = "post_add.php";
                        </script>
                <?php
                    }
                }
            } else {
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
    } else {
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

    <title> Add post - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo ADMIN_PATH ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo ADMIN_PATH ?>css/sb-admin-2.min.css" rel="stylesheet">
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
        <?php include l_ADMIN_PATH . "sideBar.php" ?>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include l_ADMIN_PATH . "topBar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->


                    <h6 class="m-0 font-weight-bold text-light">Add A New Post</h6>

                    <form action="" method="post" class="" enctype="multipart/form-data">
                        <style>
                            input,
                            select {
                                background-color: transparent !important;

                            }
                        </style>
                        <fieldset>
                            <legend>Add A New Posts</legend>
                            <div class="row">
                                <!-- left side -->
                                <div class="col-lg-8">

                                    <!-- title -->
                                    <div class="">
                                        <input type="text" name="title" id="title" placeholder="Post Title.." class="form-control" aria-describedby="titleDescription">
                                        <div id="titleDescription" class="form-text text-info">
                                            <i class="fas fa-arrow-circle-right"></i> give your post a meaningfull and unique title
                                            <p><?php $name_erro ?? "" ?></p>
                                        </div>

                                    </div>

                                    <!-- post -->
                                    <div class="my-2">
                                        <label for="description" class="form-label">Post : </label>
                                        <textarea class="form-control" name="description" id="summernote"></textarea>
                                        <div class="form-text text-info">
                                            <i class="fas fa-arrow-circle-right"></i> Describe your post
                                        </div>
                                    </div>


                                </div>


                                <!-- right side -->
                                <div class="col-lg-4">
                                    <!-- category -->
                                    <div>
                                        <select name="category" id="category" class="form-select form-control" aria-label="Default select example">
                                            <option> Select category </option>
                                            <?php

                                            $result = mysqli_query($conn, "SELECT * FROM category");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<option value='" . $row['catId'] . "'>" . $row['catName'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="form-text text-info">
                                            <i class="fas fa-arrow-circle-right"></i> it is required to select a category. it is make easier to find post.
                                            <p><?php $cat_error ?? "" ?></p>
                                        </div>
                                    </div><br>

                                    <!-- keyword -->
                                    <div>
                                        <label for="keyword">Post Keyword :</label>
                                        <input type="text" name="keyword" id="keyword" placeholder="Give 3 or 4 keyword" class="form-control">
                                        <div class="form-text text-info">
                                            <i class="fas fa-arrow-circle-right"></i> keyword makes post easy to find search engine crowler.
                                        </div>
                                    </div><br>

                                    <!-- tags -->
                                    <div>
                                        <label for="tab">Tag :</label>
                                        <input type="text" name="tag" id="tag" class="form-control" placeholder="ex : intetainment">
                                    </div><br>

                                    <!-- meta des -->
                                    <div>
                                        <label for="M-des">Meta Description :</label>
                                        <input type="text" name="meta_descriptin" id="M-des" class="form-control">
                                        <div class="form-text text-info">
                                            <i class="fas fa-arrow-circle-right"></i> Meta description are shown in the search engine page.
                                        </div>
                                    </div><br>

                                    <!-- image  -->
                                    <div>
                                        <style>
                                            label.label input[type="file"] {
                                                position: absolute;
                                                top: -1000px;
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
                                        <div>
                                            Feature image
                                        </div>
                                        <label class="label">
                                            <input type="file" name="image" id="image">
                                            <span> <i class="fas fa-upload"></i> Select a image</span>
                                        </label>
                                        <p><?php echo $image_error ?? "" ?></p>
                                    </div><br>


                                </div>






                                <div class="col-lg-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Tarms & Condition</label>
                                        <div class="form-text">
                                            By clicking this, You are agree our Terms & Condition. we won't share your email or name to another else. we save your info for our security.
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-md shadow-lg rounded-pill"> Add Post <i class="fas fa-arrow-circle-right"></i></button>
                                </div>

                            </div>
                        </fieldset>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins
    <script src="<?php PUBLISHER_PATH ?>vendor/chart.js/Chart.min.js"></script>

    

   sumernote  -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Write Your Posts',
            tabsize: 3,
            height: 600
        });
    </script>

</body>

</html>