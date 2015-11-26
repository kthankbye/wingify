<?php
/**
 * Created by PhpStorm.
 * User: rDx.LoRD
 * Date: 11/25/2015
 * Time: 1:18 PM
 */
session_start();
include "connect.php";
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con,$query) or die(mysqli_error());
    if(mysqli_num_rows($result) == 1) {
        $auth_token = bin2hex(openssl_random_pseudo_bytes(16));
        $_SESSION['auth_token'] = $auth_token;
        header("Location: home.php");
    } else {
        $error_code = md5("error");
        header("Location: index.php?error=$error_code");
    }
} else {
    $error_code = md5("error");
    header("Location: index.php?error=$error_code");
}