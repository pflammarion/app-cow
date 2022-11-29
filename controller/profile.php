<?php

$action = selectAction("view");

if(!empty($action)){
    $view = "profile/" . $action;
    if(file_exists('view/' . $view . '.php')){
        include ('view/' . $view . '.php');
    }
    else include ('view/error404.php');
}
