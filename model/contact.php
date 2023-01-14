<?php

function getAllTags(): array
{
    $sql_get_tags="SELECT Tag_Name, Tag_Id FROM tag;";
    $query_get_tags = $GLOBALS['db']->prepare($sql_get_tags);
    $query_get_tags ->execute();
    $rows = $query_get_tags->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'id'=>$row['Tag_Id'],
            'name'=>$row['Tag_Name'],
        );
    }
    return $result;
}

function getUserEmail(): string
{
    $sql_get_email="SELECT User_Email FROM user WHERE User_Id =:user ;";
    $query_get_email = $GLOBALS['db']->prepare($sql_get_email);
    $query_get_email ->execute(array(
        'user'=> intval($_SESSION['user'])
    ));
    $row = $query_get_email->fetch();
    if ($query_get_email->rowcount() === 1){
        return $row['User_Email'];
    }
    return '';
}

function getUserTickets(): array
{
    $sql_get_ticket="SELECT Tag_Id, Status_Id, Ticket_Content, Ticket_Date_Creation, Ticket_Date_Modif FROM ticket WHERE User_Id =:user ;";
    $query_get_ticket = $GLOBALS['db']->prepare($sql_get_ticket);
    $query_get_ticket ->execute();
    $rows = $query_get_ticket->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'tag_id'=>$row['Tag_Id'],
            'status_id'=>$row['Status_Id'],
            'content'=>$row['Ticket_Content'],
            'modif'=>$row['Ticket_Date_Modif'],
        );
    }
    return $result;
}