<?php

$db_name = "APPCOW";
$db_user = "app-user";
$db_pass = "APP-PSW-2022!";
$db_host = "localhost";

try {
    $GLOBALS['db'] = new PDO("mysql:host='.$db_host.';dbname='.$db_name.'", $db_user, $db_pass);
    $GLOBALS['db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(Exception $e) {
    echo 'Database connection error.'.$e->getMessage();
    exit();
}

/*Exemple de fonction :

function getUser(): array {
    $sql = 'SELECT * FROM User';
    $query = $GLOBALS['db']->prepare($s);
    $query->execute();
return $query -> fetchAll()
}
*/
