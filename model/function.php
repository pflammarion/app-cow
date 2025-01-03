<?php

function updateImage(string $table, string $destination, int $id): bool
{
    $success = false;
    if ($destination !== ""){
        $update_img_sql = "";
        switch ($table){
            case 'user' :
                $update_img_sql = "UPDATE user SET user.User_Img_Url=:destination WHERE user.User_Id = :id";
                break;
            case 'cow' :
                $update_img_sql = "UPDATE cow SET cow.Cow_Img_Url=:destination WHERE cow.Cow_Id = :id";
                break;
        }
        $update_img_query = $GLOBALS['db']-> prepare($update_img_sql);
        $update_img_query->execute(
            array(
                "destination"=> $destination,
                "id" => $id,
            )
        );
        $success = true;
    }
    return $success;
}

function checkEmail(string $email, int $id = null): bool
{
    $email_sql = "SELECT count(1) FROM user WHERE User_Email = :email AND user.User_Id != :id";
    $email_query = $GLOBALS['db']->prepare($email_sql);
    $email_query->execute(array("email"=> $email, "id"=>$id));
    return $email_query->fetchColumn();
}

function checkUser(string $username, int $id = null): bool
{
    $user_sql = "SELECT count(1) FROM user WHERE User_Username = :username AND user.User_Id != :id";
    $user_query = $GLOBALS['db']->prepare($user_sql);
    $user_query->execute(array("username"=> $username, "id"=>$id));
    return $user_query->fetchColumn();
}

function checkBan(string $username, string $email, int $id = null): bool
{
    $user_ban_sql = "SELECT User_Ban FROM user WHERE (User_Username = :username OR User_Email = :email) AND user.User_Id != :id";
    $user_ban_query = $GLOBALS['db']->prepare($user_ban_sql);
    $user_ban_query->execute(array("username"=> $username, "email"=>$email, "id"=>$id));
    return $user_ban_query->fetchColumn();
}
function removeImage(string $table, int $id): bool
{
    $update_img_sql = "";
    switch ($table) {
        case 'user' :
            $update_img_sql = "UPDATE user SET user.User_Img_Url=null WHERE user.User_Id = :id";
            break;
        case 'cow' :
            $update_img_sql = "UPDATE cow SET cow.Cow_Img_Url=null WHERE cow.Cow_Id = :id";
            break;
    }
    $update_img_query = $GLOBALS['db']->prepare($update_img_sql);
    $update_img_query->execute(
        array(
            "id" => $id,
        )
    );
    return true;
}

function getAllCows(): array
{
    $tmp = [];
    $user = $_SESSION['user'];
    $sql_get_cow = "SELECT cow.Cow_Number, cow.Cow_Img_Url, cow.Cow_Name, cow.Cow_Id
                    FROM cow 
                    left join chip_cow_user ccu on cow.Cow_Id = ccu.Cow_Id
                    WHERE ccu.User_Id =:user
                    ORDER BY cow.Cow_Name";

    $query_get_cow = $GLOBALS['db']->prepare($sql_get_cow);
    $query_get_cow->execute(array('user' => $user));
    $rows = $query_get_cow->fetchAll();
    foreach ($rows as $row) {
        $tmp[] = array(
            'number' => $row['Cow_Number'],
            'img' => $row['Cow_Img_Url'],
            'name' => $row['Cow_Name'],
            'id' => $row['Cow_Id'],
        );
    }
    return $tmp;
}


function checkUserEmailOrUser(string $email, string $user, int $id = 1): bool
{
    $sql = "SELECT COUNT(*) FROM user WHERE User_Id != :id AND (User_Email = :email OR User_Username =:user)";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute(array('email' => $email, "user"=>$user, "id"=>$id));
    $count = $query->fetchColumn();
    if ($count > 0) {
        return true;
    }
    return false;
}
