<?php

include __DIR__ . '/../model/faq.php';
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
        $roles = getRoles();
        $pages = getPages();
        $perms = getPermission();
        $view = "admin/permission/" . $action;
        if (isset($_POST['checkbox'])){
            $success = deleteAllPermExceptAdmin();
            if($success){
                $datas = $_POST['checkbox'];
                $add = false;
                print_r($datas);
                for ($i = 0; $i < count($datas); $i++){
                    $parts = explode("-", $datas[$i]);
                    addPerm(intval($parts[0]), $parts[1]);
                    if ($i === count($datas) - 1){
                        $add = true;
                    }
                }
                if ($add){
                    header("Location: admin?page=permission&success=Vous avez bien mis à jour les roles");
                    exit();
                }
            }
        }
    }
    elseif($page === 'user' && pageAuthorization('admin/user')){
        $view = "admin/user/" . $action;
    }
    else {
        echo '<script>alert("Vous n\'avez pas accès à cette page")</script>';
    }
}
include (showPage($view));
