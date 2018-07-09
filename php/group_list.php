
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
        require_once "UserModel.php";
        $i=0;
        $result = UserModel::getGroups();
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Group name</th>";
                echo "<th>Join</th>";
            echo "</tr>";
          while($i<count($result)){
             // print_r($result);

             echo $result[$i]['name'];
             echo "<br>";
             
             echo "<tr>";
                echo "<td>" . $result[$i]['group_id'] . "</td>";
                echo "<td>" . $result[$i]['name'] . "</td>";
                echo "<td align=center width=100><a href='joingroup.php?group_id=".$result[$i]['group_id'] ."'>Click</a></td>";

            echo "</tr>";
            $i++;
          }  
            echo "</table>";
        

    }
    function do_post() {

    }
