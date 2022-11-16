<?php

include __DIR__ . '/../model/login.php';

$page = selectPage("login");
$view = "";

if(!empty($page)){
    switch ($page) {
        case 'login':
            $view = "login/login";
            if (isset($_POST['username']) and isset($_POST['password'])) {
                $values = [
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                ];
                $error = login($values);
                if ($error === ""){
                    if ($_SESSION['role'] === 1){
                        header("Location: user?page=accueil");
                    }
                    else{
                        header("Location: admin?page=accueil");
                    }
                    exit();
                }
                else{
                    echo('<script>alert("' . $error . '")</script>');
                }
            }
            break;
        case 'lostpassword':
            $view = "login/lostPassword";
            break;
        case 'register' :
            $view = "login/register";
            if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['password_confirm']) and isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email'])) {
                $register_errors = [];

                if ($_POST['password'] !== $_POST['password_confirm']){
                    $register_errors[] = "Passwords don't match";
                }
                if (strlen($_POST['password']) < 4) {
                    $register_errors[] = "Password not long enough! Must be at least 8 characters long";
                }

                if ($_POST['username'] === $_POST['password']) {
                    $register_errors[]= "Your name cannot be your password!";
                }
                if (!$register_errors){
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $values = [
                        'username' => $_POST['username'],
                        'password' => $password,
                        'email' => $_POST['email'],
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                    ];

                    $register = register($values);

                    if ($register) {
                        header("Location: login?page=login");
                        exit();
                    }
                }
            }
            break;
        default:
            $view = "error404";
    }
}


include ('view/' . $view . '.php');
