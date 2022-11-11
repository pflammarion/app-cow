<?php

include 'connection.php';
include 'function.php';

function login(){
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $sql = "SELECT User.Role_Id, User.User_Ban FROM `User` WHERE  User.User_Username = :username AND User.User_Password = :password LIMIT 1";
        $query = $GLOBALS['db']->prepare($sql);
        $username = htmlentities($_POST['username']);
        $password = ($_POST['password']);
        $query->execute(array('username'=>$username, 'password'=>$password));
        $row = $query->fetch();
        if ($query->rowCount() === 1 && $row['User_Ban'] === 0 && $username === $row['username'] && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = $row['Role_Id'];
            return $auth = true;
        }
        else {
            return 'Bad credentials or ban';
        }
    }
}

function logout(){
    session_start();
    session_destroy();
    header('Location: index.html');
}
