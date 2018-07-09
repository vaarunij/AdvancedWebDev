<?php
require_once("SqlSkillsDB.php");
$db = SqlSkillsDB::getConnection();
$sql = "SELECT COUNT(user_id) AS nb
        FROM user";
$stmt = $db->prepare($sql);
$ok = $stmt->execute();

$result = null;
if($ok){
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  print $result["nb"]." users found";
}
else{
  print "We have a problem";
}
?>
