<?php

function getPage($default){
    if (empty($_GET['page'])) {
        $page = $default;
    } else {
        $page = $_GET['page'];
    }
    return $page;
}
