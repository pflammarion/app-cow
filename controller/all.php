<?php

$page = getPage("cgu");

switch ($page) {
    case 'cgu':
        $view = "cgu";
        $title = "CGU";
        break;
    case 'mentionslegales':
        $view = "mentionslegales";
        $title = "mentionslegales";
        break;

    default:
        $view = "error404";
        $title = "Erreur";
}

include ('view/' . $view . '.php');