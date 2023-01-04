<?php

require __DIR__ . '/../model/permission.php';
require __DIR__ . '/../model/home.php';

$page = selectPage("accueil");
$action = selectAction("view");
if(pageAuthorization('user') && !empty($page) && !empty($action)){
    switch ($page) {
        case 'accueil':
            if($action === 'level_selector' && isset($_GET['chipid']) && isset($_GET['cow'])){
                $view = "user/level_selector";
            }
            if($action === 'level' && isset($_GET['chipid'], $_GET['cow'], $_GET['sensorid'])){
                $view = "user/level";
                $current_level = getLevelByChip($_GET['chipid']);
                if(isset($_POST['reference'])){
                    $new_sensor = array(
                        'sensor' => intval($_POST['sensor']) ?? null,
                        'reference' => intval($_POST['reference']) ?? null,
                        'firstLevel' => intval($_POST['firstLevel']) ?? null,
                        'secondLevel' => intval($_POST['secondLevel']) ?? null,
                    );

                    $values = array($new_sensor);
                    $update = changeLevel($_GET['chipid'], $values);
                    if ($update){
                        header("Location: user?page=accueil&cow=" . $_GET['cow']);
                        exit();
                    }

                }
            }
            if($action === 'view'){
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
                    $chipId = getChip($cowId);
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
                    $view = '';
                    header("Location: user?page=accueil&cow=" . $cowId);
                    exit();
                }
            }

            break;
        case 'boitier':
            $view = "user/chip/". $action;
            break;

        case 'vache':
            $view = "user/cow/". $action;
            $content = getCow();

            break;

        case 'tableau':
            $type = $_GET['type'];
            $view = "user/table";
            break;

        default:
            $view = "error404";
    }
    include (showPage($view));
}
else{
    echo('<script>alert("Vous n\'avez pas la permission d\'accéder à cette page")</script>');
}


