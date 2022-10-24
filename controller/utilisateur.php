<?php

if (empty($_GET['fonction'])) {
    $function = 'accueil';
} else {
    $function = $_GET['fonction'];
}

switch ($function) {

    case 'accueil':
        $view = "home";
        $title = "Accueil";
        break;

    default:
        $view = "error404";
        $title = "Erreur";
        $message = "Erreur 404 : la page recherchée n'existe pas.";
}

include 'view/header.php';
include 'view/' . $view . '.php';
include 'view/footer.php';
