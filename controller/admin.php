<?php

require __DIR__ . '/../model/permission.php';

$page = selectPage("accueil");
$action = selectAction("view");

$view = "error404";
if(!empty($page) && !empty($action)){
    if($page == 'accueil' && pageAuthorization('admin')) {
        $view = "admin/home";
    }
    elseif($page == 'faq' && pageAuthorization('admin/faq')){
        $view = "admin/faq/" . $action;
    }
    elseif($page =='permission' && pageAuthorization('admin/permission')) {
        $view = "admin/permission" . $action;
    }
    elseif($page =='user' && pageAuthorization('admin/user')){
        $view = "admin/user" . $action;
    }
    else echo '<script>alert("Vous n\'avez pas accès à cette page")</script>';
}
include (showPage($view));
