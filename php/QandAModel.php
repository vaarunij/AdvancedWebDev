<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");
session_start();

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class QandAModel {
     public static function getQandA($tr_id) {

        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT sql_answer.answer, sql_question.question_text, sql_question.correct_answer, sql_answer.gives_correct_result from sql_answer inner join sql_question on sql_answer.question_id = sql_question.question_id  WHERE trainee_id = :tr_id";  

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':tr_id', $tr_id);   
        $ok = $stmt->execute();
        $result = null;

        if($ok){
            $result = $stmt->fetchAll();
            //echo $result;
        }
        return $result;
    }
}

?>