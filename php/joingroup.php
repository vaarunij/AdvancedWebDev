<?php
session_start()
require_once("DemoDB.php");
  
  $user_id =  $_SESSION['id'];
  $group_id = $_GET['group_id'];
  $date = date('Y-m-d H:i:s');
  

  
    try {
        $statement = $link->prepare("INSERT INTO group_member(user_id,group_id,validated_at)
            VALUES(?,?,?)");
        $statement->execute(array($user_id ,$group_id, $date));
    } 
	catch(PDOException $e) {
        echo $e->getMessage();
    }
  


?>