<?php
include_once('connect_sql.php');
$username = $_POST["username"];
$password = $_POST["password"];
$nickname = $_POST["nickname"];
$birthdate = $_POST["birthdate"];
$address=$_POST["address"];
echo "<style> body{text-align:center}</style>";
echo "<div style=\"padding-top:80px;\"></div>";
if(!CheckUserInfo1($username,$password) || !CheckUserInfo2($nickname,$birthdate,$address)){
    echo "用户注册失败！<br>";
}
$result=ExecuteSql("INSERT INTO 用户信息表 (用户名,密码,昵称,生日,地址) VALUES('$username','$password','$nickname','$birthdate','$address')",0);
if($result[0]==='SUCCESS'){
    echo "用户注册成功！","<br>";
}
else{
    echo "用户注册失败！<br>";
    echo "错误原因：";
    if(strpos($result[0],'Duplicate')!==false){
        echo "用户名"."\"$username\""."已被注册<br>";
    }
    else echo $result[0]."<br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>账号注册结果</title>
</head>
<body>
<style> body{text-align:center}</style>
<br><br>
<button onclick="window.location.href = 'login.html'">返回登录页面</button>
<br><br>
<button onclick="window.location.href = 'register.html'">返回注册页面</button>
</body>
</html>
