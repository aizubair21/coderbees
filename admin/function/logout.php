<?php 

session_start();
session_unset("admin_key");
header("location: ../index.php");