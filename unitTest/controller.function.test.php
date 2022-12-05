<?php

include('../controller/function.php');
function testSelectPageGet(string $tester): bool
{
    $_GET['page'] = $tester;
    $output = selectPage('test2');
    return $output == $tester;
}

function testSelectPageEmpty(string $tester): bool
{
    unset($_GET['page']);
    $output = selectPage($tester);
    return $output == $tester;
}

function testSelectActionGet(string $tester): bool
{
    $_GET['action'] = $tester;
    $output = selectAction('test2');
    return $output == $tester;
}

function testSelectActionEmpty(string $tester): bool
{
    unset($_GET['page']);
    $output = selectAction($tester);
    return $output == $tester;
}

function testShowPage(string $page): bool
{
    $tester = 'view/' . $page . '.php';
    $output = showPage($page);
    return $output == $tester;
}

