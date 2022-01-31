<?php
/*
*说明:这是聚合支付接口类
*
*
*/
namespace app\pay\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
 
  var  $alipay;
  var  $wechat;
  var  $thirdpay;

  
  public function __construct(){
   //实例化各支付类↓↓↓↓↓
   

   //实例化第三方支付类
 //  $this->thirdpay=new Thirdpay();
   //实例化签名验证类
  }
  
  
  
  //生成订单接口(写入数据库)
  public function pay(){
    /*
    *说明:该接口为集成支付接口方法(聚合支付接口)
    *methods:GET
    *@param: id int  商户id [必传]
    *@param: sign string  签名  [必传]  //签名算法规则:total_amount(金额)+trade_no(商户网站订单编号)+key(商户密钥)
    *@param: trade_no string  商户网站订单编号  [必传]
    *@param: type int    支付类型   [必传]      1:支付宝；2:微信;3:云支付
    *@param: subject  商品名   [必传]
    *@param: total_amount  金额   [必传]
    *@param: description string  订单描述   [必传]
    *@param: remark string  订单备注   [必传]
    *@param: category string  商品类别  [必传]
    *@param: yun_type int  云支付支付类型(1:支付宝(默认);2:微信;3:易支付;4:码支付)   [可传]
    *@param: pay_methods string  支付方法(部分接口参数)  [可选] 
    *@param: return_url string   商户同步通知地址  [必传]
    *@param: notify_url string    商户异步通知地址  [可选]
    */
    
    session_start();
    
    $id=input('get.id');   //商户id
    $sign=input('get.sign');  //签名------>签名算法:md5;签名规则: total_amount+trade_no+key
    $type=input('get.type');  //支付类型:   1:支付宝；2:微信;3:云支付
   
    $trade_no=input('get.trade_no');    //商户网站订单编号
    $total_amount=input('get.total_amount');  //订单金额
    $subject=input('get.subject');  //商品名称
    $description=input('get.description'); //商品描述
    $remark=input('get.remark');  //商品备注
    $category=input('get.category');  //商品分类
    $yun_type=input('get.yun_type');  //云监控支付类型
    $notify_url=input('get.notify_url'); //异步通知
    $return_url=input('get.return_url'); //同步通知
 
    
    $pay_methods=isset($_GET["pay_methods"])?$_GET["pay_methods"]:"web"; 
   
   
   //设置用户回调的同步通知地址
   $_SESSION["user_return_url"]=$return_url;  
   
   
   //判断商户是否存在
   $result=Db::name('user')->where('id', $id)->find();
   
   if(empty($result)){
     return "该商户不存在！";
   }
   
   
   //签名验证参数封装
    $sign_param=array(
      "sign"=>$sign,
      "total_amount"=>$total_amount,
      "trade_no"=>$trade_no,
      "key"=>$result["key"]
    );
   //签名验证
   $sign1=new Sign($sign_param);
   //判断结果
   if(!$sign1->verify_sign()){
       return "商户签名验证失败！";
   }
   
   
   
   
   //根据商户设置的付款方式选择接口
   /*
   *规则
   *1:支付宝；2:微信；云支付:3
   */
  if($type==3){
   
   //跳转云支付监控支付接口
   //参数
   //提交发起请求
   
   $url="/pay/api.php"
   ."?id=".$id
   ."&sign=".$sign
   ."&type=".$yun_type
   ."&notify_url=".$notify_url
   ."&return_url=".$return_url
   ."&money=".$total_amount
   ."&trade_no=".$trade_no
   ."&goods_name=".$subject
   ."&pay_tag=".$remark
   ."category=".$category
   ."&description=".$description;
   
   echo "<script language='javascript' type='text/javascript'>";
   echo "window.location.href='".$url."'";
   echo "</script>";
   
   return ;
  }
  
  //生成订单写入数据库中
    $insert=[
    "user_id"=>$id,
    "money"=>$total_amount,
    "type"=>$type, //支付方式
    "pay_tag"=>$remark,
    "description"=>$description,
    "goods_name"=>$subject,
    "category"=>$category,
    "order_no"=>$id.date('YmdHis'), //云端订单编号
    "trade_no"=>$trade_no,
    "status"=>0
    ];
    
  $insertResult=Db::name('order')->insert($insert);
  
  if(empty($insertResult)){
    return "订单插入数据库失败！";
  }
  
  
  if($type==1){
    //官方支付宝
    //封装数据调用alipay支付接口
    //实例化支付宝支付类
   $this->alipay=new Alipay();

   $order = [
    'out_trade_no' => $trade_no,
    'total_amount' => $total_amount,
    'subject'      => $subject
    ];
   return  $this->alipay->alipay($pay_methods, $order);
  }else if($type==2){
  //官方微信支付
  //封装数据调用微信支付
  //实例化微信支付类
  $this->wechat=new WechatPay();
   $order = [
    'out_trade_no' => $trade_no,
    'total_amount' => $total_amount,
    'subject'      => $subject
    ];
   $this->wechat($pay_methods, $order);
  }
  
  }
  
}