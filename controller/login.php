<?php

$page = getPage("login");

switch ($page) {
    case 'login':
        $view = "login/login";
        $title = "Accueil";
        break;

    default:
        $view = "error404";
        $title = "Erreur";
}

include ('view/' . $view . '.php');
