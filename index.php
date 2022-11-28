<?php
ini_set('display_errors', 1);

include("./controller/function.php");
include("./view/function.php");
include __DIR__ . '/model/connection.php';

if (!isset($_GET['js'])){
    include __DIR__ . '/view/header.php';
}

$request = explode('?', $_SERVER['REQUEST_URI']);
$request = explode('/', $request[0]);
if (str_starts_with($request[1], 'review')) $i = 2;
elseif (str_starts_with($request[1], 'app-cow')) $i = 2;
else $i = 1;

if (isset($_SESSION['auth']) && $_SESSION['auth']){
    switch ($request[$i]) {
        case 'user' :
            include __DIR__ . '/controller/user.php';
            break;
        case 'admin' :
            include __DIR__ . '/controller/admin.php';
            break;
        case 'all' :
            include __DIR__ . '/controller/all.php';
            break;
        case 'profile' :
            include __DIR__ . '/controller/profile.php';
            break;
        case '' :
            if($_SESSION['role'] === 1){
                include __DIR__ . '/controller/user.php';
            }
            else{
                include __DIR__ . '/controller/admin.php';
            }
            break;
        default:
            http_response_code(404);
            include __DIR__ . '/view/error404.php';
            break;
    }
}
else{
    if ($request[$i] === 'all') include __DIR__ . '/controller/all.php';
    else include __DIR__ . '/controller/login.php';
}

if (!isset($_GET['js'])) {
    include __DIR__ . '/view/footer.php';
}

