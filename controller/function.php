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
        $page = verifyString($_GET['page']);
    }
    return $page;
}
function verifyInt($valeur)
{
    if (is_int($valeur)) {
        // La valeur est déjà un entier, on ne fait rien
        return $valeur;
    } elseif (is_string($valeur) && ctype_digit($valeur)) {
        // La valeur est une chaîne de caractères qui ne contient que des chiffres, on la convertit en entier
        return (int)$valeur;
    } else {
        // La valeur n'est pas un entier, on renvoie false
        echo "erreur";
        return false;
    }
}
function verifyString($str)
{
    if (is_string($str)){
        // La valeur est déjà un string, on ne fait rien
        #echo gettype($str);
        return $str;
    }
    elseif (!is_string($str)){

        $st= "\"" . $str . "\"";
        #gettype($st)
        return $st;
    }
    else {
        return false;
    }
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

function dataSorting(array $list): array
{
    //fonctionne que pour les listes avec un objet qui a un attribut 'name'
    usort($list, function ($item1, $item2) {
        return $item1['name'] <=> $item2['name'];
    });
    return $list;
}

