 <? session_start();
     $_SESSION['id'] = $userData['user_id'];
	 
    //$user_id =  $_SESSION['id'];
	
require_once("DemoDB.php");
 
// Attempt select query execution
try{
    $sql = "SELECT * FROM usergroup";   
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Group name</th>";
                echo "<th>Join</th>";
            echo "</tr>";
        while($row = $result->fetch()){
            echo "<tr>";
                echo "<td>" . $row['group_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<a href="joingroup.php?group_id=<?php echo $row['group_id']; ?>">CLICK</a>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        unset($result);
    } else{
        echo "No records matching your query were found.";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($pdo);
   
  ?>