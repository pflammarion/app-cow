<?php
function createFaq(array $values): bool
{
    $question = $values["question"];
    $response = $values["response"];
    if ($question != "" && $response != ""){
        $create_faq_sql = "INSERT INTO faq (FAQ_Title, FAQ_Answer) VALUES (:question, :response) ";
        $create_faq_query = $GLOBALS['db']-> prepare($create_faq_sql);
        $create_faq_query->execute(
            array(
                "question"=> $question,
                "response"=> $response,
            )
        );
        return true;
    }
    return false;
}
function updateFaq(array $values): bool
{
    $question = $values["question"];
    $response = $values["response"];
    $id = $values["id"];
    if ($question != "" && $response != "" && $id != ""){
        $update_faq_sql = "UPDATE faq SET FAQ_Title=:question, FAQ_Answer=:response WHERE FAQ_Id=:id";
        $update_faq_query = $GLOBALS['db']-> prepare($update_faq_sql);
        $update_faq_query->execute(
            array(
                "question"=> $question,
                "response"=> $response,
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}
function deleteFaq(int $id): bool
{
    if ($id){
        $delete_faq_sql = "DELETE FROM faq WHERE FAQ_Id = :id;";
        $delete_faq_query = $GLOBALS['db']-> prepare($delete_faq_sql);
        $delete_faq_query->execute(
            array(
                "id"=> $id,
            )
        );
        return true;
    }
    return false;
}

function getfaq(): array
{
    $get_faq_sql = "SELECT FAQ_Id,FAQ_Title,FAQ_Answer FROM faq;";
    $get_faq_query = $GLOBALS['db']-> prepare($get_faq_sql);
    $get_faq_query->execute();
    $rows = $get_faq_query->fetchAll();
    $values = [];
    if ($get_faq_query->rowCount() > 0){
        foreach ($rows as $row) {
            $values[]=array(
                "id"=>$row["FAQ_Id"],
                "title"=>$row["FAQ_Title"],
                "answer"=>$row["FAQ_Answer"],
            );

        }
    }
    return $values;
}
