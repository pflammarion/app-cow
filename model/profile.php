<?php

function getUserProfile(int $id) : array {
    $sql = "SELECT User_Email, User_Username, User_Img_Url, User_FirstName, User_LastName  
            FROM User 
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
        );
    }
    else return [];
}
