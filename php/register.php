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

            echo $password1;
            $name = $_POST["name"];
            $first_name = $_POST["first_name"];
            $token = bin2hex(random_bytes(30));
            if (empty($email) || empty($password1)|| empty($password2) || empty($name) || empty($first_name)) {
                $msg = "fields must be filled";
            } else {
                if ($password1 === $password2) {
                    try {
                        $user = UserModel::getByEmail($email);
                        if ($user != null) {
                            $msg = "User with this email already exists";
                        } else {
                         $user = UserModel::postRegister($email, $password1 ,$name,$first_name,$token);

                        $to=$email;
                        $subject="Email verification";
                        $body='Click this link to verify <br/> <br/> <a href="http://localhost:8888/web-exercices/adv-php/verify.php?code=' . $token ;

                        sendEmail($to,$subject,$body);
                        $msg= "Registration successful, please activate email."; 
                        }
                        
                    } catch (Exception $e) {
                        $msg = $e;
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
    // $from       = "advancedphp779@gmail.com";
    // $mail       = new PHPMailer();
    // $mail->CharSet = 'UTF-8';
    // $mail->SMTPDebug  = 0; 
    // $mail->IsSMTP(true);            // use SMTP
    // $mail->IsHTML(true);
    // $mail->SMTPAuth   = true;                  // enable SMTP authentication
    // $mail->Host = "smtp.gmail.com"; // SMTP host
    // $mail->Port       =  25;                    // set the SMTP port
    // $mail->Username   = "advancedphp779@gmail.com";  // SMTP  username
    // $mail->Password   = "Epita@123" ; // SMTP password

    // $mail->Subject    = $subject;
    // $mail->MsgHTML($body);
    // $address = $to;
    // $mail->SetFrom($from, 'Advanced Web');
    // $mail->AddReplyTo($from,'Advanced Web');
    // $mail->AddAddress($to);

    // echo "function mail called";

    // if(!$mail->Send())
    //     echo "Mailer Error: " . $mail->ErrorInfo;
    // else
    //     echo "Message has been sent";
    // $mail = new PHPMailer;

    // $mail->isSMTP();                                   // Set mailer to use SMTP
    // $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
    // $mail->SMTPAuth = true;                            // Enable SMTP authentication
    // $mail->Username   = "advancedphp779@gmail.com";  // SMTP  username
    // $mail->Password   = "Epita@123" ; // SMTP password
    // $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    // $mail->Port = 25;                                 // TCP port to connect to

    // $mail->setFrom('mohsin@gmail.com', 'Mohsin SHoukat');
    // $mail->addReplyTo('mohsin@gmail.com', 'Mohsin SHoukat');
    // $mail->addAddress('thejus.manoharan@gmail.com');   // Add a recipient
    // //$mail->addCC('cc@example.com');
    // //$mail->addBCC('bcc@example.com');

    // $mail->isHTML(true);  // Set email format to HTML

    // $bodyContent = '<h1>Sending Email From LocalHost</h1>';
    // $bodyContent .= '<p>Finaly Now I can send mail <b>offline</b></p>';

    // $mail->Subject = 'Email from Localhost By Mohsin Shoukat';
    // $mail->Body    = $bodyContent;
    // echo "workin till here";
    // mail(to, subject, message)
    // if(!$mail->send()) {
    //     echo 'Message could not be sent.';
    //     echo 'Mailer Error: ' . $mail->ErrorInfo;
    // } else {
    //     echo 'Message has been sent';
    //     // visit our site www.studyofcs.com for more learning
    // }
    $to = "thejus.manoharan@gmail.com";
    $subject = $subject;
    $from = "advancedphp779@gmail.com";
    $headers = "From:" . $from;
    mail($to,$subject,$body,$headers);
    echo "Mail Sent";
    
}    

