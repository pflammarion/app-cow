<?php

include __DIR__ . '/../model/admin/faq.php';
include __DIR__ . '/../model/admin/user.php';
require __DIR__ . '/../model/permission.php';

$page = selectPage("accueil");
$action = selectAction("view");

$view = "error404";

if(!empty($page) && !empty($action)){
    if($page === 'accueil' && pageAuthorization('admin')) {
        $view = "admin/home";
    }
    elseif($page === 'faq' && pageAuthorization('admin/faq')) {
        $view = "admin/faq/" . $action;
        $content = getfaq();
        if (isset($_POST['action'])) {
            $success = False;
            if ($_POST['action'] == 'create') {
                $values = array(
                    "question" => $_POST['question'],
                    "response" => $_POST['response'],
                );
                $success = createFaq($values);
            }
            if ($_POST['action'] == 'update') {
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
        $view = "admin/permission/" . $action;
    }
    elseif($page === 'user' && pageAuthorization('admin/user')){
        $view = "admin/user/" . $action;
        $content = getuser();
        $roles = getRoles();
        if (isset($_POST['action'])) {
            $success = False;
            if ($_POST['action'] == 'create') {
                $values = array(
                    "nom" => $_POST['lastname'],
                    "prenom" => $_POST['firstname'],
                    "email" => $_POST['email'],
                    "userName" => $_POST['username'],
                    "role" => $_POST["role"],
                );
                $success = createUser($values);
                if ($_POST['action'] == 'update') {
                    $values = array(
                        "nom" => $_POST['lastname'],
                        "prenom" => $_POST['firstname'],
                        "email" => $_POST['email'],
                        "userName" => $_POST['username'],
                        "role" => $_POST["role"],
                        "id" => $_POST['id'],
                    );
                    $success = updateUser($values);
                    if ($_POST['action'] === 'delete') {
                        $success = deleteUser(intval($_POST['id']));
                    }
                    if ($success) {
                        header("Location: admin?page=user&action=view&success=Reussite");
                        exit();
                    }
                }
                }
            if ($success) {
                header("Location: admin?page=user&action=view&success=Reussite");
                exit();
            }
        }
    }
    else {
        echo '<script>alert("Vous n\'avez pas accès à cette page")</script>';
    }
include (showPage($view));{
}
}