<?php 

include "connection.php";
unset(
    $_SESSION['user_key']
);
header("location: index.php");