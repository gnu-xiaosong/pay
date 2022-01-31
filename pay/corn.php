<?php
include("./database.php");
//监听文件

if(isset($_GET["id"])==false||isset($_GET["key"])==false||isset($_GET["money"])==false||isset($_GET["type"])==false){
echo "禁止访问！";
exit();
}

//读取数据库中指定id的最新一条订单
$id=$_GET["id"];             //商户id值
$key=$_GET["key"];         //商户密钥
$money=(float)$_GET["money"];  //获取监听软件监听到的到账金额
$type=$_GET["type"];    //支付类型(支付宝1,微信2, QQ3)



//连接数据库
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

//商户信息认证
$sql="SELECT * FROM pay_user where id=".$id;
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
//var_dump($row);
if(empty($row)){
echo "该商户不存在！";
exit();
}
if($row["key"]!=$key){
echo "商户密钥不正确！";
exit();
}

//查询数据库最新订单表信息

$sql1="SELECT * from pay_order where user_id=".$id." AND  id=(SELECT max(id) FROM pay_order WHERE user_id=".$id.")";



//$sql1="select * from pay_order where user_id=".$id." order by time desc limit 1";
$result1=mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);
//var_dump($row1);

//金额数量验证
if((float)$row1["money"]!=$money){
echo "未检测最新订单！或已掉单，验证失败！";
exit();
}else if((int)$row1["type"]!=(int)$type){
//支付类型确认判断
echo "支付类型监听错误！验证失败！";
exit();
}



//获取订单编号
$order=$row1["order_no"];

//将最新订单状态的status改为1 支付状态
$sql2='UPDATE pay_order SET status=1 WHERE order_no="'.$order.'" ';
$result2=mysqli_query($conn, $sql2);
//var_dump($result2);
if(!$result2){
echo "修改支付订单状态失败！";
exit();
}
echo "监听成功ok！订单号:".$order;