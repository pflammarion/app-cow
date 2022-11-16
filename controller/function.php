<?php

function selectPage(string $default) : string
{
    if (empty($_GET['page'])) {
        $page = $default;
    }
    else {
        $page = $_GET['page'];
    }
    return $page;
}

function selectAction(string $default) : string
{
    if (empty($_GET['action'])) {
        $action = $default;
    }
    else {
        $action = $_GET['action'];
    }
    return $action;
}
