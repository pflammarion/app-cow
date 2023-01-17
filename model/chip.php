<?php
function createChip(array $values): bool
{
    $user = intval($_SESSION['user']);
    $number = htmlspecialchars($values["number"]);
    if ($number !== ""){
        $create_chip_sql = "INSERT INTO chip (Chip_Number) VALUES (:number);
INSERT INTO chip_cow_user (Chip_Id, User_Id) VALUES ((SELECT Chip_Id FROM chip WHERE Chip_Number = :number AND Chip_Id = last_insert_id()),:userId);
INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES ((SELECT Chip_Id FROM chip WHERE Chip_Number = :number AND Chip_Id = last_insert_id()), 60, 20, 40, 1);
INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES ((SELECT Chip_Id FROM chip WHERE Chip_Number = :number AND Chip_Id = last_insert_id()), 100, 10, 20, 2);
INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES ((SELECT Chip_Id FROM chip WHERE Chip_Number = :number AND Chip_Id = last_insert_id()), 60, 20, 40, 3);
INSERT INTO chip_level (Chip_Id, Chip_Reference, Chip_First_Level, Chip_Second_Level, Sensor_Id) VALUES ((SELECT Chip_Id FROM chip WHERE Chip_Number = :number AND Chip_Id = last_insert_id()), 100, 50, 75, 4);
";
        $create_chip_query = $GLOBALS['db']-> prepare($create_chip_sql);
        $create_chip_query->execute(
            array(
                "userId"=> $user,
                "number"=> $number,
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
    $sql_get_chip = "SELECT c.Cow_Name ,chip.Chip_Number, chip.Chip_Id
                    FROM chip 
                    left join chip_cow_user ccu on chip.Chip_Id = ccu.Chip_Id
                    left join cow c on c.Cow_Id = ccu.Cow_Id
                    WHERE ccu.User_Id =:user 
                    ORDER BY Chip_Number;";

    $query_get_chip = $GLOBALS['db']->prepare($sql_get_chip);
    $query_get_chip->execute(array('user'=> $user));
    $rows = $query_get_chip->fetchAll();
    foreach ($rows as $row){
        $tmp[]= array(
            'number' => $row['Chip_Number'],
            'id' => $row['Chip_Id'],
            'cow' => $row['Cow_Name'] ?? null,
        );
    }
    return $tmp;
}

function getAvailableChip(): array
{
    $tmp = [];
    $user = $_SESSION['user'];
    $sql_get_chip = "SELECT chip.Chip_Number, chip.Chip_Id
                    FROM chip 
                    left join chip_cow_user ccu on chip.Chip_Id = ccu.Chip_Id
                    WHERE ccu.User_Id =:user AND ccu.Cow_Id IS NULL
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

function linkChip(int $chip, int $cow): bool
{
    $update_user_sql = "UPDATE chip_cow_user SET Cow_Id =:cow WHERE User_Id=:id AND Chip_Id = :chip AND Cow_Id IS NULL;
                        DELETE FROM chip_cow_user WHERE Chip_Id IS NULL AND User_Id = :user AND Cow_Id = :cow";
    $update_user_query = $GLOBALS['db']-> prepare($update_user_sql);
    $update_user_query->execute(
        array(
            "chip" => $chip,
            "cow" => $cow,
        )
    );
    return true;
}
