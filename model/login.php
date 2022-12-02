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

    $email_sql = "SELECT count(1) FROM user WHERE User_Email = :email";
    $email_query = $GLOBALS['db']->prepare($email_sql);
    $email_query->execute(array("email"=> $email));
    $email_found = $email_query->fetchColumn();
    if ($email_found) {
        $register_errors[] = "Your email address is associated with another account.";
    }

    $user_sql = "SELECT count(1) FROM user WHERE User_Username = :username";
    $user_query = $GLOBALS['db']->prepare($user_sql);
    $user_query->execute(array("username"=> $username));
    $user_found = $user_query->fetchColumn();
    if ($user_found) {
        $register_errors[] = "Your username is already used.";
    }

    $user_ban_sql = "SELECT User_Ban FROM user WHERE User_Username = :username OR User_Email = :email";
    $user_ban_query = $GLOBALS['db']->prepare($user_ban_sql);
    $user_ban_query->execute(array("username"=> $username, "email"=>$email));
    $user_ban = $user_ban_query->fetch();
    if ($user_ban === 1) {
        $register_errors[] = "You were banned from our plateforme";
    }

    if (!$register_errors)
    {
        $create_account_sql = "INSERT INTO user (User_Username, User_Email, User_FirstName, User_LastName, User_Password ) VALUES (:username, :email, :firstname, :lastname, :password)";
        $create_account_query = $GLOBALS['db']->prepare($create_account_sql);
        $create_account_query->execute(
            array(
                "username"=> htmlentities($username),
                "email"=>htmlentities($email),
                "password"=>htmlentities($password),
                "firstname"=>htmlentities($firstname),
                "lastname"=>htmlentities($lastname),
            ));

        return true;
    }
    return false;
}
