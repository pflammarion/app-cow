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
    $sql_get_cow = "SELECT cow.Cow_Number, cow.Cow_Img_Url, cow.Cow_Name, cow.Cow_Id
                    FROM cow 
                    left join chip_cow_user ccu on cow.Cow_Id = ccu.Cow_Id
                    WHERE cow.Cow_Id =:id AND ccu.User_Id =:user ;";

    $query_get_cow = $GLOBALS['db']->prepare($sql_get_cow);
    $query_get_cow->execute(array('id'=>$id, 'user'=> $user));
    $row = $query_get_cow->fetch();
    if ($query_get_cow->rowcount() === 1){
        return array(
            'id' => $row['Cow_Id'],
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
    $sql_get_alert="SELECT alert.Alert_Id, alert.Alert_message,alert.Alert_Status, alert.Alert_Type_Id, alert.Alert_Date
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
            'id' => $row['Alert_Id'],
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
                        LEFT JOIN chip_cow_user ccu on chip_level.Chip_Id = ccu.Chip_Id
                        WHERE chip_level.Chip_Id =:chip AND ccu.User_Id = :user";
    $query_get_level =  $GLOBALS['db']->prepare($sql_get_level);
    $query_get_level->execute(array('chip'=>$chip_id, 'user'=>$user));
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

function getTableData(int $average, string $date_start, string $date_end, int $sensor, int $cow): array
{
    $data = [];
    $user = $_SESSION['user'];
    $sql_get_table = "
SELECT data_sensor.Value,data_sensor.Date, cow.Cow_Name
FROM data_sensor
         LEFT JOIN chip_level ON chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
         LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
         LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
WHERE cow.Cow_Id = :cow
  AND chip_cow_user.User_Id = :user
  AND chip_level.Sensor_Id = :sensor
  AND data_sensor.Average_Id = :average
  AND data_sensor.Date BETWEEN :dateStart and :dateEnd;
";
    $query_get_table =  $GLOBALS['db']->prepare($sql_get_table);
    $query_get_table->execute(
        array('cow'=>$cow,
            'user'=>$user,
            'sensor'=>$sensor,
            'average'=>$average,
            'dateStart'=>$date_start,
            'dateEnd'=>$date_end,
            ));
    $rows = $query_get_table->fetchAll();
    foreach ($rows as $row){
        $data[] = array(
            'name' => $row['Cow_Name'],
            'value' => $row['Value'],
            'date' => $row['Date'],
        );
    }
    $sql_get_herd_table = "";
    //herd year
    if ($average === 3){
        $sql_get_herd_table = "
SELECT (MONTH(data_sensor.Date) - 1) DIV 2 + 1 as ind, AVG(data_sensor.Value) as val
FROM data_sensor
         LEFT JOIN chip_level ON chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
         LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
         LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
WHERE cow.Cow_Id != :cow
  AND chip_cow_user.User_Id = :user
  AND chip_level.Sensor_Id = :sensor
  AND data_sensor.Average_Id = :average
  AND data_sensor.Date BETWEEN :dateStart and :dateEnd
GROUP BY ind;
";
    }

    if ($average ===2) {
        $sql_get_herd_table = "
SELECT AVG(data_sensor.Value) as val, day(data_sensor.Date) as ind
FROM data_sensor
         LEFT JOIN chip_level ON chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
         LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
         LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
WHERE cow.Cow_Id != :cow
  AND chip_cow_user.User_Id = :user
  AND chip_level.Sensor_Id = :sensor
  AND data_sensor.Average_Id = :average
  AND data_sensor.Date BETWEEN :dateStart and :dateEnd
GROUP BY ind;
";
    }
    if ($average === 1){
        $sql_get_herd_table = "

SELECT
    FROM_UNIXTIME(UNIX_TIMESTAMP(:dateStart) + (ref* 4*60*60)) as ind,
    AVG(data) as val
FROM (
SELECT
       FLOOR((UNIX_TIMESTAMP(data_sensor.Date) - UNIX_TIMESTAMP(:dateStart)) / (4 * 60 * 60)) as ref,
       data_sensor.Value as data
FROM
    data_sensor
        LEFT JOIN chip_level ON chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
        LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
        LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
WHERE cow.Cow_Id != :cow
  AND chip_cow_user.User_Id = :user
  AND chip_level.Sensor_Id = :sensor
  AND data_sensor.Average_Id = :average
  AND data_sensor.Date BETWEEN :dateStart and :dateEnd
          ) t
GROUP BY
    ref;
";
    }

    $query_get_herd_table =  $GLOBALS['db']->prepare($sql_get_herd_table);
    $query_get_herd_table->execute(
        array('cow'=>$cow,
            'user'=>$user,
            'sensor'=>$sensor,
            'average'=>$average,
            'dateStart'=>$date_start,
            'dateEnd'=>$date_end,
        ));
    $rows = $query_get_herd_table->fetchAll();
    foreach ($rows as $row){
        $data[] = array(
            'name' => "herd",
            'value' => $row['val'],
            'key' => $row['ind'],
        );
    }
    return $data;
}

function deleteAlertOnClick(int $id): bool
{
        $update_faq_sql = "UPDATE alert
                            LEFT JOIN chip_level cl on cl.Chip_Level_Id = alert.Chip_Level_Id
                            LEFT JOIN chip_cow_user ccu on cl.Chip_Id = ccu.Chip_Id
                            SET Alert_Status = 0 
                            WHERE Alert_Status = 1 AND Alert_Id = :id AND ccu.User_Id = :user";
        $update_faq_query = $GLOBALS['db']-> prepare($update_faq_sql);
        $update_faq_query->execute(
            array(
                "id"=> $id,
                "user"=> intval($_SESSION['user']),
            )
        );
        return true;
}

function getDownloadableData(int $id = null): array
{
    $data = [];
    if (isset($id)){
        $sql = 'SELECT Date, Value, s.Sensor_Name as sensor, c.Cow_Name as name, c.Cow_Number as number
            FROM data_sensor
            LEFT JOIN chip_level cl on cl.Chip_Level_Id = data_sensor.Chip_Level_Id
            LEFT JOIN sensor s on s.Sensor_Id = cl.Sensor_Id
            LEFT JOIN chip_cow_user ccu on cl.Chip_Id = ccu.Chip_Id
            LEFT JOIN cow c on ccu.Cow_Id = c.Cow_Id
            WHERE User_Id =:user AND ccu.Cow_Id =:cow AND Coef = 1
            ORDER BY name, number, sensor, Date';
    }
    else{
        $sql = 'SELECT Date, Value, s.Sensor_Name as sensor, c.Cow_Name as name, c.Cow_Number as number
            FROM data_sensor
            LEFT JOIN chip_level cl on cl.Chip_Level_Id = data_sensor.Chip_Level_Id
            LEFT JOIN sensor s on s.Sensor_Id = cl.Sensor_Id
            LEFT JOIN chip_cow_user ccu on cl.Chip_Id = ccu.Chip_Id
            LEFT JOIN cow c on ccu.Cow_Id = c.Cow_Id
            WHERE User_Id =:user AND Coef = 1
            ORDER BY name, number, sensor, Date';
    }
    $query =  $GLOBALS['db']->prepare($sql);
    if (isset($id)){
    $query->execute(
        array(
            'cow'=> $id ,
            'user'=> intval($_SESSION['user']),
        ));
    }
    else{
        $query->execute(
            array(
                'user'=> intval($_SESSION['user']),
            ));
    }
    $rows = $query->fetchAll();
    foreach ($rows as $row){
        $data[] = array(
            'name' => $row['name'],
            'number' => $row['number'],
            'sensor' => $row['sensor'],
            'value' => $row['Value'],
            'date' => $row['Date'],
        );
    }
    return $data;

}