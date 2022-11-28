<?php

function getUserProfile(int $id) : array {
    $sql = "SELECT User_Email, User_Username, User_Img_Url, User_FirstName, User_LastName, Role_Name  
            FROM User 
            LEFT JOIN Role on User.Role_Id = Role.Role_Id
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
            'role' => $row['Role_Name']
        );
    }
    else return [];
}
