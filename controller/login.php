<?php

$page = getPage("login");

switch ($page) {
    case 'login':
        $view = "login/login";
        break;
    case 'lostpassword':
        $view = "login/lostPassword";
        break;
    case 'register' :
        $view = "login/register";
        break;
    default:
        $view = "error404";
}

include ('view/' . $view . '.php');
