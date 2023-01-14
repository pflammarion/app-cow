<?php
require_once  __DIR__ . '/../model/faq.php';
require_once  __DIR__ . '/../model/contact.php';

$page = selectPage("");

if(!empty($page) && $page !== ""){
    switch ($page) {
        case 'cgu':
            $view = "all/cgu";
            break;

        case 'contact':
            $connected = false;
            $email  = "";
            if(isset($_SESSION['auth']) && $_SESSION['auth']){
                $connected = true;
                $email = getUserEmail();
                $tickets = getUserTickets();
            }
            $sujet = getAllTags();
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