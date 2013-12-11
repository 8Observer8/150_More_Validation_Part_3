<?php

//$current_file = $_SERVER['SCRIPT_FILENAME'];
// C:/xampp/htdocs/PhpTurorials/PhpAlex/Php_137/index.php
ob_start();
session_start();

$current_file = $_SERVER['SCRIPT_NAME'];

if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    $http_referer = $_SERVER['HTTP_REFERER'];
}

// /PhpTurorials/PhpAlex/Php_137/index.php

function loggedin() {
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function getuserfield($field) {
    $query = "SELECT `$field` FROM `users_reg` WHERE `id`='" . $_SESSION['user_id'] . "'";
    if ($query_run = @mysql_query($query)) {
        if ($query_result = @mysql_result($query_run, 0, $field)) {
            return $query_result;
        } else {
            echo 'getuserfield(): cannot find the field - ' . $field;
        }
    } else {
        echo 'getuserfield(): invalid query';
    }
}

?>
