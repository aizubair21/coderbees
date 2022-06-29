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


</head>

<body>


    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">

        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">


            <div class="collapse navbar-collapse justify-content-between align-items-center px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="<?php url_for('index.php') ?>" class="nav-item nav-link <?php if ($active == "home") {
                                                                                            echo "active";
                                                                                        } ?> ">Home</a>
                    <a href="<?php url_for('blog.php') ?>" class="nav-item nav-link <?php if ($active == "category") {
                                                                                        echo "active";
                                                                                    } ?> ">Blog</a>
                    <a class="nav-item nav-link <?php if ($active == "posts") {
                                                    echo "active";
                                                } ?> ">Single Post</a>

                    <a href="<?php url_for('contact.php') ?>" class="nav-item nav-link <?php if ($active == "contact") {
                                                                                            echo "active";
                                                                                        } ?> ">Contact</a>
                </div>
                <form action="<?php echo GlobalROOT_PATH ?>/search.php" method="GET" class="m-0">
                    <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Keyword" name="search">
                        <button class="input-group-text text-secondary"><i class="fa fa-search"></i></button>

                    </div>
                </form>
                <div class="navbar-nav mr-5 py-0">
                    <div class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-circle"></i></div>
                        <div class="dropdown-menu rounded-0 m-0">

                            <?php
                            if ($_SESSION["user_key"] ?? "") { ?>
                                <a class="nav-item nav-link dropdwon-item" href="<?php url_for('logout.php') ?>" class="dropdown-item">Logout</a>;
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
        </nav>


    </div>
    <!-- Navbar End -->