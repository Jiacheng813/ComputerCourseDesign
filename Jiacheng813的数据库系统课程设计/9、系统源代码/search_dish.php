<?php
include_once('connect_sql.php');
session_start();
$username=$_SESSION["用户名"];
$table_name='菜品信息';
$url=$_SERVER["REQUEST_URI"];///PHP/add_favourite_store.php?username=user1&store_id=1
$arr=GetUrlParameter($url);
$flag=1;
if(count($arr)>0){
    if($arr[0][0]==='mode'){
        if($arr[0][1]==='all'){
            $sql1="SELECT D.id AS 菜品id,D.名称,D.风味,D.菜系,D.所属店铺id 
            FROM 菜品信息表 AS D INNER JOIN 店铺信息表 AS S ON D.所属店铺id=S.id";
            $table1=SelectRecord($sql1);
            PrintDishs($table1,$table_name,$username);
            $flag=0;
        }
    }
}
if($flag){
    $name = $_POST["name"];
    $region = $_POST["region"];
    $flavour = $_POST["flavour"];
    echo "<style> body{text-align:center}</style>";
    echo "<div style=\"padding-top:40px;\">";
    $key_num=0;
    $sql="SELECT * FROM 菜品信息表 WHERE";
    if(!empty($name)){
        echo "菜品名称关键词：", $name, "<br>";
        $sql=$sql." 名称 like '%$name%'";
        $key_num++;
    }
    if(!empty($region)){
        echo "菜品菜系关键词：", $region, "<br>";
        if($key_num!=0) $sql=$sql." AND";
        $sql=$sql." 菜系 like '%$region%'";
        $key_num++;
    }
    if(!empty($flavour)){
        echo "菜品风味关键词：", $flavour, "<br>";
        if($key_num!=0) $sql=$sql." AND";
        $sql=$sql." 风味 like '%$flavour%'";
        $key_num++;
    }
    $table3=array();
    if($key_num>0) $table3=SelectRecord($sql);

    else{
        $table3=array(GetFieldNames('菜品信息表'),);
    }
    if($key_num===0){
        echo "无法搜索，您未输入任何关键词！<br>";
        return;
    }
    if(count($table3)<=1){
        echo "没有找到相关菜品！<br>";
    }
    else PrintDishs($table3,$table_name,$username);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>菜品搜索结果</title>
</head>
<body>
<style> body{text-align:center}</style>
<br>
<button onclick="window.location.href='index.html'">返回首页</button>
</body>
</html>

