<?php
session_unset();
echo "<style> body{text-align:center}</style>";
echo "<div style=\"padding-top:80px;\"></div>";
echo "您已注销登录！<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注销登录</title>
</head>
<body>
    <div style="padding-top:40px;"></div>
    <button onclick="window.location.href = 'login.html'">返回登录页面</button>
</body>
</html>
