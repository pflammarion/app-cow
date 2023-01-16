
<?php
ini_set('display_errors', 1);

require_once ('./config.inc.php');
require_once("./controller/function.php");
require_once("./view/function.php");
require_once("./model/permission.php");
require_once __DIR__ . '/model/connection.php';

if (!isset($_GET['api'])){
    include __DIR__ . '/view/header.php';
}

$request = explode('?', $_SERVER['REQUEST_URI']);
$request = explode('/', $request[0]);
if (str_starts_with($request[1], 'review')) $i = 2;
elseif (str_starts_with($request[1], 'app-cow')) $i = 2;
else $i = 1;

if (isset($_SESSION['auth']) && $_SESSION['auth']){
    switch ($request[$i]) {
        case 'all' :
            include __DIR__ . '/controller/all.php';
            break;
        case 'profil' :
            include __DIR__ . '/controller/profile.php';
            break;
        case '' :
        case 'root' :
        case 'user' :
        case'admin':
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

if (!isset($_GET['api'])) {
    include __DIR__ . '/view/footer.php';
}



