<?php

require_once __DIR__ . '/../model/faq.php';
require_once __DIR__ . '/../model/contact.php';
require_once __DIR__ . '/../model/login.php';
require_once __DIR__ . '/mail.php';

$page = selectPage("accueil");
$action = selectAction("view");

$view = "error404";

if(!empty($page) && !empty($action)){
    if($page === 'accueil') {
        $perms = array(
            'faq'=> pageAuthorization('admin/faq'),
            'user'=> pageAuthorization('admin/user'),
            'permission'=> pageAuthorization('admin/permission'),
            'ticket'=> pageAuthorization('admin/ticket'),
        );
        $view = "admin/home";
    }
    elseif($page === 'faq' && pageAuthorization('admin/faq')) {
        $view = "admin/faq/" . $action;
        $content = getfaq();
        if (isset($_POST['action'])) {
            $success = False;
            if ($_POST['action'] === 'create') {
                $values = array(
                    "question" => $_POST['question'],
                    "response" => $_POST['response'],
                );
                $success = createFaq($values);
            }
            if ($_POST['action'] === 'update') {
                $values = array(
                    "question" => $_POST['question'],
                    "response" => $_POST['response'],
                    "id" => $_POST['id'],
                );
                $success = updateFaq($values);
            }
            if ($_POST['action'] === 'delete') {
                $success = deleteFaq(intval($_POST['id']));
            }
            if ($success) {
                header("Location: admin?page=faq&action=view");
                exit();
            }
        }
    }
    elseif($page === 'permission' && pageAuthorization('admin/permission')) {
        $roles = getRoles();
        $pages = getPages();
        $perms = getPermission();
        $view = "admin/permission/" . $action;
        $success = false;
        if ($action === 'role'){
            $data = getAllRoles();
        }
        if(isset($_POST['role'], $_POST['action']) && $_POST['action'] === 'create'){
            $success = createRole(htmlentities($_POST['role']));
        }
        if (isset($_POST['action'],$_POST['role'], $_POST['id']) && $_POST['action'] === 'update') {
            $values = array(
                "name" => htmlentities($_POST['role']),
                "id" => htmlentities($_POST['id']),
            );
            $success = updateRole($values);
        }
        if (isset($_POST['action'], $_POST['id']) && $_POST['action'] === 'delete') {
            $success = deleteRole(intval($_POST['id']));
        }
        if ($success){
            header("Location: admin?page=permission&action=role");
            exit();
        }
        if (isset($_POST['checkbox'])){
                $datas = $_POST['checkbox'];
                $new_perms = [];
                $insert = [];
                for ($i = 0; $i < count($datas); $i++){
                    $parts = explode("-", $datas[$i]);
                    $new_perms[] = array(
                        "page" => $parts[0],
                        "role" => $parts[1],
                    );
                }
                $success = false;
                for ($i = 0; $i < count($perms); $i++){
                    if(!in_array($perms[$i], $new_perms)){
                        $success = deletePerm($perms[$i]['page'], $perms[$i]['role']);
                    }
                }
                for ($j = 0; $j < count($new_perms); $j++){
                    if(!in_array($new_perms[$j], $perms)){
                        $success = addPerm($new_perms[$j]['page'], $new_perms[$j]['role']);
                    }
                }
                if ($success){
                    header("Location: admin?page=permission&success=Vous avez bien mis à jour les roles");
                    exit();
                }

        }
    }
    elseif($page === 'user' && pageAuthorization('admin/user')){
        $roles = getRoles();
        $view = "admin/user/" . $action;
    }
    elseif($page === 'ticket' && pageAuthorization('admin/ticket')) {
        $view = "admin/ticket/" . $action;
        $tickets = getAllTickets();
        if($action === 'update' && isset($_GET['ticket'])){
            $ticket = getTicketById(intval($_GET['ticket']));
            if(isset($_GET['change'], $_GET['email'])){
                $success = updateTicketStatus(intval($_GET['change']), intval($_GET['ticket']));
                if ($success){
                    phpMailSender(htmlentities($_GET['email']), 'contact_update');
                    header("Location: admin?page=ticket&action=update&ticket=" . intval($_GET['ticket']) . "&success=Vous avez bien mis à jour le status");
                }
                else header("Location: admin?page=ticket&action=update&ticket=" . intval($_GET['ticket']) . "&error=Une erreur s'est produite pendant la mise à jour du status mis à jour le status");
                exit();
            }
        }
    }
    elseif($page === 'init' && isAdminNotInit() && intval($_SESSION['role']) === 3) {
        $view = 'admin/init/' . $action;
        if (isset($_POST['password']) && isset($_POST['password_confirm'])){
            $register_errors = [];
            if ($_POST['password'] !== $_POST['password_confirm']){
                header("Location: admin?page=init&error=Les mots de passe que vous avez saisis ne correspondent pas");
                exit();
            }
            if (strlen($_POST['password']) < 8) {
                header("Location: admin?page=init&error=Le mot de passe nécessite plus de 8 caractères");
                exit();
            }

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $update = initAdmin($password);
            if ($update) {
                header("Location: root?success=Le compte administrateur a bien été initialisé");
            }
            else {
                header("Location: admin?page=init&error=Une erreur s'est produite, merci de recommencer la saisie");
            }
            exit();
        }
    }
    else {
        echo '<script>alert("Vous n\'avez pas accès à cette page")</script>';
    }
}
include (showPage($view));
