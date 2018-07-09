<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class GroupModel {



     public static function getGroups() {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT *
              FROM usergroup";
              
        $stmt = $db->prepare($sql);
        $ok = $stmt->execute();
        //echo $ok;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public static function postGroup($user_id, $group_id,$validated_at) {
        $db = SqlSkillsDB::getConnection();

        $sql = "INSERT INTO group_member (user_id,group_id,validated_at) VALUES (:user_id, :group_id, :validated_at)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->bindValue(":group_id", $group_id);
        $stmt->bindValue(":validated_at", $validated_at);

        $ok = $stmt->execute();
        echo "string";
        echo $ok;
        return $ok;
        // return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>