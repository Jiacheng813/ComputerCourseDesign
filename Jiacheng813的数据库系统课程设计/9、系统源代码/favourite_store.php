<?php
include_once('connect_sql.php');
session_start();
$username=$_SESSION["用户名"];
$sql1="SELECT 店铺id FROM 用户收藏店铺表 WHERE 用户名='$username'";
$table_name='我收藏的店铺';
$table2=array(GetFieldNames('店铺信息表'),);
$table1=SelectRecord($sql1);
for($i=1;$i<count($table1);++$i){
    $store_id=$table1[$i][0];
    $sql2="SELECT * FROM 店铺信息表 WHERE id='$store_id'";
    $table_temp=SelectRecord($sql2);
    array_push($table2,$table_temp[1]);
}
if(count($table2)===1){
    echo "<div style=\"padding-top:80px;\"></div>";
    echo "您还未收藏任何店铺！";
}
else{
    PrintStores($table2,$table_name,$username);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我收藏的店铺</title>
</head>
<body>
<style> body{text-align:center}</style>
<br><br>
<button onclick="window.open('my_account.php','_self')">返回我的账号</button>
<br><br>
<button onclick="window.open('index.html','_self')">返回首页</button>
</body>
</html>
