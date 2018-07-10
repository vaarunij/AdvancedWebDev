<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");
session_start();

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class StudentModel {
     public static function getStudents($eval_id) {

        
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT trainee_id FROM sheet WHERE evaluation_id = :eval_id";           
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eval_id', $eval_id);   
        $ok = $stmt->execute();
        $result = null;
         $ok;
        if($ok){
            $result = $stmt->fetchAll();
            //echo $result;
        }

        return $result;
    }
}

?>