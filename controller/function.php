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
    return (file_exists(__DIR__ .'/../view/' . $view . '.php')) ? 'view/' . $view . '.php' : 'view/error404.php';
}

function recherche (array $list,string $recherche): array{
    $temp=[];
        foreach ($list as $item) {
            if (isset($item['name'])) {

                if (str_contains(strtolower($item['name']), strtolower($recherche))) {
                    $temp[] = $item;
                }
            }
        }
        return $temp;


}

