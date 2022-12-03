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
    $sql_heart_sensor_cow = "
        SELECT  data_sensor.Value, chip_level.Low_Level, chip_level.Mid_Level, chip_level.High_Level
        FROM data_sensor
        left join chip_level on chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
        left join chip_cow_user ccu on chip_level.Chip_Id = ccu.Chip_Id
        WHERE ccu.Cow_Id =:cow AND chip_level.Sensor_Id =:sensor
        ORDER BY data_sensor.DATE DESC LIMIT 1;
    ";

    $query_heart_sensor_cow = $GLOBALS['db']->prepare($sql_heart_sensor_cow);
    $query_heart_sensor_cow->execute(array('cow'=>$cow, 'sensor'=>$sensor));
    $row = $query_heart_sensor_cow->fetch();
    if ($query_heart_sensor_cow->rowcount() === 1){
        return array(
            'value' => $row['Value'],
            'low' => $row['Low_Level'],
            'mid' => $row['Mid_Level'],
            'high' => $row['High_Level'],
        );
    }
    return [];
}

function getCow(int $id): array
{
    $sql_get_cow = "SELECT cow.Cow_Number, cow.Cow_Img_Url, cow.Cow_Name 
                    FROM cow 
                    WHERE cow.Cow_Id =:id;";

    $query_get_cow = $GLOBALS['db']->prepare($sql_get_cow);
    $query_get_cow->execute(array('id'=>$id));
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
