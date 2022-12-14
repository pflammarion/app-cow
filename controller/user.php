<?php

require __DIR__ . '/../model/permission.php';
require __DIR__ . '/../model/home.php';

$page = selectPage("accueil");
$action = selectAction("view");
if(pageAuthorization('user') && !empty($page) && !empty($action)){
    switch ($page) {
        case 'accueil':
            if($action === 'level' && isset($_GET['chipid']) && isset($_GET['cow'])){
                $view = "user/level";
                $current_level = getLevelByChip($_GET['chipid']);
                if(isset($_POST['min-1'])){
                    $new_heart = array(
                        'sensor' => 1,
                        'min' => intval($_POST['min-1']) ?? null,
                        'mid' => intval($_POST['mid-1']) ?? null,
                        'max' => intval($_POST['max-1']) ?? null,
                    );
                    $new_air = array(
                        'sensor' => 2,
                        'min' => intval($_POST['min-2']) ?? null,
                        'mid' => intval($_POST['mid-2']) ?? null,
                        'max' => intval($_POST['max-2']) ?? null,
                    );
                    $new_sound = array(
                        'sensor' => 3,
                        'min' => intval($_POST['min-3']) ?? null,
                        'mid' => intval($_POST['mid-3']) ?? null,
                        'max' => intval($_POST['max-3']) ?? null,
                    );
                    $new_battery = array(
                        'sensor' => 4,
                        'min' => intval($_POST['min-4']) ?? null,
                        'mid' => intval($_POST['mid-4']) ?? null,
                        'max' => intval($_POST['max-4']) ?? null,
                    );
                    $values = array($new_heart, $new_air, $new_sound, $new_battery);
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


