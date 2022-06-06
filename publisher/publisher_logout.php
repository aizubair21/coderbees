<?php
session_start();
unset($_SESSION["publisher_key"]);

header("lcoation: ../index.php");