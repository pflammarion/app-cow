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
            $sujet = getAllTags();
            $view = "all/contact";
            if(isset($_SESSION['auth']) && $_SESSION['auth'] && !isset($_POST['email'])){
                $connected = true;
                $email = getUserEmail();
                $tickets = getUserTickets();
            }
            if(isset($_POST['email'], $_POST['tagId'], $_POST['content'])){
                $success = phpMailSender( htmlspecialchars($_POST['email']), 'contact');
                $insert = createTicket(htmlspecialchars($_POST['email']), intval($_POST['tagId']), htmlspecialchars($_POST['content']));
                if($success && $insert){
                    header("Location: all?page=contact&success=Votre demande à été envoyée, vous aurez un retour dans les plus brefs délais" );
                }
                else {
                    header("Location: all?page=contact&error=Une erreur s'est produite, merci de réessayer" );
                }
                exit();
            }


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