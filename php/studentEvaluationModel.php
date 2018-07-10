<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");
session_start();

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class studentEvaluationModel {
     public static function getEvaluation() {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT evaluation_id FROM evaluation WHERE trainer_id = :user_id";           
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);   
        $ok = $stmt->execute();
        $result = null;
        echo $ok;
        if($ok){
            $result = $stmt->fetchAll();
            //echo $result;
        }

        return $result;
    }
}

?>