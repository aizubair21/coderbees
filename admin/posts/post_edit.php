<?php
include "../connection.php";

if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}


$key = $_SESSION["admin_key"] ?? "";
$postId = $_REQUEST["post"];

//include QueryClass
include "../../configuration/QueryHandeler.php";
$mysqli = new DBSelect;

//get upldated data
$rows = $mysqli->select([])->from('posts')->where("postId = $postId")->get();
$row = $rows->fetch_assoc();

if (isset($_POST["post_update"])) {

    $name_error = "";
    $user_name_error = "";
    $email_error = "";
    $phone_error = "";
    $password_error = "";
    $name = $_POST["title"];
    $slug = substr_replace(" ", "-", "$name");
    $tag = $_POST["tag"];
    $author = $auth_admin["adminId"];
    $image = $_FILES['image']['name'];
    $description = $_POST["description"];
    $updated_at = date("y-m-d");
    $status = 0;
    $keyword = $_POST['keyword'];
    $m_des = $_POST['meta_description'];

    //error handle
    if (empty($name)) {
        $name_error = "Required Field";
    }
    if (empty($description)) {
        $description_error = "Required Field";
    }
    if (empty($image)) {
        $image_error = "Requird Field";
    }
    if (empty($category)) {
        $category_error = "Required Field";
    }

    //if image not change.
    if (!$_FILES["image"]['name']) {

        //if there is no error.
        if (empty($name_error) && empty($description_error) && empty($image_error) && empty($category_error)) {
        } else {
?>
            <script>
                alert("Please, Fill all the required fields.");
            </script>
<?php
        }
        $update = new DBUpdate;
        $update->on('posts')->set(['postTitle', 'postSlug', 'postTag', 'postStatus', 'post', 'postUpdated_at', 'keywords', 'meta_Description'])->value([$name, $slug, $tag, $status, $description, $updated_at, $keyword, $m_des])->where("postId = $postId");
        $response = $update->go();
        echo $response;
    } else {

        //if image not change
        $update = new DBUpdate;
        $update->on('posts')->set(['postTitle', 'postTag', 'postImage', 'postStatus', 'post', 'postUpdated_at', 'keywords', 'meta_Description'])->value([$name, $tag, $image, $status, $description, $updated_at, $keyword, $m_des])->where("postId = $postId");
        $response = $update->go();
        echo $response;

        //if image update, the old image delete from database.
        @unlink('../../image/' . $row['postImage']);

        //image upload
        if ($_FILES["image"]['name']) {

            if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png'  || $_FILES['image']['type'] == 'image/jpeg') {

                if (strlen($_FILES["image"]["name"]) > 100) {
                    $image_error = "Image name so long. please short it.";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../image/" . $_FILES["image"]['name'])) {
                        $_SESSION['status'] = 'post_updated';
                        header("location: post_view.php");
                    } else {
                        $image_error = "Faild to upload your image";
                    }
                }
            } else {
                $image_error = "Only jpg, png, jpeg formate supported.";
            };
        };
    };
};
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

    <style>
        td {
            text-align: center;
            font-size: 12px;
        }

        input,
        select {
            background-color: transparent !important;
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
                    <div class="mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Update and Edit post</h1>
                    </div>


                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-8">
                                <div>
                                    <label for="title">Post Title :</label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $row['postTitle'] ?>">
                                    <?php
                                    if (!empty($name_error)) {
                                        echo "<strong class='text text-danger'> " . $name_error . " </strong>";
                                    }
                                    ?>
                                </div><br>

                                <div>
                                    <label for="description">Post Details :</label>
                                    <textarea type="text" class="form-control" name="description" id="summernote"><?php echo $row["post"] ?></textarea>
                                    <div class="form-text">
                                        Describe your post
                                    </div>
                                </div><br>

                                <div class="my-2">
                                    <label for="M-des">Meta Description :</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="<?php echo $row['meta_Description'] ?>">
                                    <div class="form-text text-info">
                                        <i class="fas fa-arrow-circle-right"></i> Meta Description will show in the search page
                                    </div>
                                </div><br>

                            </div>

                            <!-- right side -->
                            <div class="col-lg-4">
                                <!-- tags -->
                                <div>
                                    <label for="tab">Tag :</label>
                                    <input type="text" name="tag" id="tag" class="form-control" placeholder="ex : intetainment" value="<?php echo $row["postTag"] ?>">
                                </div><br>

                                <!-- keywords -->
                                <div>
                                    <label for="keyword">Keywords :</label>
                                    <input type="text" name="keyword" id="keyword" class="form-control" value="<?php echo $row['keywords'] ?>" placeholder="Ex: fashion, design">
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
                                    <img width="100%" style="box-sizing: border-box;" src="/coderbees/image/<?php echo $row["postImage"] ?>" alt="Not Found" id="image">
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

                                    <button type="submit" name="post_update" class="btn btn-outline-success btn-sm rounded-pill shadow px-3"> <i class="fas fa-sync pr-2"></i> save changes </button>
                                </div>
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