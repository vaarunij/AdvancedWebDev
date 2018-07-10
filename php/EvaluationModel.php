<?php
require_once 'SqlSkillsDB.php';
class EvaluationModel {
     public static function getEvaluation() {
        $db = SqlSkillsDB::getConnection();
        $sql = "SELECT * FROM evaluation";
        $stmt = $db->prepare($sql);
        $ok = $stmt->execute();
        echo "Successful Get";
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function postEvaluation() {
        $db = SqlSkillsDB::getConnection();
        $evaluation_id = $_POST['evaluation_id'];
        $group_id = $_POST['group_id'];
        $trainer_id = $_POST['trainer_id'];
        $quiz_id = $_POST['quiz_id'];
        $scheduled_at = date('Y-m-d H:i:s');
        $ending_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO evaluation(evaluation_id, group_id, trainer_id, quiz_id, scheduled_at, ending_at)
            VALUES (:evaluation_id, :group_id, :trainer_id, :quiz_id, :scheduled_at, :ending_at)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":evaluation_id", $evaluation_id);
        $stmt->bindValue(":group_id", $group_id);
        $stmt->bindValue(":trainer_id", $trainer_id);
        $stmt->bindValue(":quiz_id", $quiz_id);
        $stmt->bindValue(":scheduled_at", $scheduled_at);
        $stmt->bindValue(":ending_at", $ending_at);
        $ok = $stmt->execute();
        echo "Successful Post";
        //echo $ok;
        // return $ok;
        // return $stmt->fetch(PDO::FETCH_ASSOC);
        // getQuizzes();
    }
}
?>
