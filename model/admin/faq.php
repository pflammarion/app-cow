<?php
function createFaq(array $values): bool
{
    $question = $values["question"];
    $response = $values["response"];
    if ($question != "" && $response != ""){
        $create_faq_sql = "INSERT INTO FAQ (FAQ_Title, FAQ_Answer) VALUES (:question, :response) ";
        $create_faq_query = $GLOBALS['db']-> prepare($create_faq_sql);
        $create_faq_query->execute(
            array(
                "question"=> ($question),
                "response"=> ($response),
            )
        );
        return true;
    }
    return false;
}
function getfaq(): array
{
    $get_faq_sql = "SELECT FAQ_Id,FAQ_Title,FAQ_Answer FROM FAQ DESC";
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
