<?php

session_name("travel");
session_start();
session_destroy();

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// if (isset($_SESSION['user_logged_in']))
    header("location: index.php");
// else 
//     var_dump('user is still logged in');
?>
