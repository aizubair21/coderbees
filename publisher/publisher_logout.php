<?php
session_start();
unset($_SESSION["publisher_key"]);
$_SESSION['status'] = 'log_out';
header("lcoation: ../index.php");
