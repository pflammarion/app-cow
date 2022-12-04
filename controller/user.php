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
                $cowId = $_GET['cow'];
                $sensors = array(
                    'heart' => getSensorValueByCowBySensor($cowId,1),
                    'air' => getSensorValueByCowBySensor($cowId,2),
                    'sound' => getSensorValueByCowBySensor($cowId,3),
                    'battery' => getSensorValueByCowBySensor($cowId,4),
                );
                $cow = getCow($cowId);
                $cow_alerts = getAlertByCow($cowId);
                $no_alert_heard = getAllCowNoAlert();
                $herd = getAllCowAlert();
                foreach ($no_alert_heard as $noh){
                    $exist = False;
                    foreach ($herd as $h){
                        if($h['id'] === $noh['id']){
                            $exist = True;
                        }
                    }
                    if(!$exist){
                        $herd[] = $noh;
                    }
                }
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


