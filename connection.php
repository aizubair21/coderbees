<?php
if (!session_start()) {
    session_start();
}

//relative URI
define('GlobalROOT_PATH', "/" . basename(dirname(__FILE__)));

define('ROOT_PATH', dirname(__FILE__) . '/');
define('ADMIN_PATH', ROOT_PATH . "admin/");
define('PUBLISHER_PATH', ROOT_PATH . "publisher/");
define('CATEGORY_PATH', ROOT_PATH . "category/");
//config 
include "config.php";

//function 
include "function/make_tags.php";

//partisl content
include "partial/related_post.php";

//include QueryHandler
include "configuration/QueryHandeler.php";
$mysqli = new DBSelect;


$key = $_SESSION["publisher_key"] ?? '';

if ($key) {
    $GLOBALS['auth_publisher'] = getPublisher($key, $conn);
}

$user_key = $_SESSION["user_key"] ?? "";
if ($user_key) {
    $user_qyr = mysqli_query($conn, "SELECT * FROM users");

    if ($user = mysqli_num_rows($user_qyr) > 0) {
        $GLOBALS['auth_user'] = mysqli_fetch_assoc($user_qyr);
    }
}

//get category name from category id
function getCategoryName($category_id)
{
    $mysqli = new DBSelect;
    $getCategorySql = $mysqli->select(['catName'])->from('category')->where("catId = '$category_id'")->get()->fetch_assoc();
    $getCategory = $getCategorySql['catName'];  
    return $getCategory;
}



function url_for($script_url)
{
    //add the loading '/' if not present.
    if ($script_url[0] != '/') {
        $script_url = '/' . $script_url;
    }

    echo GlobalROOT_PATH . $script_url;
}


//url_for('index.php');
//echo $auth_user["user_name"];



function getPublisher($key, $conn)
{
    // $conn = mysqli_connect($host, $user, '', $db, $port);
    $data = "SELECT * FROM publisher WHERE publisherId='$key'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return $row = mysqli_fetch_assoc($result);
    } else {
        return "Not found !";
    }
}


function getAllPublisher($conn)
{
    // $conn = mysqli_connect($host, $user, '', $db, $port);
    $data = "SELECT * FROM publisher";

    return mysqli_query($conn, $data);
}

function getCurd($key, $conn)
{
    // $conn = mysqli_connect($host, $user, '', $db, $port);
    $data = "SELECT * FROM crud WHERE id='$key'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return $row = mysqli_fetch_assoc($result);
    } else {
        return "Not found !";
    }
}




function isInAdminDatabase($user_name, $conn)
{
    // $conn = mysqli_connect($host, $user, '', $db, $port);
    $data = "SELECT * FROM admin WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
}
