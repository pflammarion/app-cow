<?php

function pageAuthorization(string $page) : bool
{
    $sql = "SELECT Permission.Permission_Id 
            FROM `Permission` 
            LEFT JOIN Page on Page.Page_Id = Permission.Page_Id
            WHERE  Permission.Role_Id = :role AND Page.Page_Name=:page LIMIT 1";
    $query = $GLOBALS['db']->prepare($sql);
    if ($_SESSION['role'] === 3){
        $query->execute(array('page'=>$page, 'role'=> 2));
    }
    else{
        $query->execute(array('page'=>$page, 'role'=> $_SESSION['role']));
    }
    if ($query->rowCount() === 1){
       return true;
    }
    else return false;
}
