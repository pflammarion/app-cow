<?php

$page = getPage("accueil");

switch ($page) {
    case 'accueil':
        $view = "user/home";
        $title = "Accueil";
        break;

    default:
        $view = "error404";
        $title = "Erreur";
}

include ('view/' . $view . '.php');
