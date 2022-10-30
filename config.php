<?php

$db_host = "eu-cdbr-west-03.cleardb.net";
$db_user = "b923c2350e2e98";
$db_pass = "53598933";
$db_name = "heroku_bef80f3743ee9c8";

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die ("database connection error");