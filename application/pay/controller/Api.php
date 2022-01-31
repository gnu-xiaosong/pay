<?php
namespace app\pay\controller;

use think\Controller;
use think\Db;
header('Access-Control-Allow-Origin:*'); 

class Api extends Controller{


   //监控PC端接口
    public function pc_cron(){

        // 接受参数
        $user_id = input("get.user_id");                          //商户id值
        $user_key = input("get.user_key");                        //商户秘钥
        
        $order_time = input("get.order_time");                    //订单创建时间
        $order_tenantOrderNo = input("get.order_tenantOrderNo");  //订单商户订单号
        $order_zfbOrderNo = input("get.order_zfbOrderNo");        //支付宝交易号
        $order_money = input("get.order_money");                   //订单金额
        $user1 = input("get.user");                                //买家信息
        $status = input("get.status");                            //交易状态

        // 用户验证
        $user = Db::name("user")->where("id", $user_id)->find();

        if(empty($user) || $user["key"] != $user_key){
            // 商户信息错误
            $data = array(
                "code" => 300,
                "msg" => "商户信息有误!"
            );
   
        }else{
    
            if($status=="成功"){
                // 监测订单是否已保存
                $d = Db::name("orderhistory")->where("tenantOrderNo", $order_tenantOrderNo)->find();
                // 改变订单状态 

                $max = Db::name("order")->where("user_id", $user_id)->where("type", 1)->max("id");

                //最新订单 金额验证
                $data1 = Db::name("order")->where("id", $max)->where("money", $order_money)->find();
                //判断是否为支付宝
                
               // 判断是否ok
                if (!empty($d)) {
                    // 该订单已经监听成功了，重复监听
                    $data = array(
                        "code" => 100,
                        "msg" => "云端订单号:" . $data1["order_no"] . ",订单已经监听成功了，重复监听!"
                    );

                }else if($data1["type"] == 1){
                    //改变状态
                    $res = Db::name("order")->where("order_no", $data1["order_no"])->update(["status" => 1]);
                    //存储成功订单信息
                    $insertData = array(
                        "userID" => $user_id,
                        "time" => $order_time,
                        "tenantOrderNo" => $order_tenantOrderNo,
                        "zfbOrderNo" => $order_zfbOrderNo,
                        "money" => $order_money,
                        "userInformation" => $user1,
                        "status" => $status
                    );
                    $re = Db::name("orderhistory")->insert($insertData);
                    if(!empty($res) && $re == 1){
                        $data = array(
                            "code" => 200,
                            "msg" => "监听订单号:" . $data1["order_no"] . ",成功!"
                        );
                    }else{
                        //该订单已支付成功
                        $data = array(
                            "code" => 600,
                            "msg" => "监听订单号:" . $data1["trade_no"] . ",已经支付完成，存在重复监听."
                        );
                    }
                }
            }else{
                // 商户信息错误
                $data = array(
                    "code" => 400,
                    "msg" => "有误!"
                );
            }
        }
         return json_encode($data, JSON_UNESCAPED_UNICODE);
    }



}