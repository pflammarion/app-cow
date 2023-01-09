<?php

require __DIR__ . '/../model/login.php';
require __DIR__ . '/../model/function.php';
require __DIR__.'/mail.php';

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
                        header("Location: user?page=accueil&success=Vous êtes connecté en temps que utilisateur");
                    }
                    else{
                        header("Location: admin?page=accueil");
                    }
                    exit();
                }
                else{
                    header("Location: ?page=login&error=". $error);
                }
            }
            break;
        case 'contact':
            $view = "all/contact";
            if(isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message'])){
                header("Location: login?page=contact&success=Mail envoyé !\brVous recevrez une réponse prochainement");
                exit();
                }
            else {
                    header("Location: ?page=contact&error=Un des champs n'a pas été rempli");
                }
            break;
        case 'update':
            $view = "profile/update";
            if(isset($_POST['username']) and isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email'])) {
                $update_errors = [];

                if ($_POST['password'] !== $_POST['password_confirm']){
                    $update_errors[] = "Passwords don't match";
                    if (strlen($_POST['password']) < 4) {
                        $update_errors[] = "Password not long enough! Must be at least 8 characters long";
                        if ($_POST['username'] === $_POST['password']) {
                            $update_errors[]= "Your name cannot be your password!";
                            header("Location: ?page=register&error=Votre mot de passe ne peut pas être votre nom d'utilisateur");
                            break;
                        }
                        header("Location: ?page=register&error=Le mot de passe nécessite plus de 4 caractères");
                        break;
                    }
                    header("Location: ?page=register&error=Les mots de passe que vous avez saisis ne correspondent pas");
                    break;
                }

                if (!$update_errors){

                    $values = [
                        'username' => $_POST['username'],
                        'email' => $_POST['email'],
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                    ];

                    $update = register($values);

                    if ($update) {
                        header("Location: login?page=login&success=Inscription réussite !");
                        exit();
                    }
                }
            }
            break;
        case 'lostpassword':
            $view = "login/lostPassword";
            if(isset($_POST['email'])){
                $token = tokenGeneration();
                $success = phpMailSender($token, $_POST['email']);
                $insert = addToken($token, $_POST['email']);
                if ($success && $insert){
                    header("Location: login?page=login&success=Vous recevrez un mail d'ici quelques instants" );
                    exit();
                }
                else {
                    header("Location: ?page=lostpassword&error=Email non reconnu");
                }
            }
            break;
        case 'newpassword':
            $view = "login/newPassword";
            if (isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['token'])){
                $token = $_POST['token'];
                $user = getUserByToken($token);
                if($user !== ''){
                    $register_errors = [];
                    if ($_POST['password'] !== $_POST['password_confirm']){
                        $register_errors[] = "Passwords don't match";
                        if (strlen($_POST['password']) < 4) {
                            $register_errors[] = "Password not long enough! Must be at least 8 characters long";
                            if ($user === $_POST['password']) {
                                $register_errors[]= "Your name cannot be your password!";
                                header("Location: ?page=newpassword&error=Votre mot de passe ne peut pas être votre nom d'utilisateur");
                                break;
                            }
                            header("Location: ?page=newpassword&error=Le mot de passe nécessite plus de 4 caractères");
                            break;
                        }
                        header("Location: ?page=newpassword&error=Les mots de passe que vous avez saisis ne correspondent pas");
                        break;
                    }

                    if (!$register_errors){
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        $update = updatePassword($password, $token);

                        if ($update) {
                            deleteToken($token);
                            header("Location: login?page=login&success=Votre mot de passe a été modifié !");
                            exit();
                        }
                    }
                }
            }
            break;
        case 'register' :
            $view = "login/register";
            if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['password_confirm']) and isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email'])) {
                $register_errors = [];

                if ($_POST['password'] !== $_POST['password_confirm']){
                    $register_errors[] = "Passwords don't match";
                    if (strlen($_POST['password']) < 4) {
                        $register_errors[] = "Password not long enough! Must be at least 8 characters long";
                        if ($_POST['username'] === $_POST['password']) {
                            $register_errors[]= "Your name cannot be your password!";
                            header("Location: ?page=register&error=Votre mot de passe ne peut pas être votre nom d'utilisateur");
                            break;
                        }
                        header("Location: ?page=register&error=Le mot de passe nécessite plus de 4 caractères");
                        break;
                    }
                    header("Location: ?page=register&error=Les mots de passe que vous avez saisis ne correspondent pas");
                    break;
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
                        header("Location: login?page=login&success=Inscription réussite !");
                        exit();
                    }
                }
            }
            break;
        default:
            $view = "error404";
    }
}
include (showPage($view));
