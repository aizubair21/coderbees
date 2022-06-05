<?php 

session_start();
unset($_SESSION['admin_key']);
header("location: ../index.php");