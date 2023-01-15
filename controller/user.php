<?php

require __DIR__ . '/../model/permission.php';
require __DIR__ . '/../model/home.php';
require __DIR__ . '/../model/cow.php';
require __DIR__ . '/../model/chip.php';

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
            $content = getAllChip();
            if (isset($_POST['action'])) {
                if ($_POST['action'] === 'create') {
                    $number = htmlspecialchars($_POST['number']);
                    $values = array(
                        "number" => $_POST['number'],
                    );
                    $success = createChip($values);
                    if ($success ){
                        $url = "Location: user?page=boitier&action=view&success=Le boitier " . $number . " à été ajouté à votre compte";
                        header($url);
                        exit();
                    }else{
                        header("Location: user?page=boitier&action=create&error=Une erreur s'est produite veuillez rééssayer");
                        exit();
                    }
                }
                if ($_POST['action'] === 'delete' && isset($_POST['chipId'], $_POST['number'])) {
                    $number = htmlspecialchars($_POST['number']);
                    $success = deleteChip(intval($_POST['chipId']));
                    if ($success ){
                        $url = "Location: user?page=boitier&action=view&success=Le boitier " .$number. " à été supprimée";
                        header($url);
                        exit();
                    }
                }
                if ($_POST['action'] === 'update' && isset($_POST['chipId'], $_POST['number'])) {
                    $values = array(
                        "number" => $_POST['number'],
                        "id" => $_POST['chipId'],
                    );
                    $success = updateChip($values);
                    if ($success ){
                        $url = "Location: user?page=boitier&action=view&success=Le boitier " .$number. " à été modifiée";
                        header($url);
                        exit();
                    }
                }
            }
            break;

        case 'vache':
            $view = "user/cow/". $action;
            $content = getAllCow();
            if (isset($_POST['action'])) {
                if ($_POST['action'] === 'create') {
                    $name = htmlspecialchars($_POST['name']);
                    $values = array(
                        "name" => $_POST['name'],
                        "number" => $_POST['number'],
                    );
                    $success = createCow($values);
                    if ($success ){
                        $url = "Location: user?page=vache&action=view&success=La vache " . $name . " à été ajouté à votre compte";
                        header($url);
                        exit();
                    }else{
                        header("Location: user?page=vache&action=create&error=Une erreur s'est produite veuillez rééssayer");
                        exit();
                    }
                }
                if ($_POST['action'] === 'delete' && isset($_POST['cowId'], $_POST['name'])) {
                    $name = htmlspecialchars($_POST['name']);
                    $success = deleteCow(intval($_POST['cowId']));
                    if ($success ){
                        $url = "Location: user?page=vache&action=view&success=La vache " .$name. " à été supprimée";
                        header($url);
                        exit();
                    }
                }
                if ($_POST['action'] === 'update') {
                    $values = array(
                        "name" => $_POST['name'],
                        "number" => $_POST['number'],
                        "id" => $_POST['cowId'],
                    );
                    $success = updateCow($values);
                    if ($success ){
                        $url = "Location: user?page=vache&action=view&success=La vache " .$name. " à été modifiée";
                        header($url);
                        exit();
                    }
                }
            }
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


