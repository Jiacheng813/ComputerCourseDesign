<?php
include_once('connect_sql.php');
$username = $_POST["用户名"];
$password = $_POST["密码"];
$nickname = $_POST["昵称"];
$birthdate = $_POST["生日"];
$address=$_POST['地址'];
$wait_seconds=5;
echo "<style> body{text-align:center}</style>";
echo "<div style=\"padding-top:80px;\"></div>";
if(!CheckUserInfo2($nickname,$birthdate,$address)){
    echo "账号信息修改失败！<br>";
}
else{
    $sql_statement="UPDATE 用户信息表 SET 昵称='$nickname',生日='$birthdate',地址='$address' WHERE 用户名='$username'";
    $result=ExecuteSql($sql_statement,0);
    if($result[0]==='SUCCESS') echo "账号信息修改成功！<br>";
    else{
        echo "账号信息修改失败！<br>";
        echo "$result[0]"."<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的账号-信息修改</title>
</head>
<body>
<style> body{text-align:center}</style>
<br>
<button onclick="window.location.href='my_account_modify.php'">返回修改页面</button>
<br><br>
<button onclick="window.location.href='index.html'">返回首页</button>
</body>
</html>
