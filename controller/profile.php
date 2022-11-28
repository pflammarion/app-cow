<?php

$action = selectAction("view");

include __DIR__ . '/../model/profile.php';

if(!empty($action)){
    $content = [];
    if (isset($_SESSION['user'])){
        $content = getUserProfile($_SESSION['user']);
    }
    $view = "profile/" . $action;
    if(file_exists('view/' . $view . '.php')){
        include ('view/' . $view . '.php');
    }
    else include ('view/error404.php');
}
