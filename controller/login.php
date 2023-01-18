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
                    'username' => htmlentities($_POST['username']),
                    'password' => $_POST['password'],
                ];
                $error = login($values);
                if ($error === ""){
                    if (isset($_POST['redirect']) && !empty($_POST['redirect'])){
                       if (htmlentities($_POST['redirect']) === 'ticket'){
                           header("Location: all?page=contact");
                           exit();
                       }
                    }
                    else{
                        if ($_SESSION['role'] === 1){
                            header("Location: user?page=accueil&success=Vous êtes connecté en temps qu'utilisateur");
                        }
                        elseif($_SESSION['role'] === 3){
                            $not_init = isAdminNotInit();
                            if ($not_init){
                                header("Location: admin?page=init");
                            }
                            else{
                                header("Location: admin?page=accueil");
                            }
                        }
                        else{
                            header("Location: admin?page=accueil");
                        }
                        exit();
                    }
                }
                else{
                    header("Location: ?page=login&error=". urlencode($error));
                    exit();
                }
            }
            break;
        case 'lostpassword':
            $view = "login/lostPassword";
            if(isset($_POST['email'])){
                $token = tokenGeneration();
                $success = phpMailSender(htmlspecialchars($_POST['email']),'psw', $token);
                $insert = addToken($token, htmlspecialchars($_POST['email']));
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
                $email = htmlentities($_POST['email']);
                $username= htmlentities($_POST['username']);
                    if (!$register_errors) {
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $token = tokenGeneration();
                        $success = false;
                        if(!checkUserEmailOrUser($email, $username)) {
                                $values = [
                                    'username' => $username,
                                    'password' => $password,
                                    'email' => $email,
                                    'firstname' => htmlentities($_POST['firstname']),
                                    'lastname' => htmlentities($_POST['lastname']),
                                    'token' => $token,
                                ];

                                $register = register($values);
                        }else{
                        header("Location: ?page=register&error=Ce nom d'utilisateur ou cette adresse email ne sont plus disponibles");
                        exit();
                        }
                        if ($register) {
                            phpMailSender($email, 'register', $token);
                            header("Location: login?page=login&success=Inscription réussite ! Veuillez consulter vos mails pour valider l'adresse email");
                            exit();
                        }
                    }
                }
            break;
        case 'emailvalidate':
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                $user = getUserByToken($token);
                if ($user !== '' ){
                    $success = validateUser($token);
                    if ($success){
                        deleteToken($user);
                        header("Location: login?page=login&success=Votre email a bien été validé !");
                    }
                    else{
                        header("Location: login?page=login&error=Une erreur s'est produite pendant la validation de l'email, veuillez contacter un administrateur");
                    }
                    exit();
                }
            }
            break;
        default:
            $view = "error404";
    }
}
include (showPage($view));
