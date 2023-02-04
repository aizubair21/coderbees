<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "coderbees";
$port = "3306";

$conn = mysqli_connect($host, $user, '', $db, $port);



//define path
/**
 * if you have a custom path. please change over here. it consist your system.
 * by default we are using our custom path. 
 * if you have a domain please change it hover here.
 * 
 */
$base_name = '';
if (empty($base_name)) {
    define('GlobalRootPath', '/' . basename(dirname(__FILE__)));
} else {
    define('GlobalRootPath', $base_name);
}
