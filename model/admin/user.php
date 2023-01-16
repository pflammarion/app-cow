<?php
function createUser(array $values, string $token): bool
{
    $lastname = $values['lastname'];
    $firstname = $values['firstname'];
    $username = $values["username"];
    $email = $values["email"];
    $role = $values["role"];
    if ($lastname !== "" && $firstname !== "" && $username !== "" && $email !== "" && $role !== ""){
        $create_user_sql = "INSERT INTO user (User_FirstName, User_LastName, User_Username, User_Email, Role_Id, User_Password, User_Token) VALUES (:firstname, :lastname, :username, :email, :role, :password, :token) ";
        $create_user_query = $GLOBALS['db']-> prepare($create_user_sql);
        $create_user_query->execute(
            array(
                "lastname"=> $lastname,
                "firstname"=> $firstname,
                "username"=> $username,
                "email"=> $email,
                "role"=> $role,
                "password" => $token,
                "token" => $token,
            )
        );
        return true;
    }
    return false;
}
function updateUser(array $values): bool
{
    $nom = $values["lastname"];
    $prenom = $values["firstname"];
    $usname = $values["username"];
    $email = $values["email"];
    $role = $values["role"];
    $id = $values["id"];
    if ($nom !== "" && $prenom !== "" && $usname !== "" && $email !== "" && $role !== "" && $id !== ""){
        $update_user_sql = "UPDATE user SET User_FirstName=:firstname, User_LastName=:lastname, User_Username=:username, User_Email=:email WHERE User_Id=:id";
        $update_user_query = $GLOBALS['db']-> prepare($update_user_sql);
        $update_user_query->execute(
            array(
                "lastname"=> $nom,
                "firstname"=> $prenom,
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
    $delete_user_sql = "DELETE FROM user WHERE User_Id = :id;";
    $delete_user_query = $GLOBALS['db']-> prepare($delete_user_sql);
    $delete_user_query->execute(
        array(
            "id"=> $id,
        )
    );
    return true;
}

function banUser(int $id): bool
{
    $ban_user_sql = "UPDATE user SET User_Ban = 1 WHERE User_Id=:id";
    $ban_user_query = $GLOBALS['db']-> prepare($ban_user_sql);
    $ban_user_query->execute(
        array(
            "id"=> $id,
        )
    );
    return true;
}
function getUser(): array
{
    //faire une limite 100 quand on aura la barre de recherche
    $get_user_sql = "SELECT User_Id,User_FirstName,User_LastName, User_Email, User_Username, Role_Id FROM user";
    $get_user_query = $GLOBALS['db']-> prepare($get_user_sql);
    $get_user_query->execute();
    $rows = $get_user_query->fetchAll();
    $values = [];
    if ($get_user_query->rowCount() > 0){
        foreach ($rows as $row) {
            $values[]=array(
                "id"=>$row["User_Id"],
                "firstname"=>$row["User_FirstName"],
                "lastname"=>$row["User_LastName"],
                "email"=>$row["User_Email"],
                "username"=>$row["User_Username"],
                "role"=>$row['Role_Id'],
            );

        }
    }
    return $values;
}
