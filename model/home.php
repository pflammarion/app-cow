<?php

function getCows(): array
{
    $id = $_SESSION['user'];
    $sql_first_cow = "SELECT cow.Cow_Id, cow.Cow_Name, max(alert.Alert_Type_Id) as level
                        FROM alert
                        LEFT JOIN chip_level ON chip_level.Chip_Level_Id = alert.Chip_Level_Id
                        LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
                        LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
                        WHERE chip_cow_user.User_Id =:id AND alert.Alert_Status = 1
                        GROUP BY cow.Cow_Id HAVING max(alert.Alert_Type_Id)
                        ORDER BY level DESC;";
    $query_first_cow = $GLOBALS['db']->prepare($sql_first_cow);
    $query_first_cow->execute(array('id'=>$id));
    $rows = $query_first_cow->fetchAll();
    $cow = [];
    foreach ($rows as $row){
        $cow[] = array(
            'id' => $row['Cow_Id'],
            'name' => $row['Cow_Name'],
            'level' => $row['level'],
        );
    }
    return $cow;
}

