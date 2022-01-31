<?php
/*
*说明:这是微信支付接口类
*
*
*/
namespace app\pay\controller;

use think\Controller;
use think\Db;
use think\Loader;
use Yansongda\Pay\Pay;

class WechatPay extends Controller
{
 
  protected  $config;
  protected  $wechat;
  
  
  public function __construct(){
   
    //链接数据库获取配置信息
    $result=Db::name('pay')->find();
   // dump($result);
    //微信支付参数配置
   
    $this->config = [
    'appid' => $result["wx_id"], // APP APPID
    'app_id' => $result["wx_appid"], // 公众号 APPID
    'miniapp_id' => $result["wx_miniid"], // 小程序 APPID
    'mch_id' => $result["wx_mchid"],
    'key' => $result["wx_key"],  //微信密钥
    'notify_url' =>   ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/public/wechatPay_notify",   //异步回调url
    'return_url' =>   ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/public/wechatPay_return",  //同步通知地址       
    'cert_client' => './cert/apiclient_cert.pem', // optional, 退款，红包等情况时需要用到
    'cert_key' => './cert/apiclient_key.pem',// optional, 退款，红包等情况时需要用到
    'log' => [ // optional
        'file' => './logs/wechat.log',
        'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
        'type' => 'single', // optional, 可选 daily.
        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
    ],
    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
       ],
     'mode' => 'dev',  //是否为沙箱模式下
    ];
    
   //实例化微信支付类
   $this->wechat=Pay::wechat($this->config);
  }
  
  
  //微信支付接口
  public function WechatPay($pay_methods, $order=[]){
     /*
   *请求微信支付参数:
   *@param: pay_methods string 支付方法:(详情见:https://pay.yansongda.cn/docs/v2/wechat/pay.html#%E5%85%AC%E4%BC%97%E5%8F%B7%E6%94%AF%E4%BB%98)
      mp  公众号支付   
      wap  手机网站支付
      app   APP支付
      pos   刷卡支付
      scan  扫码支付
      transfer  账户转账
      mini     小程序支付
      redpack  普通红包
      groupRedpack 裂变红包
   *@param:  $order array  订单信息  (其中具体参数见:https://pay.yansongda.cn/docs/v2/alipay/pay.html#%E7%94%B5%E8%84%91%E6%94%AF%E4%BB%98)
   $order示例:
   $order = [
    'out_trade_no' => time(),
    'body' => 'subject-测试',
    'total_fee' => '1',
    'openid' => 'onkVf1FjWS5SBxxxxxxxx',
];
   */
  
  //请求方法封装
 // $pay_methods=$_POST["pay_methods"];
  /*$order= [
    'out_trade_no' => time(),
    'body' => 'subject-测试',
    'total_fee' => '1',
    'openid' => 'onkVf1FjWS5SBxxxxxxxx',
   ];
   */
  //(array)$_POST["order"];
  
  //实例化支付类
  $wechat = $this->wechat;
  
  //支付方法选择
  switch($pay_methods){
    
    case "mp":
       $result= $wechat->mp($order);
       break;
    case "app":
       return $wechat->app($order)->send();
       break;
    case "pos":
       $result = $wechat->pos($order);
       break;
    case "scan":
       $result = $wechat->scan($order);
      //二维码内容:$qr = $result->code_url;
       break;
    case "transfer":
       $result = $wechat->transfer($order);
       break;
    case "mini":
       $result = $wechat->miniapp($order);
       break;
    default:
       //默认手机网站支付
       return $wechat->wap($order)->send();
   }
   
   //获得支付宝服务器返回 Collection 类型的数据
   dump($result);
   //处理返回 Collection 类型数据↓↓↓↓↓↓$result
  }
  
  
  
  //同步通知地址
  public function wechatPay_return(){
 
  // 验证服务器数据
  $wechat = $this->wechat;
  $result = $wechat->verify(); // 返回 `Yansongda\Supports\Collection` 实例，可以通过 `$data->xxx` 访问服务器返回的数据。
  //dump($result)
  if($result==false){
   return "非法回调，签名验证失败！";
  }
  //否则返回回调数据Collection类型
  dump($result );
  //这里编写验证成功后的业务逻辑↓↓↓↓↓↓
  
  }
  
  //异步通知地址
  public function wechatPay_notify(){
 
  // 验证服务器数据
  $wechat = $this->wechat;
  $result = $wechat->verify(); // 返回 `Yansongda\Supports\Collection` 实例，可以通过 `$data->xxx` 访问服务器返回的数据。
  //dump($result)
  if($result==false){
   return "非法回调，签名验证失败！";
  }
  //否则返回回调数据Collection类型
  dump($result );
  //这里编写验证成功后的业务逻辑↓↓↓↓↓↓
  
  }
  
  
  
  
}