
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
        require_once "evaluationModel.php";
        $i=0;
        $result = evaluationModel::getEvaluation();
        echo "<table>";
            echo "<tr>";
                echo "<th> Evaluation id</th>";
            echo "</tr>";
          while($i<count($result)){
             // print_r($result);

             
             echo "<tr>";
                echo "<td>" . $result[$i]['group_id'] . "</td>";

            echo "</tr>";
            $i++;
          }  
            echo "</table>";
        

    }
    function do_post() {

    }
