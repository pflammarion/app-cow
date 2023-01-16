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

function getUserEmail(int $user = null): string
{
    if ($user === null){
        $user = $_SESSION['user'];
    }
    $sql_get_email="SELECT User_Email FROM user WHERE User_Id =:user ;";
    $query_get_email = $GLOBALS['db']->prepare($sql_get_email);
    $query_get_email ->execute(array(
        'user'=> intval($user)
    ));
    $row = $query_get_email->fetch();
    if ($query_get_email->rowcount() === 1){
        return $row['User_Email'];
    }
    return '';
}

function getUserTickets(): array
{
    $sql_get_ticket="SELECT Ticket_Id as id, s.Status_Id, t.Tag_Name as tag, s.Status_Name as status, Ticket_Content,  DATE_FORMAT(Ticket_Date_Creation, '%d/%m/%Y') as date_create, DATE_FORMAT(Ticket_Date_Modif, '%d/%m/%Y') as date_update 
                    FROM ticket 
                    LEFT JOIN tag t on t.Tag_Id = ticket.Tag_Id
                    LEFT JOIN status s on s.Status_Id = ticket.Status_Id
                    WHERE User_Id =:user 
                    ORDER BY s.Status_Id";
    $query_get_ticket = $GLOBALS['db']->prepare($sql_get_ticket);
    $query_get_ticket ->execute(array('user'=>intval($_SESSION['user'])));
    $rows = $query_get_ticket->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'id'=> $row['id'],
            'tag'=>$row['tag'],
            'status'=>$row['status'],
            'status_id'=>$row['Status_Id'],
            'content'=>$row['Ticket_Content'],
            'creation'=> $row['date_create'],
            'modif'=>$row['date_update'],
        );
    }
    return $result;
}

function createTicket(string $email, int $tag, string $content, int $userEmail = null): bool
{
    $user = $_SESSION['user'] ?? $userEmail;
    $add_ticket_sql = "INSERT INTO ticket (User_Id, Tag_Id, Ticket_Email, Ticket_Date_Creation, Status_Id, Ticket_Content) VALUES (:user, :tag, :email, current_timestamp(), 1, :content)";
    $add_ticket_query = $GLOBALS['db']-> prepare($add_ticket_sql);
    $add_ticket_query->execute(
        array(
            "user" => $user,
            "email"=> $email,
            "tag"=> $tag,
            "content"=> $content,
        )
    );
    return true;
}
function getUserIdByEmail(string $email): int
{
    $sql_get_email="SELECT User_Id FROM user WHERE User_Email =:email ;";
    $query_get_email = $GLOBALS['db']->prepare($sql_get_email);
    $query_get_email ->execute(array(
        'email'=> $email
    ));
    $row = $query_get_email->fetch();
    if ($query_get_email->rowcount() === 1){
        return $row['User_Id'];
    }
    return 0;
}

function getAllTickets(): array
{
    $sql = "SELECT Ticket_Id as id, t.Tag_Name as tag, s.Status_Name as status, s.Status_Id, Ticket_Content,  DATE_FORMAT(Ticket_Date_Creation, '%d/%m/%Y') as date_create, DATE_FORMAT(Ticket_Date_Modif, '%d/%m/%Y') as date_update 
            FROM ticket 
            LEFT JOIN tag t on t.Tag_Id = ticket.Tag_Id
            LEFT JOIN status s on s.Status_Id = ticket.Status_Id
            ORDER BY s.Status_Id, date_create desc, date_update desc";
    $query = $GLOBALS['db']->prepare($sql);
    $query ->execute();
    $rows = $query->fetchAll();
    $result = [];
    foreach ($rows as $row){
        $result[] = array(
            'id' => $row['id'],
            'tag'=>$row['tag'],
            'status'=>$row['status'],
            'status_id' => $row['Status_Id'],
            'creation'=> $row['date_create'],
            'modif'=>$row['date_update'],
        );
    }
    return $result;
}

function getTicketById(int $ticket): array
{
    $sql = "SELECT Ticket_Id as id, t.Tag_Name as tag, s.Status_Name as status, s.Status_Id, Ticket_Content,  DATE_FORMAT(Ticket_Date_Creation, '%d/%m/%Y') as date_create, DATE_FORMAT(Ticket_Date_Modif, '%d/%m/%Y') as date_update, Ticket_Content as content, Ticket_Email as email 
            FROM ticket 
            LEFT JOIN tag t on t.Tag_Id = ticket.Tag_Id
            LEFT JOIN status s on s.Status_Id = ticket.Status_Id
            WHERE Ticket_Id = :ticket LIMIT 1";
    $query = $GLOBALS['db']->prepare($sql);
    $query ->execute(array("ticket"=>$ticket));
    $row = $query->fetch();

    return array(
        'id' => $row['id'],
        'tag'=>$row['tag'],
        'status'=>$row['status'],
        'status_id' => $row['Status_Id'],
        'content' => $row['content'],
        'creation'=> $row['date_create'],
        'modif'=>$row['date_update'],
        'email'=>$row['email'],
        );
}

function updateTicketStatus(int $status, int $id): bool
{
    $update_sql = "UPDATE ticket SET Status_Id=:status, Ticket_Date_Modif = current_timestamp WHERE Ticket_Id=:id";
    $update_query = $GLOBALS['db']-> prepare($update_sql);
    $update_query->execute(
        array(
            "id"=> $id,
            "status"=>$status,
        )
    );
    return true;
}

function deleteTicketById(int $id): bool
{
    $sql = "DELETE FROM ticket WHERE Ticket_Id =:id";
    $query = $GLOBALS['db']->prepare($sql);
    $query->execute(
        array(
            "id"=> $id,
        )
    );
    return true;
}
