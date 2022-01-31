<?php
/* *
 * 功能：云支付接口文件
 * 开发者:小松科技
 * 时间:2021.1.13
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究云支付接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 */
require_once("yunPay.config.php");
require_once("./lib/yunPay_md5.function.php");

/**************************请求参数，支持GET和POST两种请求方法**************************/

/*请求参数:
*@param:trade_no  string  订单编号    必传   商户网站唯一订单编号
*@param:type       int     支付类型    必传   支付宝1，微信2，QQ支付3
*@param:goods_name  string    商品名   必传  商户订单商品名称
*@param:money    int(float)    商品实际支付金额   必传  该商品的实际金额
*@param:yun_type    int(float)    云支付监控支付类型   必传 


*@param:pay_methods    int(float)    官方支付类型  必传 
*@param:pay_tag  string      商品备注   可选    该商品的订单备注
*@param:description  string    商品描述  可选    该商品的订单描述
*@param:sitename  string      站点名称  可选    站点名称
*@param:category   string     商品分类  可选
*/





        //异步通知地址
        $notify_url = $yunPay_config['notify_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = $yunPay_config['return_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        
        
        
        
        
  if($_SERVER['REQUEST_METHOD']=="GET"){      
        //商户订单号
        $trade_no = $_GET['trade_no'];
        //商户网站订单系统中唯一订单号，必填
		//支付方式
        $type = $_GET['type'];
        //商品名称
        $goods_name = $_GET['goods_name'];
		//付款金额
        $money = $_GET['money'];
        //云监控支付类型
        $yun_type=isset($_GET['yun_type'])?$_GET['yun_type']:1;
        //官方支付类型
        $pay_methods=isset($_GET['pay_methods'])?$_GET['pay_methods']:"web";
        
        
        
		//站点名称
        $sitename = isset($_GET["sitename"])?$_GET["sitename"]:'小松云支付测试站点';
        //订单备注(选填)
        $pay_tag  = isset($_GET["pay_tag"])?$_GET["pay_tag"]:"未备注商品";
        //分类(选填)
        $category = isset($_GET["category"]) ? $_GET["category"] : "无分类";
        //描述(选填)
        $description = isset($_GET["description"])?$_GET["description"]:"未描述商品";
      }else if($_SERVER['REQUEST_METHOD']=="POST"){
                   //商户订单号
        $trade_no = $_POST['trade_no'];
        //商户网站订单系统中唯一订单号，必填
		//支付方式
        $type = $_POST['type'];
        //商品名称
        $goods_name = $_POST['goods_name'];
		//付款金额
        $money = $_POST['money'];
        //云监控支付类型
        $yun_type=isset($_GET['yun_type'])?$_GET['yun_type']:1;
        //官方支付类型
        $pay_methods=isset($_GET['pay_methods'])?$_GET['pay_methods']:"web";
        
        
		//站点名称
        $sitename = isset($_POST["sitename"])?$_POST["sitename"]:'小松云支付测试站点';
        //订单备注(选填)
        $pay_tag  = isset($_POST["pay_tag"])?$_POST["pay_tag"]:"未备注商品";
        //分类(选填)
        $category = isset($_POST["category"]) ? $_POST["category"] : "无分类";
        //描述(选填)
        $description = isset($_POST["description"])?$_POST["description"]:"未描述商品";
      }else{
         //禁止请求方法
         echo "禁止请求方法";
         exit();
      }
   


/************************************************************/
//构造要请求的参数数组，无需改动
$parameter = array(
		"id" => $yunPay_config['id'],   
		"key"=>$yunPay_config['key'],
		"type" => $type,
        "category"=>$category,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"trade_no"	=> $trade_no,
		"total_amount"	=> $money,
		"subject"	=> $goods_name,		
		"sitename"	=> $sitename,
		"yun_type"=>$yun_type,
		"description"=> $description,
		"pay_methods"=>$pay_methods,
		"remark"=>$pay_tag
);



//字符串签名(默认MD5加签)
//签名算法规则:total_amount(金额)+trade_no(商户网站订单编号)+key(商户密钥)
   
$sign=md5($parameter["total_amount"].$parameter["trade_no"].$parameter["key"]);

    /*
    *说明:该接口为集成支付接口方法(聚合支付接口)
    *methods:GET
    *@param: id int  商户id [必传]
    *@param: sign string  签名  [必传]  //签名算法规则:total_amount(金额)+trade_no(商户网站订单编号)+key(商户密钥)
    *@param: trade_no string  商户网站订单编号  [必传]
    *@param: type int    支付类型 *0:支付宝；1:微信；码支付:2；3:云支付  [必传]
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
    
//提交发起请求
header("location:".$yunPay_config['apiurl']
    ."?id=".$parameter["id"]
    ."&sign=".$sign
    ."&type=".$parameter["type"]
    ."&trade_no=".$parameter["trade_no"]
    ."&notify_url=".$parameter["notify_url"]
    ."&return_url=".$parameter["return_url"]
    ."&subject=".$parameter["subject"]
    ."&total_amount=".$parameter["total_amount"]
    ."&description=".$parameter["description"]
    ."&remark=".$parameter["remark"]
    ."&category=".$parameter["category"]
    ."&yun_type=".$parameter["yun_type"]
    ."&pay_methods=".$parameter["pay_methods"]
    );
  