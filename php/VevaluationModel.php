<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");
session_start();

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class VevaluationModel{
     public static function getEvaluation() {

     	 $user =  $_SESSION['user'];
         $user_id = $user['user_id'];

        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT `evaluation_id` FROM evaluation WHERE `trainer_id` = :user_id";           
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);   
        $ok = $stmt->execute();
       //Execute our statement.
        $stmt->execute();

        //Loop through the $rows array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        //return $result;
    }
}

?>