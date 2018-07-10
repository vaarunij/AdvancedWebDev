
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
        require_once "QandAModel.php";
        $tr_id = $_GET['tr_id'];
        $i=0;
        $result = QandAModel::getQandA($tr_id);
        echo "<table>";
            echo "<tr>";
                echo "<th>Question</th>";
                echo "<th>Student answer</th>";
                echo "<th>Correct answer</th>";  
                echo "<th>Evaluation</th>";                
            echo "</tr>"; 
          while($i<count($result)){
             
             echo "<tr>";
                echo "<td>" . $result[$i]['question_text'] . "</td>";
                echo "<td>" . $result[$i]['answer'] . "</td>";
                echo "<td>" . $result[$i]['correct_answer'] . "</td>";
                $v = '';
                if ($result[$i]) {
                    $v = 'True';
                }
                else{
                    $v = 'False';
                }
                echo "<td>" . $v . "</td>";
                
            echo "</tr>";
            $i++;
          }  
            echo "</table>";
    }
    function do_post() {

    }
    ?>
