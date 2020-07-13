<?php
include_once('connect_sql.php');
echo "<style> body{text-align:center}</style>";
echo "<div style=\"padding-top:80px;\"></div>";
$url=$_SERVER["REQUEST_URI"];///PHP/add_favourite_store.php?username=user1&store_id=1
$arr=GetUrlParameter($url);
$username=$arr[0][1];
$store_id=$arr[1][1];
$sql_statement2="SELECT * FROM 用户收藏店铺表 WHERE 用户名='$username' AND 店铺id='$store_id'";
$result2=SelectRecord($sql_statement2);
if(count($result2)>1){
    echo "您已收藏过该店铺！<br>";
}
else{
    $sql_statement="INSERT INTO 用户收藏店铺表(用户名,店铺id) VALUES('$username','$store_id')";
    $result=ExecuteSql($sql_statement,0);
    if($result[0]!=='SUCCESS'){
        echo "收藏失败！<br>";
        echo "错误为".$result[0]."<br>";
    }
    else{
        echo "收藏成功！";
    }
}
echo "<br><br><button onclick=\"window.open('favourite_store.php?','_self')\">我收藏的店铺</button>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>收藏结果</title>
</head>
<body>
<style> body{text-align:center}</style>
<br><br>
<button onclick="window.open('index.html','_self')">返回首页</button>
</body>
</html>

