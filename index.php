<?php
ini_set('display_errors', 1);

include("./controller/function.php");
include("./view/function.php");
include __DIR__ . '/model/connection.php';
include __DIR__ . '/view/header.php';

$request = explode('?', $_SERVER['REQUEST_URI']);
$request = explode('/', $request[0]);
if (str_starts_with($request[1], 'review')) $i = 2;
elseif (str_starts_with($request[1], 'app-cow')) $i = 2;
else $i = 1;

switch ($request[$i]) {
    case 'user' :
        include __DIR__ . '/controller/user.php';
        break;
    case 'admin' :
        include __DIR__ . '/controller/admin.php';
        break;
    case 'login':
    case '':
        include __DIR__ . '/controller/login.php';
        break;
    default:
        http_response_code(404);
        include __DIR__ . '/view/error404.php';
        break;
}

include __DIR__ . '/view/footer.php';
