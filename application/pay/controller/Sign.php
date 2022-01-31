<?php
namespace app\pay\controller;

use think\Controller;
use think\Db;

//这是签名算法类
class Sign{

  var $sign_param;
  function __construct(array $sign_param){
   $this->sign_param=$sign_param;
  }
  function verify_sign(){
  
   //签名算法规则:total_amount(金额)+trade_no(商户网站订单编号)+key(商户密钥)
   
    $sign=md5($this->sign_param["total_amount"].$this->sign_param["trade_no"].$this->sign_param["key"]);
    if($this->sign_param["sign"]== $sign){
     return true;
    }
    return false;
  }
}