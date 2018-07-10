<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");
session_start();

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class evaluationModel {
     public static function getEvaluation() {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT evaluation_id
              FROM evaluation WHERE trainer";              
        $stmt = $db->prepare($sql);
        $ok = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


?>