<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class UserModel {

    /** Get person data for id $personId
     * (here demo with a SQL request about an existing table)
     * @param int $personId id of the quizz to be retrieved
     * @return associative_array table row
     */
    public static function get($userId) {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT user_id, name
              FROM user
              WHERE user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $ok = $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByLoginPassword($email, $password) {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT user_id, name, pwd
            FROM user
            WHERE email = :email AND pwd = :password";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $ok = $stmt->execute();
				return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>