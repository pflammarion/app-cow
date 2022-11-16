<?php

include __DIR__ . '/../model/permission.php';

$page = selectPage("accueil");

if(pageAuthorization('user') && !empty($page)){
    switch ($page) {
        case 'accueil':
            $view = "user/home";
            $title = "Accueil";
            break;

        default:
            $view = "error404";
            $title = "Erreur";
    }

    showPage($view);
}
else{
    echo('<script>alert("Vous n\'avez pas la permission d\'accéder à cette page")</script>');
}


