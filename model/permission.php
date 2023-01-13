<?php

function pageAuthorization(string $page) : bool
{
    $sql = "SELECT permission.Permission_Id 
            FROM `permission` 
            LEFT JOIN page on page.Page_Id = permission.Page_Id
            WHERE  permission.Role_Id = :role AND page.Page_Name=:page LIMIT 1";
    $query = $GLOBALS['db']->prepare($sql);
    if ($_SESSION['role'] === 3 && $page !== 'admin/permission'){
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
function getRoles(): array
{
    $get_role = "SELECT Role_Id, Role_Name FROM role";
    $get_role = $GLOBALS['db']-> prepare($get_role);
    $get_role->execute();
    $rows = $get_role->fetchAll();
    $values = [];
    if ($get_role->rowCount() > 0){
        foreach ($rows as $row) {
            $values[]=array(
                "id"=>$row["Role_Id"],
                "name"=>$row["Role_Name"],
            );
        }
    }
    return $values;
}
