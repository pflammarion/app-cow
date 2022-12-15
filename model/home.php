<?php

function getCowsNonViewedAlert(): int
{
    $id = $_SESSION['user'];
    $sql_first_cow = "  SELECT cow.Cow_Id
                        FROM alert
                        LEFT JOIN chip_level ON chip_level.Chip_Level_Id = alert.Chip_Level_Id
                        LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
                        LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
                        WHERE chip_cow_user.User_Id =:id AND alert.Alert_Status = 1
                        GROUP BY cow.Cow_Id HAVING max(alert.Alert_Type_Id)
                        ORDER BY max(alert.Alert_Type_Id) DESC LIMIT 1;";

    $query_first_cow = $GLOBALS['db']->prepare($sql_first_cow);
    $query_first_cow->execute(array('id'=>$id));
    $row = $query_first_cow->fetch();
    if ($query_first_cow->rowcount() === 1){
        return $row['Cow_Id'];
    }
    return 0;
}

function getSensorValueByCowBySensor(int $cow, int $sensor): array
{
    $user = $_SESSION['user'];
    $sql_heart_sensor_cow = "
        SELECT  data_sensor.Value, chip_level.Chip_Reference, chip_level.Chip_First_Level, chip_level.Chip_Second_Level, data_sensor.Date
        FROM data_sensor
        left join chip_level on chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
        left join chip_cow_user ccu on chip_level.Chip_Id = ccu.Chip_Id
        WHERE ccu.Cow_Id =:cow AND chip_level.Sensor_Id =:sensor AND User_Id =:user
        ORDER BY data_sensor.Date DESC LIMIT 1;
    ";

    $query_heart_sensor_cow = $GLOBALS['db']->prepare($sql_heart_sensor_cow);
    $query_heart_sensor_cow->execute(array('cow'=>$cow, 'sensor'=>$sensor, 'user'=> $user));
    $row = $query_heart_sensor_cow->fetch();
    if ($query_heart_sensor_cow->rowcount() === 1){
        return array(
            'value' => $row['Value'],
            'date'=> $row['Date'],
            'reference' => $row['Chip_Reference'],
            'firstLevel' => $row['Chip_First_Level'],
            'secondLevel' => $row['Chip_Second_Level'],
        );
    }
    return [];
}

function getCow(int $id): array
{
    $user = $_SESSION['user'];
    $sql_get_cow = "SELECT cow.Cow_Number, cow.Cow_Img_Url, cow.Cow_Name 
                    FROM cow 
                    left join chip_cow_user ccu on cow.Cow_Id = ccu.Cow_Id
                    WHERE cow.Cow_Id =:id AND ccu.User_Id =:user ;";

    $query_get_cow = $GLOBALS['db']->prepare($sql_get_cow);
    $query_get_cow->execute(array('id'=>$id, 'user'=> $user));
    $row = $query_get_cow->fetch();
    if ($query_get_cow->rowcount() === 1){
        return array(
            'number' => $row['Cow_Number'],
            'img' => $row['Cow_Img_Url'],
            'name' => $row['Cow_Name'],
        );
    }
    return [];
}

function getAlertByCow(int $id): array
{
    $user = $_SESSION['user'];
    $sql_get_alert="SELECT alert.Alert_message,alert.Alert_Status, alert.Alert_Type_Id, alert.Alert_Date
                    FROM alert
                    left join chip_level on chip_level.Chip_Level_Id = alert.Chip_Level_Id
                    left join chip_cow_user on chip_cow_user.Chip_Id = chip_level.Chip_Id
                    left join cow on cow.Cow_Id = chip_cow_user.Cow_Id
                    WHERE cow.Cow_Id =:id AND chip_cow_user.User_Id =:user
                    ORDER BY Alert_Status DESC , Alert_Date DESC;
    ";
    $query_get_alert = $GLOBALS['db']->prepare($sql_get_alert);
    $query_get_alert->execute(array('id'=>$id, 'user'=> $user));
    $rows = $query_get_alert->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'message'=>$row['Alert_message'],
            'status'=>$row['Alert_Status'],
            'type'=>$row['Alert_Type_Id'],
            'date'=>$row['Alert_Date'],
        );
    }
    return $result;
}

function getAllCowAlert(): array
{
    $user = $_SESSION['user'];
    $sql_get_all_cow_alert="
                SELECT cow.Cow_Name, cow.Cow_Id, max(alert.Alert_Type_Id) as level
                FROM alert
                left join chip_level on chip_level.Chip_Level_Id = alert.Chip_Level_Id
                left join chip_cow_user on chip_cow_user.Chip_Id = chip_level.Chip_Id
                left join cow on cow.Cow_Id = chip_cow_user.Cow_Id
                WHERE chip_cow_user.User_Id =:user AND alert.Alert_Status = 1
                GROUP BY cow.Cow_Name, cow.Cow_Id HAVING max(alert.Alert_Type_Id)
                ORDER BY level DESC;
    ";
    $query_get_all_cow_alert = $GLOBALS['db']->prepare($sql_get_all_cow_alert);
    $query_get_all_cow_alert->execute(array('user'=>$user));
    $rows = $query_get_all_cow_alert->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'id'=>$row['Cow_Id'],
            'name'=>$row['Cow_Name'],
            'level'=>$row['level'],
        );
    }
    return $result;
}

function getAllCowNoAlert(): array
{
    $user = $_SESSION['user'];
    $sql_get_all_cow="
                SELECT cow.Cow_Name, cow.Cow_Id
                FROM cow
                left join chip_cow_user on cow.Cow_Id = chip_cow_user.Cow_Id
                WHERE chip_cow_user.User_Id =:user
                ORDER BY Cow_Name;
    ";
    $query_get_all_cow = $GLOBALS['db']->prepare($sql_get_all_cow);
    $query_get_all_cow->execute(array('user'=>$user));
    $rows = $query_get_all_cow->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'id'=>$row['Cow_Id'],
            'name'=>$row['Cow_Name'],
        );
    }
    return $result;
}

function getChip (int $cow): int
{
    $user = $_SESSION['user'];
    $sql_get_chip="
                SELECT chip_cow_user.Chip_Id
                FROM chip_cow_user
                WHERE chip_cow_user.Cow_Id =:cow AND chip_cow_user.User_Id =:user;
    ";
    $query_get_chip = $GLOBALS['db']->prepare($sql_get_chip);
    $query_get_chip->execute(array('cow'=>$cow, "user"=>$user));
    $row = $query_get_chip->fetch();
    if ($query_get_chip->rowcount() === 1){
        return $row['Chip_Id'];
    }
    return 0;
}

function getLevelByChip(int $chip_id): array
{
    $user = $_SESSION['user'];
    $sql_get_level = "SELECT chip_level.Chip_Second_Level, chip_level.Chip_First_Level, chip_level.Chip_Reference, chip_level.Sensor_Id
                        FROM chip_level 
                        WHERE chip_level.Chip_Id =:chip";
    $query_get_level =  $GLOBALS['db']->prepare($sql_get_level);
    $query_get_level->execute(array('chip'=>$chip_id));
    $rows = $query_get_level->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'reference' => $row['Chip_Reference'],
            'firstLevel' => $row['Chip_First_Level'],
            'secondLevel' => $row['Chip_Second_Level'],
            'sensor'=>$row['Sensor_Id'],
        );
    }
    return $result;
}

function changeLevel(int $chipId, array $datas): bool
{
    foreach ($datas as $data){
        $update_level_sql = "UPDATE chip_level 
                                SET Chip_Reference = :reference, Chip_First_Level = :firstLevel, Chip_Second_Level = :secondLevel 
                                WHERE Sensor_Id = :sensor AND Chip_Id =:chipId";
        $update_level_query = $GLOBALS['db']->prepare($update_level_sql);
        $update_level_query->execute(
            array(
                "chipId" => $chipId,
                "sensor"=> $data['sensor'],
                'reference' => $data['reference'],
                'firstLevel' => $data['firstLevel'],
                'secondLevel' => $data['secondLevel'],

            ));
    }
    return true;
}
