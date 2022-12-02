<?php

include __DIR__ . '/../model/permission.php';
include __DIR__ . '/../model/admin/faq.php';

$page = selectPage("accueil");
$action = selectAction("view");

$view = "error404";
$content=[];
if(!empty($page) && !empty($action)){
    if($page == 'accueil' && pageAuthorization('admin')) {
        $view = "admin/home";
    }
    elseif($page == 'faq' && pageAuthorization('admin/faq')){
        $content = getfaq();
        if(isset($_POST['question'])){
            $values = array(
                "question" => $_POST['question'],
                "response" => $_POST['response'],
            );
            $success = createFaq($values);

            if ($success) {
                header("Location: admin?page=faq&action=view");
                exit();
            }
        }
        $view = "admin/faq/" . $action;
    }
    elseif($page =='permission' && pageAuthorization('admin/permission')) {
        $view = "admin/permission" . $action;
    }
    elseif($page =='user' && pageAuthorization('admin/user')){
        $view = "admin/user" . $action;
    }
    else echo '<script>alert("Vous n\'avez pas accès à cette page")</script>';
}
include (showPage($view));
