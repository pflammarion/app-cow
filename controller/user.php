<?php

require __DIR__ . '/../model/home.php';
require __DIR__ . '/../model/cow.php';
require __DIR__ . '/../model/chip.php';
require __DIR__ . '/../model/function.php';

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
                if (isset($_GET['api'], $_GET['alertId'])){
                    deleteAlertOnClick(intval($_GET['alertId']));
                    echo json_encode(['success']);
                }
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
            if (isset($_POST['action'], $_POST['number'])) {
                $number = htmlspecialchars($_POST['number']);
                if(strlen($number) <= 10) {
                    $number = strtoupper($number);
                    if ($_POST['action'] === 'create') {
                        $values = array(
                            "number" => $number,
                        );
                        $success = createChip($values);
                        if ($success) {
                            $url = "Location: user?page=boitier&action=view&success=Le boitier " . urlencode($number) . " à été ajouté à votre compte";
                            header($url);
                        } else {
                            header("Location: user?page=boitier&action=create&error=Une erreur s'est produite veuillez rééssayer");
                        }
                        exit();
                    }
                    if ($_POST['action'] === 'delete' && isset($_POST['chipId'])) {
                        $success = deleteChip(intval($_POST['chipId']));
                        if ($success) {
                            $url = "Location: user?page=boitier&action=view&success=Le boitier " . urlencode($number) . " à été supprimée";
                            header($url);
                            exit();
                        }
                    }
                    if ($_POST['action'] === 'update' && isset($_POST['chipId'])) {
                        $values = array(
                            "number" => $number,
                            "id" => intval($_POST['chipId']),
                        );
                        $success = updateChip($values);
                        if ($success) {
                            $url = "Location: user?page=boitier&action=view&success=Le boitier " . urlencode($number) . " à été modifiée";
                            header($url);
                            exit();
                        }
                    }
                }
                else{
                    $url = "Location: user?page=boitier&error=Le numéro de boitier n'existe pas";
                    header($url);
                    exit();
                }
            }
            break;

        case 'vache':
            $view = "user/cow/". $action;
            $content = getAllCow();
            if (isset($_POST['action'])) {
                if ($_POST['action'] === 'create' && isset($_POST['name'], $_POST['number'])) {
                    $name = htmlspecialchars($_POST['name']);
                    $values = array(
                        "name" => $name,
                        "number" => htmlentities(strtoupper($_POST['number'])),
                    );
                    $success = createCow($values);
                    if ($success ){
                        $url = "Location: user?page=vache&action=view&success=La vache " . urlencode($name) . " a été ajouté à votre compte";
                        header($url);
                    }else{
                        header("Location: user?page=vache&action=create&error=Une erreur s'est produite veuillez réessayer");
                    }
                    exit();
                }
                if ($_POST['action'] === 'delete' && isset($_POST['cowId'], $_POST['name'])) {
                    $name = htmlspecialchars($_POST['name']);
                    $success = deleteCow(intval($_POST['cowId']));
                    if ($success ){
                        $url = "Location: user?page=vache&action=view&success=La vache " . urlencode($name). " à été supprimée";
                        header($url);
                        exit();
                    }
                }
                if ($_POST['action'] === 'update' && isset($_POST['name'], $_POST['cowId'], $_POST['number'])) {
                    $name = htmlspecialchars($_POST['name']);
                    $values = array(
                        "name" => $name,
                        "number" => htmlentities(strtoupper($_POST['number'])),
                        "id" => intval($_POST['cowId']),
                    );

                    $update = updateCow($values);
                    if(isset($_POST['delete-img'], $_POST['cowId'])){
                        $update = removeImage('cow', intval($_POST['cowId']));
                    }
                    if (isset( $_FILES["file"] ) && !empty( $_FILES["file"]["name"] ) && $update){
                        $filename   = uniqid() . "-" . time();
                        $extension  = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION );
                        $basename   = $filename . "." . $extension;
                        $source       = $_FILES["file"]["tmp_name"];
                        $destination  = "./uploads/{$basename}";
                        $upload = True;
                        if($extension != "jpg" && $extension != "png" && $extension!= "jpeg") {
                            $upload = False;
                            $update= False;
                        }
                        if ($_FILES["file"]["size"] > 5000000) {
                            $upload = False;
                            $update= False;
                        }
                        if($upload){
                            $update = updateImage("cow", $destination, intval($_POST['cowId']));
                            if ($update){
                                move_uploaded_file( $source, $destination );
                                $url = "Location: user?page=vache&action=view&success=La vache " .urlencode($name). " à été modifiée";
                            }
                            else{
                                $url = "Location: user?page=vache&action=update&error=Une erreur s'est produite pendant la modification";
                            }
                        }
                        else{
                            $url = "Location: user?page=vache&action=update&error=L'extension ou la taille de l'image ne sont pas conformes";
                        }
                        header($url);
                        exit();
                    }
                    if ($update) {
                        header("Location: user?page=vache&success=La vache  " . urlencode($name) . " a bien été mise à jour");
                        exit();
                    }
                }
            }
            break;

        case 'tableau':
            if (isset($_GET['sensor'])){
                $sensor= intval(htmlspecialchars($_GET['sensor']));
                if(isset($_GET['api'], $_GET['average'], $_GET['date'], $_GET['cowId'])){
                    $average = intval($_GET['average']);
                    $cowId = intval(verifyInt($_GET['cowId']));
                    //filter data from get
                    $date = strtotime($_GET['date']);
                    //for annual
                    if ($average === 3){
                        $year = intval(date('Y', $date));
                        $date_start = $year . '-02-01';
                        $date_end = $year + 1 . '-01-31';
                    }
                    //journalier
                    if ($average ===2){
                        $date_start =  date(('Y-m-d'), strtotime('-2 days', $date));
                        $date_end =  date(('Y-m-d'), strtotime('+4 days', $date));

                    }
                    if ($average===1){
                        $date_start =  date(('Y-m-d'), $date) . ' 03:00:00';
                        $date_end =  date(('Y-m-d'), strtotime('+1 days', $date)) . ' 02:59:59';
                    }
                    $data = getTableData($average, $date_start, $date_end, $sensor, $cowId);
                    echo json_encode($data);
                }
                $view = "user/table";
            }
            if (isset($_GET['api'], $_GET['herd'])){
                $data = dataSorting(getAllCows());
                if (isset($_GET['recherche'])){
                    $data = recherche($data, $_GET['recherche']);
                }
                echo json_encode($data);
            }
            if (isset($_GET['selectedCow'])){
                $data = getCow(intval($_GET['selectedCow']));
                echo json_encode($data);
            }
            if (isset($_GET['exel'], $_GET['api'])){
                $cowExel = null;
                if (isset($_GET['cowId'])){
                    $cowExel = intval($_GET['cowId']);
                    $cow_attr = getCow($cowExel);
                    header('Content-Disposition: attachment;filename="' . $cow_attr['name'] .'_N_' . $cow_attr['number'] .'.xls"');
                }
                else header('Content-Disposition: attachment;filename="troupeau.xls"');
                $data = getDownloadableData($cowExel);
                header('Content-Type: application/vnd.ms-excel');
                header('Cache-Control: max-age=0');
                echo '<table>';
                foreach ($data as $row) {
                    echo '<tr>';
                    foreach ($row as $cell) {
                        echo '<td>' . $cell . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }


            break;
        default:
            $view = "error404";
    }
    if(!isset($_GET['api'])){
        include (showPage($view));
    }
}
else{
    echo('<script>alert("Vous n\'avez pas la permission d\'accéder à cette page")</script>');
}


