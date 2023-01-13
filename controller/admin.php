<?php

include __DIR__ . '/../model/faq.php';

$page = selectPage("accueil");
$action = selectAction("view");

$view = "error404";

if(!empty($page) && !empty($action)){
    if($page === 'accueil') {
        $perms = array(
            'faq'=> pageAuthorization('admin/faq'),
            'user'=> pageAuthorization('admin/user'),
            'permission'=> pageAuthorization('admin/permission'),
        );
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
        $view = "admin/user/" . $action;
    }
    else {
        echo '<script>alert("Vous n\'avez pas accès à cette page")</script>';
    }
}
include (showPage($view));
