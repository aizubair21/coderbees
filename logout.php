<?php

include "connection.php";

//unset user session
unset(
    $_SESSION['user_key']
);

//get redirect uri. if not exist index.php is set
$redirectURI = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("location: $redirectURI");
