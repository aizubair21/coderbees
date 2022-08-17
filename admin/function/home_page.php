<?php

include "../../configuration/QueryHandeler.php";
$mysql = new DBUpdate;

$fild = $_GET['fild'];
$value = $_GET['value'];
// echo $fild;
// echo $value;

$result = $mysql->on("home_page")->set(["$fild"])->value(["$value"])->where("id = 1")->go();
if ($result == "success") {
    echo "Successfully sync your setting.";
} else {
    echo $result;
}
