<?php

// function isActive($modifier)
// {

//     $actual_link = $_SERVER['PHP_SELF'];
//     $modifie = "/$modifier/i";
//     return preg_match($modifie, $actual_link);
//     // include "connection.php";
// };
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php

        echo $title . " | Coderbees ";

        ?>
    </title>
    <link rel="stylesheet" href="/coderbees/bootstrap-5.1.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/coderbees/fontawesome-free-5.15.3-web/css/all.min.css">

    <!-- Favicon -->
    <link href="/coderbees/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/coderbees/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/coderbees/css/style.css" rel="stylesheet">
    <link href="/coderbees/css/site.custom.css" rel="stylesheet">
    <style>
        h2 {
            font-family: "oswald";
        }

        .breadcrumbs {
            color: #ED1C24;
            display: inline-flex;
            border: 1px solid #ED1C24;
            border-radius: 25px;
            ;
        }

        .breadcrumbs-item {
            background-color: white;
            color: black;
            padding: 15px 30px;
            position: relative;
            z-index: 1;
        }

        .breadcrumbs-item:first-child {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }


        .breadcrumbs-item:hover {
            background-color: #ED1C24;
            color: white;
        }

        .breadcrumbs-item-active {
            background-color: #ED1C24;
            color: white;
            border-bottom-right-radius: 25px;
            border-top-right-radius: 25px;
            padding: 15px 30px;
            position: relative;
            z-index: 1;
            box-shadow: 3px 3px 5px gray;
        }

        .sticy_nav {
            position: fixed;
            top: 0;
            left: 0;
            height: auto;
            width: 100%;
            z-index: 9;
            box-shadow: 0px 0px 10px 5px #ED1C24;

        }

        /* container-fluid */


        /* .container {
            padding-top: 15px;
            box-shadow: 0px 0px 2px rgba(0, 0, 0, .5);
        } */
    </style>


</head>

<body>


    <!-- bootstrap nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_nav">
        <script>
            document.addEventListener("scroll", function() {
                //console.log(document.documentElement.scrollTop);

                if (document.documentElement.scrollTop > 200) {
                    document.getElementById('main_nav').classList.add("sticy_nav");
                } else {
                    document.getElementById('main_nav').classList.remove("sticy_nav");
                }

            })
        </script>
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="<?php url_for('index.php') ?>" class="nav-item nav-link <?php if ($active == "home") {
                                                                                                echo "active";
                                                                                            } ?> ">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php url_for('blog.php') ?>" class="nav-item nav-link <?php if ($active == "category") {
                                                                                            echo "active";
                                                                                        } ?> ">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item nav-link disabled <?php if ($active == "posts") {
                                                                    echo "active";
                                                                } ?> ">Single Post</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php url_for('contact.php') ?>" class="nav-item nav-link <?php if ($active == "contact") {
                                                                                                echo "active";
                                                                                            } ?> ">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" action=" <?php GlobalROOT_PATH ?> search.php">
                    <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Keyword" name="search">
                        <button class="input-group-text text-secondary"><i class="fa fa-search"></i></button>

                    </div>
                </form>

                <div class="navbar-nav mr-5 py-0">
                    <div class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                            <?php
                            if ($u_key = $_SESSION['user_key']) {
                                $conn = mysqli_connect("localhost", "root", "", "coderbees");
                                $u = mysqli_query($conn, "SELECT * FROM users WHERE(userId = $u_key)");
                                $user = mysqli_fetch_assoc($u);
                                echo $user['userName'];
                            }
                            ?>
                        </div>
                        <div class="dropdown-menu rounded-0 m-0">

                            <?php
                            if ($_SESSION["user_key"] ?? "") { ?>

                                <a class="nav-item nav-link dropdwon-item" href="<?php url_for('logout.php') ?>" class="dropdown-item">Logout</a>
                            <?php } else {
                            ?>
                                <a href="<?php url_for('login.php') ?>" class=" nav-item nav-link dropdown-item  <?php if ($active == "login") {
                                                                                                                        echo "active";
                                                                                                                    } ?> ">Login</a>
                                <a href="<?php url_for('register.php') ?>" class="nav-item nav-link dropdown-item  <?php if ($active == "register") {
                                                                                                                        echo "active";
                                                                                                                    } ?>">Register</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- bootstrap nav end  -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">

        <!-- <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">



            <div class="collapse navbar-collapse justify-content-between align-items-center px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">

                    
                    

                    <a href="<?php url_for('contact.php') ?>" class="nav-item nav-link <?php if ($active == "contact") {
                                                                                            echo "active";
                                                                                        } ?> ">Contact</a>
                </div>
                <form action="<?php echo GlobalROOT_PATH ?>/search.php" method="GET" class="m-0">
                    
                </form>
                
            </div>
        </nav> -->


    </div>


    <!-- Navbar End -->