<?php
/*
*介绍:这是同步通知处理
*时间:2021-2-27
*开发者:小松科技
*/

/****接口参数文档:
Methods:GET
接收参数:
@param: status   支付状态  int  1:成功;0:失败
@param: money   支付金额  int 
@param: type  支付类型 int  1：支付宝 2：QQ钱包 3：微信支付。默认值：1
@param: trade_no  商户网站订单编号 int 
@param: sign  签名  string
**/
require_once("lib/Sign.php");


$order=array(
  "sign"=>$_GET["sign"],
  "status"=>$_GET["status"],
  "money"=>$_GET["money"],
  "type"=>$_GET["type"],
  "trade_no"=>$_GET["trade_no"]
);

//验证签名算法
$result=new Sign($order);
$is=$result->verify_sign();

if($is){
//验证签名成功↓↓↓↓↓↓↓↓↓这里处理自己的业务逻辑

echo " 支付成功！";

}else{
//验证签名失败
echo "签名验证失败！";
}