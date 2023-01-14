<?php

require __DIR__ . '/../model/home.php';
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
                if (isset($_GET['js'], $_GET['alertId'])){
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
            break;

        case 'vache':

            $view = "user/cow/". $action;
            break;

        case 'tableau':
            if (isset($_GET['sensor'])){
                $sensor= intval(htmlspecialchars($_GET['sensor']));
                if(isset($_GET['js'], $_GET['average'], $_GET['date'], $_GET['cowId'])){
                    $average = intval($_GET['average']);
                    $cowId = intval($_GET['cowId']);
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
            if (isset($_GET['js'], $_GET['herd'])){
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
            if (isset($_GET['exel'], $_GET['js'])){
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
    if(!isset($_GET['js'])){
        include (showPage($view));
    }
}
else{
    echo('<script>alert("Vous n\'avez pas la permission d\'accéder à cette page")</script>');
}


