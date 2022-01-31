<?php
/*
* 功能:异步通知文件
* 开发者:小松科技
* 请求参数:
* 请求方法:get
* @param:trade_no string 商户网站订单编号
* @param:order_no string 云端订单编号
* @param:pay_status int  订单状态  1为完成 2超时未支付
*/

//请求参数封装
$yunReConfig["trade_no"]= $_GET["trade_no"];
$yunReConfig["order_no"]= $_GET["order_no"];
$yunReConfig["pay_status"]= $_GET["pay_status"];


if($yunReConfig["pay_status"]==1){
//-------------------------- 支付完成业务逻辑处理↓↓↓↓↓↓-----------------------------------

//--------------------在这里编写自己的业务逻辑---------------------------------

//demo测试
echo "<h1>恭喜您！支付成功！</h1><br><br>订单编号:".$_GET["trade_no"]."<br><br>云端订单编号:".$_GET["order_no"]."<br><br>支付状态:".$_GET["pay_status"];






//-------------------------- 支付完成业务逻辑处理↑↑↑↑↑↑-----------------------------------
}else{
echo "未知支付状态，已被云支付拦截！";
}