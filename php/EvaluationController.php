<?php
require_once("SqlSkillsDB.php");
require_once("EvaluationModel.php");

session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $returnVal = do_get();
    echo $returnVal;
} else {
    do_post();
}

function do_get() {
        global $msg;
        require_once "EvaluationModel.php";
          $user =  $_SESSION['user'];
          $group_id = $_GET['group_id'];
          $date = date('Y-m-d H:i:s');
          $user_id = $user['user_id'];
          try {
            $ok = EvaluationModel::getEvaluation();

            if ($ok == 1) {
             $msg = "Returned values";
            }
          } catch (Exception $e) {
            $msg = $e;
          }
          echo $msg;
    }

function do_post() {
        // echo "DO POST";
        global $msg;
        require_once "EvaluationModel.php";
          $user =  $_SESSION['user'];
          $group_id = $_GET['group_id'];
          $date = date('Y-m-d H:i:s');
          $user_id = $user['user_id'];
          try {
            $ok = EvaluationModel::postEvaluation();
            if ($ok == 1) {
              $msg = "Evaluation created successfully";
            }
          } catch (Exception $e) {
            $msg = "This evaluation id is already taken";
          }
          echo $msg;
    }
?>
