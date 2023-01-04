<?php
function createCow(array $values): bool
{
    $name = $values["name"];
    $number = $values["number"];
    if ($name != "" && $number != ""){
        $create_cow_sql = "INSERT INTO cow (Cow_Name, Cow_Number) VALUES (:name, :number) ";
        $create_cow_query = $GLOBALS['db']-> prepare($create_cow_sql);
        $create_cow_query->execute(
            array(
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
    if ($name != "" && $number != "" && $id != ""){
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

function getCow(): array
{
    $get_cow_sql = "SELECT Cow_Id,Cow_Name,Cow_Number FROM cow;";
    $get_cow_query = $GLOBALS['db']-> prepare($get_cow_sql);
    $get_cow_query->execute();
    $rows = $get_cow_query->fetchAll();
    $values = [];
    if ($get_cow_query->rowCount() > 0){
        foreach ($rows as $row) {
            $values[]=array(
                "id"=>$row["Cow_Id"],
                "name"=>$row["Cow_Name"],
                "number"=>$row["Cow_Number"],
            );

        }
    }
    return $values;
}
