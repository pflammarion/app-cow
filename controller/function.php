<?php

use JetBrains\PhpStorm\NoReturn;

function consoleLog(string $var){
    echo("<script>console.log('PHP: " . $var . "');</script>");
}

function selectPage(string $default): string
{
    if (empty($_GET['page'])) {
        $page = $default;
    }
    else {
        $page = $_GET['page'];
    }
    return $page;
}

function selectAction(string $default): string
{
    if (empty($_GET['action'])) {
        $action = $default;
    }
    else {
        $action = $_GET['action'];
    }
    return $action;
}

#[NoReturn] function logout(): void
{
    session_start();
    session_destroy();
    header("Location: login?page=login");
    exit();
}

function showPage($view): string
{
    return (file_exists('view/' . $view . '.php')) ? 'view/' . $view . '.php' : 'view/error404.php';
}