<?php

if(isset($_POST['logout']) === TRUE) {
    $_SESSION = array();

    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }

    session_destroy();
    header('Location:../view/login_view.php');
}