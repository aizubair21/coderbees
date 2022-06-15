<?php

function isActive ($modifier) {

    $actual_link = $_SERVER['PHP_SELF'];
    $modifie = "/$modifier/i";
    return preg_match($modifie, $actual_link);
    include "connection.php";
};

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
    <link rel="stylesheet" href="bootstrap-5.1.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">   

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


</head>
<body>


    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">              
         
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
                    
                    
                    <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link <?php if ($active == "home") {echo "active";} ?> ">Home</a>
                            <a href="blog.php" class="nav-item nav-link <?php if ($active == "category") {echo "active";} ?> ">Blog</a>
                            <a class="nav-item nav-link <?php if ($active == "posts") {echo "active";} ?> ">Single Post</a>



                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="#" class="dropdown-item">Menu item 1</a>
                                    <a href="#" class="dropdown-item">Menu item 2</a>
                                    <a href="#" class="dropdown-item">Menu item 3</a>
                                </div>
                            </div> -->
                            <a href="contact.php" class="nav-item nav-link <?php if ($active == "contact") {echo "active";} ?> ">Contact</a>
                        </div>
                        <form action="search.php" method="GET">
                            <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                                <input type="text" class="form-control" placeholder="Keyword" name="search">
                                <button class="input-group-text text-secondary"><i class="fa fa-search"></i></button>
                                
                            </div>
                        </form>
                        <div  class="navbar-nav mr-5 py-0">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-circle"></i></a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="login.php" class=" nav-item nav-link dropdown-item  <?php if ($active == "login") {echo "active";} ?> ">Login</a>
                                    <a href="register.php" class="nav-item nav-link dropdown-item  <?php if ($active == "register") {echo "active";} ?>">Register</a>
                                    <?php 
                                        if($_SESSION["user_key"] ?? "") {
                                            echo ' <a href="logout.php" class="dropdown-item">Logout</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

               
    </div>
    <!-- Navbar End -->


