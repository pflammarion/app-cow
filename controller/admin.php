<?php

include __DIR__ . '/../model/admin/faq.php';
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
        $roles = getRoles();
        $view = "admin/user/" . $action;
    }
    else {
        echo '<script>alert("Vous n\'avez pas accès à cette page")</script>';
    }
}
include (showPage($view));
