<?php
/*
*说明:这是支付宝支付接口类
*
*
*/
namespace app\pay\controller;

use think\Controller;
use think\Db;
use think\Loader;
use Yansongda\Pay\Pay;

class Alipay extends Controller
{
 
  protected  $config;
  
  public function __construct(){
    //链接数据库获取配置信息
    $result=Db::name('pay')->find();
   // dump($result);
    //支付宝支付参数配置
    $this->config = [
    'app_id' => $result["alipay_id"],
    'notify_url' =>  ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/public/index.php/alipay_notify",
    'return_url' =>  ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/public/index.php/alipay_return",
    'ali_public_key' => $result["alipay_public_key"],  
    'private_key' =>$result["alipay_private_key"],
    'log' => [ // optional
        'file' => './logs/alipay.log',
        'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
        'type' => 'single', // optional, 可选 daily.
        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
    ],
    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ],
   //  'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];
    
  }
  
  

  
  
  public function alipay($pay_methods, array $order=[]){
   
   /*
   *请求支付宝支付参数:
   *@param: pay_methods string 支付方法:
      web  电脑支付  
      wap  手机网站支付
      app   APP支付
      pos   刷卡支付
      scan  扫码支付
      transfer  账户转账
      mini     小程序支付
   *@param:  $order array  订单信息  (其中具体参数见:https://pay.yansongda.cn/docs/v2/alipay/pay.html#%E7%94%B5%E8%84%91%E6%94%AF%E4%BB%98)
   $order示例:
   $order = [
    'out_trade_no' => time(),
    'total_amount' => '0.01',
    'subject'      => 'test subject-测试订单',
    // 'http_method'  => 'GET' // 如果想在 wap 支付时使用 GET 方式提交，请加上此参数。默认使用 POST 方式提交
    ];
   */
  
  //请求方法封装
 // $pay_methods=$_POST["pay_methods"];
 // $order=(array)$_POST["order"];
  
  //实例化支付类
  $alipay = Pay::alipay($this->config);
  
  //支付方法选择
  switch($pay_methods){
    
    case "web":
       //电脑支付
       return $alipay->web($order)->send();
       break;
    case "app":
       return $alipay->app($order)->send();
       break;
    case "pos":
       $result = $alipay->pos($order);
       break;
    case "scan":
       $result = $alipay->scan($order);
       break;
    case "transfer":
       $result = $alipay->transfer($order);
       break;
    case "mini":
       $result = $alipay->mini($order);
       break;
    default:
       //默认手机网站支付
       return $alipay->wap($order)->send();
   }
   
   //获得支付宝服务器返回 Collection 类型的数据
   dump($result);
   //处理返回 Collection 类型数据↓↓↓↓↓↓
  }
  
  
  
  
  //请求查询订单操作接口
  public function AlipayOperationCheck(){
    /*请求参数:
    *@param: type string 必填 支付操作行为类型:
        check_order  查询普通支付订单
        check_refund  查询退款订单
        check_transfer  查询转账订单
    *@param: out_trade_no string 必填 商家订单号   商家自定义且保证商家系统中唯一。与支付宝交易号 trade_no 不能同时为空。
    *@param: out_request_no string 可选 标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传。
    */
   $type=$_GET["type"];
   $out_trade_no=$_GET["out_trade_no"];   //商家订单号(支付传入的商家订单)
   $out_request_no=isset($_GET["out_request_no"])?$_GET["out_request_no"]:$out_trade_no;
   
   
   $order= [
    'out_trade_no' =>$out_trade_no
    ];
   //支付行为操作选择
   switch($type){
    case "check_refund":
       //查询退款订单
       $order["out_request_no"]=$out_request_no;
       $result = $alipay->find($order, 'refund');
       break;
    case "check_transfer":
       $result = $alipay->find($order, 'transfer');
       break;
    default:
       //默认查询全部订单
       $result = $alipay->find($order);
   }
  //返回
  //dump($result);
  return $result;
  }
  
  
  
    //退款操作接口
  public function AlipayOperationRefund(){
   /*请求参数:
    *@param: out_trade_no string  商家订单号   商家自定义且保证商家系统中唯一。与支付宝交易号 trade_no 不能同时为空。
    *@param: refund_amount string  退款金额，不能大于订单金额
    */
  $out_trade_no=$_GET["out_trade_no"];
  $refund_amount=$_GET["refund_amount"];
  
  $order = [
    'out_trade_no' => $out_trade_no,
    'refund_amount' => $refund_amount,
    ];
  
  $result = $alipay->refund($order);
  
  //返回Collection 类型，
  return $result;
  }
  
  
  
  
  
  //异步通知地址
  public function alipay_notify(){
  $alipay = Pay::alipay($this->config);
  //$alipay=$_GET;
  $re = $alipay->verify();
  if(!$re){
    return  "订单校验失败！如果您确实已经支付请与网站管理员联系核实！";
  }
  //校验成功
  $out_trade=(array)$re;
  //订单状态改变
  $result=Db::name('order')->where("out_trade_no", $out_trade["out_trade_no"])->update("status", 1);
  
  if($result==1){
   return "支付成功！";
  }
  return "支付失败！";
  }
  
  
  

  
  //同步通知地址
  public function alipay_return(){
  session_start();
  $alipay = Pay::alipay($this->config);
  //验证支付宝返回参数签名(成功:返回支付宝回调数据，失败:返回false)
  $re = $alipay->verify();
  if(!$re){
   return  "订单校验失败！如果您确实已经支付请与网站管理员联系核实！";
  }
  //验证成功，业务处理------$result array 回调数据
  /*支付宝回调参数:
  *@param: trade_no string 支付宝交易号
  *@param: out_trade_no string  商户订单号
  *@param: seller_id string  收款支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字	
  *@param: total_amount string  交易金额
  *@param: merchant_order_no string   商户原始订单号，最大长度限制32位
  */
  //校验成功
 // dump($re);
 $out_trade=(array)$re;
  
 foreach($out_trade as $item){
  $out_trade= $item;
  }
 
 // dump($out_trade);
  //订单状态改变
  $result=Db::name('order')->where("trade_no", $out_trade["out_trade_no"])->update(["status"=>1]);
  
  if(empty($result)){
   return "该订单不存在或已经支付成功！";
  }
  
  //支付成功，这里编写业务逻辑↓↓↓↓↓↓↓↓
  
  //查询订单信息
  $row=Db::name('order')->where("trade_no", $out_trade["out_trade_no"])->find();
  //获取商户的同步通知地址
  $user_return_url=$_SESSION["user_return_url"];  
  //封装参数返回给商户的通知地址
  //签名算法------------->md5   格式:status+money+order_no
  $sign=md5($row["status"].$row["money"].$row["trade_no"]);

  //跳转
  $query = '?sign='.$sign."&status=".$row["status"]."&money=".$row["money"]."&type=".$row["type"]."&trade_no=".$row["trade_no"]; //返回订单所需的参数
  $url = $user_return_url.$query; //支付页面
  
  echo "<script language='javascript' type='text/javascript'>";
  echo "window.location.href='".$url."'";
  echo "</script>";
  
  
 // echo $url ;
 // header("Location:".$url); //跳转到商户回调地址

  }
  }