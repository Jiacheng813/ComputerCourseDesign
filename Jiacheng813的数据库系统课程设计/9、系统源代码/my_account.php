<?php
include_once('connect_sql.php');
session_start();
$username=$_SESSION["用户名"];
$sql_statement="SELECT * FROM 用户信息表 WHERE 用户名='$username'";
$table_name='用户信息表';
$arr=SelectRecord($sql_statement);
echo "<style> body{text-align:center}</style>";
PrintAsTable($arr,'我的账号信息');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的账号</title>
</head>
<body>
    <style> body{text-align:center}</style>
    <div style="padding-top:40px;">
        <button onclick="window.open('my_account-modify.php','_self')">修改账号信息</button>
        <br><br>
        <button onclick="window.open('favourite_store.php','_self')">我收藏的店铺</button>
        <br><br>
    <button onclick="window.open('index.html','_self')">返回首页</button>
    </div>
</body>
</html>
