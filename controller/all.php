<?php

$page = selectPage("cgu");

switch ($page) {
    case 'cgu':
        $view = "cgu";
        $title = "CGU";
        break;

    default:
        $view = "error404";
        $title = "Erreur";
}

include ('view/' . $view . '.php');

