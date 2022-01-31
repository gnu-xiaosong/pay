<?php
//接口参数处理(网页端数据提交处理)
//释放session值
unset($_SESSION);
session_start();
include("./database.php");
require_once("./lib/yunPay_md5.function.php");
/****接口参数文档:
Methods:GET
@param: id   云支付商户id  int
@param: key  云支付商户秘钥  string
@param: token MD5加密  云端存储为准
@param: type  支付类型 int  1：支付宝 2：QQ钱包 3：微信支付。默认值：1
@param: pay_act_type  付款类型 int 1即时到账 2代收款
@param: pay_id   (唯一标识) 用户ID,订单ID,用户名确保是唯一
@param: param   自定义字段，数据原路返回
@param: notify_url 异步通知地址  string ( 系统保留为最好级别)付款后POST通知
@param: return_url 同步通知地址 用于付款成功后跳转地址
@param: sign  MD5签名   (可选)
@param: chart 字符编码
@param: page_type 付款页面方式 int 1 默认页面
@param: outTime 二维码超时时间
@param: pay_type  是否启动官方支付接口 0为启用 1为关闭 默认1
@param: qrcode_url 二维码url自定义控制  默认为上传的收款码url
@param: pay_tag 订单备注
@param: goods_name 商品名
@param: money 实际付款金额
@param: price   原价
@param: order_no  云端流水号(订单编号)
**/


/*↓↓↓↓↓↓↓↓本页面处理参数↓↓↓↓↓↓
@param: outTime 二维码超时时间
@param: type  支付类型 int  1：支付宝 2：QQ钱包 3：微信支付。默认值：1
@param: page_type 付款页面方式 int
@param: pay_tag 订单备注
@param: money 实际付款金额
@param: price   原价
*/
//接收数据的请求↓↓↓↓↓↓↓↓↓↓默认参数设置↓↓↓↓↓↓↓↓↓↓↓↓↓↓
$order=array(
 "id"=>isset($_GET["id"])?$_GET["id"]:10001,
 "key"=>isset($_GET["key"])?$_GET["key"]:"xskj666",
 "token"=>isset($_GET["token"])?$_GET["token"]:49466565,
 "price"=>isset($_GET["price"])?$_GET["price"]:1314520,
 "type"=>isset($_GET["type"])?$_GET["type"]:1, //(支付宝1,微信2, QQ3)
 "pay_act_type"=>isset($_GET["type"])?$_GET["type"]:1,
 "pay_id"=>isset($_GET["pay_id"])?$_GET["pay_id"]:1,
 "param"=>isset($_GET["param"])?$_GET["param"]:10001,
 "notify_url"=>isset($_GET["notify_url"])?$_GET["notify_url"]:10001,  //异步加载
 "return_url"=>isset($_GET["return_url"])?$_GET["return_url"]:"http://www.xskj.store", //同步跳转
 "sign"=>isset($_GET["sign"])?$_GET["sign"]:10001,
 "chart"=>isset($_GET["chart"])?$_GET["chart"]:10001,
 "page_type"=>isset($_GET["page_type"])?$_GET["page_type"]:0,
 "outTime"=>isset($_GET["outTime"])?$_GET["outTime"]:10001,
 "pay_type"=>isset($_GET["pay_type"])?$_GET["pay_type"]:10001,
 "qrcode_url"=>isset($_GET["qrcode_url"])?$_GET["qrcode_url"]:"http://www.xskj.store",
 "pay_tag"=>isset($_GET["pay_tag"])?$_GET["pay_tag"]:"未备注商品",//订单备注
 "money"=>isset($_GET["money"])?$_GET["money"]:1, //订单备注
 "goods_name"=>isset($_GET["goods_name"])?$_GET["goods_name"]:"我是商品名",//商品名称
 "trade_no"=>isset($_GET["trade_no"])?$_GET["trade_no"]:10000001,        //订单编号(用户端真实流水号)
 "account"=>isset($_GET["account"])?$_GET["account"]:17585891151,
 "description"=>isset($_GET["description"])?$_GET["description"]:"未描述商品",
 "category"=>isset($_GET["category"]) ? $_GET["category"] : "无分类"
);
//利用session让文件共享参数
$_SESSION["id"]=$order["id"];  //商户id
$_SESSION["return_url"]=$order["return_url"];
$_SESSION["type"]=$order["type"];  //支付类型(支付宝1,微信2, QQ3)
$_SESSION["pay_id"]=$order["pay_id"];   //用户
$_SESSION["order_no"]=$order["id"].$order["pay_id"].date('YmdHis'); //云端订单编号
$_SESSION["trade_no"]=$order["trade_no"];                      //订单编号(用户端真实编号)
$order1=$order["id"].$order["pay_id"].date('YmdHis');  //订单编号
//商户验证并通过session设置收款码url传递给qr.php

//连接数据库
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
//商户信息认证
$sql="SELECT * FROM pay_user where id=".$order["id"];
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
//var_dump($row);
if(empty($row)){
echo "该商户不存在！";
exit();
}
//验证签名sign: token+money+   key
//生成签名
$sign=md5Sign($order["money"].$order["trade_no"],$row["key"]);


//验证签名
if($sign!=$order["sign"]){
echo "签名验证错误！可能原因是商户密钥不正确";
exit();
}

/**************必传参数**********************
user_id
money
pay_act_type
pay_tag
goods_name
type
order_no
pay_id     //必传 int类型   用户唯一标识
***********************************************/

//验证成功  将订单(未支付状态)写入数据库
$status=0;     //支付状态 0未支付 1支付  默认未支付仅创建
//$sql1 = 'INSERT INTO pay_order(user_id,money, pay_act_type, pay_tag, status,goods_name,type ,order_no) VALUES ('.$order["id"].','.$order["money"].','.$order["pay_act_type"].','.$order["pay_tag"].','.$status.','.$order["goods_name"].','.$order["type"].','.$order["order_no"].')';
$sql1 ="INSERT INTO ".
"pay_order".
"(user_id,      pay_id ,  money,           pay_act_type,               pay_tag,     status,      goods_name,         type ,         order_no ,     trade_no ,    description, category)".
"VALUES ".
"(".$order["id"].','.$order["pay_id"].",".$order["money"].','.$order["pay_act_type"].','."\"".$order["pay_tag"]."\"".','.$status.','."\"".$order["goods_name"]."\"".','.$order["type"].','.$order1.',"'.$order["trade_no"].'",'.'"'.$order["description"].'"'.',"'.$order["category"].'")';





$re=mysqli_query($conn, $sql1);
if ($re) {
    //写入订单successful,判断用户是否传回qr_url
    if($order["qrcode_url"]==0){
    //默认使用云端qrcode_url
    $_SESSION['qrcode_url']=$row["qr_url"];
    }else{
    //使用用户自定义qrcode_url
    $_SESSION['qrcode_url']=$order["qrcode_url"];
    }
    //跳转二维码页面
     if($order["page_type"]==1){

     }else if($order["page_type"]==2){

     }else{
     //默认付款页面
     header("location:payPage/pay_pages_default.php?money=".$order["money"]."&account=".$order["account"]."&order_no=".$order1."&outTime=".$order["outTime"]);
      }
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}