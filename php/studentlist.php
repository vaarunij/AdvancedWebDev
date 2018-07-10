
      <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        do_get();
    } else {
        do_post();
    }


    function do_get() {
        global $msg;
        require_once "StudentModel.php";
        $eval_id = $_GET['eval_id'];
        $i=0;
        $result = StudentModel::getStudents($eval_id);
        echo "<table>";
            echo "<tr>";
                echo "<th>Id</th>";
                echo "<th>Action</th>";
                
            echo "</tr>";
            
          while($i<count($result)){
             
             echo "<tr>";
                echo "<td>" . $result[$i]['trainee_id'] . "</td>";
                echo "<td align=center width=100><a href='getQandA.php?tr_id=".$result[$i]['trainee_id'] ."'>Click</a></td>";
                
            echo "</tr>";
            $i++;
          }  
            echo "</table>";
    }
    function do_post() {

    }
    ?>
