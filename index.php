<?php
ini_set('display_errors', 1);

include("controller/function.php");
include("view/function.php");

if(isset($_GET['folder']) && !empty($_GET['folder'])) {
$url = $_GET['folder'];
}
else {
$url = 'utilisateurs';
}

include('controller/' . $url . '.php');

