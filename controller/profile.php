<?php

$action = selectAction("view");

require __DIR__ . '/../model/profil.php';

if(!empty($action)){
    $content = [];
    if (isset($_SESSION['user'])){
        $content = getUserProfile($_SESSION['user']);
    }
    $view = "profile/" . $action;
    include (showPage($view));
}
