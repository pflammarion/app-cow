<?php

function getUserProfile(int $id): array
{
    $sql = "SELECT User_Email, User_Username, User_Img_Url, User_FirstName, User_LastName, Role_Name  
            FROM user 
            LEFT JOIN role on user.Role_Id = role.Role_Id
            WHERE User_Id = :id";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute(array('id'=>$id));
    $row = $query->fetch();
    if ($query->rowCount() === 1){
        return array(
            'username' => $row['User_Username'],
            'email' => $row['User_Email'],
            'firstname' => $row['User_FirstName'],
            'lastname' => $row['User_LastName'],
            'img_url' => $row['User_Img_Url'],
            'role' => $row['Role_Name'],
        );
    }
    else return [];
}

function updateProfile(array $value): bool
{
    $errors = [];
    $username = $value['username'];
    $email = $value['email'];
    $lastname = $value['lastname'];
    $firstname = $value['firstname'];
    $user = $_SESSION['user'];

    if (checkEmail($email, $user)) {
        $errors[] = "Your email address is associated with another account.";
    }

    if (checkUser($username, $user)) {
        $errors[] = "Your username is already used.";
    }

    if (checkBan($username, $email, $user)) {
        $errors[] = "You were banned from our plateforme";
    }

    if (!$errors)
    {
        $update_account_sql = "UPDATE user SET User_Username = :username, User_Email = :email, User_FirstName = :firstname, User_LastName = :lastname WHERE user.User_Id = :user";
        $update_account_query = $GLOBALS['db']->prepare($update_account_sql);
        $update_account_query->execute(
            array(
                "username"=> htmlentities($username),
                "email"=>htmlentities($email),
                "firstname"=>htmlentities($firstname),
                "lastname"=>htmlentities($lastname),
                "user"=>$user,
            ));

        return true;
    }
    return false;
}

function deleteProfile(): bool
{
    $delete_account_sql = "DELETE FROM user WHERE User_Id = :user;";
    $delete_account_query = $GLOBALS['db']->prepare($delete_account_sql);
    $delete_account_query->execute(
        array(
            "user"=> $_SESSION['user'],
        ));
    return true;
}

