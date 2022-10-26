<?php
ini_set('display_errors', 1);

include("./controller/function.php");
include("./view/function.php");
include __DIR__ . '/view/header.php';

$request = explode('?', $_SERVER['REQUEST_URI']);

switch ($request[0]) {
    case '/user' :
        include __DIR__ . '/controller/user.php';
        break;
    case '/admin' :
        include __DIR__ . '/controller/admin.php';
        break;
    case '/' :
        include __DIR__ . '/controller/login.php';
        break;
    default:
        http_response_code(404);
        include __DIR__ . '/view/error404.php';
        break;
}

include __DIR__ . '/view/footer.php';
