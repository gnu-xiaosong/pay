<?php

//这是签名算法类
class Sign{

  var $order;
  function __construct(array $order){
   $this->order=$order;
  }
  function verify_sign(){
   //签名算法
    $sign=md5($this->order["status"].$this->order["money"].$this->order["trade_no"]);
    if($this->order["sign"]== $sign){
     return true;
    }
    return false;
  }
}