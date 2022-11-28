<?php

$action = selectAction("view");

include __DIR__ . '/../model/profile.php';

if(!empty($action)){
    if (isset($_SESSION['user'])){
        $content = getUserProfile($_SESSION['user']);
        print_r($content);
    }
    $view = "profile/" . $action;
    showPage($view);
}
