<?php
require_once 'SqlSkillsDB.php';
// Fetching Values From URL
$db = SqlSkillsDB::getConnection();
$author_id = $_POST['author_id'];

echo $author_id;
$title = $_POST['title'];
echo $title;
$is_public = $_POST['is_public'];
echo $is_public;
$db_name = $_POST['db_name'];
echo $db_name;

$sql = "INSERT INTO sql_quiz(author_id, title, is_public, db_name)
    VALUES (:author_id, :title, :is_public, :db_name)";
$stmt = $db->prepare($sql);
$stmt->bindValue(":author_id", $author_id);
$stmt->bindValue(":title", $title);
$stmt->bindValue(":is_public", $is_public);
$stmt->bindValue(":db_name", $db_name);

$ok = $stmt->execute();
echo $ok;
// return $stmt->fetch(PDO::FETCH_ASSOC); // Connection Closed
?>
