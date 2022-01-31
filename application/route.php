<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//规则:('替换名','所在模块名/类名/方法名');
use  think\Route;


//管理员接口路由配置

//管理员登陆接口
Route::rule('admin_login','admin/Index/admin_login');
//请求订单列表
Route::rule('getAdminOrderList','admin/Index/getAdminOrderList');
//请求搜索订单
Route::rule('getAdminSearchOrderList','admin/Index/getAdminSearchOrderList');
//请求删除订单
Route::rule('delOrderAll','admin/Index/delOrderAll');
//请求商户列表
Route::rule('getAdminUserList','admin/Index/getAdminUserList');
//请求搜索商户
Route::rule('getAdminSearchUserList','admin/Index/getAdminSearchUserList');
//请求删除商户
Route::rule('delUserAll','admin/Index/delUserAll');
//请求修改管理员信息
Route::rule('setAdmin','admin/Index/setAdmin');
//请求管理员信息
Route::rule('getAdmin','admin/Index/getAdmin');
//请求后台分析页数据显示路由
Route::rule('getAdminIndex','admin/Index/getAdminIndex');
//发送邮件接口路由
Route::rule('sendMail','admin/Index/sendMail');
//请求邮件配置信息路由
Route::rule('getEmail','admin/Index/getEmail');
//设置邮件配置信息路由
Route::rule('setEmail','admin/Index/setEmail');
//设置邮件配置信息路由
Route::rule('getSystem','admin/Index/getSystem');
//后台管理模版
Route::rule('admin','admin/Index/admin');
//请求支付配置信息路由
Route::rule('getPaySettingData','admin/Index/getPaySettingData');
//设置支付配置信息路由
Route::rule('setPaySettingData','admin/Index/setPaySettingData');






//商户后台接口路由
//商户后台
Route::rule('login', 'user/Index/login');
//商户后台管理模版
Route::rule('user','user/Index/user');
//商户登陆接口路由
Route::rule('user_login','user/Index/user_login');
//设置注册商户接口路由
Route::rule('register','user/Index/register');
//请求商户首页信息显示接口路由
Route::rule('getUserIndex','user/Index/getUserIndex');
//请求商户信息接口路由
Route::rule('getUser','user/Index/getUser');
//请求订单列表
Route::rule('getUserOrderList','user/Index/getUserOrderList');
//请求搜索订单
Route::rule('getUserSearchOrderList','user/Index/getUserSearchOrderList');
//设置商户信息接口路由
Route::rule('setUser','user/Index/setUser');
//找回密码接口
Route::rule('findPasswd','user/Index/findPasswd');


//支付接口路由


//聚合支付接口路由
Route::rule('pay','pay/Index/pay');  

//PC端监控路由
Route::rule('pc_cron', 'pay/Api/pc_cron');

//微信支付路由
Route::rule('WechatPay','pay/WechatPay/WechatPay');  //微信支付接口路由
Route::rule('wechatPay_notify','pay/WechatPay/wechatPay_notify');  //微信支付异步通知地址路由
Route::rule('wechatPay_return','pay/WechatPay/wechatPay_return');  //微信支付同步通知地址路由
//支付宝支付
Route::rule('alipay','pay/Alipay/alipay');   //支付宝支付接口路由
Route::rule('alipay_notify','pay/Alipay/alipay_notify');  //支付宝异步通知地址
Route::rule('alipay_return','pay/Alipay/alipay_return');    //支付同步通知地址
Route::rule('AlipayOperationRefund','pay/Alipay/AlipayOperationRefund');    //支付宝退款操作接口
Route::rule('AlipayOperationCheck','pay/Alipay/AlipayOperationCheck');    //请求查询订单操作接口