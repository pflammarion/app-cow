<?php
ini_set('display_errors', 1);

include("./controller/function.php");
include("./view/function.php");

if(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/') {
$url = $_SERVER['REQUEST_URI'];
}
else {
$url = 'login';
}

include('controller/' . $url . '.php');

