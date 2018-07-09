  <?php
  require_once("SqlSkillsDB.php");
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
      do_get();
  }


  function do_get() {
          global $msg;
          require_once "UserModel.php";
            $token = $_GET['code'];
            $date = date('Y-m-d H:i:s');
            try {
              $user = UserModel::updateUserByToken($token,$date);
              if ($user == 1) {
                $msg = "Account verified";
              }
              else{
                $msg = "Invalid token";
              }
            } catch (Exception $e) {
              $msg = "Invalid token";
            }
            
            echo $msg;
                        
      }
    
  ?>