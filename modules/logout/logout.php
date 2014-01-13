<?php

//four steps to closing a session
//(i.e. logging out)
//1. Find the session
@session_start();

//2. Unset all the session variables
$_SESSION = array();

//3. Destroy the session cookie
if (isset($_COOKIE['idCookie']) != '' && isset($_COOKIE['passCookie']) != '') {
    setcookie('idCookie', '', time() - 42000, '/');   //set cookie to expire in last 42000 seconds.
    setcookie('passCookie', '', time() - 42000, '/'); //set cookie to expire in last 42000 seconds.
}


//4. Destroy the session
session_destroy();

redirect_to("index.php");
?>