<?php

$action = selectAction("view");

include __DIR__ . '/../model/profil.php';

if(!empty($action)){
    $content = [];
    if (isset($_SESSION['user'])){
        $content = getUserProfile($_SESSION['user']);
    }
    $view = "profile/" . $action;
    if (isset($_GET['js']) && isset($_SESSION['auth'])){
        echo json_encode($content);
    }
    else showPage($view);
}
