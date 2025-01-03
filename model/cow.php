<?php
function createCow(array $values): bool
{
    $user = intval($_SESSION['user']);
    $name = htmlspecialchars($values["name"]);
    $number = htmlspecialchars($values["number"]);
    if ($name !== "" && $number !== ""){
        $create_cow_sql = "INSERT INTO cow (Cow_Name, Cow_Number) VALUES (:name, :number);
                           INSERT INTO chip_cow_user (Cow_Id, User_Id)
                           SELECT Cow_Id,:user FROM cow WHERE Cow_Id = last_insert_id()";
        $create_cow_query = $GLOBALS['db']-> prepare($create_cow_sql);
        $create_cow_query->execute(
            array(
                "user"=> $user,
                "name"=> $name,
                "number"=> $number,
            )
        );
        return true;
    }
    return false;
}
function updateCow(array $values): bool
{
    $name = $values["name"];
    $number = $values["number"];
    $id = $values["id"];
    if ($name !== "" && $number !== ""){
        $update_cow_sql = "UPDATE cow SET Cow_Name=:name, Cow_Number=:number WHERE Cow_Id=:id";
        $update_cow_query = $GLOBALS['db']-> prepare($update_cow_sql);
        $update_cow_query->execute(
            array(
                "name"=> $name,
                "number"=> $number,
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}
function deleteCow(int $id): bool
{
    if ($id){
        $delete_cow_sql = "DELETE FROM cow WHERE Cow_Id = :id;";
        $delete_cow_query = $GLOBALS['db']-> prepare($delete_cow_sql);
        $delete_cow_query->execute(
            array(
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}
function getAllCow(): array
{
    $tmp = [];
    $user = $_SESSION['user'];
    $sql_get_cow = "SELECT c.Chip_Number, cow.Cow_Number, cow.Cow_Img_Url, cow.Cow_Name, cow.Cow_Id
                    FROM cow 
                    left join chip_cow_user ccu on cow.Cow_Id = ccu.Cow_Id
                    LEFT JOIN chip c on c.Chip_Id = ccu.Chip_Id
                    WHERE ccu.User_Id =:user 
                    ORDER BY Cow_Name;";

    $query_get_cow = $GLOBALS['db']->prepare($sql_get_cow);
    $query_get_cow->execute(array('user'=> $user));
    $rows = $query_get_cow->fetchAll();
    foreach ($rows as $row){
        $tmp[]= array(
            'number' => $row['Cow_Number'],
            'img_cow' => $row['Cow_Img_Url'],
            'name' => $row['Cow_Name'],
            'id' => $row['Cow_Id'],
            'chip_num'=> $row['Chip_Number'] ?? null,
        );
    }
        return $tmp;
}

function getAvailableCow(): array
{
    $tmp = [];
    $user = $_SESSION['user'];
    $sql_get_cow = "SELECT cow.Cow_Number, cow.Cow_Name, cow.Cow_Id
                    FROM cow 
                    left join chip_cow_user ccu on cow.Cow_Id = ccu.Cow_Id
                    WHERE ccu.User_Id =:user  AND ccu.Chip_Id IS NULL
                    ORDER BY Cow_Name;";

    $query_get_cow = $GLOBALS['db']->prepare($sql_get_cow);
    $query_get_cow->execute(array('user'=> $user));
    $rows = $query_get_cow->fetchAll();
    foreach ($rows as $row){
        $tmp[]= array(
            'number' => $row['Cow_Number'],
            'name' => $row['Cow_Name'],
            'id' => $row['Cow_Id'],
        );
    }
    return $tmp;
}

function linkCow(int $chip, int $cow): bool
{
    $update_user_sql = "UPDATE chip_cow_user SET Chip_Id =:chip WHERE User_Id=:id AND Cow_Id = :cow AND Chip_Id IS NULL;
                        DELETE FROM chip_cow_user WHERE chip_cow_user.Cow_Id IS NULL AND User_Id = :id AND Chip_Id = :chip";
    $update_user_query = $GLOBALS['db']-> prepare($update_user_sql);
    $update_user_query->execute(
        array(
            "chip" => $chip,
            "cow" => $cow,
            "id"=> intval($_SESSION['user']),
        )
    );
    return true;
}

