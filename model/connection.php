<?php

ob_start();

if(!isset($_SESSION)) {
    session_start();
}

$db_name = "APPCOW";
$db_user = "app-user";
$db_pass = "APP-PSW-2022!";
$db_host = "localhost";

try {
    $GLOBALS['db'] = new PDO("mysql:host='.$db_host.';dbname='.$db_name.'", $db_user, $db_pass);
    $GLOBALS['db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(Exception $e) {
    echo 'Database connection error.'.$e->getMessage();
    exit();
}
