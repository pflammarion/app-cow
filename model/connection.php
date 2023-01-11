<?php

ob_start();

if(!isset($_SESSION)) {
    session_start();
}

$db_name = config::$db_name;
$db_user = config::$db_user;
$db_pass = config::$db_pass;
$db_host = config::$db_host;

try {
    $GLOBALS['db'] = new PDO("mysql:host=". $db_host .";dbname=". $db_name ."", $db_user, $db_pass);
    $GLOBALS['db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(Exception $e) {
    echo 'Database connection error.'.$e->getMessage();
    exit();
}
