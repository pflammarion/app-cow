<?php

include __DIR__ . '/../model/permission.php';

$page = selectPage("accueil");
$action = selectAction("view");

if(!empty($page) && !empty($action)){
    switch ($page) {
        case 'accueil':
            //TODO faire ajouter dans la table page ('admin') et checkauth
            $view = "admin/home";
            break;

        case 'user' && pageAuthorization('admin/faq'):
            $view = "admin/faq/" . $action;
            break;

        case 'user' && pageAuthorization('admin/permission'):
            $view = "admin/permission" . $action;
            break;

        case 'user' && pageAuthorization('admin/user'):
            $view = "admin/user" . $action;
            break;

        default:
            $view = "error404";
    }
    showPage($view);
}

