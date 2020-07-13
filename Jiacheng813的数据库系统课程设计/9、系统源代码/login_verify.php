<?php
include_once('connect_sql.php');
session_start();
$username=$_SESSION["用户名"];
$password=$_SESSION["密码"];
$sql_statement1="SELECT * FROM 用户信息表 WHERE 用户名='$username'";
$result1=ExecuteSql($sql_statement1,0);
echo "<style> body{text-align:center}</style>";
if($result1[0]!=='SUCCESS'){
    echo "登陆失败，用户'$username'不存在！"."<br>";
    echo "<button onclick=\"window.location.href = 'login.html'\">返回登录页面</button>";;
}
else{
    $sql_statement2="SELECT * FROM 用户信息表 WHERE 用户名='$username' AND 密码='$password'";
    $result2=ExecuteSql($sql_statement2,0);
    echo "$result1"."$result2";
    if($result2[1]===0){
        echo "登陆失败，用户'$username'的密码输入错误！"."<br>";
        echo "<button onclick=\"window.location.href = 'login.html'\">返回登录页面</button>";
    }
    else{
        echo "登陆成功！"."<br>";
        header('Location:index.html');
    }
}
?>

