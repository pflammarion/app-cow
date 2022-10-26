<?php

if (empty($_GET['page'])) {
    $function = "accueil";
} else {
    $function = $_GET['page'];
}

switch ($function) {
    case 'accueil':
        $view = "user/home";
        $title = "Accueil";
        break;

    default:
        $view = "error404";
        $title = "Erreur";
}

include ('view/header.php');
include ('view/' . $view . '.php');
include ('view/footer.php');
