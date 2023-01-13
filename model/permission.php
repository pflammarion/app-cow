<?php

function pageAuthorization(string $page) : bool
{
    $sql = "SELECT permission.Permission_Id 
            FROM `permission` 
            LEFT JOIN page on page.Page_Id = permission.Page_Id
            WHERE  permission.Role_Id = :role AND page.Page_Name=:page LIMIT 1";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute(array('page'=>$page, 'role'=> $_SESSION['role']));
    if ($query->rowCount() === 1){
       return true;
    }
    if ($_SESSION['role'] === 3){
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

function getPages(): array
{
    $get_page = "SELECT Page_Id, Page_Name FROM page";
    $get_page = $GLOBALS['db']-> prepare($get_page);
    $get_page->execute();
    $rows = $get_page->fetchAll();
    $values = [];
    if ($get_page->rowCount() > 0){
        foreach ($rows as $row) {
            $values[]=array(
                "id"=>$row["Page_Id"],
                "name"=>$row["Page_Name"],
            );
        }
    }
    return $values;
}


function getPermission(): array
{
    $get_perm = "SELECT Page_Id, Role_Id FROM permission";
    $get_perm = $GLOBALS['db']-> prepare($get_perm);
    $get_perm->execute();
    $rows = $get_perm->fetchAll();
    $values = [];
    if ($get_perm->rowCount() > 0){
        foreach ($rows as $row) {
            $values[]=array(
                "page"=>$row["Page_Id"],
                "role"=>$row["Role_Id"],
            );
        }
    }
    return $values;
}

function addPerm(int $page, int $role): bool
{
    $update_perm_sql = "INSERT INTO permission (Role_Id, Page_Id) VALUES (:role, :page)";
    $update_perm_query = $GLOBALS['db']->prepare($update_perm_sql);
    $update_perm_query->execute(
        array(
            "page"=> $page,
            "role"=> $role,
        ));
    if ($update_perm_query->rowCount() === 1){
        return true;
    }
    else return false;
}

function deletePerm(int $page, int $role): bool
{
    $delete_perm_sql = "DELETE FROM permission WHERE Page_Id = :page AND Role_Id =:role AND Role_Id != 3;";
    $delete_perm_query = $GLOBALS['db']->prepare($delete_perm_sql);
    $delete_perm_query->execute(
        array(
            "page"=> $page,
            "role"=> $role,
        ));
    return true;
}

function getAllRoles(): array
{
    $get_role_sql = "SELECT Role_Id, Role_Name  FROM role";
    $get_role = $GLOBALS['db']-> prepare($get_role_sql);
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

function createRole(string $role): bool
{
        $update_faq_sql = "INSERT INTO role SET Role_Name=:role";
        $update_faq_query = $GLOBALS['db']-> prepare($update_faq_sql);
        $update_faq_query->execute(
            array(
                "role"=> $role,
            )
        );
        return true;
}
