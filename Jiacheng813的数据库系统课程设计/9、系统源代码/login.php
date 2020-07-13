<?php
include_once('connect_sql.php');
$username = $_POST["用户名"];
$password = $_POST["密码"];
session_start();
$_SESSION["用户名"]=$username;
$_SESSION["密码"]=$password;
header('Location:login_verify.php');
?>
