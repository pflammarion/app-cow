<?php
require __DIR__.'/mail.php';

$page = selectPage("");

if(!empty($page) && $page !== ""){
    switch ($page) {
        case 'cgu':
            $view = "all/cgu";
            break;

        case 'contact':
            $view = "all/contact";
            if(isset($_POST['email']) and isset($_POST['sujet']) and isset($_POST['message'])){
                echo 'fdp';
                $success = phpMailSender('', $_POST['email'], 'contact', $_POST['message'], $_POST['sujet']);
                if($success){
                    echo 'reussit';
                }
            }
            break;

        case 'faq':
            $view = "all/faq";
            break;

        case 'legal':
            $view = "all/legal";
            break;

        case 'logout':
            logout();

        default:
            $view = "error404";
    }
    include (showPage($view));
}