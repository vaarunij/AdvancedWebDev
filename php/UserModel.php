<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("SqlSkillsDB.php");

/** Access to the person table.
 * Put here the methods like getBySomeCriteriaSEarch */
class UserModel {

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
    public static function updateUserByToken($token,$validated_at) {
        $db = SqlSkillsDB::getConnection();

        $sql = "UPDATE user
              SET validated_at = :validated_at
              WHERE token = :token";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":token", $token);
        $stmt->bindValue(":validated_at", $validated_at);
        $ok = $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public static function getByEmail($email) {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT *
              FROM user
              WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $ok = $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function getByLoginPassword($email, $password) {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT user_id, name, pwd, validated_at
            FROM user
            WHERE email = :email AND pwd = :password";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $ok = $stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function postRegister($email, $password,$name,$first_name,$token) {
        $db = SqlSkillsDB::getConnection();

        $sql = "INSERT INTO user (email, pwd, name, first_name,token) VALUES (:email, :password, :name,:first_name,:token)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":first_name", $first_name);
        $stmt->bindValue(":token", $token);

        $ok = $stmt->execute();
        
        // return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>