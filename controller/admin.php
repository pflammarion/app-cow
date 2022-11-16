<?php

include __DIR__ . '/../model/permission.php';

$page = selectPage("accueil");
$action = selectAction("view");

switch ($page) {
    case 'accueil':
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

include ('view/' . $view . '.php');
