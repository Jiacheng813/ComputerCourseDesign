<?php
include_once('connect_sql.php');
$url=$_SERVER["REQUEST_URI"];///PHP/add_favourite_store.php?username=user1&store_id=1
$username=GetUrlParameterValue($url,"username");
$store_id=GetUrlParameterValue($url,"store_id");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>评价店铺</title>
</head>
<style> body{text-align:center}</style>
<div style="padding-top:40px"></div>
<h2>评价店铺</h2>
<form id=form1 action="comment_store_submit.php" method="post">
    <label>评分：</label>
    <select name="score">
        <option value=0>0</option>
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
        <option value=6>6</option>
        <option value=7>7</option>
        <option value=8>8</option>
        <option value=9>9</option>
        <option value=10>10</option>
    </select>
    <label>分</label>
    <br><br>
<!--    <label>评论：</label>-->
    评论：<br>
    <textarea name="comment" style="width:300px;height:150px;resize:none"></textarea>
<!--    <input type="text" name="comment" value="" style="height: 50px;width: 150px">-->
    <br><br>
    <input type="submit" value="提交评价">
    <br><br>
</form>
<button id=button1 onclick="window.location.href='index.html'">返回首页</button>
<script type="text/javascript">
function getQueryVariable(variable){
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if(pair[0] == variable){return pair[1];}
    }
    return(false);
}
document.getElementById("form1").action="comment_store_submit.php?username="+getQueryVariable("username")+"&store_id="+getQueryVariable("store_id");
</script>
</body>
</html>
