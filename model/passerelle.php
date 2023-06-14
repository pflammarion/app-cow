<?php

// 1. Récupérer les données brutes
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL,"http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=0011");
//curl_setopt($ch, CURLOPT_HEADER, FALSE);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//$data = curl_exec($ch);
//curl_close($ch);

function addDataFromGateway(string $trame) : bool
{

    $values = sscanf($trame, "%1d%4s%1s%1s%2x%4x%4s%2s%4d%2d%2d%2d%2d%2d");
    list($t, $o, $r, $capteur, $n, $value, $a, $x, $year, $month, $day, $hour, $min, $sec) = $values;

    $dateString = sprintf("%s-%s-%s %s:%s:%s", $year, $month, $day, $hour, $min, $sec);
    print_r($dateString);
    $datetime = DateTime::createFromFormat("Y-m-d H:i:s", $dateString);
    print_r($datetime);

    $get_value_sql = "SELECT log_id FROM log WHERE log_capteur = :capteur AND log_date = :date";
    $get_value_sql = $GLOBALS['db']->prepare($get_value_sql);
    $get_value_sql->execute(
        array(
            "date" => $datetime->format("Y-m-d H:i:s"),
            "capteur" => $capteur,
        )
    );

    if ($get_value_sql->rowCount() === 0) {
        $add_value_sql = "INSERT INTO log (log_capteur, log_valeur, log_date) VALUES (:capteur, :valeur, :date)";
        $add_value_sql = $GLOBALS['db']-> prepare($add_value_sql);
        $add_value_sql->execute(
            array(
                "capteur" => $capteur,
                "valeur"=> $value,
                "date"=> $datetime->format("Y-m-d H:i:s"),
            )
        );
        return true;
    }
    else return false;

}

function getTrameFromDatabase(): array
{
    $get_value_sql = "SELECT * FROM log";
    $get_value_sql = $GLOBALS['db']-> prepare($get_value_sql);
    $rows = $get_value_sql->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'log_capteur'=> $row['log_capteur'],
            'log_valeur'=>$row['log_valeur'],
            'log_date'=>$row['log_date'],
        );
    }
    return $result;

}
