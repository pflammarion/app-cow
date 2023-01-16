<?php
function createChip(array $values): bool
{
    $user = intval($_SESSION['user']);
    $number = htmlspecialchars($values["number"]);
    if ($number !== ""){
        $create_chip_sql = "INSERT INTO chip (Chip_Number) VALUES (:number);
                            INSERT INTO chip_cow_user (Chip_Id, User_Id) VALUES ((SELECT Chip_Id FROM chip WHERE Chip_Number = :number),:userId);
                            SELECT Cow_Id,:userId FROM cow WHERE Cow_Id = last_insert_id()";
        $create_chip_query = $GLOBALS['db']-> prepare($create_chip_sql);
        $create_chip_query->execute(
            array(
                "userId"=> $user,
                "number"=> $number,
            )
        );
        $create_chip_lvl_sql = "INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES (:id, 60, 20, 40, 1);
                                INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES (:id, 100, 10, 20, 2);
                                INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES (:id, 60, 20, 40, 3);
                                INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES (:id, 100, 50, 75, 4);
                                SELECT Chip_Id,:userId FROM chip WHERE Chip_Id = last_insert_id()";
        $create_chip_lvl_query = $GLOBALS['db']-> prepare($create_chip_lvl_sql);
        $create_chip_lvl_query->execute(
            array(
                "chipId" => $id,
            )
        );
        return true;
    }
    return false;
}
function updateChip(array $values): bool
{
    $number = htmlspecialchars($values["number"]);
    $id = intval($values["id"]);
    if ($number !== ""){
        $update_chip_sql = "UPDATE chip SET Chip_Number=:number  WHERE Chip_Id=:id";
        $update_chip_query = $GLOBALS['db']-> prepare($update_chip_sql);
        $update_chip_query->execute(
            array(
                "number"=> $number,
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}
function deleteChip(int $id): bool
{
    if ($id){
        $delete_chip_sql = "DELETE FROM chip WHERE Chip_Id = :id;";
        $delete_chip_query = $GLOBALS['db']-> prepare($delete_chip_sql);
        $delete_chip_query->execute(
            array(
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}
function getAllChip(): array
{
    $tmp = [];
    $user = $_SESSION['user'];
    $sql_get_chip = "SELECT chip.Chip_Number, chip.Chip_Id
                    FROM chip 
                    left join chip_cow_user ccu on chip.Chip_Id = ccu.Chip_Id
                    WHERE ccu.User_Id =:user 
                    ORDER BY Chip_Number;";

    $query_get_chip = $GLOBALS['db']->prepare($sql_get_chip);
    $query_get_chip->execute(array('user'=> $user));
    $rows = $query_get_chip->fetchAll();
    foreach ($rows as $row){
        $tmp[]= array(
            'number' => $row['Chip_Number'],
            'id' => $row['Chip_Id'],
        );
    }
    return $tmp;
}
