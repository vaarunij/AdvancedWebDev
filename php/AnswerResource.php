<?php

require_once("AnswerModel.php");

if(isset($_POST['action']))
{
  $action = $_POST['action'];
  
  if($action == "get"){
	  $question_id = $_POST['question_id'];
	  $evaluation_id = $_POST['evaluation_id'];
	  $user_id = $_POST['user_id'];
	  $question = AnswerModel::getAnswerOfQuestion($evaluation_id, $user_id, $question_id);
	  
	  $result = json_encode($question);
	  
	  echo $result;
  }
  if($action == "update"){
	  $question_id = $_POST['question_id'];
	  $evaluation_id = $_POST['evaluation_id'];
	  $user_id = $_POST['user_id'];
	  $query = $_POST['query'];
	  
	  
	  AnswerModel::updateAnswer($question_id,$user_id,$evaluation_id,$query);
	  
	}
}


?>
