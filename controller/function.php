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
        $page = dataCleaner($_GET['page']);
    }
    return $page;
}


function selectAction(string $default): string
{
    if (empty($_GET['action'])) {
        $action = $default;
    }
    else {
        $action = dataCleaner($_GET['action']);
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
    return $d && $d->format($format) === $date;
}

function dataChecker($data, string $validation_type): bool
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    switch ($validation_type) {
        case "email":
            if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            break;
        case "int":
            if (!filter_var($data, FILTER_VALIDATE_INT)) {
                return false;
            }
            break;
        case "string":
            if (!filter_var($data, FILTER_SANITIZE_STRING)) {
                return false;
            }
            break;

        default:
            return true;
    }
    return true;
}

function dataCleaner($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
