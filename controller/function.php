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

function tokenGeneration(): string
{
    $token = "";
    $array_letters = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));;
    for ($i = 0; $i < 30; $i++) {
        $token .= $array_letters[array_rand($array_letters, 1)];
    }
    return $token;
}

function validateDate($date, $format = 'Y-m-d H:i:s'): bool
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function recherche(array $list,string $recherche): array
{
    $affiche = [];
    if ($recherche !== ""){
        if ( !preg_match('/[^A-Za-z0-9]/', $recherche)) {
            $query = $recherche;
            foreach ($list as $item) {
                if (isset($item['name'])) {
                    if (str_contains(strtolower($item['name']), strtolower($query))) {
                        $affiche[] = $item;
                    }
                }
            }
        }
        else{
            $affiche = array(
                "error" => "preg not match",
            );
        }
    }else{
        $affiche = array(
            "error" => "requête nulle",
        );
    }
    return $affiche;
}

