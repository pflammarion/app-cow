<?php
include __DIR__ . '/../model/permission.php';

$page = selectPage("accueil");

switch ($page) {
    case 'accueil' && pageAuthorization('admin/user'):
        $view = "admin/home";
        break;

    default:
        $view = "error404";
}

include ('view/' . $view . '.php');
