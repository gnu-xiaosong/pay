<?php
//网页端付款状态循环请求状态接口
header('content-type:application:json;charset=utf8');  
include("./database.php");
//用于客服端请求数据处理
$user_id=$_GET["user_id"];  //商户id
$order_no=$_GET["order_no"];  //订单编号


// 设置PC端刷新订单指令  1代表启用  0代表关闭
$cron_tmp = 'cron.txt';
$order_no_tmp = 'order_no.txt';

// echo file_get_contents($order_no_tmp);
if(file_exists($cron_tmp) && !file_exists($order_no_tmp) || file_get_contents($order_no_tmp)!=$order_no){
    // 每次客户端请求标识-订单号
    file_put_contents($order_no_tmp, $order_no);
    //设置状态
    file_put_contents($cron_tmp, 1);
    
    @fclose($cron_tmp);
    @fclose($order_no_tmp);
}



//数据库订单查询支付订单状态
//连接数据库
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$sql="select * from pay_order where  user_id=".$user_id." and order_no="."\"".$order_no."\"";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
//var_dump($row);
if(empty($row)){
$data0=array(
'code'=>400,
'message'=>"该账单不存在！",
);
echo json_encode($data0);
exit();
}
//判断支付状态
if($row["status"]==0){
//未支付完成
$data1=array(
'code'=>300,
'message'=>"未支付完成，可能已掉单！",
);
echo json_encode($data1);
exit();
}
//支付状态完成
if($row["status"]==1){
$data=array(
'code'=>200,
'message'=>"支付成功！正在跳转中……",
);
echo json_encode($data);
exit();
}

$data3=array(
'code'=>500,
'message'=>"未知错误！",
);
echo json_encode($data3);
exit();