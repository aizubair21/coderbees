<?php
session_start();
session_unset("publisher_key");
header("lcoation: ../index.php");