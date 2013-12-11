<?php
require 'core.inc.php';
require 'connect.inc.php';

if (!loggedin()) {
    if (isset($_POST['username']) && isset($_POST['password']) &&
            isset($_POST['password_again']) && isset($_POST['firstname']) &&
            isset($_POST['surname'])) {
        $username = $_POST['username'];

        $password = $_POST['password'];
        $password_again = $_POST['password_again'];
        $password_hash = md5($password);

        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        if (!empty($username) && !empty($password) && !empty($password_again) &&
                !empty($firstname) && !empty($surname)) {
            if ($password != $password_again) {
                echo 'Passwords do not match.';
            } else {
                $query = "SELECT `username` FROM `users_reg` WHERE `username`='".$username."'";
                $query_run = mysql_query($query);
                if ($query_run) {
                    if (mysql_num_rows($query_run) >= 1) {
                        echo 'The username' . $username . ' already exists.';
                    } else {
                        $query = "INSERT INTO `users_reg` VALUES ('', '".mysql_real_escape_string($username)."', '".mysql_real_escape_string($password_hash)."', '".mysql_real_escape_string($firstname)."', '".mysql_real_escape_string($surname)."')";
                        $query_run = mysql_query($query);
                        if ($query_run) {
                            header('Location: register_success.php');
                        } else {
                            echo 'Sorry, we couldn\'t register you at this time. Thy again later.';
                        }
                    }
                } else {
                    echo 'register.php: query faild - ' . $query;
                }
            }
        } else {
            echo 'All fields are required';
        }
    }
    ?>

    <form action="register.php" method="POST">
        Username:<br />
        <input type="text" name="username" value="<?php if (isset($username)) { echo $username; } ?>" /><br />
        <br />
        Password:<br />
        <input type="password" name="password" value="" /><br />
        <br />
        Password again:<br />
        <input type="password" name="password_again" value="" /><br />
        <br />
        Firstname:<br />
        <input type="text" name="firstname" value="<?php if (isset($firstname)) { echo $firstname; } ?>" /><br />
        <br />
        Surname:<br />
        <input type="text" name="surname" value="<?php if (isset($surname)) { echo $surname; } ?>" /><br />
        <br />
        <input type="submit" value="Register" />
    </form>

    <?php
} else {
    echo 'You\'re already registered and logged in.';
}
?>
