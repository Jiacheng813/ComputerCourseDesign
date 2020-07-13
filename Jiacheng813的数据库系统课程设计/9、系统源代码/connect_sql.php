<?php
function ConnectSql(){
    $db_host = 'localhost';//主机名
    $db_user = 'root';//用户名
    $db_password = '';//密码
    $db_name = 'homework1'; //数据库名
    $db_port = '3308';//端口
    $conn = mysqli_connect($db_host.":".$db_port,$db_user,$db_password,$db_name);//连接数据库
    if(!$conn) {
            die('连接数据库失败！');
    }
    // 设置编码，防止中文乱码
    mysqli_select_db( $conn, $db_name );
    mysqli_query($conn , "set names utf8");
    return $conn;
}
function ExecuteSql($sql_statement,$isPrint){
    $sql_statement_array=explode(" ",$sql_statement);
    $table_name=$sql_statement_array[3];
    $row_num_of_result=0;
    $conn=ConnectSql();
    if(empty($sql_statement)){
        $sql = "SELECT * FROM $table_name";
    }
    else{
        $sql=$sql_statement;
    }
    $result = mysqli_query( $conn, $sql );
    if(!$result ){
        return array(mysqli_error($conn),$row_num_of_result);
    }
    if($sql_statement_array[0]==='SELECT'|| $sql_statement_array[0]==='select'){
        $row_num_of_result=mysqli_num_rows($result);
        if($isPrint){
            if($row_num_of_result===0) return array('SUCCESS',$row_num_of_result);
            $field_num= mysqli_num_fields($result);
            $field_names=array();
            while ($field_info = mysqli_fetch_field($result)) {
                array_push($field_names,$field_info->name);
            }
            echo '<p style="font-size:40pt;color:black;text-align:center">'.$table_name.'<p>';
            echo "<br>";
            echo '<table border="1" width="800" align="center">';
            for($i=0;$i<$field_num;$i++)
            {
                echo "<td>$field_names[$i]  </td>";
            }
            echo "<br>";
            while($row = mysqli_fetch_array($result))
            {
                echo '<tr>';
                for($i=0;$i<$field_num;$i++)
                {
                    echo "<td>{$row[$field_names[$i]]}</td>";
                }
                echo '</tr>';
            }
            echo '</table>';
        }
    }
    mysqli_close($conn);
    return array('SUCCESS',$row_num_of_result);
}

function SelectRecord($sql_statement){//返回二维数组，只能传入SELECT语句
    $result=array();
    $conn=ConnectSql();
    $query_retval = mysqli_query( $conn, $sql_statement);
    if(!$query_retval){
        echo mysqli_error($conn);
        return $result;
    }
    $field_names=array();
    while ($field_info = mysqli_fetch_field($query_retval)) {
        array_push($field_names,$field_info->name);
    }
    array_push($result,$field_names);
    while($row = mysqli_fetch_array($query_retval,MYSQLI_NUM)){
        array_push($result,$row);
    }
    mysqli_close($conn);
    return $result;
}
function GetFieldNames($table_name){
    $result=array();
    $sql_statement="SELECT * FROM $table_name";
    $conn=ConnectSql();
    $query_retval = mysqli_query( $conn, $sql_statement);
    if(!$query_retval){
        echo mysqli_error($conn);
        return $result;
    }
    while ($field_info = mysqli_fetch_field($query_retval)) {
        array_push($result,$field_info->name);
    }
    return $result;
}
function PrintAsTable($arr,$table_name){
    echo '<table border="1" width="600" align="center">';
    echo "<caption><h2>"."$table_name"."</h2></caption>";
    echo '<tr bgcolor="#dddddd">';
    foreach ($arr[0] as $col_name) {
        echo "<th>$col_name</th>";
    }
    echo "</tr>";
    for($row=1;$row<count($arr);$row++){
        echo "<tr>";
        for($col=0;$col<count($arr[$row]);$col++){
            echo "<td>".$arr[$row][$col]."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
function PrintStores($arr,$table_name,$username){
    echo '<table border="1" width="600" align="center">';
    echo "<caption><h2>".$table_name."</h2></caption>";
    echo '<tr bgcolor="#dddddd">';
    $store_id_i=-1;
    for($i=0;$i<count($arr[0]);++$i) {
        $col_name=$arr[0][$i];
        if($col_name==='id'){
            $store_id_i=$i;
            break;
        }
    }
    for($i=0;$i<count($arr[0]);++$i) {
        $col_name=$arr[0][$i];
        echo "<th>$col_name</th>";
    }
    echo "<th>进入店铺</th>";
    echo "<th>收藏</th>";
    echo "</tr>";
    for($row=1;$row<count($arr);$row++){
        $store_id=$arr[$row][$store_id_i];
        echo "<tr>";
        for($col=0;$col<count($arr[$row]);$col++){
            echo "<td>".$arr[$row][$col]."</td>";
        }
        echo "<td><button onclick=\"window.open('view_store.php?username=$username&store_id=$store_id')\">进入店铺页面</button></td>";
        $arr2=SelectRecord("SELECT * FROM 用户收藏店铺表 WHERE 用户名='$username' AND 店铺id=$store_id");
        if(count($arr2)<=1) {
            echo "<td><button onclick=\"window.open('add_favourite_store.php?username=$username&store_id=$store_id')\">收藏</button></td>";
        }
        else{
            echo "<td><button onclick=\"window.open('cancel_favourite_store.php?username=$username&store_id=$store_id')\">取消收藏</button></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
function PrintDishs($arr,$table_name,$username){
    echo '<table border="1" width="600" align="center">';
    echo "<caption><h2>".$table_name."</h2></caption>";
    echo '<tr bgcolor="#dddddd">';
    $store_id_i=-1;
    for($i=0;$i<count($arr[0]);++$i) {
        $col_name=$arr[0][$i];
        if($col_name==='所属店铺id'){
            $store_id_i=$i;
            break;
        }
    }
    for($i=0;$i<count($arr[0]);++$i) {
        $col_name=$arr[0][$i];
        echo "<th>$col_name</th>";
    }
    echo "<th>所属店铺名</th>";
    echo "<th>操作</th>";
    echo "</tr>";
    for($row=1;$row<count($arr);$row++){
        echo "<tr>";
        for($col=0;$col<count($arr[$row]);$col++){
            echo "<td>".$arr[$row][$col]."</td>";
        }
        $store_id=$arr[$row][$store_id_i];
        $arr2=SelectRecord("SELECT 名称 FROM 店铺信息表 WHERE id='$store_id'");
        echo"<td>".$arr2[1][0]."</td>";
        echo "<td><button onclick=\"window.open('view_store.php?username=$username&store_id=$store_id')\">进入店铺页面</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}
function CheckUserInfo1($username,$password){
    if(empty($username)){
        echo "用户名不能为空！","<br>";
        return 0;
    }
    if(strlen($username)>30){
        echo "用户名长度过长！","<br>";
        return 0;
    }
    if(empty($password)){
        echo "密码不能为空！","<br>";
        return 0;
    }
    if(strlen($password)>30){
        echo "密码长度过长！","<br>";
        return 0;
    }
    return 1;
}
function CheckUserInfo2($nickname,$birthdate,$address){
    if(strlen($nickname)>20){
        echo "昵称长度过长！","<br>";
        return 0;
    }
    if(empty($nickname)){
        echo "昵称不能为空！","<br>";
        return 0;
    }
    if(strlen($birthdate)!==8||!is_numeric($birthdate)){
        echo "生日格式不规范！","<br>";
        return 0;
    }
    if(empty($address)){
        echo "地址不能为空！","<br>";
        return 0;
    }
    return 1;
}
function GetUrlParameter($url){//返回[n][2]的数组，n为参数组数
    $result=array();
    $str1=substr(strstr($url,'?'),1);
    $arr1=explode('&',$str1);
    foreach ($arr1 as $elem){
        $key=strstr($elem,'=',true);
        $value=substr(strstr($elem,'='),1);
        array_push($result,array($key,$value));
    }
    return $result;
}
function GetUrlParameterValue($url,$key_name){
    $str1=substr(strstr($url,'?'),1);
    $arr1=explode('&',$str1);
    $arr2=array();
    foreach ($arr1 as $elem){
        $key=strstr($elem,'=',true);
        $value=substr(strstr($elem,'='),1);
        array_push($arr2,array($key,$value));
    }
    foreach ($arr2 as $pair){
        if($pair[0]===$key_name){
            return $pair[1];
        }
    }
    return false;
}
?>