<?php

include __DIR__ . '/../model/permission.php';
include __DIR__ . '/../model/home.php';

$page = selectPage("accueil");
$action = selectAction("view");

if(pageAuthorization('user') && !empty($page) && !empty($action)){
    switch ($page) {
        case 'accueil':
            $view = "user/home";
            if (isset($_GET['cow'])){
                $sensors = array(
                    'heart' => getSensorValueByCowBySensor($_GET['cow'],1),
                    'air' => getSensorValueByCowBySensor($_GET['cow'],2),
                    'sound' => getSensorValueByCowBySensor($_GET['cow'],3),
                    'battery' => getSensorValueByCowBySensor($_GET['cow'],4),
                );
                $cow = getCow($_GET['cow']);
            }
            else{
                $cowId = getCowsNonViewedAlert();
                header("Location: user?page=accueil&cow=" . $cowId);
                exit();
            }
            break;
        case 'boitier':
            $view = "user/chip/". $action;
            break;

        case 'vache':
            $view = "user/cow/". $action;
            break;

        case 'tableau':
            $view = "user/table/" . $action;
            break;

        default:
            $view = "error404";
            $title = "Erreur";
    }
    include (showPage($view));
}
else{
    echo('<script>alert("Vous n\'avez pas la permission d\'accéder à cette page")</script>');
}


