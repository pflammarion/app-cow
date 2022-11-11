<?php

include 'connection.php';
include 'function.php';

function login(): bool
{
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $sql = "SELECT User.Role_Id, User.User_Ban, User.User_Password FROM `User` WHERE  User.User_Username = :username LIMIT 1";
        $query = $GLOBALS['db']->prepare($sql);
        $username = htmlentities($_POST['username']);
        $password = $_POST['password'];
        $query->execute(array('username'=>$username, 'password'=>$password));
        $row = $query->fetch();
        if ($query->rowCount() === 1 && $row['User_Ban'] === 0  && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = $row['Role_Id'];
            return $auth = true;
        }
        else {
            return $auth = false;
        }
    }
    else return $auth = false;
}

function logout(){
    session_start();
    session_destroy();
    header("Location: /login?page=login");
}

function register()
{
    $register_errors = [];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    if ($password !== $password_confirm){
        $register_errors[] = "Passwords don't match";
    }
    if (strlen($password) < 8) {
        $register_errors[] = "Password not long enough! Must be at least 8 characters long";
    }

    if ($username === $password) {
        $register_errors[]= "Your name cannot be your password!";
    }

    $email_sql = "SELECT count(1) FROM User WHERE User_Email = :email";
    $email_query = $GLOBALS['db']->prepare($email_sql);
    $email_query->execute(array("email"=> $email));
    $email_found = $email_query->fetchColumn();
    if ($email_found) {
        $register_errors[] = "Your email address is associated with another account.";
    }

    $user_sql = "SELECT count(1) FROM User WHERE User_Username = :username";
    $user_query = $GLOBALS['db']->prepare($user_sql);
    $user_query->execute(array("username"=> $username));
    $user_found = $user_query->fetchColumn();
    if ($user_found) {
        $register_errors[] = "Your username is already used.";
    }

    $user_ban_sql = "SELECT User_Ban FROM User WHERE User_Username = :username OR User_Email = :email";
    $user_ban_query = $GLOBALS['db']->prepare($user_sql);
    $user_ban_query->execute(array("username"=> $username, "email"=>$email));
    $user_ban = $user_ban_query->fetch();
    if ($user_ban === 1) {
        $register_errors[] = "You were banned from our plateforme";
    }

    if (!$register_errors)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $create_account_sql = "INSERT INTO User (User_Username, User_Email, User_FirstName, User_LastName, User_Password ) VALUES (:username, :email, :firstname, :lastname, :password)";
        $create_account_query = $GLOBALS['db']->prepare($create_account_sql);
        $create_account_query->execute(
            array(
                "username"=> htmlentities($username),
                "email"=>htmlentities($email),
                "password"=>htmlentities($password),
                "firstname"=>htmlentities($firstname),
                "lastname"=>htmlentities($lastname),
            ));

        header("Location: /login?page=login");
        exit;
    }
}
