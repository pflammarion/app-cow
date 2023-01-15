<?php
function createUser(array $values): bool
{
    $nom = $values['nom'];
    $prenom = $values['prenom'];
    $usname = $values["username"];
    $email = $values["email"];
    $role = $values["role"];
    if ($nom != "" && $prenom != "" && $usname != "" && $email != "" && $role = ""){
        $create_user_sql = "INSERT INTO user (User_FirstName, User_LastName, User_Username, User_Email) VALUES (:firstName, :lastName, :username, :email) ";
        $create_user_query = $GLOBALS['db']-> prepare($create_user_sql);
        $create_user_query->execute(
            array(
                "nom"=> $nom,
                "prenom"=> $prenom,
                "username"=> $usname,
                "email"=> $email,
                "role"=> $role,
            )
        );
        return true;
    }
    return false;
}
function updateUser(array $values): bool
{
    $nom = $values["nom"];
    $prenom = $values["prenom"];
    $usname = $values["username"];
    $email = $values["email"];
    $role = $values["role"];
    $id = $values["id"];
    if ($nom != "" && $prenom != "" && $usname != "" && $email != "" && $role != "" && $id != ""){
        $update_user_sql = "UPDATE user SET User_FirstName=:firstname, User_LastName=:lastname, User_Username=:username, User_Email=:email WHERE User_Id=:id";
        $update_user_query = $GLOBALS['db']-> prepare($update_user_sql);
        $update_user_query->execute(
            array(
                "nom"=> $nom,
                "prenom"=> $prenom,
                "email"=> $email,
                "username"=> $usname,
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}
function deleteUser(int $id): bool
{
    if ($id){
        $delete_user_sql = "DELETE FROM user WHERE User_Id = :id;";
        $delete_user_query = $GLOBALS['db']-> prepare($delete_user_sql);
        $delete_user_query->execute(
            array(
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}

function getuser(): array
{
    $get_user_sql = "SELECT User_Id,User_FirstName,User_LastName, User_Email, User_Username FROM user";
    $get_user_query = $GLOBALS['db']-> prepare($get_user_sql);
    $get_user_query->execute();
    $rows = $get_user_query->fetchAll();
    $values = [];
    if ($get_user_query->rowCount() > 0){
        foreach ($rows as $row) {
            $values[]=array(
                "id"=>$row["User_Id"],
                "prenom"=>$row["User_FirstName"],
                "nom"=>$row["User_LastName"],
                "email"=>$row["User_Email"],
                "usname"=>$row["User_Username"],
            );

        }
    }
    return $values;
}
