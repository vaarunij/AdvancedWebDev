<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class TrainerModel {
     public static function getTrainer($userid) {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT *
              FROM trainer WHERE user_id = $userid";
              
        $stmt = $db->prepare($sql);
        $ok = $stmt->execute();
        //echo $ok;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

   
}

?>