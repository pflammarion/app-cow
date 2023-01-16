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
    $name = htmlspecialchars($values["name"]);
    $number = htmlspecialchars($values["number"]);
    $id = intval($values["id"]);
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
    $sql_get_cow = "SELECT cow.Cow_Number, cow.Cow_Img_Url, cow.Cow_Name, cow.Cow_Id
                    FROM cow 
                    left join chip_cow_user ccu on cow.Cow_Id = ccu.Cow_Id
                    WHERE ccu.User_Id =:user ;";

    $query_get_cow = $GLOBALS['db']->prepare($sql_get_cow);
    $query_get_cow->execute(array('user'=> $user));
    $rows = $query_get_cow->fetchAll();
    foreach ($rows as $row){
        $tmp[]= array(
            'number' => $row['Cow_Number'],
            'img_cow' => $row['Cow_Img_Url'],
            'name' => $row['Cow_Name'],
            'id' => $row['Cow_Id'],
        );
    }
        return $tmp;
}

