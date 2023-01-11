<?php
include __DIR__ . '/../model/faq.php';

$page = selectPage("");

if(!empty($page) && $page !== ""){
    switch ($page) {
        case 'cgu':
            $view = "all/cgu";
            break;

        case 'contact':
            $view = "all/contact";
            break;

        case 'faq':
            $view = "all/faq";
            $content = getfaq();
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