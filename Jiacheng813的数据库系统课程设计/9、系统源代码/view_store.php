<?php
include_once('connect_sql.php');
echo "<style> body{text-align:center}</style>";
echo "<div style=\"padding-top:40px;\"></div>";
$url=$_SERVER["REQUEST_URI"];///PHP/add_favourite_store.php?username=user1&store_id=1
$arr=GetUrlParameter($url);
$username=$arr[0][1];
$store_id=$arr[1][1];
$store_name=(SelectRecord("SELECT 名称 FROM 店铺信息表 WHERE id=$store_id"))[1][0];
$sql1="SELECT S.id AS 店铺id,S.名称 AS 店铺名,S.风味 AS 店铺风味,S.地址,D.名称 AS 菜品名,D.风味 AS 菜品风味,D.菜系,D.id AS 菜品id
FROM 店铺信息表 S INNER JOIN 菜品信息表 D ON S.id =D.所属店铺id WHERE S.id=$store_id ORDER BY 菜品id ASC";
echo "<h1>$store_name</h1>";
$sql2="SELECT 评分,评论,时间,用户名 FROM 用户评价店铺表 WHERE 店铺id=$store_id";
$table1=SelectRecord($sql1);
$table2=SelectRecord($sql2);
$table_name='店铺菜品信息';
$table_name2='用户评价';
PrintAsTable($table1,$table_name);
PrintAsTable($table2,$table_name2);
echo "<br><br><button onclick=\"window.open('comment_store.php?username=$username&store_id=$store_id','_self')\">评价店铺</button>";
echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
$arr2=SelectRecord("SELECT * FROM 用户收藏店铺表 WHERE 用户名='$username' AND 店铺id=$store_id");
if(count($arr2)<=1) {
    echo "<td><button onclick=\"window.open('add_favourite_store.php?username=$username&store_id=$store_id')\">收藏店铺</button></td>";
}
else{
    echo "<td><button onclick=\"window.open('cancel_favourite_store.php?username=$username&store_id=$store_id')\">取消收藏店铺</button></td>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>店铺信息</title>
</head>
<body>
<br><br>
<button onclick="window.open('index.html','_self')">返回首页</button>
<br><br>
<br><br>
</body>
</html>