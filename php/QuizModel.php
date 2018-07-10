<?php
require_once 'SqlSkillsDB.php';

class QuizModel {

     public static function getQuizzes() {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT * FROM sql_quiz";
        $stmt = $db->prepare($sql);
        $ok = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function postQuizzes() {
        echo "Reached Post";
        $db = SqlSkillsDB::getConnection();
        $author_id = $_POST['author_id'];
        $title = $_POST['title'];
        $is_public = $_POST['is_public'];
        $db_name = $_POST['db_name'];

        $sql = "INSERT INTO sql_quiz(author_id, title, is_public, db_name)
            VALUES (:author_id, :title, :is_public, :db_name)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":author_id", $author_id);
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":is_public", $is_public);
        $stmt->bindValue(":db_name", $db_name);
        $ok = $stmt->execute();
        echo "string";
        echo $ok;
        // return $ok;
        // return $stmt->fetch(PDO::FETCH_ASSOC);
        // getQuizzes();
    }
}
?>
