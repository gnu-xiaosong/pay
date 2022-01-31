<?php
/*
*说明:这是支付成功return_url通知处理
*/
session_start();
include("./database.php");

//获取支付成功订单编号
$order_no=$_SESSION["order_no"];
//获取商户通知地址
$return_url=$_SESSION["return_url"];

//查询数据库获取订单信息
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$sql="select * from pay_order where  order_no=".$order_no;
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);


//数据封装跳转

/****接口参数文档:
Methods:GET
@param: status   支付状态  int  1:成功;0:失败
@param: money   支付金额  int 
@param: type  支付类型 int  1：支付宝 2：QQ钱包 3：微信支付。默认值：1
@param: order_no  订单编号 int 
**/

//签名算法------------->md5   格式:status+money+order_no
$sign=md5($row["status"].$row["money"].$row["trade_no"]);


//跳转
$query = '?sign='.$sign."&status=".$row["status"]."&money=".$row["money"]."&type=".$row["type"]."&trade_no=".$row["trade_no"]; //返回订单所需的参数
$url = $return_url.$query; //支付页面


header("Location:{$url}"); //跳转到支付页面
