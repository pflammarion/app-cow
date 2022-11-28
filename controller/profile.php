<?php

$action = selectAction("view");

include __DIR__ . '/../model/profile.php';

if(!empty($action)){
    $content = [];
    if (isset($_SESSION['user'])){
        $content = getUserProfile($_SESSION['user']);
    }
    $view = "profile/" . $action;
    include (showPage($view));
}
