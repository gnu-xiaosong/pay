#  pay第三方支付系统，自带监控软件和后台管理系统+商户后台管理系统
## 开发者
* 所有人:小松科技
* 邮箱:1829134124@qq.com
* 说明:有任何问题都可以私信我
## 软件支付监听对象:
* 支付-------ok
* 微信支付------ok
* QQ------暂时不支持
## 安全声明:
* 不建议用于商业用途，该程序不适用于大型支付场景，适用于小型支付场景。监听成功比例与支付接口调用频率成反比。
* 每个个体支付时间间隔需要大于2分钟。该时长与支付页面等待时长一致。
* 设置不同金额会增加监听支付成功比例。
* 后期会不断优化提高支付成功比例。
## 下载:
* 蓝奏云下载: [点我下载](https://fusong.lanzous.com/b01c5m8aj
)密码:felk 
## 介绍:
* 前端利用vue开发，
* 后端利用thinkphp开发
## 项目核心目录结构
~~~
├─application           接口目录
│  ├─index             首页接口目录
│  ├─admin             管理员后台接口目录
│  ├─user              商户后台接口目录
│  ├─api               公共接口目录
│  └─route.php         路由配置文件
├─demo                 支付系统测试目录(demo)
│  
├─SDK                  支付系统集成sdk下载目录(更新时保持其文件名不变！！！，否则会下载出错)
│  ├─sdk.zip          集成支付系统SDK压缩包
│  └─云支付.apk        监控软件
│
├─template               模版目录
│  ├─admin              管理员后台模版目录
│  └─user               商户后台模版目录
│
├─pay                    支付系统核心源码{核心源码}
│  ├─js                 js类库目录
│  ├─lib                相关类库目录
│  ├─payPage            支付界面模版目录
│  │ └─pay_pages_default.php    默认支付界面文件
│  ├─corn.php           监控软件端请求接口
│  ├─api.php            支付接口(核心接口)
│  ├─payCorn.php        网页端付款状态循环请求状态接口
│  ├─notifaction.php    支付回调通知处理文件(常用于同步通知和异步通知处理)
│  ├─qr.php             支付二维码生成文件
│  ├─database.php       数据库配置文件
│  └─db.sql             数据库备份文件
│
├─public                 WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─install            系统程序安装引导文件目录
│     ├─config.db.php   系统数据库配置文件(修改数据库信息在这里修改)
│     └─install.lock    安装锁文件(需要重新安装程序时删除该文件和config.db.php文件即可)
│ 
├─thinkphp              thinkphp核心类库源码目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─index.phhp            项目入口文件
~~~
### 核心后端源码文件:
* api.php:网页端请求接口
* corn.php:监控软件端请求接口
* db.sql:创建数据库文件(导入即可)
* payCorn.php:网页端付款状态循环请求状态接口
* notifaction.php 支付成功支付回调处理文件
## 截图展示
#### 支付界面截图:
[![DkpxF1.jpg](https://s3.ax1x.com/2020/11/16/DkpxF1.jpg)](https://imgchr.com/i/DkpxF1)
#### 后台管理系统截图:
[![69CbKP.jpg](https://s3.ax1x.com/2021/02/27/69CbKP.jpg)](https://imgtu.com/i/69CbKP)
#### 商户后台系统截图:
[![69C2DK.jpg](https://s3.ax1x.com/2021/02/27/69C2DK.jpg)](https://imgtu.com/i/69C2DK)
## 通用接口地址:
* 支付接口:```http://域名/pay/api.php```
* 软件监控地址:```http://域名/pay/corn.php```
* demo测试地址:```http://域名/demo```
* 监控软件下载地址:```http://域名/SDK/云支付.apk```
* 集成包SDK下载地址:```http://域名/SDK/sdk.zip```
### 体验:
>如果不想自己搭建系统，可以在这里申请商户集成。
* 管理员后台:[点我进入](http://103.152.170.170:8083/public/index.php/admin)
* 商户后台:[点我进入](http://103.152.170.170:8083/public/index.php/user)
* 支付测试:[点我进入](http://103.152.170.170:8083/demo)
## 系统搭建使用方法:
* 解压放入网站目录下访问域名即可(如果需要全新安装只需要删除/public/install 目录下的install.lock和config.db.php文件即可)
* 提示:在宝塔环境下会出现没有入口文件的情况 ,需要删除宝塔生成的防跨站文件.user.ini文件即可
## 商户对接方法:
* 第一步:申请商户:到官网[这里的官网指用该程序搭建的网站]注册申请商户信息([点我注册](http://103.152.170.170:8083/public/index.php/user))
* 第二步:下载监控软件和SDK集成包:登陆商户后台，
* 第三步:基层SDK到自己网站:下载集成SDK包集成到自己的网站(看开发文档)
## 文档说明:
#### SDK对接文档:
###### 核心文件:
* yunPay.config.php:商户信息配置文件
* yunApi.php: 调用SDK支付接口文件
* notify_url.php: 异步支付处理文件
* return_url.php: 同步跳转处理文件(主要SDK集成业务逻辑处理文件)
###### yunApi.php接收参数:
>请求方法:同时支持GET或POST

>说明:具体参数详见SDK下的help.txt文件说明。具体以SDK下的help.txt文件为准

| 参数 | 含义    |类型 | 说明  |
|:--------:|:-------------:|:-------------:|:-------------:|
| trade_no  | 商户网站订单编号 | int| 必传 |
| type   | 支付类型 (支付宝1，微信2，QQ支付3)| int| 必传 |
| goods_name  | 商品名 |string|  必传 |
| money | 金额 | float| 必传 |
| pay_tag  | 商品备注 | string| 可传 |
| description  | 商品描述 | string| 可传 |
| sitename | 站点名称 | string| 可传 |
###### 商户信息配置文件yunPay.config.php:
```php
<?php
/* *
 * 功能：云支付商户信息配置
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究云支付接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 */

/**********↓↓↓↓↓云支付商户信息↓↓↓↓↓↓**********/

//云支付商户ID
$yunPay_config['id'] =  10008 ;

//云支付商户密钥
$yunPay_config['key'] = "Pyy9USk7cVyi2MZNI7LghulwugkGVrGL";

//云支付签名token 必填
$yunPay_config['token'] = "xskj";

//签名方式 不需修改
$yunPay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$yunPay_config['input_charset']= strtolower('utf-8');

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$yunPay_config['transport']    = 'http';

//异步通知地址，如果改SDK上传在根目录则默认不用修改，否则应该修改
$yunPay_config['notify_url'] = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/yunPay/notify_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数

//页面跳转同步通知页面路径
$yunPay_config['return_url'] = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/yunPay/return_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
   
//支付API地址   后面不要加"/"
$yunPay_config['apiurl']    = 'http://103.152.170.170:8083/pay/api.php';
```
###### 支付回调参数(暂时为同步通知回调return_url.php):
>回调方法:GET

>说明:具体参数详见SDK下的help.txt文件说明。具体以SDK下的help.txt文件为准

| 参数 | 含义     | 类型  |
|:--------:|:-------------:|:-------------:|
| status  | 支付状态 | int(1:支付成功;0:未支付)| 
| type   | 支付类型 (支付宝1，微信2，QQ支付3)| int| 
| money | 金额 | float| 
| trade_no   | 商户网站订单编号(非云订单号) | string| 
| sign  | 签名 | string  |

* 签名算法:md5
* 算法公式:status+money+trade_no
* php算法例子:
```php
md5($status.$money.$trade_no)
```
* 说明:sdk已经为您封装好了签名算法，您只需要处理接收参数逻辑即可
* 同步回调(return_url.php)SDK代码:
```php
<?php
/*
*介绍:这是同步通知处理
*时间:2021-2-27
*开发者:小松科技
*/

/****接口参数文档:
Methods:GET
接收参数:
@param: status   支付状态  int  1:成功;0:失败
@param: money   支付金额  int 
@param: type  支付类型 int  1：支付宝 2：QQ钱包 3：微信支付。默认值：1
@param: trade_no  商户网站订单编号 int 
@param: sign    签名   string
**/
require_once("lib/Sign.php");
$order=array(
  "sign"=>$_GET["sign"],
  "status"=>$_GET["status"],
  "money"=>$_GET["money"],
  "type"=>$_GET["type"],
  "trade_no"=>$_GET["trade_no"]
);
//验证签名算法
$result=new Sign($order);
$is=$result->verify_sign();
if($is){
//验证签名成功↓↓↓↓↓↓↓↓↓这里处理自己的业务逻辑

echo "支付成功！";

}else{
//验证签名失败
echo "签名验证失败！";
}
```
##### 监听软件设置:
* 声明:该支付监听软件只监听微信和支付宝支付金额信息。不会监听其他敏感信息。更不会监听用户个人信息。源代码完全开放(如下)(请大家下载正版官网的监听软件，以防被二次开发从事用户信息监听。！！！)
```javascript
auto();
var str;
var str1;
//启动通知栏监控
events.observeNotification();
events.on("notification", function(n){
            if(n.getTitle()!= null){
               //支付宝监听
                if (n.getPackageName() == "com.eg.android.AlipayGphone"){
                    str = n.getTitle();
                    //支付宝通过正则判断提取
                    str1 = str.match(/你已成功收款(.*)元/);
                    if (str1 != null) {
                        //获取成功
                        log(str1);
                        log(str1[1]);
                        //调用api
                        var response = payApi(str1[1], 1);
                        //写进日志文件
                        writeLog(response, 1);
                        toast("小松云支付:" + response);
                    }
                } 
                //微信支付监听
                if(n.getPackageName() == "com.tencent.mm" && n.getTitle() == "微信支付"){
                    str1 = n.getText();
                    //支付宝通过正则判断提取
                    str2 = str1.match(/微信支付收款(.*)元/);
                    log(str2);
                    if(str2 != null){
                        //获取成功
                        log(str2);
                        log(str2[1]);
                        //调用api
                        var response1 = payApi(str2[1], 2);
                        //写进日志文件
                        writeLog(response1, 2);
                        toast("小松云支付:" + response1);
                    }
                   }      
                   //打印
                    log(n.getTitle());
                }            
});
            //支付异步回调api
            function payApi(money, type) {

                /*参数说明:
                 *@param:money  金额
                 *@param:type   支付方式(支付宝1,微信2, QQ3)
                 */
                //本地数据获取
                var storage = storages.create("pay");
                var data = storage.get("paySite");
                //接口地址
                var url = data.url;
                //传输内容
                var data1 = {
                    "id": data.ID,
                    "key": data.key,
                    "money": money,
                    "type": type
                };
                //发起请求
                var res = http.get(url + "?id=" + data1.id + "&key=" + data1.key + "&money=" + data1.money + "&type=" + data1.type);
                log(res.statusCode);
                //res响应判断
                if (res.statusCode == 404) {

                    return "网络异常或url有误！";
                } else if (res.statusCode >= 200 && res.statusCode < 300) {
                    //回调成功
                    var resp = res.body.string();
                    log(resp);
                    return resp;
                } else {
                    return "未知异常";
                }
            }
            function writeLog(inform, type) {
                /*参数说明:
                 *@param:inform  返回信息
                 *@param:type   支付方式(支付宝1,微信2, QQ3)
                 */
                //获取当前时间
                var date = new Date();
                //年
                var year = date.getFullYear();
                //月
                var month = date.getMonth() + 1;
                //日
                var day = date.getDate();
                //时
                var hh = date.getHours();
                //分
                var mm = date.getMinutes();
                //秒
                var ss = date.getSeconds();
                var time = year + "年" + month + "月" + day + "日" + hh + ":" + mm + ":" + ss;
                //支付方式判断
                if (type == 1) {
                    pay_type = "支付宝";
                } else if (type == 2) {
                    pay_type = "微信";
                } else if (type == 3) {
                    pay_type = "QQ";
                } else {
                    pay_type = "未知支付方式";
                }
                //订单编号 正则匹配
                var order_no = inform.match(/\d+/i);
                //服务器返回信息
                var information =
                    "时间:" + time + "\r\n" +
                    "订单编号:" + order_no + "\r\n" +
                    "支付方式:" + pay_type + "\r\n" +
                    "状态信息:" + inform + "\r\n" +
                    "\r\n";
                var path = "/sdcard/payLog.txt";
                if (!files.exists(path)) {
                    files.create(path);
                    files.append(path, "软件监控服务器日志信息:\r\n");
                }
                files.append(path, information);
                log(information);
            }
```
* 所需权限:通知栏权限,无障碍。
* 支付宝:支付宝请打开收款语音提示(不要调成静音模式)
* 微信:开启微信收款到账提示
* 监听软件(云支付):保持软件持续运行,让软件保持存活状态,以免被系统查杀。

## 注意事项:
* 软件一定要给予通知栏权限！！(否则无法监控)，自启动，以防被杀死
* 支付宝语音一定要打开，保证能正常播报,授予微信消息通知权限
* 软件监控订单日志文件在sd卡目录下的payLog.txt文件

## 对接开发文档:
* 开发中
# 日志:
## 2020-12-14 全新改版！功能全部实现。
## 2020-12-15 修复监控bug，添加跳转到支付宝app，修复监控安全问题，强制更新！
## 2021-1-11  添加支付成功提示
## 2021-1-13  添加监听微信支付和qq支付(暂时监听功能不可用)
## 2020-1-14  添加集成SDK包，全新SDK版支付系统重构
## 捐赠:
[捐赠](http://103.152.170.170:8083/demo)
