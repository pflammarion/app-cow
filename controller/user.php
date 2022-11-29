<?php

include __DIR__ . '/../model/permission.php';

$page = selectPage("accueil");
$action = selectAction("view");

if(pageAuthorization('user') && !empty($page) && !empty($action)){
    switch ($page) {
        case 'accueil':
            $view = "user/home";
            $title = "Accueil";
            break;
        case 'boitier':
            $view = "user/chip/". $action;
            break;

        case 'vache':
            $view = "user/cow/". $action;
            break;

        case 'tableau':
            $view = "user/table/" . $action;
            break;

        default:
            $view = "error404";
            $title = "Erreur";
    }
    if(file_exists('view/' . $view . '.php')){
        include ('view/' . $view . '.php');
    }
    else include ('view/error404.php');
}
else{
    echo('<script>alert("Vous n\'avez pas la permission d\'accéder à cette page")</script>');
}


