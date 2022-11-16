<?php

$action = selectAction("view");

if(!empty($action)){
    $view = "profile/" . $action;
    showPage($view);
}
