<?php

function getAllTags(): array
{
    $sql_get_tags="SELECT Tag_Name, Tag_Id FROM tag";
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
    $sql_get_ticket="SELECT t.Tag_Name as tag, s.Status_Name as status, Ticket_Content,  DATE_FORMAT(Ticket_Date_Creation, '%d/%m/%Y') as date_create, DATE_FORMAT(Ticket_Date_Modif, '%d/%m/%Y') as date_update 
                    FROM ticket 
                    LEFT JOIN tag t on t.Tag_Id = ticket.Tag_Id
                    LEFT JOIN status s on s.Status_Id = ticket.Status_Id
                    WHERE User_Id =:user ;";
    $query_get_ticket = $GLOBALS['db']->prepare($sql_get_ticket);
    $query_get_ticket ->execute(array('user'=>intval($_SESSION['user'])));
    $rows = $query_get_ticket->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'tag'=>$row['tag'],
            'status'=>$row['status'],
            'content'=>$row['Ticket_Content'],
            'creation'=> $row['date_create'],
            'modif'=>$row['date_update'],
        );
    }
    return $result;
}

function createTicket(string $email, int $tag, string $content): bool
{
    $user = $_SESSION['user'] ?? null;
    $add_ticket_sql = "INSERT INTO ticket SET User_Id =:user, Tag_Id =:tag, Ticket_Email= :email, Ticket_Date_Creation = current_timestamp, Status_Id = 1";
    $add_ticket_query = $GLOBALS['db']-> prepare($add_ticket_sql);
    $add_ticket_query->execute(
        array(
            'user'=> $user,
            "email"=> $email,
            "tag"=> $tag,
            "content"=> $content,
        )
    );
    return true;
}