  <?php
  require_once("SqlSkillsDB.php");
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
      do_post();
  }


  function do_post() {
          global $msg;
          require_once "UserModel.php";
            $user =  $_SESSION['user'];
            $group_id = $_GET['group_id'];
            $date = date('Y-m-d H:i:s');
            $user_id = $user['user_id'];
            try {
              $ok = UserModel::postGroup($user_id,$group_id,$date);
              if ($ok == 1) {
                $msg = "Group join successfull";
              }
            } catch (Exception $e) {
              $msg = "You have already joined a group";
            }

            echo $msg;
                        
      }
    
  ?>