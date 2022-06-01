<?php


    function isActive ($modifier) {

        $actual_link = $_SERVER['PHP_SELF'];
        $modifie = "/$modifier/i";
        return preg_match($modifie, $actual_link);

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../bootstrap-5.1.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/all.min.css">
</head>
<body>

</body>
    <script src="../bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.1.0-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>