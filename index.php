<?php
/**
 * Created by PhpStorm.
 * User: rDx.LoRD
 * Date: 11/25/2015
 * Time: 1:14 PM
 */
session_start();
if(isset($_SESSION['auth_token'])) {
    header("Location: home.php");
} else {
?>
<html>
<head>
    <title>
        Login
    </title>
</head>
<body>
<form action="auth.php" method="post">
<div align="center">
    <h2>Login</h2>
    <labe>
        Username
    </labe>
    <input type="text" name="username" placeholder="Username"><br><br>
    <label>
        Password
    </label>
    <input type="password" name="password" placeholder="password"><br><br>
    <input type="submit" name="submit" value="Login">
</div>
</form>
</body>
</html>
<?php } ?>