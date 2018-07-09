    <?php
    /* Connect or disconnect a user.
     * The user interface is minimal.
     */
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        do_get();
    } else {
        do_post();
    }

    function do_get() {
        global $msg;
        ?>
        <!-- <form method="POST"> -->
            
                    <head>
                      <title>Registration system PHP and MySQL</title>
                      <link rel="stylesheet" type="text/css" href="style.css">
                    </head>
                    <body>
                      <div class="header">
                        <h2>Register</h2>
                      </div>
                        
                      <form method="post" action="register.php">
                        <?php include('errors.php'); ?>
                        <div class="input-group">
                          <label>Name</label>
                          <input type="text" name="name" value="<?php echo $name; ?>">
                        </div>
                        <div class="input-group">
                          <label>Last Name</label>
                          <input type="text" name="first_name" value="<?php echo $first_name; ?>">
                        </div>
                        <div class="input-group">
                          <label>Email</label>
                          <input type="email" name="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="input-group">
                          <label>Password</label>
                          <input type="password" name="password1">
                        </div>
                        <div class="input-group">
                          <label>Confirm password</label>
                          <input type="password" name="password2">
                        </div>
                        <div class="input-group">
                          <button type="submit" class="btn" name="reg_user">Register</button>
                        </div>
                        <p>
                            Already a member? <a href="login.php">Sign in</a>
                        </p>
                      </form>
                    </body>
                    </html>
                <?= $msg ?>

        <!-- </form> -->
        <?php
    }

    function do_post() {
        global $msg;
        require_once "UserModel.php";
            $email = $_POST["email"];
            $password1 = $_POST["password1"];
            $password2 = $_POST["password2"];
            $name = $_POST["name"];
            $first_name = $_POST["first_name"];
            $token = bin2hex(random_bytes(30));
            if (empty($email) || empty($password1)|| empty($password2) || empty($name) || empty($first_name)) {
                $msg = "fields must be filled";
            } else {
                if ($password1 === $password2) {
                    try {
                        $user = UserModel::getByEmail($email);
                        // if ($user != null) {
                        //     $msg = "User with this email already exists";
                        // } else {
                        $user = UserModel::postRegister($email, $password1 ,$name,$first_name,$token);

                        $to=$email;
                        $subject="Email verification";
                        $body='Click this link to verify <br/> <br/> <a href="http://localhost:8888/web-exercices/adv-php/verify.php?code=' . $token .'/a>';

                        sendEmail($to,$subject,$body);
                        $msg= "Registration successful, please activate email."; 
                        // }
                        
                    } catch (PDOException $e) {

                        $msg= "User already exists, Please use a new email"; 
                        // $msg = $e;
                    }
                    
                    
                }
                else{
                    $msg = "Password donot match";
                }
                
            }
        do_get();
    }


function sendEmail($to,$subject,$body)
{
    require ('PHPMailer/class.phpmailer.php');
  

    $to = "thejus.manoharan@gmail.com";
    $subject = $subject;
    $from = "advancedphp779@gmail.com";
    $headers = "From: $from\r\nContent-type:text/html;charset=utf8";
    mail($to,$subject,$body,$headers);
    
}    

