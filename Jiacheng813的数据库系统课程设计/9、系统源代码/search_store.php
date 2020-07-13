<?php
include_once('connect_sql.php');
session_start();
$username=$_SESSION["用户名"];
$table_name='店铺信息';
$url=$_SERVER["REQUEST_URI"];///PHP/add_favourite_store.php?username=user1&store_id=1
$mode=GetUrlParameterValue($url,"mode");
$order_key=GetUrlParameterValue($url,"order_key");
$order_mode=GetUrlParameterValue($url,"order_mode");
$flag=-1;
echo "<style> body{text-align:center}</style>";
echo "<div style=\"padding-top:40px;\">";
$name=""; $address=""; $flavour=""; $special_dish="";
if($mode){
    if($mode==='all'){
        $sql1="SELECT * FROM 店铺信息表";
        if($order_key) $sql=$sql." ORDER BY $order_key $order_mode";
        $table1=SelectRecord($sql1);
        PrintStores($table1,$table_name,$username);
        $flag=0;
    }
}
if($flag!==0){
//    if(($name=urldecode(GetUrlParameterValue($url,'name')))===false)
        $name = $_POST["name"];
//    if(($address=urldecode(GetUrlParameterValue($url,'address')))===false)
        $address = $_POST["address"];
//    if(($flavour=urldecode(GetUrlParameterValue($url,'flavour')))===false)
        $flavour = $_POST["flavour"];
//    if(($special_dish=urldecode(GetUrlParameterValue($url,'special_dish')))===false)
        $special_dish = $_POST["special_dish"];
    $key_num=0;
    $sql="SELECT * FROM 店铺信息表";
    if(!empty($name)){
        echo "店铺名称关键词：", $name, "<br>";
        if($key_num!=0) $sql=$sql." AND";
        else $sql=$sql." WHERE";
        $sql=$sql." 名称 like '%$name%'";
        $key_num++;
    }
    if(!empty($address)){
        echo "店铺地址关键词：", $address, "<br>";
        if($key_num!=0) $sql=$sql." AND";
        else $sql=$sql." WHERE";
        $sql=$sql." 地址 like '%$address%'";
        $key_num++;
    }
    if(!empty($flavour)){
        echo "食物风味关键词：", $flavour, "<br>";
        if($key_num!=0) $sql=$sql." AND";
        else $sql=$sql." WHERE";
        $sql=$sql." 风味 like '%$flavour%'";
        $key_num++;
    }
    $table3=array();
    if($key_num>0) $table3=SelectRecord($sql);
    else{
        $table3=array(GetFieldNames('店铺信息表'),);
    }
    if(!empty($special_dish)){
        echo "菜品关键词：", $special_dish,"<br>";
        $sql2="SELECT DISTINCT 所属店铺id FROM 菜品信息表 WHERE 名称 like '%$special_dish%'";
        $sql3="SELECT id,名称,风味,地址,评分 FROM ($sql) AS T1 INNER JOIN ($sql2) as T2 ON T1.id=T2.所属店铺id";
        if($order_key) $sql3=$sql3." ORDER BY $order_key $order_mode";
        $table3=SelectRecord($sql3);
        $key_num++;
    }
    if($key_num===0){
        echo "无法搜索，您未输入任何关键词！<br>";
        return;
    }
    if(count($table3)===1){
        echo "没有找到相关店铺！<br>";
    }
    else PrintStores($table3,$table_name,$username);
    $flag=1;
}
//if($flag!==-1){
//    $name=urlencode($address);
//    $flavour=urlencode($flavour);
//    $address=urlencode($address);
//    $special_dish=urlencode($special_dish);
//
//    $str1="search_store.php?name=$name&flavour=$flavour&address=$address&special_dish=$special_dish";
//    echo "<button onclick=\"window.location.href='$str1&order_key=评分&order_mode=desc'\">按评分降序排序</button>";
//    echo "<button onclick=\"window.location.href='$str1&order_key=评分&order_mode=asc'\">按评分升序排序</button>";
//    echo "<button onclick=\"window.location.href='$str1&order_key=名称&order_mode=asc'\">按店铺名称排序</button>";
//    echo "<button onclick=\"window.location.href='$str1&order_key=风味&order_mode=asc'\">按店铺风味排序</button>";
//    echo "<button onclick=\"window.location.href='$str1&order_key=id&order_mode=asc'\">按店铺id排序</button>";
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>店铺搜索结果</title>
</head>
<body>
<style> body{text-align:center}</style>
<br>
<button onclick="window.location.href='index.html'">返回首页</button>
</body>
</html>
