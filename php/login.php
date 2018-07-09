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
    <form method="POST">
        <?php
        if (array_key_exists("user", $_SESSION)) {
            ?>
            <button type="submit" name="action" value="disconnect">Disconnect
                <?= $_SESSION["user"]["name"] ?></button>
            <?php
        } else {
            $email = (array_key_exists("email", $_POST)) ? $_POST['email'] : "";
            ?>
            Email: <input type="email" name="email" value="<?= $email ?>"/>
            Password: <input type = "password" name = "password"/>
            <button type="submit">Connect</button>
            <?= $msg ?>
            <?php
        }
        ?>
    </form>
    <?php
}

function do_post() {
    global $msg;
    require_once "UserModel.php";
    if (array_key_exists("action", $_POST) && $_POST["action"] == "disconnect") {
        $_SESSION = array();
        session_destroy();
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (empty($email) || empty($password)) {
            $msg = "fields must be filled";
        } else {
            $user = UserModel::getByLoginPassword($email, $password);
            if ($user != null) {
                $_SESSION["user"] = $user;
            } else {
                $msg = "Invalid password or user unknow";
            }
        }
    }
    do_get();
}
