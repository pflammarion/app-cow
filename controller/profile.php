<?php

$action = selectAction("view");

if(!empty($action)){
    $view = "profile/" . $action;
    include (showPage($view));
}
