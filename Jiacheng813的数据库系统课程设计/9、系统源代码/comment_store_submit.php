<?php
include_once("connect_sql.php");
$url=$_SERVER["REQUEST_URI"];///PHP/add_favourite_store.php?username=user1&store_id=1
$username=GetUrlParameterValue($url,"username");
$store_id=GetUrlParameterValue($url,"store_id");
$score=$_POST["score"];
$comment=$_POST["comment"];
echo "<style> body{text-align:center}</style>";
echo "<div style=\"padding-top:80px\"></div>";
date_default_timezone_set('prc');
$time_str= date('Y年m月d日 H:i:s',time());
$sql="INSERT INTO 用户评价店铺表 (用户名,店铺id,评分,评论,时间) VALUES('$username',$store_id,$score,'$comment','$time_str')";
$result=ExecuteSql($sql,0);
if($result[0]==='SUCCESS'){
    echo "评价成功！";
}
else{
    echo "评价失败！<br>";
    echo "错误：$result[0]<br>$result[1]";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>评价结果</title>
</head>
<body>
<style> body{text-align:center}</style>
<br><br>
<button onclick="window.open('index.html','_self')">返回首页</button>
</body>
</html>

