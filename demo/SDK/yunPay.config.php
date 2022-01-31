<?php
/* *
 * 功能：云支付商户信息配置
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 */


/**********↓↓↓↓↓云支付商户信息↓↓↓↓↓↓**********/

//云支付商户ID
$yunPay_config['id'] =  10001;

//云支付商户密钥
$yunPay_config['key'] = "ARfXImoK54lgfZmMwHBjO0OcPaAG5DEZ";

//云支付签名token 必填
$yunPay_config['token'] = "xskj";

//签名方式 不需修改
$yunPay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$yunPay_config['input_charset']= strtolower('utf-8');



//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$yunPay_config['transport']    = 'http';


//异步通知地址，如果改SDK上传在根目录则默认不用修改，否则应该修改
$yunPay_config['notify_url'] = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/demo/SDK/notify_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数


//页面跳转同步通知页面路径
$yunPay_config['return_url'] = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/demo/SDK/return_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
       
       
//支付API地址   后面不要加"/"
$yunPay_config['apiurl']    = 'http://www.pay.com/public/index.php/pay';