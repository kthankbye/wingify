<?php
/**
 * Created by PhpStorm.
 * User: rDx.LoRD
 * Date: 11/25/2015
 * Time: 10:49 AM
 */
session_start();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
header("Location: /wingify");
?>