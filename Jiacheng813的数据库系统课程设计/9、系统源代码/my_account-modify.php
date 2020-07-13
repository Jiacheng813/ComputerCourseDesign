<?php
include_once('connect_sql.php');
session_start();
$username=$_SESSION["用户名"];
$sql_statement="SELECT * FROM 用户信息表 WHERE 用户名='$username'";
$arr=SelectRecord($sql_statement);
$table_name='我的信息';
echo "<style> body{text-align:center}</style>";
echo "<form action=\"my_account-modify_check.php\" method=\"post\" target='_blank'>";
echo '<table border="1" width="600" align="center">';
echo "<caption><h1>"."$table_name"."</h1></caption>";
echo '<tr bgcolor="#dddddd">';
foreach ($arr[0] as $col_name) {
    if($col_name==='用户名') $col_name=$col_name."(不可修改)";
    echo "<th>$col_name</th>";
}
echo "</tr>";
for($row=1;$row<count($arr);$row++){
    echo "<tr>";
    for($col=0;$col<count($arr[$row]);$col++){
        $key_str=$arr[0][$col];
        $val_str=$arr[$row][$col];
        if($key_str==='用户名'){
            echo "<td><input type='text' name=\"$key_str\" value=\"$val_str\" readonly=\"true\"></td>";
        }
        else{
            echo "<td><input type='text' name=\"$key_str\" value=\"$val_str\"></td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
echo "<br><br>";
echo "<input id=log type=\"submit\" value=\"提交修改\">";
echo "</form>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的账号-信息修改</title>
</head>
<body>
<style> body{text-align:center}</style>
<button onclick="window.location.href='my_account.php'">返回我的账户</button>
</body>
</html>
