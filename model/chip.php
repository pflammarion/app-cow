<?php
function createChip(array $values): bool
{
    $user = intval($_SESSION['user']);
    $number = htmlspecialchars($values["number"]);
    if ($number !== ""){
        $create_chip_sql = "INSERT INTO chip (Chip_Number) VALUES (:number);
                           INSERT INTO chip_cow_user (Chip_Id, User_Id)
                           SELECT Cow_Id,:user FROM cow WHERE Cow_Id = last_insert_id()";
        $create_chip_query = $GLOBALS['db']-> prepare($create_chip_sql);
        $create_chip_query->execute(
            array(
                "user"=> $user,
                "number"=> $number,
            )
        );
        return true;
    }
    return false;
}
function updateChip(array $values): bool
{
    $name = $values["name"];
    $number = $values["number"];
    $id = $values["id"];
    if ($number !== "" && $id !== ""){
        $update_chip_sql = "UPDATE chip SET Chip_Number=:number WHERE Chip_Id=:id";
        $update_chip_query = $GLOBALS['db']-> prepare($update_chip_sql);
        $update_chip_query->execute(
            array(
                "number"=> $number,
                "id"=> $id,
            )
        );
        $update_chip_cow_user_sql = "UPDATE chip_cow_user RIGHT JOIN chip ON chip_cow_user.Cow_Id WHERE Chip_Id =:id";
        $update_chip_cow_user_query = $GLOBALS['db']-> prepare($update_chip_cow_user_sql);
        $update_chip_cow_user_query->execute(
            array(
                "name"=> $name,
                "id"=> $id,
            )
        );
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
                    WHERE ccu.User_Id =:user ;";

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