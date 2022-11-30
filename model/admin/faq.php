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
