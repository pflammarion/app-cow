<?php

function login(array $value): string
{
    $object = htmlentities($value['username']);
    $password = $value['password'];
    $sql = "SELECT user.Role_Id, user.User_Ban, user.User_Password, user.User_Id FROM `user` WHERE  user.User_Username = :username OR User_Email=:email LIMIT 1";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute(array('username'=>$object, 'email'=> $object));
    $row = $query->fetch();
    if ($query->rowCount() === 1){
        if($row['User_Ban'] === 0) {
            if (password_verify($password, $row['User_Password'])) {
                $_SESSION['auth'] = true;
                $_SESSION['user'] = $row['User_Id'];
                $_SESSION['role'] = $row['Role_Id'];
                return "";
            }
            else return "Le nom d'utisateur ou le mot de passe est invalide";
        }
        else return "L'utilisateur a été bani de notre service";
    }
    else return "Le nom d'utisateur ou le mot de passe est invalide";
}

function register(array $value) : bool
{
    $register_errors = [];
    $username = $value['username'];
    $email = $value['email'];
    $lastname = $value['lastname'];
    $firstname = $value['firstname'];
    $password = $value['password'];
    $token = $value['token'];

    if (checkEmail($email)) {
        $register_errors[] = "Your email address is associated with another account.";
    }

    if (checkUser($username)) {
        $register_errors[] = "Your username is already used.";
    }

    if (checkBan($username, $email)) {
        $register_errors[] = "You were banned from our plateforme";
    }
    if (!$register_errors)
    {
        $create_account_sql = "INSERT INTO user (User_Username, User_Email, User_FirstName, User_LastName, User_Password, User_Token ) VALUES (:username, :email, :firstname, :lastname, :password, :token)";
        $create_account_query = $GLOBALS['db']->prepare($create_account_sql);
        $create_account_query->execute(
            array(
                "username"=> htmlentities($username),
                "email"=>htmlentities($email),
                "password"=>$password,
                "firstname"=>htmlentities($firstname),
                "lastname"=>htmlentities($lastname),
                'token' => $token,
            ));

        return true;
    }
    return false;
}

function addToken(string $token, string $email): bool
{
    $add_token_sql = "UPDATE user SET User_Token = :token WHERE user.User_Email = :email";
    $add_token_query = $GLOBALS['db']->prepare($add_token_sql);
    $add_token_query->execute(
        array(
            "token"=> $token,
            "email"=> $email,
        ));
    if ($add_token_query->rowCount() === 1){
        return true;
    }
    else return false;
}


function getUserByToken(string $token): string
{
    $sql = "SELECT User_Username
            FROM user 
            WHERE User_Token = :token";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute(array('token'=>$token));
    $row = $query->fetch();
    if ($query->rowCount() === 1){
        return $row['User_Username'];
    }
    else return '';
}

function updatePassword(string $password, string $token): bool
{
    $update_password_sql = "UPDATE user SET User_Password = :password WHERE user.User_Token = :token";
    $update_password_query = $GLOBALS['db']->prepare($update_password_sql);
    $update_password_query->execute(
        array(
            "token"=> $token,
            "password"=> $password,
        ));
    if ($update_password_query->rowCount() === 1){
        return true;
    }
    else return false;
}

function deleteToken(string $token): void
{
    $delete_token_sql = "UPDATE user SET User_Token = NULL WHERE user.User_Token = :token";
    $delete_token_query = $GLOBALS['db']->prepare($delete_token_sql);
    $delete_token_query->execute(
        array(
            "token"=> $token,
        ));
}

function isAdminNotInit(): bool
{
    $sql = "SELECT User_Id FROM user WHERE User_Id = 1 AND User_Init = 0";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute();
    if ($query->rowCount() === 1){
        return true;
    }
    else return false;
}

function initAdmin(string $password): bool
{
    $update_password_sql = "UPDATE user SET User_Password = :password, User_Init = 1 WHERE user.User_Id = 1";
    $update_password_query = $GLOBALS['db']->prepare($update_password_sql);
    $update_password_query->execute(
        array(
            "password"=> $password,
        ));
    if ($update_password_query->rowCount() === 1){
        return true;
    }
    else return false;
}

function validateUser(string $token): bool
{

    $sql = "UPDATE user SET  User_Init = 1 WHERE user.User_Token = :tokent";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute(
        array(
            "token"=> $token,
        ));
    if ($query->rowCount() === 1){
        return true;
    }
    else return false;
}