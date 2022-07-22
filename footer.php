<?php
$mysqli = new DBSelect;
?>
<div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-5">
            <a href="index.php" class="navbar-brand">
                <h1 class="mb-2 mt-n2 display-5 text-uppercase"><span class="text-primary">Coder</span>bee</h1>
            </a>
            <p>Volup amet magna clita tempor. Tempor sea eos vero ipsum. Lorem lorem sit sed elitr sed kasd et</p>
            <div class="d-flex justify-content-start align-items-center mt-4">
                <?php
                $social_qry = mysqli_query($conn, "SELECT * FROM social_media_link");
                $row = mysqli_fetch_assoc($social_qry) ?>

                <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="<?php echo $row['twitter'] ?>"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="<?php echo $row['facebook'] ?>"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="<?php echo $row['linkedin'] ?>"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="<?php echo $row['instagram'] ?>"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="<?php echo $row['youtube'] ?>"><i class="fab fa-youtube"></i></a>

                <?php
                ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Categories</h4>
            <div class="d-flex flex-wrap m-n1">
                <?php

                $cat_qry = $mysqli->select(["catId", "catName", "catSlug"])->from("category")->get();
                if ($cat_qry->num_rows > 0) {
                    while ($cat = mysqli_fetch_assoc($cat_qry)) {
                        echo '<a href="category.php?category=' . $cat["catName"] . '" class="btn btn-sm btn-outline-secondary m-1">' . $cat["catName"] . '</a>';
                    }
                } else {
                    echo "<button class='btn btn-outline-secondary btn-sm'>Uncategory</button>";
                }
                ?>


            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <?php include "partial/tags.php"; ?>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Quick Links</h4>
            <div class="d-flex flex-column justify-content-star">
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>About</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Advertise</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Privacy & policy</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Terms & conditions</a>
                <a class="text-secondary" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Contact</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <p class="m-0 text-center">
        &copy; <a class="font-weight-bold" href="#">coderbees</a>. All Rights Reserved.

        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
        Designed by <a class="font-weight-bold" href="">Coderbees</a>
    </p>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-outline-primary back-to-top"><i class="fa fa-angle-up"></i></a>


<!-- JavaScript Libraries -->
<script src="bootstrap-5.1.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- toaster_plugin -->
<!-- <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>

<?php

//if session set. then alert swho
if (isset($_SESSION['status'])) {


    switch ($_SESSION['status']) {
        case 'like_login_error':
?>
            <script>
                toastr.warning("Please login to react.");
            </script>
        <?php
            break;

            //if login. welcomed him
        case 'greeting':
        ?>
            <script>
                toastr.success("Successfully login.");
            </script>
        <?php

            break;

        case 'subscribe_error':
        ?>
            <script>
                toastr.info('No need subscrive again. You already subscrived.');
            </script>
        <?php
            break;

        case 'subscrived':
        ?>
            <script>
                toastr.success('Thanks for your subscription. w\'ll mail you our sevicess');
            </script>
        <?php
            break;

        case 'comment_success':
        ?>
            <script>
                toastr.info('Comment successfully added. Comment under review !');
            </script>
        <?php
            break;

        case 'comment_reject':
        ?>
            <script>
                toastr.warning('Something wrong ! You can\'t comment right now');
            </script>
        <?php
            break;

            //like alert
        case 'like':
        ?>
            <script>
                toastr.success('Like added');
            </script>
        <?php
            break;

            //if already liked a post
        case 'already_liked':
        ?>
            <script>
                toastr.warning("Can't like again. You like it once.");
            </script>
        <?php
            break;

        case 'not_liked_yet':
        ?>
            <script>
                toastr.warning("Like first !");
            </script>
        <?php
            break;

        case 'unlike':
        ?>
            <script>
                toastr.success("Post unliked ");
            </script>
<?php
            break;
    }

    include 'unset_session.php';
}
?>