<?php
require_once  __DIR__ . '/../model/faq.php';
require_once  __DIR__ . '/../model/contact.php';
require __DIR__.'/mail.php';

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
            if (isset($_GET['isconnected'])){
                if (!isset($_SESSION['auth']) || !$_SESSION['auth']){
                    header("Location: login?page=login&error=Merci de vous connecter pour accéder à vos tickets" );
                    exit();
                }
            }
            if(isset($_SESSION['auth']) && $_SESSION['auth'] && $_SERVER['REQUEST_METHOD'] === 'GET'){
                $connected = true;
                $email = getUserEmail();
                $tickets = getUserTickets();
                if (count($tickets) === 0){
                    $tickets = array(
                        'content'=> null,
                    );
                }
            }
            if(isset($_POST['email'], $_POST['tag'], $_POST['content'])){
                if (!empty($_POST['tag']) && !empty($_POST['email']) && !empty($_POST['content'])) {
                    $success = phpMailSender(htmlspecialchars($_POST['email']), 'contact');
                    $user = getUserIdByEmail(htmlspecialchars($_POST['email']));
                    if ($user === 0) {
                        $user = null;
                    }
                    $insert = createTicket(htmlspecialchars($_POST['email']), intval($_POST['tag']), htmlspecialchars($_POST['content']), $user);
                    if ($success && $insert) {
                        header("Location: all?page=contact&success=Votre demande à été envoyée, vous aurez un retour dans les plus brefs délais");
                    } else {
                        header("Location: all?page=contact&error=Une erreur s'est produite, merci de réessayer");
                    }
                }else{
                    header("Location: all?page=contact&error=Merci de bien remplir tous les champs" );
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